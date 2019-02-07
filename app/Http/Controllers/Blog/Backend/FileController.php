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
		$path = 'temp/'.Auth::user()->id.'/'. $id;
		blog_tmp::where('user_id',Auth::user()->id)->where('file',$path)->delete();
		Storage::delete($path);
	}
	
	public function store(Request $request)
	{
		$ret = array();
		$files = $request->file('myfile');
		$key = $request->input('key');
		$ret[]= $files->getClientOriginalName();
		
		$path = Storage::disk('local')->putFileAs('temp/'. Auth::user()->id, $files, $files->getClientOriginalName());
		$blog_tmp = blog_tmp::updateOrCreate(
    			['user_id' => Auth::user()->id, 'file' => $path],
    			['key' => $key]
			);
			
				$file = BlogClass::getAttrPhoto($path);
			
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