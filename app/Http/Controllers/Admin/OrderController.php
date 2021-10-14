<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class OrderController extends Controller
{
    //pending order
    public function pendingOrder()
    {
        $orders=Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.orders.pending',compact('orders'));
    }
    // orders view
    public function viewOrders($order_id)
    {
        $order=Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItems=OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('admin.orders.view-order',compact('order','orderItems'));
    }
    //confirm Orders
    public function confirmedOrder()
    {
        $orders=Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.orders.confirm',compact('orders'));
    }
//order processing
    public function processingOrder()
    {
        $orders=Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('admin.orders.processing',compact('orders'));
    }
    
    //picked order
    public function pickedOrders(){
        $orders = Order::where('status','picked')->orderBy('id','DESC')->get();
        return view('admin.orders.picked',compact('orders'));
    }

    //Shipped order
    public function shippedOrders(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
        return view('admin.orders.shipped',compact('orders'));
    }

    //delivery order
    public function deliveredOrders(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('admin.orders.delivered',compact('orders'));
    }

    //cancel order
    public function cancelOrders(){
        $orders = Order::where('status','Cancel')->orderBy('id','DESC')->get();
        return view('admin.orders.cancel',compact('orders'));
    }
}
