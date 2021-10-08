<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function create()
    {
        $coupons=Coupon::orderBy('id','DESC')->get();
        return view ('admin.coupon.create',compact('coupons'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name'=>'required',
            'coupon_discount'=>'required',
            'coupon_validity'=>'required',
        ]);

        Coupon::insert([
            'coupon_name'=>strtoupper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity,
            'created_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Coupon Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function edit($coupon_id)
    {
        $coupons=Coupon::findOrFail($coupon_id);
        return view ('admin.coupon.edit',compact('coupons'));
    }
    public function update(Request $request)
    {
        $coupon_id=$request->id;
        $request->validate([
            'coupon_name'=>'required',
            'coupon_discount'=>'required',
            'coupon_validity'=>'required',
        ]);
        Coupon::findOrFail($coupon_id)->update([
            'coupon_name'=>strtoupper($request->coupon_name),
            'coupon_discount'=>$request->coupon_discount,
            'coupon_validity'=>$request->coupon_validity,
            'updated_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('coupon')->with($notification);
    }
    public function destroy($coupon_id)
    {
        Coupon::findOrFail($coupon_id)->delete();
        $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('coupon')->with($notification);
    }
}
