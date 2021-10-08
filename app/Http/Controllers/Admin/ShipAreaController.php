<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use Carbon\Carbon;

class ShipAreaController extends Controller
{
    public function createDivision()
    {
        $divisions=ShipDivision::orderBy('id','DESC')->get();
        return view ('admin.ship-division.create',compact('divisions'));
    }
    public function storeDivision(Request $request)
    {
        $request->validate([
            'division_name'=> 'required',
        ]);
        ShipDivision::insert([
            'division_name'=>strtoupper($request->division_name),
            'created_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function edit($coupon_id)
    {
        $divisions=ShipDivision::findOrFail($coupon_id);
        return view ('admin.ship-division.edit',compact('divisions'));
    }
    public function update(Request $request)
    {
        $division_id=$request->id;
        $request->validate([
            'division_name'=>'required',
        ]);
        ShipDivision::findOrFail($division_id)->update([
            'division_name'=>strtoupper($request->division_name),
            'updated_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('division')->with($notification);
    }
    public function destroy($division_id)
    {
        ShipDivision::findOrFail($division_id)->delete();
        $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('division')->with($notification);
    }
    public function createDistrict()
    {
        $divisions=ShipDivision::orderBy('id','DESC')->get();
        $districts=ShipDistrict::orderBy('id','DESC')->get();
        return view ('admin.ship-district.create',compact('districts','divisions'));
    }
    public function storeDistrict(Request $request)
    {
        $request->validate([
            'district_name'=> 'required',
            'division_id'=> 'required',
        ],[
            'division_id.required'=>'Select Division'
        ]);
        ShipDistrict::insert([
            'division_id'=>$request->division_id,
            'district_name'=>strtoupper($request->district_name),
            'created_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
