<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Start of customer routes

Route::get('/get-customers','CustomerController@fetchCustomers');

Route::post('/store-customer','CustomerController@store');

Route::get('/get-customer/{id}','CustomerController@getCustomer');

Route::put('/update-customer/{id}','CustomerController@update');

Route::delete('/delete-customer/{id}','CustomerController@destroy');
//End of customer routes


//Start of product routes

Route::get('/get-products','ProductController@fetchProducts');

Route::post('/store-product','ProductController@store');

Route::get('/get-product/{id}','ProductController@getProduct');

Route::put('/update-product/{id}','ProductController@update');

Route::delete('/delete-product/{id}','ProductController@destroy');

//End of product routes

//Start of order routes 

Route::post('/create-order','OrderController@store');
Route::get('/get-orders','OrderController@getOrders');

Route::get('/get-order/{id}','OrderController@getOrder');
