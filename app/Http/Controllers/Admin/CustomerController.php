<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Session;

class CustomerController extends Controller
{
    public function showData(){
        $customers = Customer::all();
        return view('admin.customer.index',compact('customers'));
    }
    public function addData(){
        return view('admin.customer.create');
    }
    public function storeData(Request $request){


        $rules = [
            'customer_num'=>'required|max:15',
            'address'=>'required',
            'customer_name'=>'required',
            'email'=>'email',
            
        ];
        $this->validate($request, $rules );

        $customer = new Customer();
        $customer->customer_num = $request->customer_num;
        $customer->address = $request->address;
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->save();
        $msg='Data Successfully Added'; 
        return redirect()-> route('admin.cus.index')->with('msg',$msg);

    }
    public function editData($id) {
        $customer = Customer::find($id);
        return view('admin.customer.edit',compact('customer'));
    }


    public function updateData(Request $request,$id){

        

        $rules = [
            'customer_num'=>'required|max:15',
            'address'=>'required',
            'customer_name'=>'required',
            'email'=>'email',
        ];
        $this->validate($request, $rules, );

        $customer = new Customer();
        $customer->customer_num = $request->customer_num;
        $customer->address = $request->address;
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->save();
        $msg='Data Successfully Updated'; 
        return redirect()-> route('admin.cus.index')->with('msg',$msg);

    }

    public function deleteData($id=null) {
        $deleteData = Customer::find($id);
        $deleteData->delete();
        $msg='Data Successfully Deleted'; 
        return redirect()-> route('admin.cus.index')->with('msg',$msg);
    }

}