<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\Product;
use App\Supplier;
use App\TmpPurchase;
use App\PurchaseItem;
use Session;
use DB;

class PurchaseController extends Controller
{
    public function showData(){
        $purchases = Purchase::all();
        return view('admin.purchase.index',compact('purchases'));
    }
    public function addData(){

        $products = Product::all();
        $suppliers = Supplier::all();    
        $purchases = TmpPurchase::all();  
        
        

        return view('admin.purchase.create',compact('products','suppliers','purchases'));
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
    
            $purchase = new TmpPurchase();
    
            $purchase->product_id = $request->product_id;
            $purchase->name = $product->name;
            $purchase->rate = $product->price;
            $purchase->qty = $request->qty;
            $purchase->save();
            $msg='Data Successfully Added'; 
            return redirect()-> route('admin.pur.add')->with('msg',$msg);
        }

        if(isset($_POST['submit'])) {

            $tmp = TmpPurchase::all();
            $total_product = count($tmp);

            $purchase = new Purchase();
            $purchase->ref_no = trim($request->ref_no);
            $purchase->supplier_id = $request->supplier_id;
            $purchase->date = $request->date;
            $purchase->discount = $request->discount;
            $purchase->Total_product = $total_product;
            $purchase->vat = $request->vat;
            $purchase->save();

            $purchase_items = TmpPurchase::all();
            if(count($purchase_items) > 0) {
                foreach($purchase_items as $item) {
                    // $purchase_item = new PurchaseItem();
                    // $purchase_item->purchase_id = $purchase->id;
                    // $purchase_item->product_id = $item->product_id;
                    // $purchase_item->name = $item->name;
                    // $purchase_item->rate = $item->rate;
                    // $purchase_item->qty = $item->qty;

                    $total_amount += $item->rate*$item->qty;

                    DB::table('purchase_items')->insert([
                        'purchase_id' => $purchase->id,
                        'product_id' => $item->product_id,
                        'name' => $item->name,
                        'rate' => $item->rate,
                        'qty' => $item->qty,
                    ]);
                }

            }

            $purchase = Purchase::find($purchase->id);
            $purchase->total =  $total_amount;
            $purchase->save();

            //TmpPurchase::delete();
            DB::table('tmp_purchases')->delete();

            $msg='Item Successfully Added'; 
            return redirect()->route('admin.pur.index')->with('msg',$msg);

        }


    }
    public function editData($id) {

            $purchase = Purchase::with('purchase_item')->where('id',$id)->get();
    
            DB::table('tmp_purchases')->delete();
            foreach ($purchase[0]->purchase_item as $value) {
            
                $purchase_tmp = new TmpPurchase();
                $purchase_tmp->purchase_id = 6;
                $purchase_tmp->product_id = $value->product_id; 
                $purchase_tmp->name = $value->name;
                $purchase_tmp->rate = $value->rate;
                $purchase_tmp->qty = $value->qty;
                $purchase_tmp->save();
            }
             
            $tmp_purchases = TmpPurchase::all();
            $suppliers = Supplier::all();
            $products = Product::all();
    
            return view('admin.purchase.edit',compact('purchase','suppliers','products','tmp_purchases'));
        }
    


    public function updateData(Request $request,$id){

        //dd($id);

        if(isset($_POST['add_item'])) {
            $rules = [
                'product_id'=>'required|max:15',
               
            ];
            $this->validate($request, $rules, );
            
            //dd($request->product_id);
            $product = Product::find($request->product_id);
    
            $purchase = new TmpPurchase();
            $purchase->id = $id;
            $purchase->product_id = $request->product_id; 
            $purchase->name = $product->name;
            $purchase->rate = $product->price;
            $purchase->qty = $request->qty;
            $purchase->save();
        $msg='Item Successfully Added'; 
        return redirect()-> route('admin.pur.edit')->with('msg',$msg);

    }

    if(isset($_POST['submit'])) {

        $tmp = TmpPurchase::all();



        $total_product = count($tmp);

        $purchase = Purchase::find($id);
        $purchase->ref_no = trim($request->ref_no);
        $purchase->supplier_id = $request->supplier_name;
        $purchase->date = $request->date;
        $purchase->discount = $request->discount;
        $purchase->Total_product = $total_product;
        $purchase->vat = $request->vat;
        $purchase->save();

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
        DB::table('tmp_purchases')->delete();

        $msg='Item Successfully Updated'; 
        return redirect()->route('admin.pur.index')->with('msg',$msg);

    }

}

    public function deleteData($id=null) {
        $deleteData = TmpPurchase::find($id);
        $deleteData->delete();
        $msg='Item Removed!!'; 
        return redirect()-> route('admin.pur.add')->with('msg',$msg);
    }

    public function deleteItem($id=null) {
        $deleteData = Purchase::find($id);
        $deleteData->delete();
        $msg='Data Succesfully Deleted'; 
        return redirect()-> route('admin.pur.index')->with('msg',$msg);
    }


    public function getProductById($id)
    {
        $product = Product::find($id);
        return response()->json(['html' => $product]);
    }

}