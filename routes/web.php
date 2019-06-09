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
        return redirect('/jogja-food-tour');
    });
});

Route::get('/', 'Blog\Frontend\BlogController@foodtour');
Route::get('/yogyakarta-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/jogja-food-tour', 'Blog\Frontend\BlogController@foodtour');

Route::get('/cancel', function () {
        return redirect('/');
    });
Route::get('/success', 'Blog\Frontend\BlogController@success');
Route::get('/order', 'Blog\Frontend\BlogController@book');
Route::post('/order', 'Blog\Frontend\BlogController@order');
Route::post('/ipn', 'Blog\Frontend\BlogController@ipn');
Route::get('/airbnb', function () {
        return redirect('https://www.airbnb.com/experiences/434368');
});
Route::get('/volcano', function () {
        return redirect('https://m.viator.com/tours/Yogyakarta/Culture-and-Nature-Journey-at-The-Slope-of-Merapi-Mountain/d22560-110844P3');
});

Route::get('/tripadvisor', function () {
		return redirect('https://www.tripadvisor.com/AttractionProductDetail-g294230-d15646790-Yogyakarta_Night_Walking_and_Food_Tours-Yogyakarta_Region_Java.html');
});
	

//Route::get('/', 'Blog\Frontend\TimelineController@index');

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
	