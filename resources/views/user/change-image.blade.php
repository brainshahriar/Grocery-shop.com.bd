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
                <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your Profile</h3>
                <div class="card-body">
                    <form action="{{ route('update-image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"name="old_image" value="{{ Auth::user()->image }}">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control"
                            aria-describedby="emailHelp">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>                         
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Upload</button>
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
