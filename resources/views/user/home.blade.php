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
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset("frontend/media/avatar.jpg") }}" class="card-img-top" alt="Card image cap" style="border-radius:50%;" height="100%;"
                    width="100%">
                    <br>
                    <br>
                    <div class="card-header">
                      Profile Details
                    </div>
                    <br>
                    <ul class="list-group list-group-flush">
                      <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                      <a class="btn btn-primary btn-sm btn-block">Update Image</a>
                  
                      <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block"  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Log Out</a>
                    </ul>
                  </div>
            </div>
            <div class="col-md-8 mt-1">
              <div class="card">
                  <h3 class="text-center"><span class="text-danger">Hii</span>
                <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your Profile</h3>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control"
                            aria-describedby="emailHelp" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control"
                            aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control"
                            aria-describedby="emailHelp" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
