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
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
// Home Routes...




Route::get('/home/gpio/17/high','HomeController@on');
Route::get('/home/gpio/17/low','HomeController@off');
Route::post('/toggle','HomeController@toggle')->middleware(['auth', 'verified']);
Route::get('/home','HomeController@index')->middleware(['auth', 'verified']);
//========================================================================
// Front Page
//========================================================================
Route::get('/','HomeController@index')->middleware(['auth', 'verified']);
//========================================================================
Route::post('/home/relay/toggle/{id}','Home\RelayController@toggle');
Route::get('/home/relay/toggle/{id}/{action}','Home\RelayController@toggle_action');
Route::resource('/home/relay','Home\RelayController',[ 'names' => 'relay' ])
	->middleware(['auth', 'verified']);
//========================================================================