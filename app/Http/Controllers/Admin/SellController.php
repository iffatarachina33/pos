<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sell;
use App\Product;
use App\Customer;
use App\TmpSell;
use App\SellItem;
use Session;
use DB;

class SellController extends Controller
{
    public function showData(){
        $sells = Sell::all();
        return view('admin.sell.index',compact('sells'));
    }
    public function addData(){

        $products = Product::all();
        $customers = Customer::all();    
        $sells = TmpSell::all();  
        
        

        return view('admin.sell.create',compact('products','customers','sells'));
    }
    public function storeData(Request $request){

        //dd($request->all());

        $total_amount = 0;

        if(isset($_POST['add_item'])) {
            $rules = [
                'product_id'=>'required|max:15',
               
            ];
            $this->validate($request, $rules, );
    
            $product = Product::find($request->product_id);
    
            $sell = new TmpSell();
    
            $sell->product_id = $request->product_id; 
            $sell->name = $product->name;
            $sell->rate = $product->price;
            $sell->qty = $request->qty;
            $sell->save();
            $msg='Data Successfully Added'; 
            return redirect()-> route('admin.sell.add')->with('msg',$msg);
        }

        if(isset($_POST['submit'])) {

            $tmp = TmpSell::all();
            $total_product = count($tmp);

            $sell = new Sell();
            $sell->ref_no = trim($request->ref_no);
            $sell->customer_id = $request->customer_name;
            $sell->date = $request->date;
            $sell->discount = $request->discount;
            $sell->Total_product = $total_product;
            $sell->vat = $request->vat;
            $sell->save();

            $sell_items = TmpSell::all();
            if(count($sell_items) > 0) {
                foreach($sell_items as $item) {
                    // $purchase_item = new PurchaseItem();
                    // $purchase_item->purchase_id = $purchase->id;
                    // $purchase_item->product_id = $item->product_id;
                    // $purchase_item->name = $item->name;
                    // $purchase_item->rate = $item->rate;
                    // $purchase_item->qty = $item->qty;


                    $total_amount += $item->rate*$item->qty;
                    
                    DB::table('sell_items')->insert([
                        'sell_id' => $sell->id,
                        'product_id' => $item->product_id,
                        'name' => $item->name,
                        'rate' => $item->rate,
                        'qty' => $item->qty,
                    ]);
                }

            }

            $sell = Sell::find($sell->id);
            $sell->total =  $total_amount;
            $sell->save();

            //TmpPurchase::delete();
            DB::table('tmp_sells')->delete();

            $msg='Item Successfully Added'; 
            return redirect()->route('admin.sell.index')->with('msg',$msg);

        }


    }
    public function editData($id) {
        $sell = Sell::with('sale_item')->where('id',$id)->get(); 

    

        DB::table('tmp_sells')->delete();
        foreach ($sell[0]->sale_item as $value) {
        
            $sell_tmp = new TmpSell();
            $sell_tmp->sell_id = 6;
            $sell_tmp->product_id = $value->product_id;
            $sell_tmp->name = $value->name;
            $sell_tmp->rate = $value->rate;
            $sell_tmp->qty = $value->qty;
            $sell_tmp->save();
        }
         
        $tmp_sell = TmpSell::all();

        $customers = Customer::all();
        $products = Product::all();

        return view('admin.sell.edit',compact('sell','customers','products','tmp_sell'));
    }


    public function updateData(Request $request,$id){

       

        if(isset($_POST['add_item'])) {
            $rules = [
                'product_id'=>'required|max:15',
               
            ];
            $this->validate($request, $rules, );
            
            //dd($request->product_id);
            $product = Product::find($request->product_id);
    
            $sell = new TmpSell();
            $sell->id = $id;
            $sell->product_id = $request->product_id; 
            $sell->name = $product->name;
            $sell->rate = $product->price;
            $sell->qty = $request->qty;
            $sell->save();
            $msg='Data Successfully Added'; 
            return redirect()-> route('admin.sell.edit',$id)->with('msg',$msg);
        }

        if(isset($_POST['submit'])) {

            $tmp = TmpSell::all();



            $total_product = count($tmp);

            $sell = Sell::find($id);
            $sell->ref_no = trim($request->ref_no);
            $sell->customer_id = $request->customer_name;
            $sell->date = $request->date;
            $sell->discount = $request->discount;
            $sell->Total_product = $total_product;
            $sell->vat = $request->vat;
            $sell->save();

            // $sell_items = TmpSell::all();
            // if(count($sell_items) > 0) {
            //     foreach($sell_items as $item) {
            //         // $purchase_item = new PurchaseItem();
            //         // $purchase_item->purchase_id = $purchase->id;
            //         // $purchase_item->product_id = $item->product_id;
            //         // $purchase_item->name = $item->name;
            //         // $purchase_item->rate = $item->rate;
            //         // $purchase_item->qty = $item->qty;

            //         DB::table('sell_items')->insert([
            //             'sell_id' => $sell->id,
            //             'product_id' => $item->product_id,
            //             'name' => $item->name,
            //             'rate' => $item->rate,
            //             'qty' => $item->qty,
            //         ]);
            //     }

            // }

            //TmpPurchase::delete();
            DB::table('tmp_sells')->delete();

            $msg='Item Successfully Updated'; 
            return redirect()->route('admin.sell.index')->with('msg',$msg);

        }
     
        return redirect()->route('admin.sell.index');

    }

    public function deleteData($id=null) {
        $deleteData = TmpSell::find($id);
        $deleteData->delete();
        $msg='Item Removed!!'; 
        return redirect()-> route('admin.sell.add')->with('msg',$msg);
    }

    public function deleteItem($id=null) {
        $deleteData = Sell::find($id);
        $deleteData->delete();
        $msg='Data Succesfully Deleted'; 
        return redirect()-> route('admin.sell.index')->with('msg',$msg);
    }


    public function getProductById($id)
    {
        $product = Product::find($id);
        return response()->json(['html' => $product]);
    }

}