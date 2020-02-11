<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\Rev\ResellersDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Rev\rev_resellers;

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
			'commission' => 'required|numeric'
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$commission =  $request->input('commission');
		$link =  $request->input('link');
		
		$rev_resellers = new rev_resellers();
		$rev_resellers->name = $name;
		$rev_resellers->commission = $commission;
		$rev_resellers->link = $link;
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
        $rev_resellers = rev_resellers::findOrFail($id);
        return view('rev.resellers.edit',['rev_resellers'=>$rev_resellers]);
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
          	'name' => 'required|string|max:255',
			'uuid' => 'required|string|max:255',
			'commission' => 'required|numeric'
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$name =  $request->input('name');
		$commission =  $request->input('commission');
		$link =  $request->input('link');
		$uuid =  $request->input('uuid');
		
		$rev_resellers = rev_resellers::findOrFail($id);
		$rev_resellers->id = $uuid;
		$rev_resellers->name = $name;
		$rev_resellers->commission = $commission;
		$rev_resellers->link = $link;
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
