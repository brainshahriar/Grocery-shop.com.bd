<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;



Use App\Http\Controllers\Admin\AdminController;
Use App\Http\Controllers\Admin\BrandController;
Use App\Http\Controllers\Admin\CategoryController;
Use App\Http\Controllers\Admin\ProductController;
Use App\Http\Controllers\Admin\SliderController;

Use App\Http\Controllers\Frontend\LanguageController;
Use App\Http\Controllers\Frontend\IndexController;
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




});

//admin route

//user route
    Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'User'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::post('update/data',[UserController::class,'updateData'])->name('update-profile');
    Route::get('image',[UserController::class,'imagePage'])->name('user-image');
    Route::post('update/image',[UserController::class,'updateImage'])->name('update-image');
    Route::get('update/password',[UserController::class,'updatePassPage'])->name('update-password');
    Route::post('store/password',[UserController::class,'storePassword'])->name('store-password');

});

//user route

//frontend route
Route::get('language/bangla',[LanguageController::class,'bangla'])->name('bangla.language');
Route::get('language/english',[LanguageController::class,'english'])->name('english.language');
Route::get('single/product/{id}/{slug}',[IndexController::class,'singleProduct']);