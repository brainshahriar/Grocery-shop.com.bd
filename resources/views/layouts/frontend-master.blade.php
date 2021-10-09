<!DOCTYPE html>
<html lang="en">
	
<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
        <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>@yield('title')</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css">
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/blue.css">
	    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.carousel.css">
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.transitions.css">
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.min.css">
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/rateit.css">
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="{{ asset('backend') }}/lib/toastr/toastr.css">

		

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-awesome.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <style>
            .search-area{
                position: relative;
            }
            #suggestProduct {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: #fff;
                z-index: 999;
                border-radius: 4px;
                margin-top: 2px;
            }
            </style>

	</head>
    <body class="cnt-home">
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
					<li><a href="{{ route('user.dashboard') }}"><i class="icon fa fa-user"></i>
                        @if(session()->get('language')=='bangla') 
                        আমার প্রফাইল
                        @else
                        My Account
                    @endif
                    </a></li>
					<li><a href="{{ route('wishlist') }}"  @yield('title')><i class="icon fa fa-heart"></i>Wishlist</a></li>
					<li><a href="{{ route('cart') }}"  @yield('title')><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
					<li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
                    
					<li>
                        @auth
                        <a href="{{ route('user.dashboard') }}"><i class="icon fa fa-lock"></i>{{ Auth::user()->name }}</a>
                        <li>
                         
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>

                            @else
                            <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login/Register</a>

                        @endauth
                    </li>
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">USD</a></li>
							<li><a href="#">INR</a></li>
							<li><a href="#">GBP</a></li>
						</ul>
					</li>

					<li class="dropdown dropdown-small">
						<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value" >   @if(session()->get('language')=='bangla') ভাষা পরিবর্তন করুন @else Language @endif</span><b class="caret"></b></a>
						<ul class="dropdown-menu">
                            @if(session()->get('language')=='bangla')
                            <li><a href="{{ route('english.language') }}">English</a></li>
                            @else
                            <li><a href="{{ route('bangla.language') }}">বাংলা</a></li>
                            @endif
						</ul>
					</li>
				</ul><!-- /.list-unstyled -->
			</div><!-- /.cnt-cart -->
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="{{ url('/') }}">
		
		<img src="{{ asset('frontend') }}/assets/images/logo.png" alt="">

	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
					<!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form action="{{ route('search.product') }}" method="GET">
        <div class="control-group">
            <input class="search-field" autocomplete="off" onfocus="showSearchResult()" onblur="hideSearchResult()" name="search" id="search" placeholder="Search here..." />
            <button class="search-button"></button>
        </div>
    </form>
    <div id="suggestProduct"></div>
</div><!-- /.search-area -->
<!-- ============================= SEARCH AREA : END ============== -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
            <div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count" id="cartQty"></span></div>
				<div class="total-price-basket">
					<span class="lbl">cart -</span>
					<span class="total-price">
						<span class="sign">$</span><span class="value" id="cartSubTotal"></span>
					</span>
				</div>
				
			
		    </div>
		</a>
		<ul class="dropdown-menu">
			<li>
                {{-- start mini cart --}}
                <div id="miniCart">

                </div>
               {{-- end mini cart --}}
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Sub Total :</span><span class='price' id="cartSubTotal"></span>
						
				</div>
				<div class="clearfix"></div>
					
				<a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->

<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="active dropdown yamm-fw">
				<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                    @if(session()->get('language')=='bangla') 
                    হোম
                    @else
                    Home
                @endif</a>				
			</li>

            @php
                $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
            @endphp
            @foreach ($categories as $category)
                
       
			<li class="dropdown yamm mega-menu">
                @if(session()->get('language')=='bangla') 
                <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name_bn }}</a>
                @else
				<a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name_en }}</a>
                @endif
                <ul class="dropdown-menu container">
					<li>
               		<div class="yamm-content ">
                      <div class="row">

                        @php
                          $subcategories = App\Models\Subcategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                        @endphp
                 @foreach ($subcategories as $subcat)
                              
                        
                   <div class="col-xs-12 col-sm-6 col-md-2 col-menu">

                        @if(session()->get('language')=='bangla') 
                        <h2 class="title">{{ $subcat->subcategory_name_bn }}</h2>
                        @else
                        <h2 class="title">{{ $subcat->subcategory_name_en }}</h2>
                        @endif
                    
                       @php
                        $subsubcategory = App\Models\Subsubcategory::where('subcategory_id',$subcat->id)->orderBy('subsubcategory_name_en','ASC')->get();
                       @endphp

                       @foreach ($subsubcategory as $subsubcat)
                           
                    
                        <ul class="links">
                            @if(session()->get('language')=='bangla')
                            <li><a href="#">{{ $subsubcat->subsubcategory_name_bn }}</a></li>  
                            @else
                            <li><a href="#">{{ $subsubcat->subsubcategory_name_en }}</a></li>  
                            @endif                               
                        </ul>
                        @endforeach
                    </div><!-- /.col -->
                    @endforeach



                    
       <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                    <img class="img-responsive" src="assets/images/banners/top-menu-banner.jpg" alt="">
                              </div><!-- /.yamm-content -->					
                        </div>
                        </div>

                        </li>
				</ul>
				
			</li>
            @endforeach

			<li class="dropdown mega-menu">
				<a href="category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics
				   <span class="menu-label hot-menu hidden-xs">hot</span>
				</a>
                <ul class="dropdown-menu container">
					<li>
						<div class="yamm-content">
    <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                <h2 class="title">Laptops</h2>
                <ul class="links">
                   <li><a href="#">Gaming</a></li>
                   <li><a href="#">Laptop Skins</a></li>
                    <li><a href="#">Apple</a></li>
                    <li><a href="#">Dell</a></li>
                    <li><a href="#">Lenovo</a></li>
                    <li><a href="#">Microsoft</a></li>
                    <li><a href="#">Asus</a></li>
                     <li><a href="#">Adapters</a></li>
                     <li><a href="#">Batteries</a></li>
                     <li><a href="#">Cooling Pads</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                <h2 class="title">Desktops</h2>
                <ul class="links">
                    <li><a href="#">Routers & Modems</a></li>
                    <li><a href="#">CPUs, Processors</a></li>
                    <li><a href="#">PC Gaming Store</a></li>
                    <li><a href="#">Graphics Cards</a></li>
                    <li><a href="#">Components</a></li>
                    <li><a href="#">Webcam</a></li>
                    <li><a href="#">Memory (RAM)</a></li>
                    <li><a href="#">Motherboards</a></li>
                    <li><a href="#">Keyboards</a></li>
                    <li><a href="#">Headphones</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                <h2 class="title">Cameras</h2>
                <ul class="links">
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Binoculars</a></li>
                    <li><a href="#">Telescopes</a></li>
                    <li><a href="#">Camcorders</a></li>
                    <li><a href="#">Digital</a></li>
                     <li><a href="#">Film Cameras</a></li>
                     <li><a href="#">Flashes</a></li>
                     <li><a href="#">Lenses</a></li>
                     <li><a href="#">Surveillance</a></li>
                      <li><a href="#">Tripods</a></li>
                     
                </ul>
            </div><!-- /.col -->
            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                <h2 class="title">Mobile Phones</h2>
                <ul class="links">
                    <li><a href="#">Apple</a></li>
                    <li><a href="#">Samsung</a></li>
                    <li><a href="#">Lenovo</a></li>
                    <li><a href="#">Motorola</a></li>
                    <li><a href="#">LeEco</a></li>
                    <li><a href="#">Asus</a></li>
                    <li><a href="#">Acer</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Headphones</a></li>
                     <li><a href="#">Memory Cards</a></li>
                </ul>
            </div>
            
             <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner">
             <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a>
             </div>
    </div><!-- /.row -->
</div><!-- /.yamm-content -->					</li>
				</ul>
			</li>

			
             <li class="dropdown  navbar-right special-menu">
				<a href="#">Todays offer</a>
			</li>
					
			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->


            </div><!-- /.nav-bg-class -->
        </div><!-- /.navbar-default -->
    </div><!-- /.container-class -->

</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->



@yield('frontend-content')




<!-- BRand -->

@include('frontend.inc.brand')

<!-- BRands -->




<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">


    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Contact Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
        <ul class="toggle-footer" style="">
            <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>+(888) 123-4567<br>+(888) 456-7890</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <span><a href="#">flipmart@themesground.com</a></span>
                </div>
            </li>
              
            </ul>
    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Customer Service</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="#" title="Contact us">My Account</a></li>
                <li><a href="#" title="About us">Order History</a></li>
                <li><a href="#" title="faq">FAQ</a></li>
                <li><a href="#" title="Popular Searches">Specials</a></li>
                <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Corporation</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                          <li class="first"><a title="Your Account" href="#">About us</a></li>
                <li><a title="Information" href="#">Customer Service</a></li>
                <li><a title="Addresses" href="#">Company</a></li>
                <li><a title="Addresses" href="#">Investor Relations</a></li>
                <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Why Choose Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                <li><a href="#" title="Blog">Blog</a></li>
                <li><a href="#" title="Company">Company</a></li>
                <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                  <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                  <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                  <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
                  <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                  <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
                  <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
                  <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="assets/images/payments/1.png" alt=""></li>
                        <li><img src="assets/images/payments/2.png" alt=""></li>
                        <li><img src="assets/images/payments/3.png" alt=""></li>
                        <li><img src="assets/images/payments/4.png" alt=""></li>
                        <li><img src="assets/images/payments/5.png" alt=""></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div>
    </div>



    @include('modal.cart-modal')
</footer>
<!-- ============================================================= FOOTER : END============================================================= -->


	<!-- For demo purposes – can be removed on production -->
	
	
	<!-- For demo purposes – can be removed on production : End -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="{{ asset('frontend') }}/assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
	
	<script src="{{ asset('frontend') }}/assets/js/echo.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.rateit.min.js"></script>
    <script type="{{ asset('frontend') }}/text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
	<script src="{{ asset('frontend') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/sweetalert2@8.js"></script>

    <script type="text/javascript" src="{{ asset('backend') }}/lib/toastr/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        var type="{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
                case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
                case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;         
        }
        @endif
    </script>

<script>
    $("body").on("keyup","#search",function () {
        let searchData = $("#search").val();
        if (searchData.length > 0) {
            $.ajax({
            type:'POST',
            url: "{{ url('/find-products') }}",
            data:{search:searchData},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(result){
                $('#suggestProduct').html(result)
            }
            });
        }
        if(searchData.length < 1) $('#suggestProduct').html("");
    })
</script>


<script>
    function showSearchResult(){
        $('#suggestProduct').slideDown();
    }
    function hideSearchResult(){
        $('#suggestProduct').slideUp();
    }
</script>

@yield('scripts')

<script>
    function wishlist(){
           $.ajax({
               type:'GET',
                url: "{{ url('/user/get-wishlist-product') }}",
               dataType:'json',
               success:function(response){
                   var rows = ""
                  $.each(response, function(key,value){
                      rows += `<tr>
                       <td class="col-md-2"><img src="/${value.product.product_thambnail}" alt="imga"></td>
                       <td class="col-md-7">
                           <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
   
                           <div class="price">
                           ${value.product.discount_price == null
                               ? `$${value.product.selling_price}`
                               :
                               `$${value.product.discount_price} <span>$${value.product.selling_price}</span>`
                           }
                           </div>
                       </td>
                       <td class="col-md-2">
                           <button class="btn-upper btn btn-primary" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id="${value.product_id}" onclick="productView(this.id)">Add to cart</button>
                       </td>
                       <td class="col-md-1 close-btn">
                           <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-times"></i></button>
                       </td>
                   </tr>`
   
                  });
   
                  $('#wishlist').html(rows);
   
               }
           })
       }
       wishlist();
   
     function wishlistRemove(id){
         $.ajax({
             type:'GET',
             url: "{{ url('/user/wishlist-remove/') }}/"+id,
             dataType:'json',
             success:function(data){
                 wishlist();
                 //  start message
                 const Toast = Swal.mixin({
                         toast: true,
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 3000
                       })
                      if($.isEmptyObject(data.error)){
                           Toast.fire({
                             type: 'success',
                             title: data.success
                           })
                      }else{
                            Toast.fire({
                               type: 'error',
                               title: data.error
                           })
            }
                     //  end message
             }
         });
     }
   </script>
   {{-- cart page --}}
<script>
 function cart(){
        $.ajax({
            type:'GET',
             url: "{{ url('/user/get-cart-product') }}",
            dataType:'json',
            success:function(response){
                var rows = ""
               $.each(response.carts, function(key,value){
                   rows += `<tr>
					<td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="height:60px; width:60px;"></td>
					<td class="col-md-2">
						<div class="product-name"><strong>${value.name}</strong></div>
						<strong>
                        $${value.price}
						</strong>
					</td>
                    <td class="col-md-2">
                        <strong>${value.options.color}</strong>
					</td>
                    <td class="col-md-2">
                        ${value.options.size == null
                            ? `<span >......</span>`
                            :
                            `<strong>${value.options.size}</strong>`
                        }
                    </td>
                    <td class="col-md-2">
                        ${value.qty > 1
                        ? ` <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                        : ` <button type="submit" class="btn btn-success btn-sm" disabled>-</button>`
                        }
                        <input type="text" value="${value.qty}" min="1" max="100" disabled style="width:25px;">
                        <button type="submit" id="${value.rowId}" onclick="cartIncrement(this.id)" class="btn btn-danger btn-sm">+</button>
                    </td>
                    <td class="col-md-1">
                        <strong>$${value.subtotal}</strong>
                    </td>
					<td class="col-md-1 close-btn">
						<button type="submit" class="" id="${value.rowId}" onclick="CartRemove(this.id)" ><i class="fa fa-times"></i></button>
					</td>
				</tr>`
               });
               $('#cartPage').html(rows);
            }
        })
    }
    cart();

    function CartRemove(id){
        $.ajax({
             type:'GET',
             url: "{{ url('/user/cart-remove/') }}/"+id,
             dataType:'json',
             success:function(data){
                 cart();
                 miniCart();
                 //  start message
                 const Toast = Swal.mixin({
                         toast: true,
                         position: 'top-end',
                         showConfirmButton: false,
                         timer: 3000
                       })
                      if($.isEmptyObject(data.error)){
                           Toast.fire({
                             type: 'success',
                             title: data.success
                           })
                      }else{
                            Toast.fire({
                               type: 'error',
                               title: data.error
                           })
            }
                     //  end message
             }
         });
    }
    function cartIncrement(rowId){
        $.ajax({
            type:'GET',
            url: "{{ url('/cart-increment/') }}/"+rowId,
            dataType:'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
    }
    function cartDecrement(rowId){
        $.ajax({
            type:'GET',
            url: "{{ url('/cart-decrement/') }}/"+rowId,
            dataType:'json',
            success:function(data){
                couponCalculation();
                cart();
                miniCart();
            }
        });
 }


</script>
   
</body>

</html>









