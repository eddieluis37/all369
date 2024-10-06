<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftClose extends Model
{
    use HasFactory;
    protected $table = 'rrhh_shift_close';
    protected $fillable = [ 'status','total_hours' ,'first_confirmation_commentary','first_confirmation_status','first_confirmation_date','close_commentary' ,'close_status' ,'close_date' ,'date_of_closing_id' ,'first_confirmation_user_id' ,'close_user_id' ,'owner_of_the_days_id' ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_of_the_days_id');
    }

    public function status()
    {   
        $name = "";
        if( $this->status == 1 ){
            $name = "Confirmado";
        
        }elseif ($this->status == 2) {
            $name = "Cerrado";
            
        }elseif ($this->status == 3){
            $name = "Rechazado";

        }elseif ($this->status == 4){
            $name = "Confirmado - Rechazado";

        }

        return  array("id"=>$this->status,"name"=>$name);
    }


}
