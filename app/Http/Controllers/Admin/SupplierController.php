<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Session;

class SupplierController extends Controller
{
    public function showData(){
        $suppliers = Supplier::all();
        return view('admin.supplier.index',compact('suppliers'));
    }
    public function addData(){
        return view('admin.supplier.create');
    }
    public function storeData(Request $request){


        $rules = [
            'supplier_id'=>'required|max:15',
            'name'=>'required|max:15',
        ];
        $this->validate($request, $rules );

        $supplier = new Supplier();
        $supplier->supplier_id = $request->supplier_id;
        $supplier->name = $request->name;
        $supplier->save();
        $msg='Data Successfully Added'; 
        return redirect()-> route('admin.sup.index')->with('msg',$msg);

    }
    public function editData($id) {
        $supplier = Supplier::find($id);
        return view('admin.supplier.edit',compact('supplier'));
    }


    public function updateData(Request $request,$id){

        

        $rules = [
            'supplier_id'=>'required|max:15',
            'name'=>'required|max:15',
        ];
        $this->validate($request, $rules, );

        $supplier = Supplier::find($id);
        $supplier->supplier_id = $request->supplier_id;
        $supplier->name = $request->name;
        $supplier->save();
        $msg='Data Successfully Updated'; 
        return redirect()-> route('admin.sup.index')->with('msg',$msg);

    }

    public function deleteData($id=null) {
        $deleteData = Supplier::find($id);
        $deleteData->delete();
        $msg='Data Successfully Deleted'; 
        return redirect()-> route('admin.sup.index')->with('msg',$msg);
    }

}