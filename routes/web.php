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

// Reservation --------------------------------------------------------------------------
Route::get('/', 'Blog\Frontend\BlogController@foodtour');
Route::get('/ticket', function () {
        return redirect('/');
    });
Route::get('/ticket/{id}', 'Rev\BookController@ticket');

Route::post('/book', 'Rev\BookController@book');

Route::get('/tour/{id}', 'Blog\Frontend\BlogController@tour');
Route::get('/payment/bokun', 'Blog\Frontend\BlogController@bokun');

Route::get('/review/tripadvisor', function () {
        return redirect('https://www.tripadvisor.com/UserReviewEdit-g12872450-d15646790.html');
    });

//Route::get('/order', 'Blog\Frontend\BlogController@paypal');

Route::get('/order', function () {
        //return redirect('/tour/yogyakarta-night-walking-and-food-tours');
		return redirect('/payment/bokun');
    });

Route::get('/yogyakarta-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/jogja-food-tour', 'Blog\Frontend\BlogController@foodtour');
Route::get('/cancel', function () {
        return redirect('/');
    });
Route::get('/success', 'Blog\Frontend\BlogController@success');
Route::get('/availability', 'Rev\AvailabilityController@getAvailability');
// Reservation --------------------------------------------------------------------------

// Reservation Admin --------------------------------------------------------------------------
Route::resource('/rev/availability','Rev\AvailabilityController',[ 'names' => 'rev_availability' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/review','Rev\ReviewController',[ 'names' => 'rev_review' ])
	->middleware(['auth', 'verified']);	
// Reservation Admin --------------------------------------------------------------------------

// Link --------------------------------------------------------------------------
// Tugu Pal Putih
//https://www.google.com/maps/reserve/v/ttd/c/v1m16zP9SuA?source=pa&hl=id-ID&gei=2lc2XZSqMsT-9QOXy62oBg&sourceurl=https://www.google.com/search?q%3Dtugu%2Bpal%2Bputih%26oq%3Dtugu%2Bpal%2Bputih%26aqs%3Dchrome.0.69i59j0l5.1431j0j7%26sourceid%3Dchrome%26ie%3DUTF-8
// Vertikal Trip
//https://www.google.com/maps/reserve/v/ttd/c/pIOOLeN8cZQ?source=pa&hl=id-ID&gei=tAQ3XeWxGPXWz7sP__OKsAw&sourceurl=https://www.google.com/search?q%3Dvertikal%2Btrip%26oq%3Dvert%26aqs%3Dchrome.1.69i60j69i59j0j69i60l2j69i57.2623j0j4%26sourceid%3Dchrome%26ie%3DUTF-8
Route::get('/facebook', function () {
        return redirect('https://www.facebook.com/events/2283084325275232/');
});
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
Route::get('/eventbrite', function () {
		return redirect('https://jogjafoodtour.eventbrite.com');
});
Route::get('/maps', function () {
		return redirect('maps://www.google.com/maps/search/?api=1&query=tugu+pal+putih');
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
	