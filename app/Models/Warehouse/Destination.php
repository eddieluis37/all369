<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wre_destinations';

    protected $fillable = [
        'name',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
