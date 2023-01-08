<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Brand;
use App\Supplier;
use App\UnitOfMeasarement;



class Product extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'supplier_id',
        'category_id',
        'brand_id',
        'code',
        'uom_name',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function supplier()
    {
        return $this->hasOne(supplier::class,'id','supplier_id');
    }

    public function uom()
    {
        return $this->hasOne(UnitOfMeasarement::class,'id','uom_name');
    }
}

