<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\Category;
use App\Brand;
use App\UnitOfMeasarement;

class ProductsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);

        $products = Product::with('category')->with('brand')->with('supplier')->with('uom')->get();

        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $supplier= Supplier::all();
        $category= Category::all();
        $brand= Brand::all();
        $unitOfMeasarement= UnitOfMeasarement::all();
        return view('admin.products.create' , compact('supplier','category','brand','unitOfMeasarement'));
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows('product_create'), 403);


        $product = new Product();

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->uom_name = $request->uom_name;
        $product->supplier_id = $request->supplier_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->code = $request->code;

        $product->save();

        //return view('admin.products.edit',compact('product'));

        //$product = Product::create($request->all());

        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        $product = Product::find($id);

        $suppliers = Supplier::all();
        $categories = Category::all();
        $brands = Brand::all();
        $unitOfMeasarement = UnitOfMeasarement::all();
        return view('admin.products.edit' , compact('product','suppliers','categories','brands','unitOfMeasarement'));



        //return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request,$id)
    {
        abort_unless(\Gate::allows('product_edit'), 403);


        $product =  Product::find($id);

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->uom_name = $request->uom_name;
        $product->supplier_id = $request->supplier_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->code = $request->code;

        //$product->update($request->all());

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_unless(\Gate::allows('product_show'), 403);

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_unless(\Gate::allows('product_delete'), 403);

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
