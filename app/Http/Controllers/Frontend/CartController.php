<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {
        
        $product=Product::findOrFail($id);
        $amount=0;
        $discount=0;
     if($product->selling_price >0 && $product->discount_price>0)
     {
        $amount=$product->selling_price;
        $discount=$product->discount_price;
     }
        if($product->discount_price==NULL)
        {
            Cart::add([
                'id' => $id,
             'name' => $request->product_name,
              'qty' => $request->quantity,
               'price' => $amount,
                'weight' => 1,
                'options' => ['size' => $request->color],
                'options' => ['size' => $request->size],
                'options' => ['image' => $request->product_thambnail],
            
                
                ]);
                return response()->json(['success'=>'Successfully Added on your Cart']);
        }
        else
        {
            Cart::add([
                'id' => $id,
             'name' => $request->product_name,
              'qty' => $request->quantity,
               'price' => $discount,
                'weight' => 1,
                 'options' => ['size' => $request->color],
                 'options' => ['size' => $request->size],
                 'options' => ['image' => $request->product_thambnail],
                
            ]);
            return response()->json(['success'=>'Successfully Added on your Cart']);
        }

    }
}

?>