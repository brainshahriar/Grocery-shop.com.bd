<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\User\WishlistController;
Use App\Http\Controllers\User\CartPageController;
Use App\Http\Controllers\User\CheckoutController;
Use App\Http\Controllers\User\StripeController;


Use App\Http\Controllers\Admin\AdminController;
Use App\Http\Controllers\Admin\BrandController;
Use App\Http\Controllers\Admin\CategoryController;
Use App\Http\Controllers\Admin\ProductController;
Use App\Http\Controllers\Admin\SliderController;
Use App\Http\Controllers\Admin\CouponController;
Use App\Http\Controllers\Admin\ShipAreaController;
Use App\Http\Controllers\Admin\OrderController;
Use App\Http\Controllers\Admin\ReportController;


Use App\Http\Controllers\Frontend\LanguageController;
Use App\Http\Controllers\Frontend\IndexController;
Use App\Http\Controllers\Frontend\CartController;

Use App\Http\Controllers\SearchController;

Use App\Http\Controllers\SslCommerzPaymentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[IndexController::class,'index'] );

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin route
Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'Admin'], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');


    //brands
    Route::get('all-brand',[BrandController::class,'index'])->name('brand');
    Route::post('brand/store',[BrandController::class,'brandStore'])->name('brand-store');
    Route::get('brand-edit/{brand_id}',[BrandController::class,'edit']);
    Route::post('brand/update',[BrandController::class,'brandUpdate'])->name('update-brand');
    Route::get('/brand-delete/{brand_id}',[BrandController::class,'delete']);



    //category
    Route::get('category',[CategoryController::class,'index'])->name('category');
    Route::post('category/store',[CategoryController::class,'categoryStore'])->name('category-store');
    Route::get('/category-edit/{cat_id}',[CategoryController::class,'edit']);
    Route::post('category/update',[CategoryController::class,'catUpdate'])->name('update-category');
    Route::get('/category-delete/{cat_id}',[CategoryController::class,'delete']);

    //category


    //subcategory
    Route::get('sub-category',[CategoryController::class,'subIndex'])->name('sub-category');
    Route::post('sub-category/store',[CategoryController::class,'subCategoryStore'])->name('subcategory-store');
    Route::get('sub-category-edit/{subcat_id}',[CategoryController::class,'subEdit']);
    Route::post('sub-category/update',[CategoryController::class,'subCatUpdate'])->name('update-sub-category');
    Route::get('sub-category-delete/{subcat_id}',[CategoryController::class,'subDelete']);

    //subsubcategory
    Route::get('sub-sub-category',[CategoryController::class,'subSubIndex'])->name('sub-sub-category');
    Route::get('subcategory/ajax/{cat_id}',[CategoryController::class,'getSubCat']);
    Route::post('sub-sub-category/store',[CategoryController::class,'subSubCategoryStore'])->name('sub-subcategory-store');
    Route::get('sub-sub-category-edit/{subsubcat_id}',[CategoryController::class,'subSubEdit']);
    Route::post('sub-subcategory/update',[CategoryController::class,'subSubCatUpdate'])->name('update-sub-subcategory');
    Route::get('sub-sub-category-delete/{subsubcat_id}',[CategoryController::class,'subSubDelete']);

    //product
    Route::get('add-product',[ProductController::class,'addProduct'])->name('add-product');
    Route::post('product/store',[ProductController::class,'store'])->name('store-product');
    Route::get('sub-subcategory/ajax/{subcat_id}',[ProductController::class,'getSubSubCat']);
    Route::get('manage-product',[ProductController::class,'manageProduct'])->name('manage-product');
    Route::get('/product-edit/{product_id}',[ProductController::class,'edit']);
    Route::post('product/data-update',[ProductController::class,'productDataUpdate'])->name('update-product-data');
    Route::post('product/thambnail/update',[ProductController::class,'thambnailUpdate'])->name('update-product-thambnail');
    Route::post('product/multi-image/update',[ProductController::class,'multiImageUpdate'])->name('update-product-image');
    Route::get('/product/multiimg/delete/{id}',[ProductController::class,'multiImageDelete']);
    Route::get('product-delete/{product_id}',[ProductController::class,'delete']);

    //active-inactive product
    Route::get('/product-inactive/{id}',[ProductController::class,'inactive']);
    Route::get('/product-active/{id}',[ProductController::class,'active']);

    //sliders
    Route::get('slider',[SliderController::class,'index'])->name('sliders');
    Route::post('slider/store',[SliderController::class,'store'])->name('slider-store');
    Route::get('slider-edit/{id}',[SliderController::class,'edit']);
    Route::post('slider/update',[SliderController::class,'update'])->name('update-slider');
    Route::get('slider/delete/{id}',[SliderController::class,'destroy']);
    Route::get('slider-inactive/{id}',[SliderController::class,'inactive']);
    Route::get('slider-active/{id}',[SliderController::class,'active']);
//cupon
    Route::get('coupon',[CouponController::class,'create'])->name('coupon');
    Route::post('coupon/store',[CouponController::class,'store'])->name('coupon-store');
    Route::get('coupon-edit/{id}',[CouponController::class,'edit']);
    Route::post('coupon/update',[CouponController::class,'update'])->name('coupon-update');
    Route::get('coupon-delete/{id}',[CouponController::class,'destroy']);

//shipping area
//divisions
    Route::get('division',[ShipAreaController::class,'createDivision'])->name('division');
    Route::post('division/store',[ShipAreaController::class,'storeDivision'])->name('division-store');
    Route::get('division-edit/{id}',[ShipAreaController::class,'edit']);
    Route::post('division/update',[ShipAreaController::class,'update'])->name('division-update');
    Route::get('division-delete/{id}',[ShipAreaController::class,'destroy']);
    //districs
    Route::get('district',[ShipAreaController::class,'createDistrict'])->name('district');
    Route::post('district/store',[ShipAreaController::class,'storeDistrict'])->name('district-store');
    Route::get('district-edit/{id}',[ShipAreaController::class,'districtEdit']);
    Route::post('district/update',[ShipAreaController::class,'districtUpdate'])->name('district-update');
    Route::get('district-delete/{id}',[ShipAreaController::class,'districtDestroy']);

    //state
    Route::get('state',[ShipAreaController::class,'stateCreate'])->name('state');
    Route::get('district-get/ajax/{division_id}',[ShipAreaController::class,'getDistrictAjax']);
    Route::post('state/store',[ShipAreaController::class,'stateStore'])->name('state-store');
    Route::get('state-edit/{id}',[ShipAreaController::class,'stateEdit']);
    Route::post('state/update',[ShipAreaController::class,'stateUpdate'])->name('state-update');
    Route::get('state-delete/{id}',[ShipAreaController::class,'stateDestroy']);

    //orders
    Route::get('pending-orders',[OrderController::class,'pendingOrder'])->name('pending-orders');
    Route::get('orders-view/{id}',[OrderController::class,'viewOrders']);
    Route::get('confirmed-orders',[OrderController::class,'confirmOrder'])->name('confirmed-orders');
    Route::get('processing-orders',[OrderController::class,'processingOrder'])->name('processing-orders');
    Route::get('picked-orders',[OrderController::class,'pickedOrders'])->name('picked-orders');
    Route::get('shipped-orders',[OrderController::class,'shippedOrders'])->name('shipped-orders');
    Route::get('delivered-orders',[OrderController::class,'deliveredOrders'])->name('delivered-orders');
    Route::get('cancel-orders',[OrderController::class,'cancelOrders'])->name('order-cancel');

    //status
    Route::get('pending-to-confirm/{order_id}',[OrderController::class,'pendingToConfirm']);
    Route::get('pending-to-cancel/{order_id}',[OrderController::class,'pendingToCancel']);
    Route::get('confirm-to-processing/{order_id}',[OrderController::class,'confirmToProcess']);
    Route::get('processing-to-picked/{order_id}',[OrderController::class,'processToPicked']);
    Route::get('picked-to-shipped/{order_id}',[OrderController::class,'pickedToShipped']);
    Route::get('shipped-to-delivery/{order_id}',[OrderController::class,'shippedToDelivery']);
    //invoice download
    Route::get('invoice-download/{order_id}',[OrderController::class,'downloadInvoice']);
    //delete order
    Route::get('pending/orders-delete/{order_id}',[OrderController::class,'destroy']);
    //reports
    Route::get('reports',[ReportController::class,'index'])->name('reports');
    Route::post('reports/by-date',[ReportController::class,'reportByDate'])->name('search-by-date');
    Route::post('reports/by-month',[ReportController::class,'reportByMonth'])->name('search-by-month');
    Route::post('reports/by-year',[ReportController::class,'reportByYear'])->name('search-by-year');


});

//admin route end

//user route
    Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'User'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::post('update/data',[UserController::class,'updateData'])->name('update-profile');
    Route::get('image',[UserController::class,'imagePage'])->name('user-image');
    Route::post('update/image',[UserController::class,'updateImage'])->name('update-image');
    Route::get('update/password',[UserController::class,'updatePassPage'])->name('update-password');
    Route::post('store/password',[UserController::class,'storePassword'])->name('store-password');

    

    //wishlist

    //Route::post('/add-to-wishlist/{product_id}',[WishlistController::class,'addToWishlist']);
    Route::get('wishlist',[WishlistController::class,'create'])->name('wishlist');
    Route::get('/get-wishlist-product',[WishlistController::class,'readAllProduct']);
    Route::get('/wishlist-remove/{id}',[WishlistController::class,'destory']);

    //cart
    Route::get('my-cart',[CartController::class,'create'])->name('cart');
    Route::get('/get-cart-product',[CartController::class,'getAllCart']);
    Route::get('/cart-remove/{rowId}',[CartController::class,'destory']);
    Route::get('/cart-increment/{rowId}',[CartController::class,'cartIncrement']);
    Route::get('/cart-decrement/{rowId}',[CartController::class,'cartDecrement']);

    //coupon apply
    Route::post('/coupon-apply',[CartController::class,'couponApply']);
    Route::get('/coupon-calculation',[CartController::class,'couponCalcaultion']);
    Route::get('/coupon-remove',[CartController::class,'removeCoupon']);
   //checkout
    Route::get('/checkout',[CartController::class,'checkoutCreate'])->name('checkout');
    Route::get('district-get/ajax/{division_id}',[CheckoutController::class,'getDistricWithtAjax']);
    Route::get('state-get/ajax/{district_id}',[CheckoutController::class,'getStateWithtAjax']);
    Route::post('payment',[CheckoutController::class,'storeCheckout'])->name('user.checkout.store');

    //stripe payment
    Route::post('stripe/payment-store',[StripeController::class,'store'])->name('stripe.order');

    //user order show

    Route::get('orders',[UserController::class,'orderCreate'])->name('my-orders');
    Route::get('order-view/{order_id}',[UserController::class,'orderView']);
    Route::get('invoice-download/{order_id}',[UserController::class,'invoiceDownload']);
    //return orders
    Route::post('return/orders-submit',[UserController::class,'returnOrderSubmit'])->name('user-return-order');
    Route::get('return/orders',[UserController::class,'returnOrder'])->name('return-orders');
    Route::get('cancel/orders',[UserController::class,'cancelOrder'])->name('cancel-orders');



    

});

//user route

//frontend route
Route::get('language/bangla',[LanguageController::class,'bangla'])->name('bangla.language');
Route::get('language/english',[LanguageController::class,'english'])->name('english.language');

//single wise product show
Route::get('single/product/{id}/{slug}',[IndexController::class,'singleProduct']);

//product tags
Route::get('product/tag/{tag}',[IndexController::class,'tagWiseProduct']);
//subcategory wise product show
Route::get('subcategory/product/{subcat_id}/{slug}',[IndexController::class,'subcategoryProduct']);
//subsubcategory wise product show
Route::get('sub/subcategory/product/{subsubcat_id}/{slug}',[IndexController::class,'subsubcategoryProduct']);
//product cart modal ajax
Route::get('product/view/modal/{id}',[IndexController::class,'productViewAjax']);
//addtocart
Route::post('cart/data/store/{id}',[CartController::class,'addToCart']);
//minicart
Route::get('product/mini/cart',[CartController::class,'miniCart']);

//cart remove
Route::get('/minicart/product-remove/{rowId}',[CartController::class,'miniCartRemove']);
//add to wishlist without login
Route::post('/add-to-wishlist/{product_id}',[CartController::class,'addToWishlist']);


//search

 //search product
 Route::get('/search-products',[SearchController::class,'searchProduct'])->name('search.product');
 Route::post('/find-products',[SearchController::class,'findProducts']);

 // SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
