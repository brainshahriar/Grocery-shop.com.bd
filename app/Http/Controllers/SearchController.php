<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    //search product
    public function searchProduct(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $products = Product::where("product_name_en","LIKE","%".$request->search."%")
                            ->orWhere('product_name_bn',"LIKE","%".$request->search."%")
                            ->orWhere('product_tags_en',"LIKE","%".$request->search."%")
                            ->orWhere('product_tags_bn',"LIKE","%".$request->search."%")
                            ->orWhere('short_descp_en',"LIKE","%".$request->search."%")
                            ->orWhere('short_descp_bn',"LIKE","%".$request->search."%")
                            ->paginate(5);
                return view('frontend.search-result',compact('products'));
    }


    //findProducts with ajax
    public function findProducts(Request $request){
        $request->validate([
            'search' => 'required'
        ]);

        $products = Product::where("product_name_en","LIKE","%".$request->search."%")
                            ->orWhere('product_name_bn',"LIKE","%".$request->search."%")
                            ->orWhere('product_tags_en',"LIKE","%".$request->search."%")
                            ->orWhere('product_tags_bn',"LIKE","%".$request->search."%")
                            ->orWhere('short_descp_en',"LIKE","%".$request->search."%")
                            ->orWhere('short_descp_bn',"LIKE","%".$request->search."%")
                            ->take(5)->get();
                return view('frontend.search-product',compact('products'));
    }
}