<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
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

    //district

    public function createDistrict()
    {
        $divisions=ShipDivision::orderBy('id','DESC')->get();
        $districts=ShipDistrict::with('division')->orderBy('id','DESC')->get();
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
    public function districtEdit($district_id)
    {
        $divisions=ShipDivision::orderBy('division_name','ASC')->get();
        $districts=ShipDistrict::findOrFail($district_id);
        return view ('admin.ship-district.edit',compact('districts','divisions'));
    }
    public function districtUpdate(Request $request)
    {
        $district_id=$request->id;
        $request->validate([
            'district_name'=> 'required',
            'division_id'=> 'required',
        ],[
            'division_id.required'=>'Select Division'
        ]);
 
        ShipDistrict::findOrFail($district_id)->update([
            'division_id'=>$request->division_id,
            'district_name'=>strtoupper($request->district_name),
            'updated_at'=>Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('district')->with($notification);
    }
    public function districtDestroy($district_id)
    {
        ShipDistrict::findOrFail($district_id)->delete();
        $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('district')->with($notification);
    }


    // ==================== state ===============
    public function stateCreate(){
        $states = ShipState::with('division','district')->orderBy('id','DESC')->get();
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        return view('admin.ship-state.create',compact('states','divisions'));
    }

    //get district with ajax
    public function getDistrictAjax($division_id){
           $ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
           return json_encode($ship);
    }

    //store
    public function stateStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //state edit
    public function stateEdit($state_id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $state = ShipState::findOrFail($state_id);
        return view('admin.ship-state.edit',compact('divisions','state'));
    }

    //state update
    public function stateUpdate(Request $request){
        $state_id = $request->id;
        $request->validate([
            'division_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('state')->with($notification);
    }


     //district destory
     public function stateDestroy($state_id){
        ShipState::findOrFail($state_id)->delete();
        $notification=array(
           'message'=>'Delete Success',
           'alert-type'=>'success'
       );
       return Redirect()->back()->with($notification);
    }
}
