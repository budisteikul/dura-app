<?php

namespace App\Http\Controllers\Blog\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog\blog_categories;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_attachments;
use App\Models\Blog\blog_tmp;
use Illuminate\Support\Facades\Validator;
use App\Classes\Blog\BlogClass;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
		if($request->ajax())
		{
			$posts = blog_posts::with('categories')
			->with('attachments')
			->where('user_id',$user->id)
			->where('content_type','standard');
			return Datatables::eloquent($posts)
				->addIndexColumn()
				->addColumn('attachments',function (blog_posts $blog_posts) {
						$file = '';
						foreach($blog_posts->attachments as $attachment)
						{
							$file .= '<img class="rounded" style="margin:1px;" src="/storage/'. Auth::user()->id .'/images/50/'. $attachment->file_name .'">';
						}
						return $file;
					})
				->addColumn('categories',function (blog_posts $blog_posts) {
						return $blog_posts->categories->map(function($post) {
                        	return str_limit($post->name, 30, '...');
                    	})->implode(', ');
					})
				->addColumn('action', function ($post) {
					if($post->status==1)
					{
						$label = ""	;
						$status = 0;
						$button = "btn-primary";
						$icon = "fa-toggle-on";
						$text = " Published";
					}
					else
					{
						$label = "";
						$status = 1;
						$button = "btn-primary";
						$icon = "fa-toggle-off";
						$text = " Pending";
					}
					return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-1" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$post->id.'\'); return false;" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $post->id .'\')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></div><div class="btn-group mb-1" role="group"><button id="btn-update" type="button" onClick="STATUS(\''. $post->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div></div>';
				})
				->rawColumns(['action','attachments'])
				->toJson();
		}
        return view('blog.backend.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
		
		$stdClass = app();
		$setting = $stdClass->make('stdClass');
		$setting->key = Uuid::uuid4();
		$setting->date = date("Y-m-d H:i:s", strtotime('+7 hours'));
		
		$result_categories = blog_categories::where('user_id',$user->id)->get();
        return view('blog.backend.post.create')
				->with('result_categories',$result_categories)
				->with('setting',$setting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
          	'title' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$date =  $request->input('date');
		$user_id =  $user->id;
		$key = $request->input('key');
		$content = $request->input('content');
		$category_id = $request->input('category_id');
		
		$blog_posts = new blog_posts;
		$blog_posts->title = $title;
		$blog_posts->slug = BlogClass::makeSlug($title,$user_id);
		$blog_posts->content = $content;
		$blog_posts->date = $date;
		$blog_posts->user_id = $user_id;
		$blog_posts->content_type = 'standard';
		$blog_posts->post_type = 'post';
		$blog_posts->status = 0;
		$blog_posts->save();
		
		$blog_posts->categories()->attach($category_id,['user_id' => $user_id]);
		
		$result = blog_tmp::where('key',$key)->where('user_id',$user_id)->get();
		$sort_order = 0 ;
		foreach($result as $rs)
		{
				$sort_order++;
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->sort = $sort_order;
				
				$file = BlogClass::getAttrFile($rs->file);
				
				$blog_attachments->file_name = $file->name;
				$blog_attachments->file_size = $file->size;
				$blog_attachments->file_mimetype = $file->mimetype;
				$blog_attachments->file_width = $file->width;
				$blog_attachments->file_height = $file->height;
				$blog_attachments->file_path = $user_id .'images/original/'. $file->name;
				$blog_attachments->file_url = '/storage/'. $user_id .'/images/original/'. $file->name;
				
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$file->name);
				blog_tmp::where('id',$rs->id)->delete();
				BlogClass::deleteTempPhoto($rs->file);
		}
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = Auth::user();
		 $result = blog_posts::with('categories')->where('user_id',$user->id)->findOrFail($id);
		 $result_categories = blog_categories::where('user_id',$user->id)->get();
		 $stdClass = app();
		 $setting = $stdClass->make('stdClass');
		 $setting->key = Uuid::uuid4();
         return view('blog.backend.post.edit')
		 ->with('result_categories',$result_categories)
		 ->with('result',$result)
		 ->with('setting',$setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
		
		if($request->input('status')!="")
		{
			$validator = Validator::make($request->all(), [
          			'status' => 'in:0,1'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
			$blog_posts->status = $request->input('status');
			$blog_posts->save();
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
		
        $validator = Validator::make($request->all(), [
          	'title' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$date =  $request->input('date');
		$user_id =  $user->id;
		$key = $request->input('key');
		$content = $request->input('content');
		$category_id = $request->input('category_id');
		
		$result = blog_attachments::where('post_id',$id)->get();
		foreach($result as $rs)
		{
			$sort_order = $request->input('attachment_'. str_ireplace("-","_",$rs->id));
			if($sort_order=="") $sort_order = 0;
			$blog_attachments = blog_attachments::find($rs->id);
			$blog_attachments->sort = $sort_order;
			$blog_attachments->save();
			
			$bbb = $request->input('del_attachment_'. str_ireplace("-","_",$rs->id));
			if($bbb=="hapus")
			{
				$blog_attachments = blog_attachments::find($rs->id);
				$blog_attachments->delete();
				BlogClass::deletePhoto($rs->file_name);
			}
			
		}
		
		$blog_posts = blog_posts::findOrFail($id);
		$blog_posts->title = $title;
		$blog_posts->slug = BlogClass::makeSlug($title,$user_id,$id);
		$blog_posts->content = $content;
		$blog_posts->date = $date;
		$blog_posts->user_id = $user_id;
		$blog_posts->content_type = 'standard';
		$blog_posts->post_type = 'post';
		$blog_posts->save();
		
		$blog_posts->categories()->detach();
		$blog_posts->categories()->attach($category_id,['user_id' => $user_id]);
		
		$result = blog_tmp::where('key',$key)->where('user_id',$user_id)->get();
		$sort_order = blog_attachments::where('post_id',$id)->max('sort');
		foreach($result as $rs)
		{
				$sort_order++;
				$blog_attachments = new blog_attachments;
				$blog_attachments->post_id = $blog_posts->id;
				$blog_attachments->sort = $sort_order;
				
				$file = BlogClass::getAttrFile($rs->file);
				$blog_attachments->file_name = $file->name;
				$blog_attachments->file_size = $file->size;
				$blog_attachments->file_mimetype = $file->mimetype;
				$blog_attachments->file_width = $file->width;
				$blog_attachments->file_height = $file->height;
				$blog_attachments->file_path = $user_id .'images/original/'. $file->name;
				$blog_attachments->file_url = '/storage/'. $user_id .'/images/original/'. $file->name;
				
				$blog_attachments->save();
				
				BlogClass::createPhoto($rs->file,$file->name);
				blog_tmp::where('id',$rs->id)->delete();
				BlogClass::deleteTempPhoto($rs->file);
		}
		return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
		$result = blog_attachments::where('post_id',$id)->get();
		foreach($result as $rs)
		{
				BlogClass::deletePhoto($rs->file_name);
		}
		$blog_posts = blog_posts::where('user_id',$user->id)->find($id);
		$blog_posts->attachments()->delete();
		$blog_posts->delete();
    }
}
