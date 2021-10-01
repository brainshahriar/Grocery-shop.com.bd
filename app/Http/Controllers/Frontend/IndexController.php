<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index()
    {
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        return view ('frontend.index',compact('sliders'));
    }
}
