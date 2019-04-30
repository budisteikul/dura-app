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




Route::domain('www.vertikaltrip.com')->group(function () {
    Route::get('/', function () {
        return redirect('/yogyakarta-food-tour');
    });
	Route::get('/yogyakarta-food-tour', 'Blog\Frontend\BlogController@foodtour');
	Route::post('/booking', 'Blog\Frontend\BlogController@booking');
});

Route::domain('www.jogjafoodtour.com')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@foodtour');
	Route::post('/booking', 'Blog\Frontend\BlogController@booking');
});


Route::get('/yogyakarta-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/', 'Blog\Frontend\TimelineController@index');

Auth::routes(['verify' => true]);
Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);

//========================================================================
// Blog App Route
//========================================================================
Route::resource('/blog/photo','Blog\Backend\PhotoController',[ 'names' => 'blog_photo' ])
	->middleware(['auth', 'verified']);
Route::resource('/blog/category','Blog\Backend\CategoryController',[ 'names' => 'blog_category' ])
	->middleware(['auth', 'verified']);
	Route::resource('/blog/post','Blog\Backend\PostController',[ 'names' => 'blog_post' ])
	->middleware(['auth', 'verified']);
Route::resource('/blog/file', 'Blog\Backend\FileController',[ 'names' => 'blog_file' ])
	->only('store','destroy')
	->middleware(['auth', 'verified']);
Route::resource('/blog/setting','Blog\Backend\SettingController',[ 'names' => 'blog_setting' ])
	->only('edit','update')
	->middleware(['auth', 'verified']);
	