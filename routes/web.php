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


Route::get('/', 'Blog\Frontend\BlogController@foodtour');
Route::get('/review', 'Rev\ReviewController@get_review');

Route::get('/blank', function () {
	return view('blog.frontend.blank');
});

Route::get('/book', 'Blog\Frontend\BlogController@timeselector_stripe');
Route::get('/book/checkout', 'Blog\Frontend\BlogController@checkout_stripe');
Route::get('/book/checkout/receipt', 'Blog\Frontend\BlogController@receipt_stripe');

Route::get('/book/payment', 'Blog\Frontend\BlogController@payment');

Route::get('/book/paypal', 'Blog\Frontend\BlogController@timeselector_paypal');
Route::get('/book/paypal/checkout', 'Blog\Frontend\BlogController@checkout_paypal');
Route::get('/book/paypal/checkout/receipt', 'Blog\Frontend\BlogController@receipt_paypal');

Route::get('/book/stripe', 'Blog\Frontend\BlogController@timeselector_stripe');
Route::get('/book/stripe/checkout', 'Blog\Frontend\BlogController@checkout_stripe');
Route::get('/book/stripe/checkout/receipt', 'Blog\Frontend\BlogController@receipt_stripe');

Route::get('/tour/{id}', 'Blog\Frontend\BlogController@tour');

Route::post('/mails/webhook', function () {
	return redirect('https://mail.vertikaltrip.com/mails/webhook');
});
Route::get('/order', function () {
	return redirect('/tour/yogyakarta-night-walking-and-food-tours');
});
Route::get('/timeout', function () {
	return redirect('/');
});
Route::get('/cancel', function () {
	return redirect('/');
});







// Reservation Admin --------------------------------------------------------------------------
Route::resource('/rev/availability','Rev\AvailabilityController',[ 'names' => 'rev_availability' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/review','Rev\ReviewController',[ 'names' => 'rev_review' ])
	->middleware(['auth', 'verified']);	
// Reservation Admin --------------------------------------------------------------------------


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
	