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

Auth::routes(['verify' => true]);
Route::get('/home','HomeController@index')->name('home')->middleware(['auth', 'verified']);
//========================================================================
// Blog App Route
//========================================================================
Route::resource('/blog/post','Blog\Backend\PostController')->middleware(['auth', 'verified']);
Route::resource('/blog/file', 'Blog\Backend\FileController')->only('store','destroy')->middleware(['auth', 'verified']);
Route::resource('/blog/setting','Blog\Backend\SettingController')->only('edit','update')->middleware(['auth', 'verified']);