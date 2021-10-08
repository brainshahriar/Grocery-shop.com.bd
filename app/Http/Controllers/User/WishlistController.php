<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Cart;
use Auth;
class WishlistController extends Controller
{
    public function create()
    {
        return view('user.wishlist');
    }
    public function readAllProduct()
    {
        $wishlist=Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }

    //get all product
    // public function readAllProduct(){
    //     $wishlist=Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
    //     return response()-json($wishlist);
    //     $carts = Cart::content();
    //     $cartQty = Cart::count();
    //     $cartTotal = Cart::total();

    //     return response()->json(array(
    //         'carts' => $carts,
    //         'cartQty' => $cartQty,
    //         'cartTotal' => round($cartTotal),
    //     ));

    // }
    // public function wishListRemove($rowId){

    //     Cart::remove($rowId);
    //     return response()->json(['success' => 'Product Removed']);
    // }
}
