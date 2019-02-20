<?php

namespace App\Http\Controllers\Blog\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog\blog_categories;
use Illuminate\Support\Facades\Validator;
use App\Classes\Blog\BlogClass;

class CategoryController extends Controller
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
			$categories = blog_categories::where('user_id',$user->id);
			return Datatables::eloquent($categories)
				->addIndexColumn()
				->addColumn('action', function ($category) {
					return '<div class="btn-group" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$category->id.'\'); return false;" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $category->id .'\')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></div>';
				})
				->rawColumns(['action'])
				->toJson();
		}
        return view('blog.backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = Auth::user();
		$categories = blog_categories::where('user_id',$user->id)->get();
        return view('blog.backend.category.create')->with('categories',$categories);
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
          	'name' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name = $request->input('name');
		$description = $request->input('description');
		$parent_id = $request->input('parent_id');
		$slug = BlogClass::makeSlugCat($name,$user->id);
		if(empty($parent_id)) $parent_id = '00000000-0000-0000-0000-000000000000';
		
		$blog_categories = new blog_categories();
		$blog_categories->parent_id = $parent_id;
		$blog_categories->user_id = $user->id;
		$blog_categories->name = $name;
		$blog_categories->description = $description;
		$blog_categories->slug = $slug;
		$blog_categories->save();
		
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
		 $category = blog_categories::where('user_id',$user->id)->findOrFail($id);
		 $categories = blog_categories::where('user_id',$user->id)->where('id','!=',$category->id)->get();
         return view('blog.backend.category.edit')->with('categories',$categories)->with('category',$category);
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
          	'name' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name = $request->input('name');
		$description = $request->input('description');
		$parent_id = $request->input('parent_id');
		$slug = BlogClass::makeSlugCat($name,$user->id,$id);
		if(empty($parent_id)) $parent_id = '00000000-0000-0000-0000-000000000000';
		
		$blog_categories = blog_categories::where('user_id',$user->id)->findOrFail($id);
		$blog_categories->parent_id = $parent_id;
		$blog_categories->user_id = $user->id;
		$blog_categories->name = $name;
		$blog_categories->description = $description;
		$blog_categories->slug = $slug;
		$blog_categories->save();
		
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
        $user = Auth::user();
		$blog_categories = blog_categories::where('user_id',$user->id)->find($id);
		$blog_categories->delete();
    }
}
