<?php

namespace App\Models\ServiceRequests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Subdirection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'status'
    ];

    protected $table = 'doc_subdirections';
}
