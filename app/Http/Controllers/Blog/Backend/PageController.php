<?php

namespace App\Http\Controllers\Blog\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\blog_posts;
use App\DataTables\Blog\PagesDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Classes\Blog\BlogClass;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('blog.backend.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.backend.page.create');
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
			'content' => ['required', 'string'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$content =  $request->input('content');
		$description =  $request->input('description');
		
		$blog_posts = new blog_posts;
		$blog_posts->title = $title;
		$blog_posts->content = $content;
		$blog_posts->description = $description;
		$blog_posts->slug = BlogClass::makeSlug($title,$user->id);
		$blog_posts->date = date('Y-m-d H:i:s');
		$blog_posts->user_id = $user->id;
		$blog_posts->content_type = 'page';
		$blog_posts->post_type = 'post';
		$blog_posts->status = 1;
		$blog_posts->save();
		
		
		
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
        $blog_posts = blog_posts::where('slug',$id)->first();
		return view('page.page',['blog_posts'=>$blog_posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog_posts = blog_posts::findOrFail($id);
		return view('blog.backend.page.edit',['blog_posts'=>$blog_posts]);
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
		
        $validator = Validator::make($request->all(), [
          	'title' => ['required', 'string', 'max:255'],
			'content' => ['required', 'string'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$content =  $request->input('content');
		$description =  $request->input('description');
		
		$blog_posts = blog_posts::find($id);
		$blog_posts->title = $title;
		$blog_posts->content = $content;
		$blog_posts->description = $description;
		$blog_posts->date = date('Y-m-d H:i:s');
		$blog_posts->user_id = $user->id;
		$blog_posts->content_type = 'page';
		$blog_posts->post_type = 'post';
		$blog_posts->status = 1;
		$blog_posts->save();
		
		
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
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
        blog_posts::find($id)->delete();
    }
}
