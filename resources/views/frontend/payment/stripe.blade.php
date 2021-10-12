@extends('layouts.frontend-master')
@section('frontend-content')
@section('title') Stripe Payment @endsection
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Payment</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
    

				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Your Shopping Amount</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">                   
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
            <div class="col-md-6">
                <!-- checkout-progress-sidebar -->
             <form action="{{ route('stripe.order') }}" method="POST" id="payment-form">
                @csrf
            <div class="form-now">
                <label for="card-element" class="">
                    Credit or Debit Card
                </label>
                <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                <input type="hidden" name="notes" value="{{ $data['notes'] }}">

                <div id="card-element">

                </div>
                <div id="card-errors" role="alert"></div>
            </div>
            <br>
            <button class="btn btn-primary">Submit Payment</button>
            </form>					<!-- checkout-progress-sidebar -->
        </div>

			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- =================== BRANDS CAROUSEL =================================== -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    // Create a Stripe client.
var stripe = Stripe('pk_test_51JjlquJOzdETOk5uJCn5QG9RJG5vPzjXgLhEFSF0KhlV3GI7omRstT6mFlQMBRfnZxqWRIR1MEFzBpwww25o5wSm00FP9eTHi4');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
}
</script>
@endsection
