<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Rev\ExperiencesDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog\blog_posts;
use App\Classes\Blog\BlogClass;
use App\Classes\Rev\BokunClass;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_reviews;

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
			'product_id' => ['required', 'int'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$product_id =  $request->input('product_id');
		//319494
		$blog_posts = new blog_posts;
		$blog_posts->title = $title;
		$blog_posts->slug = BlogClass::makeSlug($title,$user->id);
		$blog_posts->date = date('Y-m-d H:i:s');
		$blog_posts->user_id = $user->id;
		$blog_posts->content_type = 'experience';
		$blog_posts->post_type = 'post';
		$blog_posts->status = 1;
		$blog_posts->product_id = $product_id;
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
		$limit = false;
		
		
		$blog_posts = blog_posts::findOrFail($id);		
				
				$rev_books = rev_books::where('post_id',$blog_posts->id)->get();
				if(count($rev_books))
				{
					$limit = true;
				}
				$rev_reviews = rev_reviews::where('post_id',$blog_posts->id)->get();
				if(count($rev_reviews))
				{
					$limit = true;
				}
				
		
        return view('rev.experiences.edit',['blog_posts'=>$blog_posts,'limit'=>$limit]);
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
			'product_id' => ['required', 'int'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$product_id =  $request->input('product_id');
		
		
		$blog_posts = blog_posts::find($id);
		$blog_posts->title = $title;
		$blog_posts->product_id = $product_id;
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
        $blog_posts = blog_posts::find($id);
		$blog_posts->delete();
    }
	
	public function import()
	{
		if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
		{
			$product_lists = BokunClass::get_product_list_byid(27645);
		}
		else
		{
			$product_lists = BokunClass::get_product_list_byid(27651);
		}
		foreach($product_lists->children as $product_list)
		{
			$products = BokunClass::get_product_list_byid($product_list->id);
			foreach($products->items as $product)
			{
				print($product->activity->title .''. $product->activity->id .'<br>');
				/*
				$title = $product->activity->title;
				$id = $product->activity->id;
				
				$check = blog_posts::where('product_id',$id)->first();
				if(!isset($check))
				{
					$blog_posts = new blog_posts;
					$blog_posts->title = $title;
					$blog_posts->slug = BlogClass::makeSlug($title,Auth::user()->id);
					$blog_posts->date = date('Y-m-d H:i:s');
					$blog_posts->user_id = Auth::user()->id;
					$blog_posts->content_type = 'experience';
					$blog_posts->post_type = 'post';
					$blog_posts->status = 1;
					$blog_posts->product_id = $id;
					$blog_posts->save();
				}
				*/
				
			}
		}
		//return redirect("/rev/experiences");
	}
}
