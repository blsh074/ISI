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

//test case
Route::view('/checkouttest', 'checkout');
Route::view('/index1', 'main.index1');

//notifiable
Route::get('/inform/{notifiableID}', 'TrackController@deleteinform');
Route::get('/informp/{notifiableID}', 'TrackController@deletepromotion');

//track
Route::get('/track',  function(){
    return view('cart.track');
});
Route::resource('/track', 'TrackController');

//home
Route::get('/', function () {
    return view('welcome');
});

//customer cancel 
//Route::get('/track/cancel/{track}', 'TrackController@guestcancel');

//order
Route::get('/order', 'TrackController@orderpage');
Route::get('/order/{order}', 'TrackController@orderprocess');
Route::get('/order/shipping/{order}', 'TrackController@shipping');
Route::get('/order/hold/{order}', 'TrackController@hold');
Route::get('/order/cancel/{order}', 'TrackController@cancel');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//productdetailpage
Route::get('/product/{product}', 'ProductController@productDetail'); 

//products
Route::get('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/product/promotion', 'ProductController@newPromotion');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');

//Route::post('/admin/product/save', 'ProductController@add');
Route::post('/admin/promotion/save', 'ProductController@addcode');
//test case
Route::post('/admin/product/save', 'ProductController@store');

//Mainpage, products list page and searching
Route::get('/lists', 'MainController@index');
Route::get('/lists/searching', 'MainController@searching');

//Cart
Route::get('/addProduct/{productId}', 'CartController@addItem');
Route::get('/removeItem/{productId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');
Route::get('/checkout', 'CartController@checkout');
Route::get('/cart/discount', 'CartController@discount');
Route::get('/cart/{url}', 'CartController@discountcheckout');



//track
Route::get('/track/{track}', 'TrackController@orderDetail');
Route::get('track/{id}', 'TrackController@orderDetail')->name('po');
Route::post('/track',  'TrackController@addItem');

//comment
//Route::get('/rc/{productId}', 'RatingController@index');
Route::post('/rc/{productId}', 'RatingController@addItem');

//change password
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
