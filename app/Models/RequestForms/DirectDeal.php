<?php

namespace App\Models\RequestForms;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RequestForms\PurchasingProcessDetail;
use App\Models\Parameters\Supplier;
use App\Models\Parameters\PurchaseType;

class DirectDeal extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'purchase_type_id' ,'description', 'is_lower_amount', 'resol_direct_deal', 'resol_contract', 'guarantee_ticket', 'guarantee_ticket_exp_date', 'supplier_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'guarantee_ticket_exp_date' => 'date'
    ];

    public function purchaseType()
    {
        return $this->belongsTo(PurchaseType::class, 'purchase_type_id');
    }

    public function purchasingProcessDetail()
    {
        return $this->hasOne(PurchasingProcessDetail::class);
    }

    public function attachedFiles()
    {
        return $this->hasMany(AttachedFile::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function oc()
    {
        return $this->hasOne(ImmediatePurchase::class, 'direct_deal_id');
    }

    public function findAttachedFile($name){
        return $this->attachedFiles->first( function($item) use ($name){
            return Str::contains($item->file, $name);
        });
    }

    protected $table = 'arq_direct_deals';

}
