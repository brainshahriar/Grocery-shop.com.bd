<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubsubCategory;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories=Category::latest()->get();
        $brands=Brand::latest()->get();
        return view('admin.product.create',compact('categories','brands'));
    }

    public function getSubSubCat($sub_cat)
    {
        $subsubCat=SubsubCategory::where('subcategory_id',$sub_cat)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubCat);
    }
    public function store(Request $request)
    {
        
    }
}
