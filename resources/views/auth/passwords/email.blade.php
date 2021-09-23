@extends('layouts.frontend-master')

@section('frontend-content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Reset Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-12 col-sm-12 sign-in">
	<h4 class="">Forget Password</h4>


	<form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('password.email') }}">
        @csrf
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
            
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

<br>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Send Password Reset Link') }}</button>
          <a href="{{ route('login') }}" class="forgot-password pull-right">Return to Login?</a>

    </form>					
</div>
<!-- Sign-in -->


<!-- create a new account -->			</div><!-- /.row -->
		</div><!-- /.sigin-in-->

        @include('frontend.inc.brand')

	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

