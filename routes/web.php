<?php
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;
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

Route::get('/', 'Blog\Frontend\TimelineController@index');
/*
Route::get('/test',function(){
	
		$result = DB::table('blog_attachments')->get();
			foreach($result as $rs)
			{
				DB::table('blog_attachments')->where('id',$rs->id)->update([
					'file_path'=>'images/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/original/'.$rs->file_name,
					'file_url'=>'/storage/images/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/original/'.$rs->file_name,
				]);
			}
		
	});
*/
Auth::routes(['verify' => true]);
Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);
//========================================================================
// Blog App Route
//========================================================================
Route::resource('/blog/photo','Blog\Backend\PhotoController',[ 'names' => 'blog_photo' ])->middleware(['auth', 'verified']);
Route::resource('/blog/file', 'Blog\Backend\FileController',[ 'names' => 'blog_file' ])->only('store','destroy')->middleware(['auth', 'verified']);
Route::resource('/blog/setting','Blog\Backend\SettingController',[ 'names' => 'blog_setting' ])->only('edit','update')->middleware(['auth', 'verified']);