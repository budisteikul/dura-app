<?php
namespace App\Http\Controllers\Blog\Backend;
use App\Classes\Blog\BlogClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use App\Jobs\RCloneImages;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_tmp;
use App\Models\Blog\blog_attachments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
	
	public function index(Request $request)
	{
		if($request->ajax())
		{
			$user = Auth::user();
			$posts = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->orderBy('sort', 'asc');
				   }
				   ))->where('user_id',$user->id)->where('post_type','post')->orderBy('date','desc');
			return Datatables::eloquent($posts)
				->addColumn('contents', function ($post){
					$contents = "";
				
					if(@count($post->attachments))
					{
						foreach($post->attachments as $attachment)
						{
							$contents	 .= '<img style="margin:1px;" src="/storage/images/'. Auth::user()->id .'/50/'. $attachment->file_name .'">';
						}
					
						$contents .=	"<br />". $post->content;
					
					}
					else
					{
						$contents = $post->content;
					}
					return $contents;
				})
				->editColumn('date', function ($post){
					return $post->date;
				})
				->addColumn('action', function ($post) {
					if($post->status==1)
					{
						$label = ""	;
						$status = 0;
						$button = "btn-primary";
						$icon = "fa-toggle-on";
						$text = " On";
					}
					else
					{
						$label = "";
						$status = 1;
						$button = "btn-primary";
						$icon = "fa-toggle-off";
						$text = " Off";
					}
					return '<div class="btn-group" role="group"><button id="btn-edit" type="button" onClick="window.location=\'/blog/post/'.$post->id.'/edit\'" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $post->id .'\')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button><button id="btn-del" type="button" onClick="UPDATE(\''. $post->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div>';
				})
				->rawColumns(['action','contents'])
				->toJson();
			}
			else
			{
				return view('blog.backend.post');
			}
		}

	
	public function create(Request $request)
	{
		$user = Auth::user();

		$content_type = $request->input('content_type');
		switch($content_type)
		{
			case "photo":
			$content_type = "photo";
			break;
			default:
			$content_type = "photo";
		}

		$result = blog_tmp::where('user_id',$user->id)->get();
		foreach($result as $rs)
		{
			if(file_exists($rs->file))
			{
				BlogClass::deleteTempPhoto($rs->file);	
			}
		}
		blog_tmp::where('user_id',$user->id)->delete();
		
		$stdClass = app();
		$setting = $stdClass->make('stdClass');
		$setting->key = Uuid::uuid4();
		$setting->date = date("Y-m-d H:i:s", strtotime('+7 hours'));
		$setting->content_type = $content_type;
		$setting->post_type = 'post';
    	return view('blog.backend.post-add')->with('setting',$setting);
		
	}
	
	public function edit($id)
	{
		$user = Auth::user();
		$stdClass = app();
		$setting = $stdClass->make('stdClass');
		$setting->key = Uuid::uuid4();
		$result = blog_posts::where('user_id',$user->id)->find($id);
		
		return view('blog.backend.post-edit')
			   ->with('result',$result)
			   ->with('setting',$setting);
	}
	
	public function update(Request $request, $id)
	{
		if($request->input('status')!="")
		{
			$validator = Validator::make($request->all(), [
          			'status' => 'in:0,1'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$user = Auth::user();
			$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
			$blog_posts->status = $request->input('status');
			$blog_posts->save();
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
		
		$user = Auth::user();
		$job = false;
		$title =  $request->input('title');
		$date =  $request->input('date');
		$user_id =  $user->id;
		$key = $request->input('key');
		$content_type = $request->input('content_type');
		$post_type = $request->input('post_type');
		$content = $request->input('content');
		$layout = $request->input('layout');
		
		$result = blog_attachments::where('post_id',$id)->where('user_id',$user->id)->get();
		foreach($result as $rs)
		{
			$sort_order = $request->input('attachment_'. str_ireplace("-","_",$rs->id));
			if($sort_order=="") $sort_order = 0;
			$blog_attachments = blog_attachments::where('user_id',$user->id)->find($rs->id);
			$blog_attachments->sort = $sort_order;
			$blog_attachments->save();
			
			$bbb = $request->input('del_attachment_'. str_ireplace("-","_",$rs->id));
			if($bbb=="hapus")
			{
				$blog_attachments = blog_attachments::where('user_id',$user->id)->find($rs->id);
				$blog_attachments->delete();
				
				BlogClass::deletePhoto($rs->file_name);
				
				$job = true;
			}
			
		}
		
		if($title=="") $title = date("j M Y", strtotime($date));
		$guid = BlogClass::makeSlug($title,$user_id,$id);
		
		$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
		$blog_posts->title = $title;
		$blog_posts->slug = $guid;
		$blog_posts->content = $content;
		$blog_posts->layout = $layout;
		$blog_posts->date = $date;
		$blog_posts->content_type = $content_type;
		$blog_posts->post_type = $post_type;
		$blog_posts->save();
		
		$result = blog_tmp::where('key',$key)->where('user_id',$user->id)->get();
		if(@count($result))
		{
			$job = true;
		}
		
		$sort_order = blog_attachments::where('post_id',$id)->where('user_id',$user->id)->max('sort');
		foreach($result as $rs)
		{
				$sort_order++;
				//====================================================================================================
			
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->sort = $sort_order;
				$blog_attachments->user_id = $user->id;
				
				$file = BlogClass::getAttrFile($rs->file);
				$blog_attachments->file_name = $file->name;
				$blog_attachments->file_size = $file->size;
				$blog_attachments->file_mimetype = $file->mimetype;
				$blog_attachments->file_width = $file->width;
				$blog_attachments->file_height = $file->height;
				$blog_attachments->file_path = 'images/'. Auth::user()->id .'/original/'. $file->name;
				$blog_attachments->file_url = '/storage/images/'. Auth::user()->id .'/original/'. $file->name;
				
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$file->name);
				blog_tmp::where('key',$key)->where('file',$rs->file)->where('user_id',$user->id)->delete();
				BlogClass::deleteTempPhoto($rs->file);
			//====================================================================================================
		}
		//================================================
		if($job)
		{
			$rcloneJob = (new RCloneImages())->delay(now()->addSeconds(60));
   			dispatch($rcloneJob);	
		}
		//================================================	
    	BlogClass::repair_layout($id);
		return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
	}
	
	public function store(Request $request)
	{
		
		$user = Auth::user();
		$job = false;
		$title =  $request->input('title');
		$date =  $request->input('date');
		$user_id =  $user->id;
		$key = $request->input('key');
		$content_type = $request->input('content_type');
		$post_type = $request->input('post_type');
		$content = $request->input('content');
		$layout = $request->input('layout');
		
		if($title=="") $title = date("j M Y", strtotime($date));
		$guid = BlogClass::makeSlug($title,$user_id);
		
		$blog_posts = new blog_posts;
		$blog_posts->title = $title;
		$blog_posts->slug = $guid;
		$blog_posts->content = $content;
		$blog_posts->layout = $layout;
		$blog_posts->date = $date;
		$blog_posts->user_id = $user_id;
		$blog_posts->content_type = $content_type;
		$blog_posts->post_type = $post_type;
		$blog_posts->status = 0;
		$blog_posts->save();
		
		$result = blog_tmp::where('key',$key)->where('user_id',$user->id)->get();
		
		if(@count($result))
		{
			$job = true;	
		}
		
		$sort_order = 0 ;
		foreach($result as $rs)
		{
			$sort_order++;
			
			//====================================================================================================
				
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->sort = $sort_order;
				$blog_attachments->user_id = $user->id;
				
				$file = BlogClass::getAttrFile($rs->file);
				$blog_attachments->file_name = $file->name;
				$blog_attachments->file_size = $file->size;
				$blog_attachments->file_mimetype = $file->mimetype;
				$blog_attachments->file_width = $file->width;
				$blog_attachments->file_height = $file->height;
				$blog_attachments->file_path = 'images/'. Auth::user()->id .'/original/'. $file->name;
				$blog_attachments->file_url = '/storage/images/'. Auth::user()->id .'/original/'. $file->name;
				
				
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$file->name);
				blog_tmp::where('key',$key)->where('file',$rs->file)->where('user_id',$user->id)->delete();
				BlogClass::deleteTempPhoto($rs->file);
				
			//====================================================================================================
			
		}
		BlogClass::repair_layout($blog_posts->id);
		//================================================
		if($job)
		{
			$rcloneJob = (new RCloneImages())->delay(now()->addSeconds(60));
   			dispatch($rcloneJob);	
		}
		//================================================		
    	
		return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
	}
	
	public function destroy($id)
	{
		$user = Auth::user();
		$job = false;
		$result = blog_attachments::where('post_id',$id)->where('user_id',$user->id)->get();
		if(@count($result))
		{
			$job = true;	
		}
		foreach($result as $rs)
		{
				//====================================================================================================
					BlogClass::deletePhoto($rs->file_name);
				//====================================================================================================
		}
		
		$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
		$blog_posts->attachments()->delete();
		$blog_posts->delete();
		//================================================
		if($job)
		{
			//$rcloneJob = (new RCloneImages())->delay(now()->addSeconds(60));
   			//dispatch($rcloneJob);
		}
		//================================================
	}
	
}
?>