<?php
namespace App\Classes\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use \DateTime;
use Intervention\Image\Facades\Image;
use App\Models\Blog\blog_attachments;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_settings;
use Storage;
class BlogClass {

	public static function timeAgo($timestamp){
		$datetime1=new DateTime("now");
		$datetime1->modify('+7 hour');
		$datetime2=date_create($timestamp);
		$diff=date_diff($datetime1, $datetime2);
		$timemsg='';
		if($diff->y > 0){
			$timemsg = $diff->y .' year'. ($diff->y > 1?"s":'');

		}
		else if($diff->m > 0){
			$timemsg = $diff->m . ' month'. ($diff->m > 1?"s":'');
		}
		else if($diff->d > 0){
			$timemsg = $diff->d .' day'. ($diff->d > 1?"s":'');
		}
		else if($diff->h > 0){
			$timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
		}
		else if($diff->i > 0){
			$timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
		}
		else if($diff->s > 0){
			$timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
		}

		$timemsg = $timemsg.' ago';
		return $timemsg;
	}
	
	public static function getAttrPhoto($file)
	{
		$stdClass = app();
    	$photo = $stdClass->make('stdClass');
		list($width, $height, $type, $attr) = getimagesize(realpath($file));
		$get_mime = getimagesize(realpath($file));
		$mime = explode("/",$get_mime['mime']);
		$size = filesize(realpath($file));
		$photo->width = $width;
		$photo->height = $height;
		$photo->resource_type = $mime[0];
		$photo->format = $mime[1];
		if($photo->format=="jpeg") $photo->format = "jpg";
		$photo->bytes = $size;
		$photo->version = date('U');
		$photo->signature = "signature";
		$photo->type = "upload";
		$photo->etag = "etag";
		return $photo;	
	}
	
	public static function createDirPhoto()
	{
			$path = public_path().'/storage/images/50';
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    		$path = public_path().'/storage/images/250';
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			$path = public_path().'/storage/images/500';
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			$path = public_path().'/storage/images/original';
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
			$path = public_path().'/storage/images/header';
			File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
	}
	
	public static function createPhoto($file_path,$file)
	{
		BlogClass::createDirPhoto();
		copy($file_path,'storage/images/original/'. $file );
		
		//Storage::disk('local')->copy($file_path,'storage/images/original/'. $file);
		$img = Image::make('storage/images/original/'. $file );
		$img->fit(500, 500);
		$img->save('storage/images/500/'. $file );
		$img = Image::make('storage/images/500/'. $file );
		$img->resize(250, 250);
		$img->save('storage/images/250/'. $file );
		$img = Image::make('storage/images/500/'. $file );
		$img->resize(50, 50);
		$img->save('storage/images/50/'. $file );
	}
	
	public static function deletePhoto($file)
	{
				if(file_exists("storage/images/50/". $file))
				{
					unlink("storage/images/50/". $file);
				}
				if(file_exists("storage/images/250/". $file))
				{
					unlink("storage/images/250/". $file);
				}
				if(file_exists("storage/images/500/". $file))
				{
					unlink("storage/images/500/". $file);
				}
				if(file_exists("storage/images/original/". $file))
				{
					unlink("storage/images/original/". $file);
				}
	}
	
	public static function repair_layout($id)
	{
		$result = blog_posts::where('id',$id)->first();
		$layout = $result->layout;
		
		if($layout == "" ) $layout = 1;
		
			$b = str_split($layout);
			$c= 0;
			for($i=0;$i<count($b);$i++)
			{
				$c += $b[$i];
			}
			$result = blog_attachments::where('post_id',$id)->count();
			if($c!=$result)
			{
				$layout = "";
				$result = blog_attachments::where('post_id',$id)->get();
				for($i=0;$i<count($result);$i++)
				{
					$layout .= "1";
				}
			}
			$result = blog_posts::find($id);
			$result->layout = $layout;
			$result->save();
	}
	
	
	public static function setConf($name,$value,$user_id="")
		{
			if($user_id=="")
			{
				$user = Auth::user();
				$user_id = $user->id;	
			}
			
			$result = blog_settings::where('name',$name)->where('user_id',$user_id)->first();
			
			if(empty($result))
			{
				$result = new blog_settings;
				$result->name = $name;
				$result->user_id = $user_id;
				$result->save();
			}
			
			if($value=="" && $name!="")
			{
				$result = blog_settings::where('user_id',$user_id)->where('name',$name)->first();
				$result->delete();
			}
			else
			{
				$result = blog_settings::where('user_id',$user_id)->where('name',$name)->first();
				$result->value = $value;
				$result->save();
			}
		}
	
	public static function getConf($name,$user_id="")
		{
			if($user_id=="")
			{
				$user = Auth::user();
				$user_id = $user->id;	
			}
			
			$value = "";
			$result = blog_settings::where('name',$name)->where('user_id',$user_id)->first();
			
			if(empty($result))
			{
				$result = new blog_settings;
				$result->name = $name;
				$result->user_id = $user_id;
				$result->save();
			}
			else
			{
				$value = $result->value;
			}
    		return $value;
		}
		
	public static function makeSlug($string,$user_id,$id="")
		{
			
			$string = str_slug($string,"-");
			$cek = 1;
			$string_test = $string;
			$i = 2;
			while($cek==1)
			{
				if ($id=="")
				{
					$results = blog_posts::where('user_id',$user_id) ->where('slug',$string_test)->count();
				}
				else
				{
					$results = blog_posts::where('user_id',$user_id) ->where('slug',$string_test)->where('id','<>',$id)->count();
				}
				if($results==0)
				{
					$cek=0;	
				}
				else
				{
					$string_test = $string ."-". $i;
				}
				$i++;
			}
			return $string_test;
			
		}
}
?>