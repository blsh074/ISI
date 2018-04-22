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
Route::get('/track',  function(){
    return view('cart.track');
});

Route::resource('/track', 'TrackController');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products.index');
});

//Route::resource('/products', 'ProductsController');//old verison

Route::view('/about', 'about');

Route::view('/checkout', 'checkout');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//productdetailpage
//Route::get('/productdetail/{productId}', 'DetailpageController'); 
Route::get('/product/{product}', 'ProductController@productDetail'); 

//products
Route::get('/admin/product/new', 'ProductController@newProduct');
Route::get('/admin/products', 'ProductController@index');
Route::get('/admin/product/destroy/{id}', 'ProductController@destroy');
Route::post('/admin/product/save', 'ProductController@add');

//Mainpage, products list page
Route::get('/lists', 'MainController@index');

//Cart
Route::get('/addProduct/{productId}', 'CartController@addItem');
Route::get('/removeItem/{productId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');

//track
Route::get('/track/{track}', 'TrackController@orderDetail');
Route::post('/track',  'TrackController@addItem');
