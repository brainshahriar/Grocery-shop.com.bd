@extends('layouts.frontend-master')

@section('frontend-content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
        <div class="sign-in-page">
        <div class="row">
            <div class="col-md-4">
     @include('user.inc.sidebar')
            </div>
            <div class="col-md-8 mt-1">
              <div class="card">
                  <h3 class="text-center"><span class="text-danger">Hii</span>
                <strong class="text-warning">{{ Auth::user()->name }}</strong> Change Your Password</h3>
                <div class="card-body">
                    <form action="{{ route('store-password') }}" method="POST">
                        @csrf
             
        
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="old_password" class="form-control"
                            aria-describedby="emailHelp" placeholder="Enter Old Password">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>                         
                        @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="new_password" class="form-control"
                            aria-describedby="emailHelp" placeholder="Enter New Password">
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>                         
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control"
                            aria-describedby="emailHelp" placeholder="Retype Your Password">
                            @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>                         
                        @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Change Password</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
@endsection
