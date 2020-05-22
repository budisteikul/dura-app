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
	Route::get('/', 'Rev\FrontendController@vertikaltrip');
	Route::get('/jogjafoodtour', 'Rev\FrontendController@jogjafoodtour');
	Route::get('/foodtours', 'Rev\FrontendController@foodtours');
	Route::get('/ratnawahyu', 'Blog\Frontend\TimelineController@index');
});
Route::domain('ratna.vertikaltrip.com')->group(function () {
    Route::get('/', 'Blog\Frontend\TimelineController@index');
});
Route::domain('www.shinjukufoodtour.com')->group(function () {
	Route::get('/', function () {
		return redirect('https://foodtours.xyz/tours/26778');
	});
});
Route::domain('vertikaltrip.herokuapp.com')->group(function () {
	Route::get('/', function () {
		return redirect('https://foodtours.xyz');
	});
});
Route::domain('www.vertikaltrip.com')->group(function () {
	Route::get('/', 'Rev\FrontendController@vertikaltrip');
});
Route::domain('www.jogjafoodtour.com')->group(function () {
	Route::get('/', 'Rev\FrontendController@jogjafoodtour');
	Route::get('/order', function () {
		return redirect('https://www.jogjafoodtour.com/booking/yogyakarta-night-walking-and-food-tours');
	});
	Route::get('/review', function () {
		return redirect('https://www.tripadvisor.com/UserReviewEdit-g12872450-d15646790.html');
	});
});
Route::domain('foodtours.xyz')->group(function () {
	Route::get('/', 'Rev\FrontendController@foodtours');
});





//========================================================================
// Front Page
//========================================================================
Route::get('/', 'Rev\FrontendController@vertikaltrip');
Route::post('/review', 'Rev\ReviewController@get_review');
Route::get('/sitemap.txt', 'Rev\FrontendController@sitemap');
//========================================================================
// Booking Page
//========================================================================
Route::post('/rev/webhook/{bokun_accesskey}/{bokun_secretkey}', 'Rev\WebhookController@store');
Route::get('/rev/webhook/{bokun_accesskey}/{bokun_secretkey}', 'Rev\WebhookController@store');
Route::get('/tour/{id}', 'Rev\FrontendController@product_page_byslug');
Route::get('/tour', 'Rev\FrontendController@product_page_byid');
Route::get('/tours/{slug}/{id}', 'Rev\FrontendController@product_list_byslug');
Route::get('/tours/{id}', 'Rev\FrontendController@product_list_byid');
Route::get('/tours', function () {
	return view('rev.frontend.vt-product-list-all');
});
Route::get('/snippets/activity/{activityId}/calendar/json/{year}/{month}', 'Rev\ShoppingCartController@snippetscalendar');
Route::post('/snippets/activity/invoice-preview', 'Rev\ShoppingCartController@snippetsinvoice');
Route::post('/snippets/widget/cart/session/{id}/activity', 'Rev\ShoppingCartController@addshoppingcart');
Route::get('/snippets/widgets', 'Rev\ShoppingCartController@widget');
//========================================================================
// Shopping Cart
//========================================================================
Route::get('/booking/shoppingcart/empty', function () {
	return view('page.empty-shoppingcart');
});
Route::get('/booking/shoppingcart', 'Rev\ShoppingCartController@get_shoppingcart');
Route::get('/booking/checkout', 'Rev\ShoppingCartController@get_checkout');
Route::post('/booking/checkout', 'Rev\ShoppingCartController@post_checkout');
Route::post('/booking/remove', 'Rev\ShoppingCartController@removebookingid');
Route::post('/booking/promo-code', 'Rev\ShoppingCartController@applypromocode');
Route::post('/booking/promo-code/remove', 'Rev\ShoppingCartController@removepromocode');
Route::post('/booking/payment', 'Rev\ShoppingCartController@payment');
Route::post('/booking/create-paypal-transaction', 'Rev\ShoppingCartController@createPayment');
Route::get('/booking/receipt/{id}', 'Rev\ShoppingCartController@receipt');
Route::get('/booking/invoice/{id}', 'Rev\ShoppingCartController@get_invoice');
Route::get('/booking/ticket/{id}', 'Rev\ShoppingCartController@get_ticket');
Route::get('/booking/{slug}', 'Rev\FrontendController@time_selector');
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
Route::resource('/rev/booking','Rev\BookingController',[ 'names' => 'bookings' ])
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




