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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shopping', 'ShoppingController@shopping')->name('shopping');

Route::get('/addToCart/{id}', 'ShoppingController@addToCart')->name('addToCart');
Route::get('/removeFromCart/{id}', 'ShoppingController@removeFromCart')->name('removeFromCart');
Route::get('/removeAllItems/{id}', 'ShoppingController@removeAllItems')->name('removeAllItems');
Route::get('/getCart', 'ShoppingController@getCart')->name('getCart');

Route::get('/checkout', 'ShoppingController@getCheckout')->name('checkout');
Route::post('/checkout', 'ShoppingController@postCheckout')->name('checkout');

Route::get('/check', 'ShoppingController@check')->name('check');
