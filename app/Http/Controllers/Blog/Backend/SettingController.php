<?php
namespace App\Http\Controllers\Blog\Backend;
use App\Classes\Blog\BlogClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Blog\blog_tmp;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
	public function __construct()
	{
    	$this->middleware(['auth', 'verified']);
	}
		
	public function edit($id)
	{
		
		$user = Auth::user();
		$stdClass = app();
    	$setting = $stdClass->make('stdClass');
		$setting->title1 = BlogClass::getConf('title1');
		$setting->title2 = BlogClass::getConf('title2');
		$setting->description = BlogClass::getConf('description');
		$setting->header = BlogClass::getConf('header');
		$setting->facebook = BlogClass::getConf('facebook');
		$setting->twitter = BlogClass::getConf('twitter');
		$setting->instagram = BlogClass::getConf('instagram');
		$setting->github = BlogClass::getConf('github');
		$setting->path = BlogClass::getConf('path');
		$setting->user_id = $user->id;
		
		$results = blog_tmp::where('key','header_file')->get();
		foreach($results as $result)
		{
			BlogClass::deleteTempPhoto($result->file);
		}
		blog_tmp::where('key','header_file')->delete();
		
		
		return view('blog.backend.setting')->with('setting',$setting);
	}
	
	public function update(Request $request,$id)
	{
		$user = Auth::user();
		$tipe = $request->input('tipe');
		
		if($tipe=="general_setting"){
			$key = $request->input('key');
			BlogClass::setConf('title1',$request->input('title1'));
			BlogClass::setConf('title2',$request->input('title2'));
			BlogClass::setConf('description',$request->input('description'));
			BlogClass::setConf('facebook',$request->input('facebook'));
			BlogClass::setConf('twitter',$request->input('twitter'));
			BlogClass::setConf('instagram',$request->input('instagram'));
			BlogClass::setConf('github',$request->input('github'));
			BlogClass::setConf('path',$request->input('path'));
			$result = blog_tmp::where('key',$key)->where('user_id',$user->id)->first();
			if (@count($result))
			{
				
				$header = BlogClass::getConf('header');
			
				if($header != "")
				{
					Storage::disk('public')->delete('images/header/'. $user->id .'/'. $header);
				}
				
				$file_attr = BlogClass::getAttrFile($result->file);
				Storage::disk('local')->copy($result->file,'public/images/header/'. $user->id .'/'. $file_attr->name);
				blog_tmp::where('key',$key)->where('file',$result->file)->where('user_id',$user->id)->delete();
				BlogClass::setConf('header',$file_attr->name);
				BlogClass::deleteTempPhoto($result->file);
			}
			
			return response()->json([
					"id"=>"1",
					"message"=>'<i class="fa fa-check"></i> Update Success'
					]);
		}
		
	}
	
}
?>