<?php
namespace App\Http\Controllers\Blog\Backend;
use App\Classes\Blog\BlogClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Blog\blog_tmp;

class FileController extends Controller
{
	
	public function destroy($id)
	{
		$user = Auth::user();
		blog_tmp::where('user_id',$user->id)->where('file',"../storage/logs/". $id)->delete();
		if(file_exists("../storage/logs/". $id))
		{
			unlink("../storage/logs/". $id);
		}
	}
	
	public function store(Request $request)
	{
		$ret = array();
		$user = Auth::user();
		$output_dir = "../storage/logs/";
		$key = $request->input('key');
		if(!is_array($_FILES["myfile"]["name"])) //single file
		{
			$namaTemp = rand(5, 15);
			$namaTemp = $namaTemp ."_". date('YmdHis');
 	 		$fileName = $_FILES["myfile"]["name"];
			$array = explode(".",$fileName);
			$pathfile = $output_dir.$fileName;
 			move_uploaded_file($_FILES["myfile"]["tmp_name"],$pathfile);
    		$ret[]= $fileName;
			
			if(end($array)=="jpg" || end($array)=="jpeg" || end($array)=="png" )
			{
				list($width, $height, $type, $attr) = getimagesize($pathfile);
    			$size = getimagesize($pathfile);
			
				if($key!="header_file"){
					if($width>1280)
					{
						$img = Image::make($pathfile);
						$img->resize(1280, null, function ($constraint) {
    						$constraint->aspectRatio();
						});
						$img->save($pathfile);
					
					}
					else if($height>1280)
					{
						$img = Image::make($pathfile);
						$img->resize(null, 1280, function ($constraint) {
    						$constraint->aspectRatio();
						});
						$img->save($pathfile);
					
					}
				}
			
			}
			
			$blog_tmp = blog_tmp::updateOrCreate(
    			['user_id' => $user->id, 'file' => $pathfile],
    			['key' => $key]
			);
			
			
		}
		else
		{
			$fileCount = count($_FILES["myfile"]["name"]);
	  		for($i=0; $i < $fileCount; $i++)
	  		{
				$namaTemp = rand(5, 15);
				$namaTemp = $namaTemp ."_". date('YmdHis');
				$fileName = $_FILES["myfile"]["name"][$i];
				$array = explode(".",$fileName);
				$pathfile = $output_dir.$fileName;
	  			$fileName = $_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$pathfile);
	  			$ret[]= $fileName;
		
				if(end($array)=="jpg" || end($array)=="jpeg" || end($array)=="png" )
				{
				
					list($width, $height, $type, $attr) = getimagesize($pathfile);
    				$size = getimagesize($pathfile);
				
					if($key!="header"){
						if($width>1280)
						{
							$img = Image::make($pathfile);
							$img->resize(1280, null, function ($constraint) {
    							$constraint->aspectRatio();
							});
							$img->save($pathfile);
						}
						else if($height>1280)
						{
							$img = Image::make($pathfile);
							$img->resize(null, 1280, function ($constraint) {
    							$constraint->aspectRatio();
							});
							$img->save($pathfile);
						}
					}
				}
				
				$blog_tmp = blog_tmp::updateOrCreate(
    				['user_id' => $user->id, 'file' => $pathfile],
    				['key' => $key]
				);
		
	  		}
		}
		echo json_encode($ret);
	}
}
?>