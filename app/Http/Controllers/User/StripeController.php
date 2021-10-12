<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function store(Request $request)
    {
      
        \Stripe\Stripe::setApiKey('sk_test_51JjlquJOzdETOk5ucIFdK2oDMr44vW7eXb9yBhcnh74NL3aOzxTcrCYHiZHY2Ip246rkNoweuRHqAy4Sk8S5cbTK00t0RIXFYw');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => 30*100,
        'currency' => 'usd',
        'description' => 'Payment From ASM SOFTWARE',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
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
            'invoice_no' => 'SPM'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);
      
    }
}
