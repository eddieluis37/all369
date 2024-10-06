<?php

namespace App\Models\Pharmacies;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    protected $table = 'frm_categories';

    //relaciones
    public function products()
    {
      return $this->hasMany('App\Models\Pharmacies\Product');
    }
}
