<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Session;
use App\Models\Coupon;
class CartController extends Controller

{
    public function addToCart(Request $request,$id){

   

        $product = Product::findOrFail($id);

            if ($product->discount_price == NULL) {
                Cart::add([
                    'id' => $id,
                     'name' => $request->product_name,
                     'qty' => $request->quantity,
                     'price' => $product->selling_price,
                     'weight' => 1,
                     'options' => [
                         'image' => $product->product_thambnail,
                         'color' => $request->color,
                         'size' => $request->size,
                        ],
                     ]);

                     return response()->json(['success' => 'Sucessfully Added On Your Cart']);
            }else {
                Cart::add([
                    'id' => $id,
                     'name' => $request->product_name,
                     'qty' => $request->quantity,
                     'price' => $product->discount_price,
                     'weight' => 1,
                     'options' => [
                        'image' => $product->product_thambnail,
                        'color' => $request->color,
                        'size' => $request->size,
                       ],
                     ]);
                     return response()->json(['success' => 'Sucessfully Added On Your Cart']);

            }


    }

    //mini cart

    public function miniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round((int)$cartTotal),
        ));

    }
    //cart remove
    public function miniCartRemove($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed']);
    }

    //add wish list user
    public function addToWishlist(Request $request,$product_id){
        if (Auth::check()) {
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Sucessfully Added On Your Wishlist']);
            }else {
                return response()->json(['error' => 'The Product Has Already On Your Wishlist']);
            }

        }else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
   }
   
       
        //create
        public function create(){
            return view('user.cart-page');
        }

        //get all product
        public function getAllCart(){
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();

            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round((int)$cartTotal),
            ));
        }

        //cart remove product
        public function destory($rowId){
            Cart::remove($rowId);
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            return response()->json(['success' => 'Product Remove From Cart']);
        }

        //cart increment
        public function cartIncrement($rowId){

            $row = Cart::get($rowId);
            Cart::update($rowId, $row->qty + 1);
            if (Session::has('coupon')) {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();
                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round((int)(Cart::total()) * $coupon->coupon_discount/100),
                    'total_amount' => round((int)(Cart::total()) - round((int)(Cart::total())) * $coupon->coupon_discount/100),
                ]);
            }
            return response()->json('increment');
        }

        //cart decrement
        public function cartDecrement($rowId){

            $row = Cart::get($rowId);
            if ($row->qty == 1) {
                return response()->json('not decrement');
            }else {
                Cart::update($rowId, $row->qty - 1);
                if (Session::has('coupon')) {
                    $coupon_name = Session::get('coupon')['coupon_name'];
                    $coupon = Coupon::where('coupon_name',$coupon_name)->first();
                    Session::put('coupon',[
                        'coupon_name' => $coupon->coupon_name,
                        'coupon_discount' => $coupon->coupon_discount,
                        'discount_amount' => round((int)(Cart::total()) * $coupon->coupon_discount/100),
                    'total_amount' => round((int)(Cart::total()) - round((int)(Cart::total())) * $coupon->coupon_discount/100),
                    ]);
                }
                return response()->json('decrement');
            }
        }

// ===================== coupon start =======================

    public function couponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((int)(Cart::total()) * $coupon->coupon_discount/100),
                'total_amount' => round((int)(Cart::total()) - round((int)(Cart::total())) * $coupon->coupon_discount/100),
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Success'
            ));
        }else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    //coupon calculation
    public function couponCalcaultion(){
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    //remove coupon
    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Success']);
    }

   
}

?>