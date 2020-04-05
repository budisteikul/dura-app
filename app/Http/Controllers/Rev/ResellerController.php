<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\Rev\ResellersDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Rev\rev_resellers;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_reviews;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResellersDataTable $dataTable)
    {
        return $dataTable->render('rev.resellers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rev.resellers.create');
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
          	'name' => 'required|string|max:255',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$uuid =  $request->input('uuid');
		
		if($uuid=="") $uuid = Uuid::uuid4()->toString();
		
		$rev_resellers = new rev_resellers();
		$rev_resellers->name = $name;
		$rev_resellers->save();
		
		$rev_resellers = rev_resellers::findOrFail($rev_resellers->id);
		$rev_resellers->id = $uuid;
		$rev_resellers->save();
		
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
		
				$rev_books = rev_books::where('source',$id)->get();
				if(count($rev_books))
				{
					$limit = true;
				}
				$rev_reviews = rev_reviews::where('source',$id)->get();
				if(count($rev_reviews))
				{
					$limit = true;
				}
		
        $rev_resellers = rev_resellers::findOrFail($id);
        return view('rev.resellers.edit',['rev_resellers'=>$rev_resellers,'limit'=>$limit]);
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
		if($request->input('update')!="")
		{
			$validator = Validator::make($request->all(), [
          			'update' => 'in:0,1'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
			
			rev_resellers::query()->update(['status'=>0]);
			$rev_resellers = rev_resellers::find($id);
			$rev_resellers->status = $request->input('update');
			$rev_resellers->save();
			
			
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
		
        $validator = Validator::make($request->all(), [
          	'name' => 'required|string|max:255',
			'uuid' => 'required|string|max:255',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$uuid =  $request->input('uuid');
		
		$rev_resellers = rev_resellers::findOrFail($id);
		$rev_resellers->id = $uuid;
		$rev_resellers->name = $name;
		$rev_resellers->save();
		
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
        rev_resellers::find($id)->delete();
    }
}
