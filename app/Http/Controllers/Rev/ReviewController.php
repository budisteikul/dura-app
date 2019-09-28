<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_reviews;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Classes\Rev\BookClass;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
	public function get_review(Request $request)
	{
		
			$resources = rev_reviews::query();
			return Datatables::eloquent($resources)
				->addColumn('style', function ($resource) {
					
					$rating = $resource->rating;
					switch($rating)
					{
						case '1':
							$star ='<i class="fa fa-star"></i>';	
						break;
						case '2':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '3':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '4':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '5':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						default:
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
					}
					
					
					$rev_resellers = rev_resellers::findOrFail($resource->source);
					
					$title = "";
					if(isset($resource->title))
					{
						$title = '<b>'.$resource->title.'</b><br>';
					}
					
					$date = Carbon::parse($resource->date)->formatLocalized('%b, %Y');
					
					$user = '<a href="'.$rev_resellers->link.'" target="_blank" rel="noreferrer" class="text-danger"><b>'. $resource->user .'</b></a> <small><span class="text-muted">'.$date.'</span></small><br>';
					$rating = '<span class="text-warning">'. $star .'</span>‎<br>';
					$text = nl2br($resource->text) .'<br>';
					$from = '<a href="'. $rev_resellers->link .'" class="text-danger" target="_blank" rel="noreferrer">  <small> '. $rev_resellers->link .'</small></a>';
					$output = $user.$rating.$title.$text.$from;
					return '<div style="margin-bottom:20px;" >'. $output .'</div>';
				})
				->rawColumns(['style'])
				->toJson();
		
	}
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
				->editColumn('source', function ($resource) {
					$rev_resellers = rev_resellers::findOrFail($resource->source);
					return $rev_resellers->name;
				})
				->addColumn('product', function ($resource) {
					$post = blog_posts::find($resource->post_id);
					return $post->title;
				})
				->addColumn('action', function ($resource) {
					
						return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$resource->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $resource->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
					
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
		$rev_resellers = rev_resellers::orderBy('name')->get();
        $blog_post = blog_posts::where('content_type','standard')->orderBy('created_at')->get();
        return view('rev.review.create',['blog_post'=>$blog_post,'rev_resellers'=>$rev_resellers]);
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
		$rev_resellers = rev_resellers::orderBy('name')->get();
		$blog_post = blog_posts::where('content_type','standard')->orderBy('created_at')->get();
        return view('rev.review.edit',['review'=>$review,'blog_post'=>$blog_post,'rev_resellers'=>$rev_resellers]);
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
