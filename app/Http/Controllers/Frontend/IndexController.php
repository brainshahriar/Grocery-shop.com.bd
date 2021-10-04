<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;

class IndexController extends Controller
{
    public function index()
    {
        
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        $proudcts=Product::where('status',1)->orderBy('id','DESC')->get();
        $featureds=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->get();
        $hotdeals=Product::where('status',1)->where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->get();
        $specialoffer=Product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->get();
        $specialdeals=Product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->get();
        $skip_category_0=Category::skip(0)->first();
        $skip_product_0=Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();
        $skip_category_1=Category::skip(1)->first();
        $skip_product_1=Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();
        $skip_category_2=Category::skip(2)->first();
        $skip_product_2=Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->get();
        $skip_brand_0=Brand::skip(4)->first();
        $skip_product_brand_0=Product::where('status',1)->where('brand_id',$skip_brand_0->id)->orderBy('id','DESC')->get();
        return view ('frontend.index',compact('sliders','categories','proudcts','featureds','hotdeals','specialoffer','specialdeals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_category_2','skip_product_2','skip_brand_0','skip_product_brand_0'));
    }
    //product details
    public function singleProduct($id,$slug)
    {
        $products=Product::findOrFail($id);
        $multiImgs=MultiImg::where('product_id',$id)->get();
        return view('frontend.single-product',compact('products','multiImgs'));
    }
    //tagwise product
    public function tagWiseProduct($tag)
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $products=Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(1);
        return view ('frontend.tag-product',compact('products','categories'));
    }
    public function subcategoryProduct($subcat_id,$slug)
    {
        $products=Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate();
        $categories=Category::orderBy('category_name_en','ASC')->get();
        return view ('frontend.category-wise-product',compact('products','categories'));
    }
}

// where('subcategory_id',$subcat_id)->orWhere('subcategory_slug_en',$slug)->orWhere('subcategory_slug_bn',$slug)->
