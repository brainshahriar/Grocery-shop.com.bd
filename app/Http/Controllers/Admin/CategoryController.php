<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubsubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    //store category
    public function categoryStore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_icon' => 'required',
       ]);

       Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_bn' => $request->category_name_bn,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
        'category_icon' => $request->category_icon,
        'created_at' => Carbon::now(),
       ]);

       $notification=array(
        'message'=>'Catetory Added Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);

    }

    //edit category
    public function edit($cat_id){
        $category = Category::findOrFail($cat_id);
        return view('admin.category.edit',compact('category'));
    }

    //update

    public function catUpdate(Request $request){
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->Update([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
            'category_icon' => $request->category_icon,
            'created_at' => Carbon::now(),
           ]);

           $notification=array(
            'message'=>'Catetory Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('category')->with($notification);
    }



    //delete Category
   public function delete($cat_id){
    Category::findOrFail($cat_id)->delete();
        $notification=array(
        'message'=>'Category Delete Success',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
    }
}
