<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\MultiImg;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        $proudcts=Product::where('status',1)->orderBy('id','DESC')->get();
        $featureds=Product::where('status',1)->where('status',1)->orderBy('id','DESC')->get();
        return view ('frontend.index',compact('sliders','categories','proudcts','featureds'));
    }
    //product details
    public function singleProduct($id)
    {
        $products=Product::findOrFail($id);
        $multiImgs=MultiImg::where('product_id',$id)->get();
        return view('frontend.single-product',compact('products','multiImgs'));
    }
}


