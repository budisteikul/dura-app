<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_availability;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; 

class AvailabilityController extends Controller
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
			$query = rev_availability::query();
			return Datatables::eloquent($query)
				->addIndexColumn()
				->editColumn('date', function ($order) {
					return Carbon::parse($order->date)->formatLocalized('%d %B %Y');
				})
				->addColumn('action', function ($e) {
					return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="DELETE(\''. $e->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div></div>';
				})
				->rawColumns(['action'])
				->toJson();
		}
        return view('rev.availability.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		return view('rev.availability.create');
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
          	'date' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$date = $request->input('date');
		
		$rev_availability = rev_availability::where('date',$date);
		$rev_availability->delete();
		
		$rev_availability = new rev_availability();
		$rev_availability->date = $date;
		$rev_availability->save();
		
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rev_availability = rev_availability::find($id);
		$rev_availability->delete();
    }
}
