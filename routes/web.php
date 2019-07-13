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


Route::domain('www.ratnawahyu.com')->group(function () {
    Route::get('/', 'Blog\Frontend\TimelineController@index');
});

// Bot --------------------------------------------------------------------------
Route::post('/bot/telegram', 'Rev\Bot@telegram');
Route::post('/bot/order', 'Rev\Bot@order');
Route::get('/bot/order', 'Rev\Bot@index');
Route::get('/bot/success', 'Rev\Bot@success');
// Bot --------------------------------------------------------------------------

// Reservation --------------------------------------------------------------------------
Route::get('/', 'Blog\Frontend\BlogController@foodtour');
Route::post('/book', 'Rev\BookController@book');
Route::get('/yogyakarta-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/jogja-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/cancel', function () {
        return redirect('/');
    });
Route::get('/success', 'Blog\Frontend\BlogController@success');


// Reservation --------------------------------------------------------------------------

// Reservation Admin --------------------------------------------------------------------------
Route::resource('/rev/availability','Rev\AvailabilityController',[ 'names' => 'rev_availability' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);	
// Reservation Admin --------------------------------------------------------------------------

// Link --------------------------------------------------------------------------
Route::get('/expedia', function () {
        return redirect('https://www.expedia.com/things-to-do/yogyakarta-night-walking-and-food-tours.a669776.activity-details');
});
Route::get('/tourhq', function () {
        return redirect('https://www.tourhq.com/id60620/tours/3Hours-private--tour-itinerary-yogyakarta/travel-through-jogja-citys-mystical-imaginary-line');
});
Route::get('/viator', function () {
        return redirect('https://www.viator.com/tours/Yogyakarta/Food-Journey-in-Yogyakarta-at-Night/d22560-110844P2');
});
Route::get('/airbnb', function () {
        return redirect('https://www.airbnb.com/experiences/434368');
});
Route::get('/volcano', function () {
        return redirect('https://m.viator.com/tours/Yogyakarta/Culture-and-Nature-Journey-at-The-Slope-of-Merapi-Mountain/d22560-110844P3');
});
Route::get('/tripadvisor', function () {
		return redirect('https://www.tripadvisor.com/AttractionProductDetail-g294230-d15646790-Yogyakarta_Night_Walking_and_Food_Tours-Yogyakarta_Region_Java.html');
});
// Link --------------------------------------------------------------------------

// Auth Laravel --------------------------------------------------------------------------
Auth::routes(['verify' => true]);
Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);
// Auth Laravel --------------------------------------------------------------------------


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
	