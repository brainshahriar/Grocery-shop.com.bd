<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
//use Intervention\Image\Image;
use Image;

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
}
