<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Auth;

class AvailabilityController extends Controller
{
	public function getAvailability()
	{
		$post_id = '7d435e1b-3fa8-470b-aaaf-f43a4b6fe947';
		$disDates = array();
		$rev_availability = rev_availability::where('post_id',$post_id)->get();
		foreach($rev_availability as $avalaibility)
		{
			array_push($disDates,$avalaibility->date);
		}
		$str1 = date('YmdHis');
		$str2 = date('Ymd173000');
		if($str1>=$str2) array_push($disDates,date('Y-m-d 00:00:00'));
		
		$defaultTimes = '18:30:00';
		$defaultDates = date('Y-m-d') .' 00:00:00';
		while(in_array($defaultDates, $disDates))
		{
			$defaultDates = date('Y-m-d 00:00:00',strtotime($defaultDates . "+1 days"));
		}
		$disabledDates = "'" . implode("','", $disDates) . "'";
		return response()->json(["defaultDates" => $defaultDates,"disabledDates" => $disabledDates,"defaultTimes" => $defaultTimes]);
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
			$query = rev_availability::query();
			return Datatables::eloquent($query)
				->addIndexColumn()
				->editColumn('date', function ($order) {
					return Carbon::parse($order->date)->formatLocalized('%d %B %Y');
				})
				->addColumn('product', function ($order) {
					$post = blog_posts::find($order->post_id);
					return $post->title;
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
    public function create()
    {
		$blog_posts = blog_posts::where('content_type','standard')->where('user_id', Auth::user()->id)->orderBy('created_at')->get();
		return view('rev.availability.create',['blog_posts'=>$blog_posts]);
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
			'post_id'    => 'required',
			'date'    => 'required|date',
    		'date2'      => 'required|date|after_or_equal:date',
       	]);
        
		
	
		
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		
		$post_id = $request->input('post_id');
		$date = $request->input('date');
		$date2 = $request->input('date2');
		
		
		// Specify the start date. This date can be any English textual format  
		$date_from = $date;   
		$date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
  
		// Specify the end date. This date can be any English textual format  
		$date_to = $date2;  
		$date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
  
		// Loop from the start date to end date and output all dates inbetween  
		for ($i=$date_from; $i<=$date_to; $i+=86400) {
			  
			$rev_availability = rev_availability::where('date',date("Y-m-d", $i));
			$rev_availability->delete();
		
			$rev_availability = new rev_availability();
			$rev_availability->post_id = $post_id;
			$rev_availability->date = date("Y-m-d", $i);
			$rev_availability->save();
			
		} 
		
		
		
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
