<?php

namespace App\Livewire\ServiceRequest;

use Livewire\Component;
use App\Models\ServiceRequests\ServiceRequest;
use App\Models\Rrhh\UserBankAccount;
use App\Models\User;
use App\Models\Parameters\Bank;

class UpdateAccount extends Component
{
    public $bank_id;
    public $banks;
    public $account_number;
    public $pay_method;
    public $serviceRequest;
    public $bankaccount;
    public $user;

    public $phone_number;
    public $email;
    //

    protected $rules = [
        'account_number' => 'required|integer',
        'bank_id' => 'required',
        'pay_method' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email',
    ];

    protected $messages = [
        'account_number.required' => 'Debe Ingresar Número de Cuenta',
        'bank_id.required' => 'Debe Seleccionar un Banco',
        'pay_method.required' => 'Debe Seleccionar una Forma de Pago',
        'phone_number.required' => 'Debe Ingresar su Número Telefónico',
        'email.required' => 'Debe Ingresar un Correo Electrónico',
        'email.email' => 'El Formato del Correo Electrónico no es válido',
        'account_number.integer' => 'Debe Ingresar solo números ej:123456789',
    ];




    public function save()
    {
      // dd($this->serviceRequest->employee);
        $this->validate();

        // $this->serviceRequest->employee->bankAccount->bank_id = $this->bank_id;
        // $this->serviceRequest->employee->bankAccount->number = $this->account_number;
        // $this->serviceRequest->employee->bankAccount->type = $this->pay_method;
        // $this->serviceRequest->employee->bankAccount->save();

        //devuelve user o lo crea
        $userBankAccount = UserBankAccount::updateOrCreate(
            ['user_id' => $this->user->id],
            ['bank_id' => $this->bank_id,
             'number' => $this->account_number,
             'type' => $this->pay_method]
        );

        $user = User::updateOrCreate(
            ['id' => $this->user->id],
            ['phone_number' => $this->phone_number,
             'email' => $this->email]
        );

        // $this->serviceRequest->employee->phone_number = $this->phone_number;
        // $this->serviceRequest->employee->email = $this->email;
        //$this->serviceRequest->phone_number = $this->phone_number;
        //$this->serviceRequest->email = $this->email;

        //$this->user->save();

        //$this->userBankAccount->save();
        //$this->serviceRequest->save();
        session()->flash('message', 'Información Bancaria Actualizada Exitosamente');
    }

    public function mount()
    {
        if($this->bankaccount){
        if ($this->bankaccount->bank) {
          $this->bank_id = $this->bankaccount->bank_id;
          $this->account_number = $this->bankaccount->number;
          $this->pay_method = $this->bankaccount->type;
        }
    }

        $this->phone_number = $this->user->phone_number;
        $this->email = $this->user->email;
    
    }

    public function render()
    {
        //if($this->bankaccount){
        $this->banks = Bank::where('active_agreement',true)->get();
        return view('livewire.service-request.update-account');
        //}
        // else{
        //     return view('-empty');
        // }
        
    }

}
