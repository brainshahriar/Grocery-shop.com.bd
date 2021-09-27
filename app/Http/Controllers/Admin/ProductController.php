<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubsubCategory;
use App\Models\MultiImg;
use App\Models\Product;
use Carbon\Carbon;
use Image;

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
    public function store(Request $request){

        $image = $request->file('product_thambnail');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(917,1000)->save('uploads/products/thambnail/'.$name_gen);
                $save_url = 'uploads/products/thambnail/'.$name_gen;
    
       $product_id =  Product::insertGetId([
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'subsubcategory_id' => $request->subsubcategory_id,
                    'product_name_en' => $request->product_name_en,
                    'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
                    'product_name_bn' => $request->product_name_bn,
                    'product_slug_bn' => str_replace(' ','-',$request->product_name_bn),
                    'product_code' => $request->product_code,
                    'product_qty' => $request->product_qty,
                    'product_tags_en' => $request->product_tags_en,
                    'product_tags_bn' => $request->product_tags_bn,
                    'product_size_en' => $request->product_size_en,
                    'product_size_bn' => $request->product_size_bn,
                    'product_color_en' => $request->product_color_en,
                    'product_color_bn' => $request->product_color_bn,
                    'selling_price' => $request->selling_price,
                    'discount_price' => $request->discount_price,
                    'short_descp_en' => $request->short_descp_en,
                    'short_descp_bn' => $request->short_descp_bn,
                    'long_descp_en' => $request->long_descp_en,
                    'long_descp_bn' => $request->long_descp_bn,
                    'hot_deals' => $request->hot_deals,
                    'featured' => $request->featured,
                    'special_offer' => $request->special_offer,
                    'special_deals' => $request->special_deals,
                    'product_thambnail' => $save_url,
                    'status' => 1,
                    'created_at' => Carbon::now(),
    
    
        ]);
    
        //////////////////// Multiple image uplod start /////////////////////////////////
    
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name=hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('uploads/products/multi-image/'.$make_name);
            $uplodPath = 'uploads/products/multi-image/'.$make_name;
    
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uplodPath,
                'created_at' => Carbon::now(),
            ]);
        }
         //////////////////// Multiple image uplod End /////////////////////////////////
    
    
        $notification=array(
            'message'=>'Product Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function manageProduct()
    {
        $products=Product::latest()->get();
        return view('admin.product.index',compact('products'));
    }
}