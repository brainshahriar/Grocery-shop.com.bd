<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use App\Models\Order;
use App\Models\OrderItem;
//use Intervention\Image\Image;
use Image;
use Hash;

class UserController extends Controller
{
    public function index(){
        return view('user.home');
    }
    public function updateData(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
        
        ],[
            'name.required'=>'Input Your Name',
        
        
        ]);

        User::findOrFail(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'updated_at'=>Carbon::now(),

        ]);
        $notification=array(
            'message'=>'Your Profile Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    //image
    public function imagePage()
    {
        return view ('user.change-image');
    }
    //updateImane
    public function updateImage(Request $request)
    {
        $old_image=$request->old_image;
        if(User::findOrFail(Auth::id())->image =='frontend/media/avatar.jpg')
        {
 
            $image=$request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('frontend/media/'.$name_gen);
            $save_url='frontend/media/'.$name_gen;
            User::findOrFail(Auth::id())->update([
                'image'=>$save_url

            ]);
            $notification=array(
                'message'=>'Wow Check Your New Look !!!',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        else
        {
            unlink($old_image);
            $image=$request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('frontend/media/'.$name_gen);
            $save_url='frontend/media/'.$name_gen;
            User::findOrFail(Auth::id())->update([
                'image'=>$save_url

            ]);
            $notification=array(
                'message'=>'Wow Check Your New Look !!!',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function updatePassPage()
    {
        return view ('user.password');
    }
    public function storePassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required',
        ]);
        $db_pass=Auth::user()->password;
        $old_password=$request->old_password;
        $new_password=$request->new_password;
        $confirm_password=$request->confirm_password;

       if(Hash::check($old_password,$db_pass))
       {
            if($new_password==$confirm_password)
            {
                User::findOrFail(Auth::id())->update([
                    'password'=>Hash::make($new_password)
                ]);
                Auth::logout();
                $notification=array(
                    'message'=>'Oh Wow !!!',
                    'alert-type'=>'success'
                );
                return Redirect()->route('login')->with($notification);

            }
            else
            {
                $notification=array(
                    'message'=>'I think You Mistake Your Typing !!!',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
               }
            }
            else
            {
             $notification=array(
                 'message'=>'I think You Forgot !!!',
                 'alert-type'=>'error'
             );
             return Redirect()->back()->with($notification);
            }
       }

       //user order
       public function orderCreate()
       {
           $orders=Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
           return view('user.order.orders',compact('orders'));
       }
       //view order
       public function orderView($order_id)
       {
           $order=Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
           $orderItems=OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
           return view('user.order.view-order',compact('order','orderItems'));
       }

    

}
