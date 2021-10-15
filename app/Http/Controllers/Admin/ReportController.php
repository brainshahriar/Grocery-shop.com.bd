<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }
    //date wise report
    public function reportByDate(Request $request)
    {
        $date=new DateTime($request->date);
        $formatDate=$date->format('d F Y');
        
        $orders=Order::where('order_date',$formatDate)->latest()->get();
        return view('admin.reports.reports',compact('orders'));
    }
    //search by month
    public function reportByMonth(Request $request)
    {
      
        $orders=Order::where('order_month',$request->month_name)->where('order_year',$request->year_name)->latest()->get();
        return view('admin.reports.reports',compact('orders'));
    }
    public function reportByYear(Request $request)
    {
      
        $orders=Order::where('order_year',$request->year_name)->latest()->get();
        return view('admin.reports.reports',compact('orders'));
    }
}
