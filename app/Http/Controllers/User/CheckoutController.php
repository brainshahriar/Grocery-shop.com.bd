<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Cart;
use Session;

class CheckoutController extends Controller
{
    public function getDistricWithtAjax($division_id)
    {
        $ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($ship);
    }
    public function getStateWithtAjax($district_id)
    {
        $ship = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
        return json_encode($ship);
    }
    public function storeCheckout(Request $request)
    {
        $data=array();
        $data['shipping_name']= $request->shipping_name;
        $data['shipping_email']= $request->shipping_email;
        $data['shipping_phone']= $request->shipping_phone;
        $data['post_code']= $request->post_code;
        $data['division_id']= $request->division_id;
        $data['district_id']= $request->district_id;
        $data['state_id']= $request->state_id;
        $data['notes']= $request->notes;
        $cartTotal = Cart::total();
        $carts = Cart::content();
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else
        {
            $total_amount=round((int)Cart::total());
        }

    
        if($request->payment_method=='stripe')
        {
            return view ('frontend.payment.stripe',compact('data','cartTotal'));
        }
        elseif($request->payment_method=='sslHost')
        {
            return view ('frontend.payment.hostedPayment',compact('data','total_amount','carts'));
        }
        elseif($request->payment_method=='sslEasy')
        {
            return view ('frontend.payment.easyPayment',compact('data','total_amount','carts'));

        }
        else
        {
            return 'handcash';
        }
      
    }
}
