<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    public function allUsers()
    {
        $users=User::where('role_id','!=',1)->orderBy('id','DESC')->get();
        return view('admin.users.index',compact('users'));
    }
}
