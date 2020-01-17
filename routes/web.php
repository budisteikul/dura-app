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

// Auth Laravel --------------------------------------------------------------------------
//Auth::routes(['verify' => true]);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);
// Auth Laravel --------------------------------------------------------------------------

Route::domain('www.ratnawahyu.com')->group(function () {
    Route::get('/', 'Blog\Frontend\TimelineController@index');
});

Route::domain('www.vertikaltrip.com')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@product_tour');
	Route::get('/shinjuku', function () {
			return redirect('/tour?activityId=284167');
	});
});

Route::domain('www.jogjafoodtour.com')->group(function () {
	Route::get('/shinjuku', function () {
			return redirect('/tour?activityId=284167');
	});
});

Route::domain('www.budi.my.id')->group(function () {
	//Route::get('/', 'Blog\Frontend\BlogController@index');
	Route::get('/', 'Blog\Frontend\BlogController@product_tour');
});

Route::domain('localhost')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@index_product');
    
});


// ================================================================================
Route::get('/tour', 'Blog\Frontend\BlogController@product_tour');
Route::get('/tour/{id}', 'Blog\Frontend\BlogController@product_tour');
// ================================================================================


Route::get('/blank', function () {
	return view('blog.frontend.blank');
});

Route::get('/page/waiver-and-release', function () {
	return view('blog.frontend.waiver-liability');
});
Route::get('/page/terms-and-conditions', function () {
	return view('blog.frontend.terms-and-conditions');
});

Route::get('/', 'Blog\Frontend\BlogController@index');
Route::get('/review', function () {
	return redirect('https://www.tripadvisor.com/UserReviewEdit-g12872450-d15646790.html');
});
Route::post('/review', 'Rev\ReviewController@get_review');


Route::get('/booking/checkout', 'Blog\Frontend\BlogController@checkout');
Route::get('/booking/receipt', 'Blog\Frontend\BlogController@receipt');
Route::get('/booking/{id}', 'Blog\Frontend\BlogController@product');
Route::get('/product-list/{id}', 'Blog\Frontend\BlogController@product_list');

Route::get('/map', function () {
	return redirect('https://goo.gl/maps/noCZwng3FBtCVruj9');
});
Route::get('/maps', function () {
	return redirect('https://goo.gl/maps/noCZwng3FBtCVruj9');
});
Route::get('/order', function () {
	return redirect('/');
});
Route::get('/timeout', function () {
	return redirect('/');
});
Route::get('/cancel', function () {
	return redirect('/');
});


// Financial Admin --------------------------------------------------------------------------
Route::resource('/fin/categories','Fin\CategoryController',[ 'names' => 'route_categories' ])
	->middleware(['auth', 'verified']);
Route::resource('/fin/transactions','Fin\TransactionController',[ 'names' => 'route_transactions' ])
	->middleware(['auth', 'verified']);
Route::get('/fin/profitloss', 'Fin\SalesController@profitloss')->middleware(['auth', 'verified']);
// Reservation Admin --------------------------------------------------------------------------

// Reservation Admin --------------------------------------------------------------------------
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/review','Rev\ReviewController',[ 'names' => 'rev_review' ])
	->middleware(['auth', 'verified']);	
Route::resource('/rev/resellers','Rev\ResellerController',[ 'names' => 'resellers' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/widgets','Rev\WidgetController',[ 'names' => 'widgets' ])
	->middleware(['auth', 'verified']);
// Reservation Admin --------------------------------------------------------------------------

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


Route::get('/profiles/{id}/{setting}/{token}', 'Auth\ProfileController@index')->name('profiles.index')->middleware(['auth', 'verified']);
Route::resource('profiles','Auth\ProfileController',[ 'names' => 'profiles' ])->only(['show','update','store'])->middleware(['auth', 'verified']);

Route::resource('/mails/webhook','Mail\WebhookController',[ 'names' => 'mail_webhooks' ])->only(['store','index']);
Route::resource('/mails/settings','Mail\SettingController',[ 'names' => 'mail_settings' ])->middleware(['auth', 'verified']);
Route::resource('/mails/attachments','Mail\AttachmentController',[ 'names' => 'mail_attachments' ])->only(['show'])->middleware(['auth', 'verified']);
Route::resource('/mails','Mail\MailController',[ 'names' => 'mails' ])->middleware(['auth', 'verified']);
Route::get('/mails/{id}/{view}', 'Mail\MailController@show')->name('mails.show')->middleware(['auth', 'verified']);


Route::post('/sms/webhook', 'SMS\SMSController@index');




