@extends('layouts.frontend-master')
@section('title')
Home	
@endsection
@section('frontend-content')
@php
     function bn_price($str)
    {
        $en=array(1,2,3,4,5,6,7,8,9,0);
        $bn=array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $str=str_replace($en,$bn,$str);
        return $str;
    }
@endphp
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
	<div class="row">
	<!-- ============================================== SIDEBAR ============================================== -->	
		<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
			
			<!-- ================================== TOP NAVIGATION ================================== -->
			@php
			$categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
			@endphp
			<div class="side-menu animate-dropdown outer-bottom-xs">
				<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
				<nav class="yamm megamenu-horizontal" role="navigation">
					<ul class="nav">
					   @foreach ($categories as $category)
							<li class="dropdown menu-item">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
									 @if (session()->get('language') == 'bangla')
									  {{ $category->category_name_bn }} 
									  @else {{ $category->category_name_en }}
									 @endif</a>
								<ul class="dropdown-menu mega-menu">
									<li class="yamm-content">
										<div class="row">
											@php
											$subcategories = App\Models\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
											@endphp
											@foreach ($subcategories as $subcat)
													<div class="col-sm-12 col-md-3">
														@if (session()->get('language') == 'bangla')
												
															<h2 class="title">{{ $subcat->subcategory_name_bn }}</h2>
													
													@else
												
															<h2 class="title">{{ $subcat->subcategory_name_en }}</h2>
												
													 @endif
														<ul class="links list-unstyled">
															@php
															 $subsucategories = App\Models\Subsubcategory::where('subcategory_id',$subcat->id)->orderBy('subsubcategory_name_en','ASC')->get();
															@endphp
															@foreach ($subsucategories as $subsubcat)
															<li>
																@if (session()->get('language') == 'bangla')
															<a href="{{ url('sub/subcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_bn) }}">{{ $subsubcat->subsubcategory_name_bn }}</a>
															@else
															 <a href="{{ url('sub/subcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">{{ $subsubcat->subsubcategory_name_en }}</a>
															 @endif
															</li>
															@endforeach
														</ul>
													</div><!-- /.col -->
											@endforeach
										</div><!-- /.row -->
									</li><!-- /.yamm-content -->
								</ul><!-- /.dropdown-menu -->
							</li><!-- /.menu-item -->
						@endforeach
					</ul><!-- /.nav -->
				</nav><!-- /.megamenu-horizontal -->
			</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->

	<!-- ============================================== HOT DEALS ============================================== -->

	

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
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
										<i class="fa fa-shopping-cart"></i>													
									</button>
									<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>
					@endforeach
				
	    
    </div>
<!-- /.sidebar-widget -->
</div>

<!-- ============================================== HOT DEALS: END ============================================== -->


			<!-- ============================================== SPECIAL OFFER ============================================== -->

	

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Special Offer</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
			@foreach ($specialoffer as $product)
	        	        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					@if (session()->get('language') == 'bangla')
					<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
					@else
					<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
					@endif					
				</div><!-- /.image -->
											
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">
					@if (session()->get('language') == 'bangla')
					<a href="detail.html">{{ $product->product_name_bn }}</a>
					@else
					<a href="detail.html">{{ $product->product_name_en }}</a>
					@endif
				</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">

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
				</span>
				
			</div><!-- /.product-price -->
				
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
	</div>
  	</div>
	        </div>
			@endforeach
	    		    </div>
	</div><!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
			<!-- ============================================== PRODUCT TAGS ============================================== -->
@include('frontend.inc.product-tag')
<!-- ============================================== PRODUCT TAGS : END ============================================== -->
			<!-- ============================================== SPECIAL DEALS ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Special Deals</h3>
	<div class="sidebar-widget-body outer-top-xs">
	
			
	
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
			@foreach ($specialdeals as $product)
	        	        <div class="item">
	        	<div class="products special-product">
		        							<div class="product">
							<div class="product-micro">

</div><!-- /.product-micro -->
      
						</div>
		
		 <div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					@if (session()->get('language') == 'bangla')
					<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
					@else
					<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
					@endif					
				</div><!-- /.image -->
		
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Shirt</a></h3>
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
				
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
    	</div>
		        		        	</div>
	        </div>
			@endforeach

	    		    </div>
				
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL DEALS : END ============================================== -->
			<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
	<h3 class="section-title">Newsletters</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<p>Sign Up for Our Newsletter!</p>
        <form role="form">
        	 <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
			  </div>
			<button class="btn btn-primary">Subscribe</button>
		</form>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->
		
			<!-- ============================================== Testimonials============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
        <div class="item">
            <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image"></div>
		<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
        </div><!-- /.item -->

         <div class="item">
         	<div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
		<div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>    
        </div><!-- /.item -->

        <div class="item">
            <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
		<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
        </div><!-- /.item -->

    </div><!-- /.owl-carousel -->
</div>
    
<!-- ============================================== Testimonials: END ============================================== -->

<div class="home-banner">
<img src="{{ asset('frontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 




		</div><!-- /.sidemenu-holder -->
		<!-- ============================================== SIDEBAR : END ============================================== -->

		<!-- ============================================== CONTENT ============================================== -->
		<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
			<!-- ========================================== SECTION – HERO ========================================= -->
			
<div id="hero">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		@foreach ($sliders as $slider)
			
	
		<div class="item" style="background-image: url({{ asset($slider->image) }})">
			<div class="container-fluid">
				<div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1"></div>
					<div class="big-text fadeInDown-1">
						@if(session()->get('language')=='bangla')
						{{ $slider->title_bn }}
						@else
						{{ $slider->title_en }}
						@endif
					</div>

					<div class="excerpt fadeInDown-2 hidden-xs">
					
					<span>
						@if(session()->get('language')=='bangla')
						{{ $slider->description_en }}
						@else
						{{ $slider->description_bn }}
						@endif
					</span>

					</div>
					
					<div class="button-holder fadeInDown-3">
						<a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
					</div>
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div><!-- /.item -->
		@endforeach


		
		

	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTION – HERO : END ========================================= -->	

			<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
		<div class="row">
			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">money back</h4>
						</div>
					</div>	
					<h6 class="text">30 Days Money Back Guarantee</h6>
				</div>
			</div><!-- .col -->

			<div class="hidden-md col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">free shipping</h4>
						</div>
					</div>
					<h6 class="text">Shipping on orders over $99</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">Special Sale</h4>
						</div>
					</div>
					<h6 class="text">Extra $5 off on all items </h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div><!-- /.info-boxes -->
<!-- ============================================== INFO BOXES : END ============================================== -->
<!-- ================================ SCROLL TABS ============================= -->
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
	<div class="more-info-tab clearfix ">
	   <h3 class="new-product-title pull-left"> @if (session()->get('language') == 'bangla') নতুন পণ্যসমূহ @else New Products @endif </h3>
		<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">@if (session()->get('language') == 'bangla') সকল @else All @endif</a></li>
            @foreach ($categories as $category)
            <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">@if (session()->get('language') == 'bangla') {{ $category->category_name_bn }}  @else {{ $category->category_name_en }} @endif</a></li>
            @endforeach
		</ul><!-- /.nav-tabs -->
	</div>

	<div class="tab-content outer-top-xs">
		<div class="tab-pane in active" id="all">
			<div class="product-slider">
				<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @foreach ($proudcts as $product)
                        <div class="item item-carousel">
                            <div class="products">
                            <div class="product">
                                    <div class="product-image">
                                        <div class="image">
											@if (session()->get('language') == 'bangla')
											<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
											@else
											<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
											@endif
                                        </div><!-- /.image -->
										@php
										$amount=0;
										$discount=0;
									 if($product->selling_price >0 && $product->discount_price>0)
									 {
										$amount+=$product->selling_price - $product->discount_price;
										$discount+=($amount/$product->selling_price)*100;
									 }
								   @endphp
                                        <div class="tag new">
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
											   {{ bn_price(round($discount)) }}%</span>
											   @else
											   {{ round($discount) }}%
											@endif
											</span>
										  @endif
                                        </div>

                                    </div><!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            @if (session()->get('language') == 'bangla')
                                            <a href="detail.html">{{ $product->product_name_bn }}</a>
                                            @else
                                            <a href="detail.html">{{ $product->product_name_en }}</a>
                                            @endif
                                        </h3>
                            
                                         <span class="text-danger">No Review</span>
                                
                                        <div class="description"></div>
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
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id=")">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button" >
																@if(session()->get('language')=='bangla')
																Add to cart
																@else
																কার্টে সংযুক্ত করুন
																@endif
																<button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button" title="Add to WIshlist" id="" onclick="">
                                                            <i class="icon fa fa-heart"></i>
                                                        </button>

                                                    </ul>
                                                </div><!-- /.action -->
                                            </div><!-- /.cart -->
                                    </div><!-- /.product -->
                            </div><!-- /.products -->
                        </div><!-- /.item -->
                    @endforeach
                </div><!-- /.home-owl-carousel -->

	        </div><!-- /.product-slider -->

        </div><!-- /.tab-pane -->

		
		
		@foreach ($categories as $category)
			
	

   <div class="tab pan" id="category{{ $category->id }}">
	<div class="product-slider">
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
		@php
			$catwiseProduct=App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get();
		@endphp
		@forelse ($catwiseProduct as $product)
		<div class="item item-carousel">
			<div class="products">
			<div class="product">
					<div class="product-image">
						<div class="image">
							@if (session()->get('language') == 'bangla')
							<a href=""><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
							@else
							<a href=""><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
							@endif
						</div><!-- /.image -->
						@php
						$amount=0;
						$discount=0;
					 if($product->selling_price >0 && $product->discount_price>0)
					 {
						$amount+=$product->selling_price - $product->discount_price;
						$discount+=($amount/$product->selling_price)*100;
					 }
				   @endphp
						<div class="tag new">
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
							   {{ bn_price(round($discount)) }}%</span>
							   @else
							   {{ round($discount) }}%
							@endif
							</span>
						  @endif
						</div>

					</div><!-- /.product-image -->

					<div class="product-info text-left">
						<h3 class="name">
							@if (session()->get('language') == 'bangla')
							<a href="detail.html">{{ $product->product_name_bn }}</a>
							@else
							<a href="detail.html">{{ $product->product_name_en }}</a>
							@endif
						</h3>
			
						 <span class="text-danger">No Review</span>
				
						<div class="description"></div>
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
									<ul class="list-unstyled">
										<li class="add-cart-button btn-group">
											<button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id=")">
												<i class="fa fa-shopping-cart"></i>
											</button>
											<button class="btn btn-primary cart-btn" type="button" >
												@if(session()->get('language')=='bangla')
												Add to cart
												@else
												কার্টে সংযুক্ত করুন
												@endif
												<button>
										</li>
										<button class="btn btn-primary icon" type="button" title="Add to WIshlist" id="" onclick="">
											<i class="icon fa fa-heart"></i>
										</button>

									</ul>
								</div><!-- /.action -->
							</div><!-- /.cart -->
					</div><!-- /.product -->
			</div><!-- /.products -->
		</div><!-- /.item -->
			@empty
			@if (session()->get('language') == 'bangla')
			<h5 class="text-danger">কোনো পণ্য পাওয়া যায়নি</h5>
			@else
			<h5 class="text-danger">No Product Found</h5>
			@endif
		@endforelse
	</div><!-- /.home-owl-carousel -->
   </div>
</div>
   @endforeach
	</div><!-- /.tab-content -->
</div>
		<!-- /.scroll-tabs -->
<!-- ================== SCROLL TABS : END ================================= -->
			<!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
	<div class="row">
<div class="col-md-7 col-sm-7">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="assets/images/banners/home-banner1.jpg" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
<div class="col-md-5 col-sm-5">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="assets/images/banners/home-banner2.jpg" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.wide-banners -->

<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
			<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Featured products</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
		@foreach ($featureds as $product)	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			
			<div class="image">
				@if (session()->get('language') == 'bangla')
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@else
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@endif
			</div>
			<!-- /.image -->			

			@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="tag new">
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
				   {{ bn_price(round($discount)) }}%</span>
				   @else
				   {{ round($discount) }}%
				@endif
				</span>
			  @endif
			</div>	   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">
				@if (session()->get('language') == 'bangla')
				<a href="detail.html">{{ $product->product_name_bn }}</a>
				@else
				<a href="detail.html">{{ $product->product_name_en }}</a>
				@endif
			</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					
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
	
				</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div>
		@endforeach<!-- /.item -->
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->

<!-- skip product 0 -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla')
		{{ $skip_category_0->category_name_bn }}</h3>
		@else
		{{ $skip_category_0->category_name_en }}</h3>
		@endif
		
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
		@foreach ($skip_product_0 as $product)	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			
			<div class="image">
				@if (session()->get('language') == 'bangla')
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@else
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@endif
			</div>
			<!-- /.image -->			

			@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="tag new">
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
				   {{ bn_price(round($discount)) }}%</span>
				   @else
				   {{ round($discount) }}%
				@endif
				</span>
			  @endif
			</div>	   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">
				@if (session()->get('language') == 'bangla')
				<a href="detail.html">{{ $product->product_name_bn }}</a>
				@else
				<a href="detail.html">{{ $product->product_name_en }}</a>
				@endif
			</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					
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
	
				</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div>
		@endforeach<!-- /.item -->
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla')
		{{ $skip_category_1->category_name_bn }}</h3>
		@else
		{{ $skip_category_1->category_name_en }}</h3>
		@endif
		
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
		@foreach ($skip_product_1 as $product)	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			
			<div class="image">
				@if (session()->get('language') == 'bangla')
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@else
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@endif
			</div>
			<!-- /.image -->			

			@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="tag new">
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
				   {{ bn_price(round($discount)) }}%</span>
				   @else
				   {{ round($discount) }}%
				@endif
				</span>
			  @endif
			</div>	   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">
				@if (session()->get('language') == 'bangla')
				<a href="detail.html">{{ $product->product_name_bn }}</a>
				@else
				<a href="detail.html">{{ $product->product_name_en }}</a>
				@endif
			</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					
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
	
				</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div>
		@endforeach<!-- /.item -->
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla')
		{{ $skip_category_2->category_name_bn }}</h3>
		@else
		{{ $skip_category_2->category_name_en }}</h3>
		@endif
		
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
		@foreach ($skip_product_2 as $product)	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			
			<div class="image">
				@if (session()->get('language') == 'bangla')
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@else
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@endif
			</div>
			<!-- /.image -->			

			@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="tag new">
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
				   {{ bn_price(round($discount)) }}%</span>
				   @else
				   {{ round($discount) }}%
				@endif
				</span>
			  @endif
			</div>	   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">
				@if (session()->get('language') == 'bangla')
				<a href="detail.html">{{ $product->product_name_bn }}</a>
				@else
				<a href="detail.html">{{ $product->product_name_en }}</a>
				@endif
			</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					
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
	
				</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div>
		@endforeach<!-- /.item -->
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla')
		{{ $skip_brand_0->brand_name_bn }}</h3>
		@else
		{{ $skip_brand_0->brand_name_en }}</h3>
		@endif
		
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
		@foreach ($skip_product_brand_0 as $product)	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			
			<div class="image">
				@if (session()->get('language') == 'bangla')
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@else
				<a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
				@endif
			</div>
			<!-- /.image -->			

			@php
			$amount=0;
			$discount=0;
		 if($product->selling_price >0 && $product->discount_price>0)
		 {
			$amount+=$product->selling_price - $product->discount_price;
			$discount+=($amount/$product->selling_price)*100;
		 }
	   @endphp
			<div class="tag new">
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
				   {{ bn_price(round($discount)) }}%</span>
				   @else
				   {{ round($discount) }}%
				@endif
				</span>
			  @endif
			</div>	   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">
				@if (session()->get('language') == 'bangla')
				<a href="detail.html">{{ $product->product_name_bn }}</a>
				@else
				<a href="detail.html">{{ $product->product_name_en }}</a>
				@endif
			</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					
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
	
				</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div>
		@endforeach<!-- /.item -->
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
			<!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
	<div class="row">

		<div class="col-md-12">
			<div class="wide-banner cnt-strip">
				<div class="image">
					<img class="img-responsive" src="assets/images/banners/home-banner.jpg" alt="">
				</div>	
				<div class="strip strip-text">
					<div class="strip-inner">
						<h2 class="text-right">New Mens Fashion<br>
						<span class="shopping-needs">Save up to 40% off</span></h2>
					</div>	
				</div>
				<div class="new-label">
				    <div class="text">NEW</div>
				</div><!-- /.new-label -->
			</div><!-- /.wide-banner -->
		</div><!-- /.col -->

	</div><!-- /.row -->
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
			<!-- ============================================== BEST SELLER ============================================== -->

<div class="best-deal wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">Best seller</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
	        	        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p20.jpg" alt="">
					</a>					
				</div><!-- /.image -->
					
											
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
			
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p21.jpg" alt="">
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
			
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p22.jpg" alt="">
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
			
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p23.jpg" alt="">
						</a>					
				</div><!-- /.image -->
					
					
											
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
		
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p24.jpg" alt="">
					</a>					
				</div><!-- /.image -->
											
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
		
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p25.jpg" alt="">
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
			
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		        <div class="item">
	        	<div class="products best-product">
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p26.jpg" alt="">
								</a>					
				</div><!-- /.image -->
											
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
	
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        							<div class="product">
							<div class="product-micro">
	<div class="row product-micro-row">
		<div class="col col-xs-5">
			<div class="product-image">
				<div class="image">
					<a href="#">
						<img src="assets/images/products/p27.jpg" alt="">
					</a>					
				</div><!-- /.image -->
					
					
								</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col2 col-xs-7">
			<div class="product-info">
				<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
				<span class="price">
					$450.99				</span>
				
			</div><!-- /.product-price -->
	
			</div>
		</div><!-- /.col -->
	</div><!-- /.product-micro-row -->
</div><!-- /.product-micro -->
      
						</div>
		        		        	</div>
	        </div>
	    		    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== BEST SELLER : END ============================================== -->	

			<!-- ============================================== BLOG SLIDER ============================================== -->
<section class="section latest-blog outer-bottom-vs wow fadeInUp">
	<h3 class="section-title">latest form blog</h3>
	<div class="blog-slider-container outer-top-xs">
		<div class="owl-carousel blog-slider custom-carousel">
													
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a></h3>	
							<span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
							<p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>	
							<span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
							<p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>	
							<span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
						<h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>	
							<span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
												
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
					
					
						<div class="blog-post-info text-left">
							<h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>	
							<span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
							<p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
							<a href="#" class="lnk btn btn-primary">Read more</a>
						</div><!-- /.blog-post-info -->
						
						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			
						
		</div><!-- /.owl-carousel -->
	</div><!-- /.blog-slider-container -->
</section><!-- /.section -->
<!-- ============================================== BLOG SLIDER : END ============================================== -->	

			<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section wow fadeInUp new-arriavls">
	<h3 class="section-title">New Arrivals</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p19.jpg" alt=""></a>
			</div><!-- /.image -->			

			<div class="tag new"><span>new</span></div>                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p28.jpg" alt=""></a>
			</div><!-- /.image -->			

			<div class="tag new"><span>new</span></div>                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p30.jpg" alt=""></a>
			</div><!-- /.image -->			

			                        <div class="tag hot"><span>hot</span></div>		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p1.jpg" alt=""></a>
			</div><!-- /.image -->			

			                        <div class="tag hot"><span>hot</span></div>		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p2.jpg" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p3.jpg" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$450.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

		</div><!-- /.homebanner-holder -->
		<!-- ============================================== CONTENT : END ============================================== -->
	</div><!-- /.row -->
@endsection