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

Route::domain('localhost')->group(function () {
    Route::get('/', 'Blog\Frontend\BlogController@index');
});

Route::domain('192.168.0.2')->group(function () {
    Route::get('/', 'Blog\Frontend\BlogController@index');
});

Route::domain('www.ratnawahyu.com')->group(function () {
    Route::get('/', 'Blog\Frontend\TimelineController@index');
});

Route::domain('vertikaltrip.herokuapp.com')->group(function () {
    Route::get('/', 'Blog\Frontend\BlogController@foodtour');
	Route::get('/success', 'Blog\Frontend\BlogController@success');
	Route::get('/availability', 'Rev\AvailabilityController@getAvailability');
	Route::post('/book', 'Rev\BookController@book');
	Route::get('/payment', 'Blog\Frontend\BlogController@payment');
	Route::get('/payment/shoppingcart', 'Blog\Frontend\BlogController@shoppingcart');
	Route::get('/payment/stripe', 'Blog\Frontend\BlogController@stripe');
	Route::get('/payment/stripe/checkout', 'Blog\Frontend\BlogController@stripe_checkout');
	Route::get('/payment/paypal', 'Blog\Frontend\BlogController@paypal');
	Route::get('/payment/paypal/checkout', 'Blog\Frontend\BlogController@paypal_checkout');
	Route::get('/tour/{id}', 'Blog\Frontend\BlogController@tour');
	Route::get('/order', function () {
        return redirect('/tour/yogyakarta-night-walking-and-food-tours');
    });
	Route::get('/cancel', function () {
        return redirect('/');
    });
	Route::get('/index', 'Blog\Frontend\BlogController@index');
});

Route::domain('www.vertikaltrip.com')->group(function () {
    Route::get('/', 'Blog\Frontend\BlogController@foodtour');
	Route::get('/success', 'Blog\Frontend\BlogController@success');
	Route::get('/availability', 'Rev\AvailabilityController@getAvailability');
	Route::post('/book', 'Rev\BookController@book');
	Route::get('/payment', 'Blog\Frontend\BlogController@payment');
	Route::get('/payment/shoppingcart', 'Blog\Frontend\BlogController@shoppingcart');
	Route::get('/payment/stripe', 'Blog\Frontend\BlogController@stripe');
	Route::get('/payment/stripe/checkout', 'Blog\Frontend\BlogController@stripe_checkout');
	Route::get('/payment/paypal', 'Blog\Frontend\BlogController@paypal');
	Route::get('/payment/paypal/checkout', 'Blog\Frontend\BlogController@paypal_checkout');
	Route::get('/tour/{id}', 'Blog\Frontend\BlogController@tour');
	Route::get('/order', function () {
        return redirect('/tour/yogyakarta-night-walking-and-food-tours');
    });
	Route::get('/cancel', function () {
        return redirect('/');
    });
	Route::get('/index', 'Blog\Frontend\BlogController@index');
});

Route::domain('www.jogjafoodtour.com')->group(function () {
    Route::get('/', 'Blog\Frontend\BlogController@foodtour');
	Route::get('/success', 'Blog\Frontend\BlogController@success');
	Route::get('/availability', 'Rev\AvailabilityController@getAvailability');
	Route::post('/book', 'Rev\BookController@book');
	Route::get('/payment', 'Blog\Frontend\BlogController@payment');
	Route::get('/payment/shoppingcart', 'Blog\Frontend\BlogController@shoppingcart');
	Route::get('/payment/stripe', 'Blog\Frontend\BlogController@stripe');
	Route::get('/payment/stripe/checkout', 'Blog\Frontend\BlogController@stripe_checkout');
	Route::get('/payment/paypal', 'Blog\Frontend\BlogController@paypal');
	Route::get('/payment/paypal/checkout', 'Blog\Frontend\BlogController@paypal_checkout');
	Route::get('/tour/{id}', 'Blog\Frontend\BlogController@tour');
	Route::get('/order', function () {
        return redirect('/tour/yogyakarta-night-walking-and-food-tours');
    });
	Route::get('/cancel', function () {
        return redirect('/');
    });
});




// Reservation Admin --------------------------------------------------------------------------
Route::resource('/rev/availability','Rev\AvailabilityController',[ 'names' => 'rev_availability' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/review','Rev\ReviewController',[ 'names' => 'rev_review' ])
	->middleware(['auth', 'verified']);	
// Reservation Admin --------------------------------------------------------------------------

// Link --------------------------------------------------------------------------
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
	