<?php

namespace App;

use App\SellItem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ]; 

    protected $fillable = [
        'ref_no',
        'supplier_id',
        'date',
        'total_product',
        'discount',
        'vat',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function purchase_item()
    {
        return $this->hasMany(PurchaseItem::class,  'purchase_id', 'id');
    }
}