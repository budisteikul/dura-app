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
Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);
//========================================================================
// Custom domain
//========================================================================
Route::domain('localhost')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@vertikaltrip');
	Route::get('/jogjafoodtour', 'Blog\Frontend\BlogController@jogjafoodtour');
	Route::get('/foodtours', 'Blog\Frontend\BlogController@foodtours');
});
Route::domain('www.ratnawahyu.com')->group(function () {
    Route::get('/', 'Blog\Frontend\TimelineController@index');
});
Route::domain('www.shinjukufoodtour.com')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@shinjukufoodtour');
});
Route::domain('www.vertikaltrip.com')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@vertikaltrip');
});
Route::domain('www.jogjafoodtour.com')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@jogjafoodtour');
	Route::get('/order', function () {
		return redirect('https://www.jogjafoodtour.com/booking/yogyakarta-night-walking-and-food-tours');
	});
	Route::get('/review', function () {
		return redirect('https://www.tripadvisor.com/UserReviewEdit-g12872450-d15646790.html');
	});
});
Route::domain('foodtours.xyz')->group(function () {
	Route::get('/', 'Blog\Frontend\BlogController@foodtours');
});





//========================================================================
// Front Page
//========================================================================
Route::get('/', 'Blog\Frontend\BlogController@vertikaltrip');
Route::post('/review', 'Rev\ReviewController@get_review');
//========================================================================
// Booking Page
//========================================================================
Route::post('/rev/webhook', 'Rev\WebhookController@store');
Route::get('/tour/{id}', 'Blog\Frontend\BlogController@vt_product_page');
Route::get('/tour', 'Blog\Frontend\BlogController@vt_product_page');
Route::get('/tours/{id}', 'Blog\Frontend\BlogController@vt_product_list');
Route::get('/tours', function () {
	return view('blog.frontend.vt-product-list-all');
});
//========================================================================
// Shopping Cart
//========================================================================
Route::get('/booking/shoppingcart/empty', function () {
	return view('page.empty-shoppingcart');
});
Route::get('/booking/shoppingcart', 'Rev\ShoppingCartController@get_shoppingcart');
Route::get('/booking/checkout', 'Rev\ShoppingCartController@get_checkout');
Route::post('/booking/checkout', 'Rev\ShoppingCartController@post_checkout');
Route::post('/booking/promo-code', 'Rev\ShoppingCartController@applypromocode');
Route::post('/booking/promo-code/remove', 'Rev\ShoppingCartController@removepromocode');
Route::post('/booking/payment', 'Rev\ShoppingCartController@payment');
Route::post('/booking/create-paypal-transaction', 'Rev\ShoppingCartController@createPayment');
Route::get('/booking/receipt/{id}', 'Rev\ShoppingCartController@receipt');
Route::get('/booking/invoice/{id}', 'Rev\ShoppingCartController@get_invoice');
Route::get('/booking/ticket/{id}', 'Rev\ShoppingCartController@get_ticket');
Route::get('/booking/{id}', 'Rev\ShoppingCartController@time_selector');

Route::get('/pdf/invoice/{id}', 'Rev\ShoppingCartController@get_invoicePDF');
Route::get('/pdf/ticket/{id}', 'Rev\ShoppingCartController@get_ticketPDF');
//========================================================================
// Redirect Page
//========================================================================
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
Route::get('/review', function () {
	return redirect('https://www.tripadvisor.com/UserReviewEdit-g14782503-d17523331-Vertikal_Trip-Yogyakarta_Yogyakarta_Region_Java.html');
});
Route::get('/shinjuku', function () {
			return redirect('/tour?activityId=284167');
	});
//========================================================================
// Financial Admin
//========================================================================
Route::resource('/fin/categories','Fin\CategoryController',[ 'names' => 'route_categories' ])
	->middleware(['auth', 'verified']);
Route::resource('/fin/transactions','Fin\TransactionController',[ 'names' => 'route_transactions' ])
	->middleware(['auth', 'verified']);
Route::get('/fin/profitloss', 'Fin\SalesController@profitloss')->middleware(['auth', 'verified']);
//========================================================================
// Reservation Admin
//========================================================================
Route::resource('/rev/book','Rev\BookController',[ 'names' => 'rev_book' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/review','Rev\ReviewController',[ 'names' => 'rev_review' ])
	->middleware(['auth', 'verified']);	
Route::resource('/rev/resellers','Rev\ResellerController',[ 'names' => 'resellers' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/widgets','Rev\WidgetController',[ 'names' => 'widgets' ])
	->middleware(['auth', 'verified']);
Route::get('/rev/experiences/import','Rev\ExperienceController@import')
	->middleware(['auth', 'verified']);
Route::resource('/rev/experiences','Rev\ExperienceController',[ 'names' => 'experiences' ])
	->middleware(['auth', 'verified']);
Route::resource('/rev/shoppingcart','Rev\Backend\ShoppingCartController',[ 'names' => 'shoppingcarts' ])
	->middleware(['auth', 'verified']);
//========================================================================
// Blog App Route
//========================================================================
Route::get('/page/{id}','Blog\Backend\PageController@show');
Route::resource('/blog/page','Blog\Backend\PageController',[ 'names' => 'page' ])
	->middleware(['auth', 'verified']);
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
//========================================================================
// Mail Route
//========================================================================
Route::get('/profiles/{id}/{setting}/{token}', 'Profile\ProfileController@index')->name('profiles.index')->middleware(['auth', 'verified']);
Route::resource('profiles','Profile\ProfileController',[ 'names' => 'profiles' ])->only(['show','update','store'])->middleware(['auth', 'verified']);
Route::resource('/mails/webhook','Mail\WebhookController',[ 'names' => 'mail_webhooks' ])->only(['store','index']);
Route::resource('/mails/settings','Mail\SettingController',[ 'names' => 'mail_settings' ])->middleware(['auth', 'verified']);
Route::resource('/mails/attachments','Mail\AttachmentController',[ 'names' => 'mail_attachments' ])->only(['show'])->middleware(['auth', 'verified']);
Route::get('/mails/folder/{id}/', 'Mail\MailController@index')->middleware(['auth', 'verified']);
Route::resource('/mails','Mail\MailController',[ 'names' => 'mails' ])->middleware(['auth', 'verified']);
Route::get('/mails/{id}/{view}', 'Mail\MailController@show')->name('mails.show')->middleware(['auth', 'verified']);
//========================================================================




