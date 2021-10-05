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
        $related_product=Product::where('category_id',$products->category_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

        $color_en=$products->product_color_en;
        $product_color_en=explode(',',$color_en);
        $color_bn=$products->product_color_bn;
        $product_color_bn=explode(',',$color_bn);
        $size_en=$products->product_size_en;
        $product_size_en=explode(',',$size_en);
        $size_bn=$products->product_size_bn;
        $product_size_bn=explode(',',$size_bn);

        return view('frontend.single-product',compact('products','multiImgs','product_color_en','product_color_bn','product_size_en','product_size_bn','related_product'));
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
        $products=Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $categories=Category::orderBy('category_name_en','ASC')->get();
        return view ('frontend.subcategory-wise-product',compact('products','categories'));
    }
    public function subsubcategoryProduct($subsubcat_id,$slug)
    {
        $products=Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(3);
        $categories=Category::orderBy('category_name_en','ASC')->get();
        return view ('frontend.subsubcategory-wise-product',compact('products','categories'));
    }
    //product view with ajax
    public function productViewAjax($product_id)
    {
        $product=Product::with('category','brand')->findOrFail($product_id);
        $color=$product->product_color_en;
        $product_color=explode(',',$color);
        $size=$product->product_size_en;
        $product_size=explode(',',$size);
        return response()->json(array(
            'product'=>$product,
            'color'=>$product_color,
            'size'=>$product_size,
        ));

    }
}


