<?php

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
//Frontend............................................................................................
Route::get('/','HomeController@index')->name('home');
Route::get('/category/product/{id}','HomeController@category_product')->name('category.product');
Route::get('/brand/product/{id}','HomeController@brand_product')->name('brand.product');
Route::get('/brand/product/details/{id}','HomeController@brand_product_details')->name('brand.product.details');
Route::get('/category/product/details/{id}','HomeController@category_product_details')->name('category.product.details');


Route::post('/product/cart','CartController@product_send_to_cart')->name('product.send_to_cart');
Route::get('/show/cart','CartController@show_cart')->name('show.cart');
Route::get('/delete/cart/{rowId}','CartController@delete_to_cart')->name('product.delete_to_cart');
Route::post('/update/cart','CartController@update_cart')->name('update.cart');


Route::get('/customer/login','CheckoutController@check_login')->name('check.login');
Route::post('/customer/checkout','CheckoutController@customer_checkout')->name('customer.checkout');
Route::get('/show/checkout','CheckoutController@checkout')->name('show.checkout');
Route::post('/checkout/submit','CheckoutController@submit')->name('checkout.submit');
Route::post('/register/submit','CheckoutController@register_submit')->name('register.submit');
Route::post('/save/shipping/details','CheckoutController@save_shipping_details')->name('save.shipping.details');
Route::post('/shipping/payment','CheckoutController@payment')->name('shipping.payment');


//Admin Login Route
Route::get('/admin/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/login/submit','Auth\Admin\LoginController@login')->name('admin.login.submit');
//Route::post('/logout/submit','Auth\Admin\LoginController@logout')->name('admin.logout');
Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');
Route::get('/admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

//Backend.............................................................................................
Route::group(['prefix'=> 'admin', 'middleware'=>'auth:admin', 'namespace' => 'Admin'], function(){

	// Routes For Admin Dashboard
	Route::get('/dashboard','DashboardController@dashboard')->name('admin.dashboard');

    // Routes For Category
	Route::resource('/category','CategoryController');
	Route::get('/category/inactive/{id}','CategoryController@inactive')->name('category.inactive');
	Route::get('/category/active/{id}','CategoryController@active')->name('category.active');			

    // Routes For Brand
	Route::resource('/brand','BrandController');
	Route::get('/brand/inactive/{id}','BrandController@inactive')->name('brand.inactive');
	Route::get('/brand/active/{id}','BrandController@active')->name('brand.active');

	// Routes For Product
	Route::resource('/product','ProductController');
	Route::get('/product/inactive/{id}','ProductController@inactive')->name('product.inactive');
	Route::get('/product/active/{id}','ProductController@active')->name('product.active');

	// Routes For Slider
	Route::resource('/slider','SliderController');
	Route::get('/slider/inactive/{id}','SliderController@inactive')->name('slider.inactive');
	Route::get('/slider/active/{id}','SliderController@active')->name('slider.active');

});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
