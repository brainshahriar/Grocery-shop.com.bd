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
                <div class="col-md-9 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item active text-center">Shipping Information</li>
                                <li class="list-group-item">
                                    <strong>Name:</strong> {{ $order->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong>
                                    {{ $order->phone }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong>
                                    {{ $order->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Division:</strong>
                                    {{ $order->division->division_name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>District:</strong>
                                    {{ $order->district->district_name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>State:</strong>
                                    {{ $order->state->state_name }}
                                </li>
    
                                    <li class="list-group-item">
                                        <strong>Post Code:</strong>
                                        {{ $order->post_code }}
                                    </li>
                                <li class="list-group-item">
                                    <strong>Order Date:</strong>
                                    {{ $order->order_date }}
                                </li>
                            </ul>
                        </div>
    
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item active text-center">Order Information</li>
                                <li class="list-group-item">
                                    <strong>Name:</strong> {{ $order->user->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong>
                                    {{ $order->user->phone }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Payment By:</strong>
                                    {{ $order->payment_method }}
                                </li>
                                <li class="list-group-item">
                                    <strong>TNX Id:</strong>
                                    {{ $order->transaction_id }}
                                </li>
    
                                    <li class="list-group-item">
                                        <strong>Invoice No:</strong>
                                        {{ $order->invoice_no }}
                                    </li>
                                <li class="list-group-item">
                                    <strong>Order Total:</strong>
                                    {{ $order->amount }}Tk
                                </li>
    
                                <li class="list-group-item">
                                    <strong>Order Status:</strong>
                                    <span class="badge badge-pill badge-primary">{{ $order->status }}</span> <br>
    
                                </li>
    
                                <li class="list-group-item">
                                @php
                                    $order_r = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                                    @endphp
                                    @if (!$order_r)
                                    <span class="badge badge-pill badge-warning" style="background: red; text:white;">You Have Send a Return Request</span>
                                    @endif
                                </li>
    
                            </ul>
                        </div>
    
                        <div class="row mt-3">
                            <div class="col-md-8 m-auto">
                              <div class="table-responsive">
                                  <table class="table">
                                  <tbody>
                                          <tr style="background: #E9EBEC;">
                                              <td class="col-md-1">
                                                  <label for="">Image</label>
                                              </td>
                                              <td class="col-md-3">
                                              <label for="">Poduct Name</label>
                                              </td>
    
                                              <td class="col-md-3">
                                                  <label for="">Poduct Code</label>
                                              </td>
    
                                              <td class="col-md-2">
                                                  <label for="">Color</label>
                                              </td>
    
                                              <td class="col-md-2">
                                                  <label for="">Size</label>
                                              </td>
    
                                              <td class="col-md-2">
                                                  <label for="">Quantity</label>
                                              </td>
    
                                              <td class="col-md-1">
                                                  <label for="">Price</label>
                                              </td>
    
                                          </tr>
    
                                       @foreach ($orderItems as $item)
                                          <tr>
                                              <td class="col-md-1"><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;" alt="imga"></td>
                                              <td class="col-md-3">
                                                  <div class="product-name"><strong>{{ $item->product->product_name_en }}</strong>
                                                  </div>
                                              </td>
    
                                              <td class="col-md-2">
                                              <strong>{{ $item->product->product_code }}</strong>
                                              </td>
    
                                              <td class="col-md-2">
                                                  <strong>{{ $item->color }}</strong>
                                                  </td>
    
                                              <td class="col-md-2">
                                              <strong>{{ $item->size }}</strong>
                                              </td>
    
                                              <td class="col-md-2">
                                              <strong>{{ $item->qty }}</strong>
                                              </td>
    
                                              <td class="col-md-1">
                                              <strong>৳{{ $item->price }} ({{ $item->price * $item->qty }})</strong>
                                            @if ($order->status == 'Delivered')
                                              <td class="col-md-1">
                                                <a href="{{ url('user/review-create/'.$item->product_id) }}">write a review</a>
                                              </td>
                                            @endif
    
                                          </tr>
                                       @endforeach
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
    
                    @if ($order->status !== "Delivered")
                    @else
                    @php
                        $order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                    @endphp
                        @if ($order)
                        <form action="{{ route('user-return-order') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <div class="form-group">
                                <label for="label">Do You want To Return This Order?:</label>
                                <textarea name="return_reason" id="label"  class="form-control" cols="30" rows="05" placeholder="Return Reason"></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-danger">Submit</button>
                        </form>
                        @endif
                    @endif
    
                </div>
            </div>
          </div>
        </div>
        </div>
    </div>
@endsection


