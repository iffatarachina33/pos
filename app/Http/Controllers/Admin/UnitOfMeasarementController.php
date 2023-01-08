<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UnitOfMeasarement;
use Session;

class UnitOfMeasarementController extends Controller
{
    public function showData(){
        $unit_of_measarement = UnitOfMeasarement::all();
        return view('admin.unit_of_measarement.index',compact('unit_of_measarement'));
    }
    public function addData(){
        return view('admin.unit_of_measarement.create');
    }
    public function storeData(Request $request){


        $rules = [
            'uom_name'=>'required|max:15',
            
        
        ];
        $this->validate($request, $rules, );

        $unit_of_measarement = new UnitOfMeasarement();
        $unit_of_measarement->uom_name = $request->uom_name;
        $unit_of_measarement->save();
        $msg='Data Successfully Added'; 
        return redirect()-> route('admin.uom.index')->with('msg',$msg);

    }
    public function editData($id) {
        $unit_of_measarement = UnitOfMeasarement::find($id);
        return view('admin.unit_of_measarement.edit',compact('unit_of_measarement'));
    }


    public function updateData(Request $request,$id){

        

        $rules = [
            'uom_name'=>'required|max:15',
            
        ];
        $this->validate($request, $rules, );

        $unit_of_measarement = new UnitOfMeasarement();
        $unit_of_measarement->uom_name = $request->uom_name;
        $unit_of_measarement->save();
        $msg='Data Successfully Updated'; 
        return redirect()-> route('admin.uom.index')->with('msg',$msg);

    }

    public function deleteData($id=null) {
        $deleteData = UnitOfMeasarement::find($id);
        $deleteData->delete();
        $msg='Data Successfully Deleted'; 
        return redirect()-> route('admin.uom.index')->with('msg',$msg);
    }

}