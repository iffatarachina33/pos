<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Purchase;
use DB;



class HomeController extends Controller
{
    public function index(){

        return view('home', $data);
    }
}