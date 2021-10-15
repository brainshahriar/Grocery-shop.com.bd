<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
   //pending orders
   public function pendingOrder(){
       $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
       return view('admin.orders.pending',compact('orders'));
   }

   //orders view
   public function viewOrders($order_id){
    $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    $orderItems = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('admin.orders.view-order',compact('order','orderItems'));
    }

    //confirm order
    public function confirmOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.orders.confirm',compact('orders'));
    }

    //processing
    public function processingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
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

    //pending to confirm
    public function pendingToConfirm($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Confirm',
            'confirmed_date' => Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Confirm Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('pending-orders')->with($notification);
    }

    //cancel order
    public function pendingToCancel($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Cancel',
            'cancel_date' => Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Cancel Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('pending-orders')->with($notification);
    }

    //confirm to process
    public function confirmToProcess($order_id){
        Order::findOrFail($order_id)->update(['status' => 'Processing', 'processing_date' => Carbon::now()]);
            $notification=array(
            'message'=>'Order Processing Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('confirmed-orders')->with($notification);
    }

     //  process to Picked
     public function processToPicked($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Picked',
            'picked_date' => Carbon::now()
        ]);
            $notification=array(
            'message'=>'Order Picked Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('processing-orders')->with($notification);
    }



     //  process to Picked
     public function pickedToShipped($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Shipped',
            'shipped_date' => Carbon::now()
            ]);
            $notification=array(
            'message'=>'Order Shipped Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('picked-orders')->with($notification);
    }

     //  process to Picked
     public function shippedToDelivery($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
            'delivered_date' => Carbon::now()
        ]);
            $notification=array(
            'message'=>'Order Delivery Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('picked-orders')->with($notification);
    }

    //invoice download
    public function downloadInvoice($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        // return view('user.order.invoice',compact('order','orderItems'));
        $pdf = PDF::loadView('admin.orders.invoice',compact('order','orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

}