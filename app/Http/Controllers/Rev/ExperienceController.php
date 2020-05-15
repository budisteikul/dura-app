<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Rev\ExperiencesDataTable;
use Illuminate\Support\Facades\Validator;
use App\Classes\Rev\BokunClass;
use App\Classes\Rev\RevClass;
use App\Models\Rev\rev_experiences;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Str;

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
			'productId' => ['required', 'int'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$productId =  $request->input('productId');
		
		$rev_experiences = new rev_experiences;
		$rev_experiences->title = $title;
		$rev_experiences->slug = RevClass::makeSlug($title);
		$rev_experiences->productId = $productId;
		$rev_experiences->save();
		
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
		$rev_experiences = rev_experiences::findOrFail($id);
		return view('rev.experiences.edit',['rev_experiences'=>$rev_experiences]);
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
			'productId' => ['required', 'int'],
       	]);
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$title =  $request->input('title');
		$productId =  $request->input('productId');
		
		
		$rev_experiences = rev_experiences::find($id);
		$rev_experiences->title = $title;
		$rev_experiences->slug = RevClass::makeSlug($title,$id);
		$rev_experiences->productId = $productId;
		$rev_experiences->save();
		
		
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
        $rev_experiences = rev_experiences::find($id);
		$rev_experiences->delete();
    }
	
	
}
