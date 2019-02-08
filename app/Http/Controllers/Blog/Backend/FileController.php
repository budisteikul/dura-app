<?php
namespace App\Http\Controllers\Blog\Backend;
use App\Classes\Blog\BlogClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Blog\blog_tmp;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
	
	public function destroy($id)
	{
		$blog_tmp = blog_tmp::find($id);
		Storage::delete($blog_tmp->file);
		blog_tmp::where('id',$id)->delete();
	}
	
	public function store(Request $request)
	{
		$ret = array();
		$files = $request->file('myfile');
		$key = $request->input('key');
		
		
		$path = Storage::disk('local')->putFile('temp/'. Auth::user()->id, $files);
		$file = BlogClass::getAttrPhoto($path);
		
		$blog_tmp = new blog_tmp();
		$blog_tmp->user_id = Auth::user()->id;
		$blog_tmp->file = $path;
		$blog_tmp->key = $key;
		$blog_tmp->save();
		$ret[] = $blog_tmp->id;
			
				
			
				if($key!="header_file"){
					if($file->width>1280)
					{
						$img = Image::make($file->path);
						$img->resize(1280, null, function ($constraint) {
    						$constraint->aspectRatio();
						});
						$img->save($file->path);
					
					}
					else if($file->height>1280)
					{
						$img = Image::make($file->path);
						$img->resize(null, 1280, function ($constraint) {
    						$constraint->aspectRatio();
						});
						$img->save($file->path);
					
					}
				}	
				
		return response()->json($ret);
	}
	
	
}
?>