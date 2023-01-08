<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    public function showData(){
        $brand = Brand::all();
        return view('admin.brand.index',compact('brand'));
    }
    public function addData(){
        return view('admin.brand.create');
    }
    public function storeData(Request $request){


        $rules = [
            'brand_id'=>'required|max:15',
            'brand_name'=>'required|max:15',
        ];
        $this->validate($request, $rules, );

        $brand = new Brand();
        $brand->brand_id = $request->brand_id;
        $brand->brand_name = $request->brand_name;
        $brand->save();
        $msg='Data Successfully Added'; 
        return redirect()-> route('admin.brn.index')->with('msg',$msg);

    }
    public function editData($id) {
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }


    public function updateData(Request $request,$id){

        

        $rules = [
            'brand_id'=>'required|max:15',
            'brand_name'=>'required|max:15',
        ];
        $this->validate($request, $rules, );

        $brand = Brand::find($id);
        $brand->brand_id = $request->brand_id;
        $brand->brand_name = $request->brand_name;
        $brand->save();
        $msg='Data Successfully Updated'; 
        return redirect()-> route('admin.brn.index')->with('msg',$msg);

    }

    public function deleteData($id=null) {
        $deleteData = Brand::find($id);
        $deleteData->delete();
        $msg='Data Successfully Deleted'; 
        return redirect()-> route('admin.brn.index')->with('msg',$msg);
    }

}