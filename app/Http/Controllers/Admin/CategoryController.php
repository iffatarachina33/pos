<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function showData(){
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }
    public function addData(){
        return view('admin.category.create');
    }
    public function storeData(Request $request){


        $rules = [
            'code'=>'required|max:15',
            'name'=>'required|max:15',
        ];
        $this->validate($request, $rules, );

        $category = new Category();
        $category->code = $request->code;
        $category->name = $request->name;
        $category->save();
        $msg='Data Successfully Added'; 
        return redirect()-> route('admin.cat.index')->with('msg',$msg);

    }
    public function editData($id) {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }


    public function updateData(Request $request,$id){

        

        $rules = [
            'code'=>'required|max:15',
            'name'=>'required|max:15',
        ];
        $this->validate($request, $rules, );

        $category = Category::find($id);
        $category->code = $request->code;
        $category->name = $request->name;
        $category->save();
        $msg='Data Successfully Updated'; 
        return redirect()-> route('admin.cat.index')->with('msg',$msg);

    }

    public function deleteData($id=null) {
        $deleteData = Category::find($id);
        $deleteData->delete();
        $msg='Data Successfully Deleted'; 
        return redirect()-> route('admin.cat.index')->with('msg',$msg);
    }

}