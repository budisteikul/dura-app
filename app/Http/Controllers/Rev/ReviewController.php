<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_reviews;
use App\Models\Blog\blog_posts;
use App\Classes\Rev\BookClass;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
		{
			$resources = rev_reviews::query();
			return Datatables::eloquent($resources)
				->addIndexColumn()
				->editColumn('date', function ($resource) {
					$date = Carbon::parse($resource->date)->formatLocalized('%d %b %Y %I:%M %p');
					return '<span class="badge badge-success">'. $date .'</span>';
				})
				->editColumn('text', function ($resource) {
					return str_limit($resource->text,100);
				})
				->addColumn('product', function ($resource) {
					$post = blog_posts::find($resource->post_id);
					return $post->title;
				})
				->addColumn('action', function ($resource) {
					$check = blog_posts::where('user_id',Auth::user()->id)->where('id',$resource->post_id)->first();
					if(isset($check))
					{
						return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$resource->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $resource->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
					}
					else
					{
						return '';	
					}
				})
				->rawColumns(['action','date'])
				->toJson();
		}
        return view('rev.review.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_post = blog_posts::where('content_type','standard')->where('user_id', Auth::user()->id)->orderBy('created_at')->get();
        return view('rev.review.create',['blog_post'=>$blog_post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          	'user' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id = $request->input('post_id');
		$user = $request->input('user');
		$title = $request->input('title');
		$text = $request->input('text');
		$date = $request->input('date');
		$rating = $request->input('rating');
		$source = $request->input('source');
		
		$rev_reviews = new rev_reviews();
		$rev_reviews->post_id = $post_id;
		$rev_reviews->user = $user;
		$rev_reviews->title = $title;
		$rev_reviews->text = $text;
		$rev_reviews->date = $date;
		$rev_reviews->rating = $rating;
		$rev_reviews->source = $source;
		$rev_reviews->save();
		
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
        $review = rev_reviews::findOrFail($id);
		$blog_post = blog_posts::where('content_type','standard')->where('user_id', Auth::user()->id)->orderBy('created_at')->get();
        return view('rev.review.edit',['review'=>$review,'blog_post'=>$blog_post]);
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
        
		$validator = Validator::make($request->all(), [
          	'user' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id = $request->input('post_id');
		$user = $request->input('user');
		$title = $request->input('title');
		$text = $request->input('text');
		$date = $request->input('date');
		$rating = $request->input('rating');
		$source = $request->input('source');
		
		
		$rev_reviews = rev_reviews::findOrFail($id);
		$rev_reviews->post_id = $post_id;
		$rev_reviews->user = $user;
		$rev_reviews->title = $title;
		$rev_reviews->text = $text;
		$rev_reviews->date = $date;
		$rev_reviews->rating = $rating;
		$rev_reviews->source = $source;
		$rev_reviews->save();
		
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
        $rev_reviews = rev_reviews::find($id);
		$rev_reviews->delete();
    }
}
