<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftDayHistoryOfChanges extends Model
{
    use HasFactory;

    protected $fillable = [ 'previous_user','current_user','previous_value','current_value','day','modified_by','change_type','commentary','shift_user_day_id'];
    protected $table = 'rrhh_shift_day_hitory_of_changes';
	/*change_type: 0:asignado 1:cambio estado, 2 cambio de tipo de jornada, 3 intercambio con otro usuario;4:Confirmado por el usuario 5: confirmado por el administrador, 6:rechazado por usuario?, 7 Dejar disponible,8 Dispomnible ya tomado, 9 solicitud de dia,10:suplencia  */
    public function ShiftUserDay()
	{
    	return $this->belongsTo(ShiftUserDay::class, 'shift_user_day_id');
	}
	public function PreviousUser()
	{
    	return $this->belongsTo(User::class, 'previous_user');
	}
	public function CurrentUser()
	{
    	return $this->belongsTo(User::class, 'current_user');
	}
	public function ModifiedBy()
	{
    	return $this->belongsTo(User::class, 'modified_by');
	}
}
