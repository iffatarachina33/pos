<?php

namespace App\Http\Controllers\Admin;
use App\Purchase;
use App\Product;
use DB;

class HomeController 
{
    public function index(){
        $data['total_amount'] = DB::table('purchases')->sum('total');
        //  dd($total_amount);

        $products = Product::all();
        $total_product = $products->count();
        
        return view('home', compact('data','total_product'));
    }
}
