<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->where('role_id','!=',2)->get();
        return view('admin.subadmin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','!=',2)->get();
        return view('admin.subadmin.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'role_id' => 'required|numeric',
        ]);

        $request['password'] = Hash::make($request->password);
        User::create($request->all());
        $notification=array(
            'message'=>'user Created Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('subadmin.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('id','!=',2)->get();
        return view('admin.subadmin.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:4|confirmed',
            'role_id' => 'required|numeric',
        ]);

        if ($request->password === null) {
            $request['password'] = auth()->user()->password;
        }else {
            $request['password'] = Hash::make($request->password);
        }

        User::findOrFail($id)->update($request->all());
        $notification=array(
            'message'=>'user Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('subadmin.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        $notification=array(
            'message'=>'User Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

}