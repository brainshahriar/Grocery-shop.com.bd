@extends('layouts.frontend-master')
@section('frontend-content')
@section('title') Checkout @endsection
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>Checkout Method
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

			<!-- already-registered-login -->
            <div class="col-md-6 col-sm-6 already-registered-login">
                <h4 class="checkout-subtitle">Shipping Address?</h4>
                <form class="register-form" role="form">
                    <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}">
                  </div>
                  <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}">
                  </div>
                  <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}">
                  </div>
                  <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
                    <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" >
                  </div>
          
            </div>	
            <!-- already-registered-login -->
				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
	
                    
                        <div class="form-group">
                            <label class="form-control-label">Select Division: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search" data-placeholder="Select One" name="division_id">
                              <option label="Choose one"></option>
                              @foreach ($division as $div)
                              <option value="{{ $div->id }}">{{ ucwords($div->division_name) }}</option>
                              @endforeach
                            </select>
                            @error('division_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="form-group">
                            <label class="form-control-label">Select District: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search" data-placeholder="Select One" name="district_id">
                              <option label="Choose one"></option>
                     
                            </select>
                            @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label class="form-control-label">Select State: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search" data-placeholder="Select One" name="state_id">
                              <option label="Choose one"></option>
                     
                            </select>
                            @error('state_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Notes <span>*</span></label>
                                <textarea class="form-control" name="notes" id="" cols="30" rows="5" placeholder="Notes"></textarea>
                              </div>
                          </div>
           
					  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
					</form>
				</div>	
				<!-- already-registered-login -->		

        
			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>

					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($carts as $item)
                                            
                                  
										<li>
                                            <strong>Image : </strong>
                                            <img src="{{ asset($item->options->image) }}" alt="" 
                                            style="height: 50px; width:50px;">
                                            <strong>Qty : </strong>
                                            <span>{{ $item->qty }}</span>
                                            <strong>Color : </strong>
                                            <span>{{ $item->options->color }}</span>
                                            <strong>Size : </strong>
                                            <span>{{ $item->options->size }}</span>
                                        </li>
                                        @endforeach
                                        <hr>
                                        <br>
										<li>
                                            @if(Session::has('coupon'))
                                            <strong>Subtotal : </strong>
                            
                                            <span>{{ round($cartTotal) }}</span>
                                            <br>
                                            <strong>Coupon Name : </strong>
                            
                                            <span>{{ session()->get('coupon')['coupon_name'] }} ({{ (session('coupon')['coupon_discount']) }}%)</span>
                                            <br>
                                            <strong>Coupon Discount : </strong>
                            
                                            <span> - {{ session()->get('coupon')['discount_amount'] }}</span>
                                            <br>
                                            <strong>Grandtotal : </strong>
                                            <span>{{ session()->get('coupon')['total_amount'] }}</span>
                                            @else
                                            <strong>Subtotal : </strong>
                            
                                            <span>{{ round($cartTotal) }}</span>
                                            <br>
                                            <strong>Grandtotal : </strong>
                                            <span>{{ round($cartTotal) }}</span>
                                            @endif
                                    
                                        </li>
                                        
					
									</ul>		
								</div>
							</div>
						</div>
					</div> 					<!-- checkout-progress-sidebar -->
			</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- =================== BRANDS CAROUSEL =================================== -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

<script src="{{asset('backend')}}/lib/jquerysubsubcategory/jquery-2.2.4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        if(division_id) {
            $.ajax({
                url: "{{  url('/user/district-get/ajax') }}/"+division_id,
                type:"GET",
                dataType:"json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data) {
                   var d =$('select[name="district_id"]').empty();
                      $.each(data, function(key, value){
                          $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                      });
                },
            });
        } else {
            alert('danger');
        }
    });

    $('select[name="district_id"]').on('change', function(){
        var district_id = $(this).val();
        if(district_id) {
            $.ajax({
                url: "{{  url('/user/state-get/ajax') }}/"+district_id,
                type:"GET",
                dataType:"json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data) {
                   var d =$('select[name="state_id"]').empty();
                      $.each(data, function(key, value){
                          $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                      });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>
@endsection
