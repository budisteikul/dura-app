<?php
namespace App\Http\Controllers\Blog\Frontend;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Request;
use App\Classes\Blog\BlogClass;
use Redirect;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_settings;
use App\User;

class TimelineController extends Controller
{
	
	
	public function __construct()
	{
	}
	
	public function getIndex(Request $request)
	{
		$blog_setting = blog_settings::where('value',preg_replace('#^https?://#', '', Request::root()))->where('name','domain')->first();
		if(!$blog_setting) return Redirect('/home');
		
		$user_id = $blog_setting->user_id;
		$get_user = User::where('id',$user_id)->whereNotNull('email_verified_at')->first();
		if(!$get_user) return Redirect('/login');
		
		
		
		if (Auth::check()) {
			
			$check = blog_posts::where('user_id',$user_id)
				   ->where('content_type','photo')
				   ->orderBy('date','desc')
				   ->first();
		}
		else
		{
				$check = blog_posts::where('user_id',$user_id)
				   ->where('content_type','photo')
				   ->where('status',1)
				   ->orderBy('date','desc')
				   ->first();
		}
		
		if(!@count($check))
		{	
				return Redirect('/login');
		}
		
		
		if (Auth::check()) {
			$results = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->orderBy('sort', 'asc');
				   }
				   ))
				   ->where('user_id',$user_id)
				   ->where('content_type','photo')
				   ->orderBy('date','desc')
				   ->paginate(6);
		}
		else
		{
			$results = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->where('resource_type', 'image');
					   $query->orderBy('sort', 'asc');
				   }
				   ))
				   ->where('user_id',$user_id)
				   ->where('content_type','photo')
				   ->where('status',1)
				   ->orderBy('date','desc')
				   ->paginate(6);
		}
		
		
		
		
		$stdClass = app();
    	$setting = $stdClass->make('stdClass');
		
		$setting->title1 = BlogClass::getConf('title1',$user_id);
		if($setting->title1=="") $setting->title1 = str_ireplace("www.","",$_SERVER['HTTP_HOST']);
		$setting->title2 = BlogClass::getConf('title2',$user_id);
		$setting->description = BlogClass::getConf('description',$user_id);
		$setting->gravatar = $get_user->picture_url;
		//===========================================================================
		$header = BlogClass::getConf('header',$user_id);
		$setting->header = "/storage/images/header/". $header ;
		//===========================================================================
		$setting->facebook = BlogClass::getConf('facebook',$user_id);
		$setting->twitter = BlogClass::getConf('twitter',$user_id);
		$setting->instagram = BlogClass::getConf('instagram',$user_id);
		$setting->github = BlogClass::getConf('github',$user_id);
		$setting->path = BlogClass::getConf('path',$user_id);
		
		$url = Request::url();
		$setting->url = $url;
		$setting->image = $setting->url . $setting->header;
		$setting->title = $setting->title2;
		$setting->user_id = $user_id;
		
		return view('blog.frontend.timeline')->with('setting',$setting)->with('results',$results);
	}
}
?>
