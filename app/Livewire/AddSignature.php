<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rrhh\OrganizationalUnit;
use App\Models\User;

class AddSignature extends Component
{
    public $organizationalUnits, $users, $visators, $signers;
    public $inputs = [];
    public $i = 1;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function getusers()
    {
        $this->users = OrganizationalUnit::find($this->visators[0])->users;
        //dd($this->users);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        //$this->users = User::where('organizationalUnit')

        $this->organizationalUnits = OrganizationalUnit::where('establishment_id',38)->orderBy('id','asc')->get();
        return view('livewire.add-signature');
    }
}
