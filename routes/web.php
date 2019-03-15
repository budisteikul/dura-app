<?php
use DB;
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

Route::get('/repair', function () {
    $results = DB::table('blog_attachments')->get();
	foreach($results as $rs)
	{
		DB::table('blog_attachments')->where('id',$rs->id)->update(['file_path'=>'eca1ca75-9e80-493f-bfef-cbeb44f8aac3/images/original/'. $rs->file_name,'file_url'=>'/storage/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/images/original/'. $rs->file_name]);
	}
});


Route::get('/landing', 'Blog\Frontend\LandingController@index');
Route::get('/blog', 'Blog\Frontend\BlogController@index');
Route::get('/single', 'Blog\Frontend\BlogController@single');

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
	