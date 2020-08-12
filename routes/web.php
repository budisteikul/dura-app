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

//========================================================================
// Auth Laravel
//========================================================================
//Auth::routes(['verify' => true]);
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/','HomeController@index')->middleware(['auth', 'verified']);
Route::get('/home','HomeController@index')->middleware(['auth', 'verified']);

Route::resource('/products','ProductController',[ 'names' => 'route_products' ])
	->middleware(['auth', 'verified']);
