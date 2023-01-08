<?php

namespace App;

use App\SellItem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sell extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref_no',
        'customer_id',
        'date',
        'total_product',
        'discount',
        'vat',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sale_item()
    {
        return $this->hasMany(SellItem::class,  'sell_id', 'id');
    }
}




