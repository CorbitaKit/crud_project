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


Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});



Route::post('/create-user','UserController@register')->name('create-user');

Route::post('/login-user','UserController@login')->name('login');

Route::get('/dashboard',function(){
	return view('index');
})->name('dashboard');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('{any?}', 'HomeController@index')->where('any', '^(?!(api|xyz).*$).*');