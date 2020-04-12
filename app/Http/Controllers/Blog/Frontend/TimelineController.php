<?php
namespace App\Http\Controllers\Blog\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Http;
use App\Classes\Blog\BlogClass;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_attachments;
use App\Models\Blog\blog_settings;
use App\User;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
	
	public function index(Request $request)
	{
		
		if($request->ajax() && !empty($request->input('post_id')))
		{
			$output = array();
			$post_id = $request->input('post_id');
			if (Auth::check()) {
				$result = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->orderBy('sort', 'asc');
				   }
				   ))->where('user_id',Auth::user()->id)->find($post_id);
			}
			else
			{
				$result = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->orderBy('sort', 'asc');
				   }
				   ))->where('status',1)->find($post_id);
			}
			foreach($result->attachments as $attachment)
			{
				//$src = '/storage/'. $result->user_id .'/images/original/'. $attachment->file_name;
				//$thumb = '/storage/'. $result->user_id .'/images/250/'. $attachment->file_name;
				
				$src = \App\Classes\Blog\BlogClass::cloudinary_url($result->user_id.'/images/original/'.$attachment->file_name);
				$thumb = \App\Classes\Blog\BlogClass::cloudinary_url($result->user_id.'/images/original/'.$attachment->file_name,250);
				
				$caption = $result->content;
				if($caption=="") $caption = $result->title;
				$output[] = array('src' => $src, 'thumb' => $thumb, 'caption' => $caption);
			}
			return response()->json($output);
		}
		
		
		
		//$blog_setting = blog_settings::where('value','like','%'. preg_replace('#^https?://#', '', Http::root() .'%'))->where('name','domain')->first();
		//if(!$blog_setting) return Redirect('/home');
		
		$user_id = Auth::user()->id;
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
				return redirect('/login');
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
		$setting->title = $get_user->name;
		$setting->user_id = $user_id;
		$setting->description = BlogClass::getConf('description',$user_id);
		$setting->gravatar = $get_user->picture_url;
		$setting->facebook = BlogClass::getConf('facebook',$user_id);
		$setting->twitter = BlogClass::getConf('twitter',$user_id);
		$setting->instagram = BlogClass::getConf('instagram',$user_id);
		return view('blog.frontend.timeline')->with('setting',$setting)->with('results',$results);
	}
}
?>
