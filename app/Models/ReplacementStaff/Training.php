<?php

namespace App\Models\ReplacementStaff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'training_name', 'hours_training', 'file','replacement_staff_id'
    ];

    public function replacement_staff() {
        return $this->belongsTo('App\Models\ReplacementStaff\ReplacementStaff');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $table = 'rst_trainings';
}
