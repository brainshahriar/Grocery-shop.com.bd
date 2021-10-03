@extends('layouts.frontend-master')
@section('frontend-content')
@section('title') {{ $products->product_name_en }} @endsection
    

@php
     function bn_price($str)
    {
        $en=array(1,2,3,4,5,6,7,8,9,0);
        $bn=array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $str=str_replace($en,$bn,$str);
        return $str;
    }
@endphp

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li><a href="#">Clothing</a></li>
				<li class='active'>Floral Print Buttoned</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->



@endsection