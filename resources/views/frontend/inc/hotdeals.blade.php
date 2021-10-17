@php
	$hotdeals=App\Models\Product::where('status',1)->where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->get();

@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">HOT DEALS</h3>

	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
		@foreach ($hotdeals as $product)
				<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								@if (session()->get('language') == 'bangla')
								<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
								@else
								<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
								@endif
							</div>
									@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="sale-offer-tag">
				@if($discount<=0)
				<span>
					@if (session()->get('language') == 'bangla')
					নতুন
					@else
					New
				   @endif
			</span>
				@else
			   <span>
				   @if(session()->get('language')=='bangla')
				   {{ bn_price(round($discount)) }}%<br>অফ</span>
				   @else
				   {{ round($discount) }}%<br>OFF
				@endif
				</span>
			  @endif
							</div>
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">DAYS</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="detail.html">
								@if (session()->get('language') == 'bangla')
								<a href="detail.html">{{ $product->product_name_bn }}</a>
								@else
								<a href="detail.html">{{ $product->product_name_en }}</a>
								@endif	
							</a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								@if($product->discount_price==NULL)
								@if (session()->get('language') == 'bangla')
									<span class="price">${{bn_price($product->selling_price) }}</span>
								@else
									<span class="price">${{$product->selling_price }}</span>
			
								@endif
			
								  @else
								@if (session()->get('language') == 'bangla')
								<span class="price">${{bn_price($product->discount_price)}}</span>
								<span class="price-before-discount">${{bn_price($product->selling_price) }}</span>
								@else
								<span class="price">${{$product->discount_price }}</span>
								<span class="price-before-discount">${{$product->selling_price }}</span>
								@endif
							
								@endif				
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
									id="{{ $product->id }}" onclick="productView(this.id)">
										<i class="fa fa-shopping-cart"></i>
								   </button>
									<button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#cartModal" id="{{ $product->id }}" onclick="productView(this.id)">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>
					@endforeach
				
	    
    </div>
<!-- /.sidebar-widget -->
</div>