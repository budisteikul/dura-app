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

Route::get('/', 'Blog\Frontend\TimelineController@getIndex');
Route::post('/', 'Blog\Frontend\TimelineController@getIndex');

/*
Route::get('/test', function () {
	$result3 = DB::table('blog_settings2')->get();
		 foreach($result3 as $rs3)
		 {
			 $blog_setting_id = Generator::uuid4()->toString();
			 DB::table('blog_settings')->insert([
			'id' => $blog_setting_id,
			'user_id' => 'eca1ca75-9e80-493f-bfef-cbeb44f8aac3',
			'name' => $rs3->name,
			'value' => $rs3->value,
			'created_at' => $rs3->created_at,
			'updated_at' => $rs3->updated_at
			]);
		 }
    $result = DB::table('blog_posts2')->get();
	foreach($result as $rs)
	{
		$blog_post_id = Generator::uuid4()->toString();
		DB::table('blog_posts')->insert([
		'id' => $blog_post_id,
		'user_id' => 'eca1ca75-9e80-493f-bfef-cbeb44f8aac3',
		'judul' => $rs->judul,
		'slug' => $rs->slug,
		'tipe_post' => $rs->tipe_post,
		'tipe_konten' => $rs->tipe_konten,
		'tanggal' => $rs->tanggal,
		'konten' => $rs->konten,
		'layout' => $rs->layout,
		'note' => $rs->note,
		'status' => $rs->status,
		'created_at' => $rs->created_at,
		'updated_at' => $rs->updated_at
		 ]);
		 
		 $result2 = DB::table('blog_attachments2')->where('post_id', $rs->id)->get();
		 foreach($result2 as $rs2)
		 {
			$blog_attachments_id = Generator::uuid4()->toString();
			DB::table('blog_attachments')->insert([
			'id' => $blog_attachments_id,
			'post_id' => $blog_post_id,
			'user_id' => 'eca1ca75-9e80-493f-bfef-cbeb44f8aac3',
			'public_id' => $rs2->public_id,
			'version' => $rs2->version,
			'signature' => $rs2->signature,
			'width' => $rs2->width,
			'height' => $rs2->height,
			'format' => $rs2->format,
			'resource_type' => $rs2->resource_type,
			'bytes' => $rs2->bytes,
			'type' => $rs2->type,
			'etag' => $rs2->etag,
			'url' => $rs2->type,
			'secure_url' => $rs2->type,
			'sort' => $rs2->sort,
			'created_at' => $rs2->created_at,
			'updated_at' => $rs2->updated_at
			]);
			
			
		 }
		
		 
	}
});
*/

Auth::routes(['verify' => true]);

Route::get('/home',function(){ return redirect('/'); })->name('home')->middleware(['auth', 'verified']);

//========================================================================
// Blog App Route
//========================================================================
Route::get('/blog/post', 'Blog\Backend\PostController@getIndex');
Route::get('/blog/post/data', 'Blog\Backend\PostController@getData');
Route::get('/blog/post/edit/{id}','Blog\Backend\PostController@getEditPost');
Route::post('/blog/post/edit','Blog\Backend\PostController@postEditPost');
Route::get('/blog/post/add/{tipe_konten}','Blog\Backend\PostController@getAddPost');
Route::post('/blog/post/add','Blog\Backend\PostController@postAddPost');
Route::get('/blog/post/delete/{id}','Blog\Backend\PostController@getDeletePost');
Route::get('/blog/post/publish/{id}/{status}', 'Blog\Backend\PostController@getPublishData');
Route::post('/blog/file/add', 'Blog\Backend\FileController@postFileAdd');
Route::post('/blog/file/delete', 'Blog\Backend\FileController@postFileDelete');
Route::get('/blog/setting', 'Blog\Backend\SettingController@getSetting');
Route::post('/blog/setting', 'Blog\Backend\SettingController@postSetting');