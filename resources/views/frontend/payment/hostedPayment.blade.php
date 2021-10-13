@extends('layouts.frontend-master')
@section('frontend-content')
@section('title') SSL Hosted Payment @endsection
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Hosted Payment</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($carts as $item)
                            
                     
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item->name }}</h6>
                                <span>Color : <small class="text-muted">{{ $item->options->color }}</small></span> 
                                <br>
                               <span>Size : <small class="text-muted">{{ $item->options->size }}</small></span> 
                            </div>
                            <span>Price : <small class="text-muted">{{ $item->price }}</small></span> 
                        </li>
                        @endforeach
             
            
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BDT)</span>
                            <strong>{{ $total_amount }}</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                  
                    <form action="{{ url('/pay') }}" method="POST" class="needs-validation" novalidate>
                        
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" value="{{ $total_amount }}" name="amount" id="total_amount" required/>
                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                    <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                    <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                    <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                                address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection