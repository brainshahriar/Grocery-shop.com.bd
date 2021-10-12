<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use Cart;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
class StripeController extends Controller
{
    public function store(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else
        {
            $total_amount=round((int)Cart::total());
        }
        \Stripe\Stripe::setApiKey('sk_test_51JjlquJOzdETOk5ucIFdK2oDMr44vW7eXb9yBhcnh74NL3aOzxTcrCYHiZHY2Ip246rkNoweuRHqAy4Sk8S5cbTK00t0RIXFYw');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Payment From ASM SOFTWARE',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

   


        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
            'invoice_no' => 'ASM'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);
        $carts = Cart::content();
        foreach($carts as $cart)
        {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        if(Session::has('coupon'))
        {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification=array(
            'message'=>'Order Placed',
            'alert-type'=>'success'
        );
        return Redirect()->route('user.dashboard')->with($notification);
      
    }
}
