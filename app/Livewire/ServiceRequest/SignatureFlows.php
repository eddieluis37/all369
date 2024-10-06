<?php

namespace App\Livewire\ServiceRequest;

use Illuminate\Support\Facades\Auth;
use App\Models\Rrhh\Authority;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class SignatureFlows extends Component
{
    public $program_contract_type;
    public $type;
    public $signatureFlows = [];
    public $a;

    #[On('listener')]
    public function listener($program_contract_type = NULL, $type = NULL)
    {
        $this->signatureFlows = NULL;
        $this->program_contract_type = $program_contract_type;
        $this->type = $type;
    }

    public function render()
    {
      $users = User::orderBy('name','ASC')->get();

      if ($this->type == NULL || $this->type == "Covid") {
        if ($this->program_contract_type == "Mensual") {
          $this->a = "mensual";
          if (auth()->user()->organizationalUnit->establishment_id == 38) {
            //Hector Reyno (CGU)
            if (auth()->user()->organizationalUnit->id == 24) {
              $this->signatureFlows['RRHH CGU'] = 10739552; //RR.HH del CGU
              $this->signatureFlows['Directora CGU'] = 14745638; // 24 - Consultorio General Urbano Dr. Hector Reyno
              $this->signatureFlows['S.D.G.A SSI'] = 14104369; // 2 - Subdirección de Gestion Asistencial / Subdirección Médica
              $this->signatureFlows['Planificación CG RRHH'] = 14112543; // 59 - Planificación y Control de Gestión de Recursos Humanos
              $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
              $this->signatureFlows['S.D.A SSI'] = 9994426; // 31 - Subdirección de Recursos Físicos y Financieros
              $this->signatureFlows['Director SSI'] = 9381231; // 1 - Dirección
            }
            //servicio de salud iqq
            else{
              $this->signatureFlows['S.D.G.A SSI'] = 14104369; // 2 - Subdirección de Gestion Asistencial / Subdirección Médica
              $this->signatureFlows['Planificación CG RRHH'] = 14112543; // 59 - Planificación y Control de Gestión de Recursos Humanos
              $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
              $this->signatureFlows['S.D.A SSI'] = 9994426; // 31 - Subdirección de Recursos Físicos y Financieros
              $this->signatureFlows['Director SSI'] = 9381231; // 1 - Dirección
            }
          }
          //hospital
          elseif(auth()->user()->organizationalUnit->establishment_id == 1){
            $this->signatureFlows['Subdirector'] = 12621281; // 88 - Subdirección Médica - 9882506 - (iriondo)
            $this->signatureFlows['S.D.G.A SSI'] = 14104369; // 2 - Subdirección de Gestion Asistencial / Subdirección Médica
            $this->signatureFlows['S.G.D.P Hospital'] = 16390845; // 86 - Subdirección de Gestión de Desarrollo de las Personas
            $this->signatureFlows['Jefe Finanzas'] = 13866194; // 11 - Departamento de Finanzas
            $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
            $this->signatureFlows['Director Hospital'] = 14101085; // 84 - Dirección
          }
        }elseif ($this->program_contract_type == "Horas") {
          $this->a = "horas";
          if (auth()->user()->organizationalUnit->establishment_id == 38) {
            //Hector Reyno (CGU)
            if (auth()->user()->organizationalUnit->id == 24) {
              $this->signatureFlows['Funcionario'] = 10739552; // 24 - Consultorio General Urbano Dr. Hector Reyno
              $this->signatureFlows['Directora CGU'] = 14745638; // 24 - Consultorio General Urbano Dr. Hector Reyno
              $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
              $this->signatureFlows['S.D.A SSI'] = 9994426; // 31 - Subdirección de Recursos Físicos y Financieros
            }
            //servicio de salud iqq
            else{
              $this->signatureFlows['Planificación CG RRHH'] = 14112543; // 59 - Planificación y Control de Gestión de Recursos Humanos
              $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
              $this->signatureFlows['S.D.A SSI'] = 9994426; // 31 - Subdirección de Recursos Físicos y Financieros
            }
          }
          //hospital
          elseif(auth()->user()->organizationalUnit->establishment_id == 1){
            $this->signatureFlows['Subdirector'] = 12621281; // 88 - Subdirección Médica - 9882506 - (iriondo)
            $this->signatureFlows['S.G.D.P Hospital'] = 16390845; // 86 - Subdirección de Gestión de Desarrollo de las Personas
            $this->signatureFlows['Jefe Finanzas'] = 13866194; // 11 - Departamento de Finanzas
          }
        }
      }else{
        if (auth()->user()->organizationalUnit->establishment_id == 1) {
          $this->a = "suma";
          $this->signatureFlows['S.G.D.P Hospital'] = 16390845;
          $this->signatureFlows['Jefe Finanzas'] = 13866194;
          $this->signatureFlows['Director Hospital'] = 14101085;
        }else{
          $this->signatureFlows['Planificación CG RRHH'] = 14112543; // 59 - Planificación y Control de Gestión de Recursos Humanos
          $this->signatureFlows['S.G.D.P SSI'] = 15685508; // 44 - Subdirección de Gestión y Desarrollo de las Personas
          $this->signatureFlows['S.D.A SSI'] = 9994426; // 31 - Subdirección de Recursos Físicos y Financieros
        }
      }

        return view('livewire.service-request.signature-flows',compact('users'));
    }
}
