<?php
namespace App\Http\Controllers\Blog\Backend;
use App\Classes\Blog\BlogClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Blog\blog_tmp;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class SettingController extends Controller
{
	public function __construct()
	{
    	$this->middleware(['auth', 'verified']);
	}
		
	public function getSetting()
	{
		
		$user = Auth::user();
		$stdClass = app();
    	$setting = $stdClass->make('stdClass');
		$setting->judul1 = BlogClass::getConf('judul1');
		$setting->judul2 = BlogClass::getConf('judul2');
		$setting->deskripsi = BlogClass::getConf('deskripsi');
		$setting->header = BlogClass::getConf('header');
		$setting->facebook = BlogClass::getConf('facebook');
		$setting->twitter = BlogClass::getConf('twitter');
		$setting->instagram = BlogClass::getConf('instagram');
		$setting->github = BlogClass::getConf('github');
		$setting->path = BlogClass::getConf('path');
		
		
		
		
		$results = blog_tmp::where('key','header_file')->get();
		foreach($results as $result)
		{
			unlink($result->file);	
		}
		blog_tmp::where('key','header_file')->delete();
		
		
		return view('blog.backend.setting')->with('user',$user)->with('setting',$setting);
	}
	
	public function postSetting(Request $request)
	{
		$user = Auth::user();
		$tipe = $request->input('tipe');
		
		if($tipe=="general_setting"){
			$key = $request->input('key');
			BlogClass::setConf('judul1',$request->input('judul1'));
			BlogClass::setConf('judul2',$request->input('judul2'));
			BlogClass::setConf('deskripsi',$request->input('deskripsi'));
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
				
					if(file_exists("storage/images/header/". $header))
					{
						unlink("storage/images/header/". $header);
					}
				
				}
				
				blog_tmp::where('key',$key)->where('file',$result->file)->where('user_id',$user->id)->delete();
				
				$header = Uuid::uuid4();
				$photo = BlogClass::getAttrPhoto($result->file);
				$header = $header .".". $photo->format;
				BlogClass::setConf('header',$header);
				copy($result->file,'storage/images/header/'. $header);
				unlink($result->file);
			}
			print('<div class="alert alert-success"  role="alert">
					Update Success
				</div>');
		}
		
	}
	
}
?>