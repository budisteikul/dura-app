<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Rev\ExperiencesDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Rev\rev_widgets;
use App\Models\Blog\blog_posts;
use App\Classes\Blog\BlogClass;

use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExperiencesDataTable $dataTable)
    {
        return $dataTable->render('rev.experiences.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rev.experiences.create');
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
			'product_id' => ['required', 'string', 'max:255'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$product_id =  $request->input('product_id');
		$calendar_id =  $request->input('calendar_id');
		
		$blog_posts = new blog_posts;
		$blog_posts->title = $title;
		$blog_posts->slug = BlogClass::makeSlug($title,$user->id);
		$blog_posts->date = date('Y-m-d H:i:s');
		$blog_posts->user_id = $user->id;
		$blog_posts->content_type = 'experience';
		$blog_posts->post_type = 'post';
		$blog_posts->status = 1;
		$blog_posts->save();
		
		$rev_widgets = new rev_widgets();
		$rev_widgets->post_id = $blog_posts->id;
		$rev_widgets->product_id = $product_id;
		$rev_widgets->calendar_id = $calendar_id;
		$rev_widgets->save();
		
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
		$rev_widgets = rev_widgets::findOrFail($id);
		$blog_posts = blog_posts::findOrFail($rev_widgets->post_id);
        return view('rev.experiences.edit',['rev_widgets'=>$rev_widgets,'blog_posts'=>$blog_posts]);
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
			'product_id' => ['required', 'string', 'max:255'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$product_id =  $request->input('product_id');
		$calendar_id =  $request->input('calendar_id');
		
		$rev_widgets = rev_widgets::findOrFail($id);
		$blog_posts = blog_posts::find($rev_widgets->post_id);
		
		$rev_widgets->product_id = $product_id;
		$rev_widgets->calendar_id = $calendar_id;
		$rev_widgets->save();
		
		
		$blog_posts->title = $title;
		//$blog_posts->slug = BlogClass::makeSlug($title,$user->id);
		$blog_posts->date = date('Y-m-d H:i:s');
		$blog_posts->user_id = $user->id;
		$blog_posts->content_type = 'experience';
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
        rev_widgets::find($id)->delete();
		blog_posts::find($rev_widgets->post_id)->delete();
    }
}
