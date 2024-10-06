<?php

namespace App\Http\Controllers\ServiceRequests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceRequests\ServiceRequest;
use App\Models\ServiceRequests\SignatureFlow;
use App\Models\ServiceRequests\Fulfillment;
use App\Mail\ServiceRequestNotification;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use App\Models\Rrhh\Authority;
use Carbon\Carbon;

class SignatureFlowController extends Controller
{
  protected $FulfillmentController;
  public function __construct(FulfillmentController $FulfillmentController)
  {
    $this->FulfillmentController = $FulfillmentController;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // $serviceRequests = ServiceRequest::orderBy('name', 'ASC')->get();
    // return view('service_requests.requests.index', compact('serviceRequests'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // $subdirections = Subdirection::orderBy('name', 'ASC')->get();
    // $responsabilityCenters = ResponsabilityCenter::orderBy('name', 'ASC')->get();
    // return view('service_requests.requests.create', compact('subdirections','responsabilityCenters'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->status != null) {
      //verifica que el proximo usuario corresponde a proximo firmante
      $serviceRequest = ServiceRequest::find($request->service_request_id);

      if ($serviceRequest->SignatureFlows->whereNull('status')->count() == 0) {
        session()->flash('danger', "No existen visaciones por realizar.");
        return redirect()->back();
      }

      if ($serviceRequest->SignatureFlows->whereNull('status')->sortBy('sign_position')->first()->responsable_id != auth()->id()) {
        session()->flash('danger', "Existe otra persona que debe visar este documento antes que usted.");
        return redirect()->back();
      }

      if ($serviceRequest->SignatureFlows->where('status', '===', 0)->count() > 0) {
        session()->flash('danger', "No es posible visar esta solicitud puesto que ya fue rechazada.");
        return redirect()->back();
      }

      //saber la organizationalUnit que tengo a cargo
      $authorities = Authority::getAmIAuthorityFromOu(Carbon::today(), 'manager', auth()->id());
      $employee = auth()->user()->position;
      if ($authorities->isNotEmpty()) {
        $employee = $authorities[0]->position; // . " - " . $authorities[0]->organizationalUnit->name;
        $ou_id = $authorities[0]->organizational_unit_id;
      } else {
        $ou_id = auth()->user()->organizational_unit_id;
      }

      //si seleccionó una opción, se agrega visto bueno.
      if ($request->status != null) {

        //Devolver
        if ($request->status == 2) {
          foreach ($serviceRequest->SignatureFlows as $key => $SignatureFlow) {
            //Devuelve firma
            $SignatureFlow->signature_date = Carbon::now();
            $SignatureFlow->status = $request->status;
            $SignatureFlow->observation = "Firma devuelta - " . $request->observation;
            $SignatureFlow->save();

            //Nuevo flujo
            $SignatureFlowNew = new SignatureFlow();
            $SignatureFlowNew->user_id = $SignatureFlow->user_id;
            $SignatureFlowNew->ou_id = $SignatureFlow->ou_id;
            $SignatureFlowNew->responsable_id = $SignatureFlow->responsable_id;
            $SignatureFlowNew->service_request_id = $SignatureFlow->service_request_id;
            $SignatureFlowNew->type = $SignatureFlow->type;
            $SignatureFlowNew->employee = $SignatureFlow->employee;
            $SignatureFlowNew->sign_position = $SignatureFlow->sign_position;
            if ($SignatureFlow->sign_position == 1) {
              $SignatureFlowNew->signature_date = Carbon::now();
              $SignatureFlowNew->status = 1;
            }
            $SignatureFlowNew->save();
          }

          session()->flash('success', 'Se ha reiniciado el flujo de firmas.');
          return redirect()->route('rrhh.service-request.index','pending');
        }
        //Aceptar o rechazar
        else {
          $SignatureFlow = SignatureFlow::where('responsable_id', auth()->id())
            ->where('service_request_id', $request->service_request_id)
            ->whereNull('status')
            ->first();

          $SignatureFlow->employee = $request->employee;
          $SignatureFlow->signature_date = Carbon::now();
          $SignatureFlow->status = $request->status;
          $SignatureFlow->observation = $request->observation;
          $SignatureFlow->save();

          $posicion = $SignatureFlow->sign_position;
          $posicion = $posicion + 1; //la firma que sigue

          //$emaildire = $serviceRequest->SignatureFlows->where('responsable_id', 9381231)->first()->user->email;
          if (env('APP_ENV') == 'production') {
            if ($serviceRequest->SignatureFlows->where('responsable_id', 9381231)->where('sign_position', $posicion)->first()) {
              $emaildire = $serviceRequest->SignatureFlows->where('responsable_id', 9381231)->where('sign_position', $posicion)->first()->user->email;
              Mail::to($emaildire)->send(new ServiceRequestNotification($serviceRequest));
            }
          }
        }



        // // send emails (next flow position)
        // try {
        //   if (env('APP_ENV') == 'production') {
        //     $email = $serviceRequest->SignatureFlows->whereNull('status')->sortBy('sign_position')->first()->user->email;
        //     Mail::to($email)->send(new ServiceRequestNotification($serviceRequest));
        //   }
        // } catch (\Exception $e) {
        //   session()->flash('success', 'Se ha registrado la visación (No se envió correo electrónico: ' . $e->getMessage() .').');
        //   return redirect()->route('rrhh.service-request.index');
        // }

        // //cuando visa responsable (2), se guarda automáticamente el cumplimiento (fulfillment) - solo para contrato por turno (horas)
        // if ($serviceRequest->program_contract_type == "Horas" && $SignatureFlow->sign_position == 2) {
        //   $this->FulfillmentController->save_approbed_fulfillment($serviceRequest);
        // }
        //
        // if ($serviceRequest->Fulfillments->count() > 0 && $serviceRequest->program_contract_type == "Horas" && ($SignatureFlow->sign_position == 4 || $SignatureFlow->sign_position == 5)) {
        //   $this->FulfillmentController->confirmFulfillmentBySignPosition($serviceRequest->Fulfillments->first(),$SignatureFlow->sign_position);
        // }

        // if ($serviceRequest->program_contract_type == "Horas" && $SignatureFlow->sign_position == 2) {
        //
        //   $fulfillment = new Fulfillment();
        //   $fulfillment->service_request_id = $serviceRequest->id;
        //   $fulfillment->type = "Horas";
        //   $fulfillment->start_date = $serviceRequest->start_date;
        //   $fulfillment->end_date = $serviceRequest->end_date;
        //   $fulfillment->observation = "Aprobaciones en flujo de firmas";
        //   $fulfillment->user_id = auth()->id();
        //   $fulfillment->save();
        //
        //   session()->flash('info', 'Se ha registrado la visación de solicitud nro: <b>'.$serviceRequest->id.'</b>. Para visualizar el certificado de confirmación, hacer click <a href="'. route('rrhh.service-request.certificate-pdf', $serviceRequest) . '" target="_blank">Aquí.</a>');
        //   return redirect()->route('rrhh.service-request.index');
        // }

      }
    }

    session()->flash('success', 'Se ha registrado la visación.');
    return redirect()->route('rrhh.service-request.index','pending');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Pharmacies\Establishment  $establishment
   * @return \Illuminate\Http\Response
   */
  public function show(ServiceRequest $serviceRequest)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Pharmacies\Establishment  $establishment
   * @return \Illuminate\Http\Response
   */
  public function edit(ServiceRequest $serviceRequest)
  {
    // $subdirections = Subdirection::orderBy('name', 'ASC')->get();
    // $responsabilityCenters = ResponsabilityCenter::orderBy('name', 'ASC')->get();
    // return view('service_requests.requests.edit', compact('serviceRequest', 'subdirections', 'responsabilityCenters'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Pharmacies\Establishment  $establishment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ServiceRequest $serviceRequest)
  {
    // $serviceRequest->fill($request->all());
    // $serviceRequest->save();
    //
    // session()->flash('info', 'La solicitud '.$serviceRequest->id.' ha sido modificada.');
    // return redirect()->route('rrhh.service-request.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Pharmacies\Establishment  $establishment
   * @return \Illuminate\Http\Response
   */
  public function destroy(ServiceRequest $serviceRequest)
  {
    //
  }
}
