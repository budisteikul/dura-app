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
class PostController extends Controller
{
	
	public function __construct()
	{
    	$this->middleware(['auth', 'verified']);
	}
		
	public function getData()
	{
		$user = Auth::user();
		$posts = blog_posts::with(array('attachments' => function($query)
				   {
					   $query->where('resource_type', 'image');
					   $query->orderBy('sort', 'asc');
				   }
				   ))->where('user_id',$user->id)->where('tipe_post','post')->orderBy('tanggal','desc');
        return Datatables::eloquent($posts)
		->addColumn('contents', function ($post){
				$contents = "";
				
                if(@count($post->attachments))
				{
					foreach($post->attachments as $attachment)
					{
						$contents	 .= '<img style="margin:1px;" src="/storage/images/50/'. $attachment->public_id .'.'. $attachment->format .'">';
					}
					
					$contents .=	"<br />". $post->konten;
					
				}
				else
				{
					$contents = $post->konten;
				}
				return $contents;
            })
		->editColumn('tanggal', function ($post){
                return $post->tanggal;
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
                return '<div class="btn-group" role="group"><button id="btn-edit" type="button" onClick="window.location=\'/blog/post/edit/'.$post->id.'\'" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</button><button id="btn-del" type="button" onClick="delPost(\''. $post->id .'\')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button><button id="btn-del" type="button" onClick="upPost(\''. $post->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div>';
            })
		->rawColumns(['action','contents'])
		->toJson();
	}
		
	public function getIndex()
	{
		$user = Auth::user();
    	return view('blog.backend.post')->with('user',$user);
	}
	
	public function getAddPost($tipe_konten)
	{
		$user = Auth::user();
		$result = blog_tmp::where('user_id',$user->id)->get();
		foreach($result as $rs)
		{
			if(file_exists($rs->file))
			{
				unlink($rs->file);	
			}
		}
		blog_tmp::where('user_id',$user->id)->delete();
		
		$tanggal = date("Y-m-d H:i:s", strtotime('+7 hours'));
		
    		return view('blog.backend.post-add')
				->with('user',$user)
				->with('tanggal',$tanggal)
				->with('tipe_konten',$tipe_konten);
		
	}
	
	public function getEditPost($id)
	{
		$user = Auth::user();
		$stdClass = app();
		$setting = $stdClass->make('stdClass');
		$result = blog_posts::where('user_id',$user->id)->find($id);
		$result_attachments = blog_attachments::where('post_id',$result->id)->where('user_id',$user->id)->orderBy('sort','asc')->get();
		
		return view('blog.backend.post-edit')
			   ->with('user',$user)
			   ->with('result',$result)
			   ->with('result_attachments',$result_attachments)
			   ->with('id',$id)
			   ->with('setting',$setting);
	}
	
	public function postEditPost(Request $request)
	{
		
		$user = Auth::user();
		$job = false;
		$judul =  $request->input('judul');
		$tanggal =  $request->input('tanggal');
		$user_id =  $user->id;
		$key = $request->input('key');
		$tipe_konten = $request->input('tipe_konten');
		$tipe_post = $request->input('tipe_post');
		$konten = $request->input('konten');
		$layout = $request->input('layout');
		$id = $request->input('id');
		
		
		
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
				
				BlogClass::deletePhoto($rs->public_id .".". $rs->format);
				
				$job = true;
			}
			
		}
		
		if($judul=="") $judul = date("j M Y", strtotime($tanggal));
		$guid = BlogClass::makeSlug($judul,$user_id,$id);
		
		
		$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
		$blog_posts->judul = $judul;
		$blog_posts->slug = $guid;
		$blog_posts->konten = $konten;
		$blog_posts->layout = $layout;
		$blog_posts->tanggal = $tanggal;
		$blog_posts->tipe_konten = $tipe_konten;
		$blog_posts->tipe_post = $tipe_post;
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
			
				$public_id = Uuid::uuid4();
				$photo = BlogClass::getAttrPhoto($rs->file);
				
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->public_id = $public_id;
				$blog_attachments->version = $photo->version;
				$blog_attachments->signature = $photo->signature;
				$blog_attachments->width = $photo->width;
				$blog_attachments->height = $photo->height;
				$blog_attachments->format = $photo->format;
				$blog_attachments->resource_type = $photo->resource_type;
				$blog_attachments->bytes = $photo->bytes;
				$blog_attachments->type = $photo->type;
				$blog_attachments->etag = $photo->etag;
				$blog_attachments->url = url('/') ."/storage/images/original/". $public_id .".". $photo->format;
				$blog_attachments->secure_url = str_ireplace("http://","https://",$blog_attachments->url);
				$blog_attachments->sort = $sort_order;
				$blog_attachments->user_id = $user->id;
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$public_id .'.'. $photo->format);
			
				blog_tmp::where('key',$key)->where('file',$rs->file)->where('user_id',$user->id)->delete();
				unlink($rs->file);
			//====================================================================================================
		}
		//================================================
		if($job)
		{
			//$rcloneJob = (new RCloneImages())->delay(now()->addSeconds(60));
   			//dispatch($rcloneJob);	
		}
		//================================================	
    	BlogClass::repair_layout($id);
	}
	
	public function postAddPost(Request $request)
	{
		
		$user = Auth::user();
		$job = false;
		$judul =  $request->input('judul');
		$tanggal =  $request->input('tanggal');
		$user_id =  $user->id;
		$key = $request->input('key');
		$tipe_konten = $request->input('tipe_konten');
		$tipe_post = $request->input('tipe_post');
		$konten = $request->input('konten');
		$layout = $request->input('layout');
		
		if($judul=="") $judul = date("j M Y", strtotime($tanggal));
		$guid = BlogClass::makeSlug($judul,$user_id);
		
		$blog_posts = new blog_posts;
		$blog_posts->judul = $judul;
		$blog_posts->slug = $guid;
		$blog_posts->konten = $konten;
		$blog_posts->layout = $layout;
		$blog_posts->tanggal = $tanggal;
		$blog_posts->user_id = $user_id;
		$blog_posts->tipe_konten = $tipe_konten;
		$blog_posts->tipe_post = $tipe_post;
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
				
				$public_id = Uuid::uuid4();
				$photo = BlogClass::getAttrPhoto($rs->file);
				
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->public_id = $public_id;
				$blog_attachments->version = $photo->version;
				$blog_attachments->signature = $photo->signature;
				$blog_attachments->width = $photo->width;
				$blog_attachments->height = $photo->height;
				$blog_attachments->format = $photo->format;
				$blog_attachments->resource_type = $photo->resource_type;
				$blog_attachments->bytes = $photo->bytes;
				$blog_attachments->type = $photo->type;
				$blog_attachments->etag = $photo->etag;
				$blog_attachments->url = url('/') ."/storage/images/original/". $public_id .".". $photo->format;
				$blog_attachments->secure_url = str_ireplace("http://","https://",$blog_attachments->url);
				$blog_attachments->sort = $sort_order;
				$blog_attachments->user_id = $user->id;
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$public_id .'.'. $photo->format);
				
				blog_tmp::where('key',$key)->where('file',$rs->file)->where('user_id',$user->id)->delete();
				unlink($rs->file);
			//====================================================================================================
			
		}
		
		//================================================
		if($job)
		{
			//$rcloneJob = (new RCloneImages())->delay(now()->addSeconds(60));
   			//dispatch($rcloneJob);	
		}
		//================================================		
    	BlogClass::repair_layout($blog_posts->id);
	}
	
	public function getDeletePost($id)
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
					BlogClass::deletePhoto($rs->public_id .".". $rs->format);
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
	
	public function getPublishData($id,$status)
	{
		$user = Auth::user();
		$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
		$blog_posts->status = $status;
		$blog_posts->save();
	}
	
}
?>