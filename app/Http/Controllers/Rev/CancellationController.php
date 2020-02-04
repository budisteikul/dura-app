<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use Illuminate\Support\Facades\Validator;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'email' => ['required', 'string', 'max:255'],
          	'code' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$ticket = $request->input('code');
		$email = $request->input('email');
		$book = rev_books::where('ticket',$ticket)->where('email',$email)->first();
		if(!isset($book)) return response()->json([ "id" => "1", "message" => '<div class="alert alert-danger" role="alert">Ticket not found</div>' ]);
		
		$ticket = '';
		$name = '';
		$phone = '';
		$email = '';
		$date_text = '';
		$traveller = 'People : '. $book->traveller .'<br>';
		$channel = '';
					
		if($book->ticket!='') $ticket = '<b>'.$book->ticket .'</b><br>';
		if($book->name!='') $name = 'Name : '. $book->name .'<br>';
		if($book->phone!='') $phone = 'Phone : '.$book->phone .'<br>';
		if($book->email!='') $email = 'Email : '.$book->email .'<br>';
		if($book->date_text!='') $date_text = 'Date : '.$book->date_text .'<br>';
		$rev_resellers = rev_resellers::find($book->source);
		if(isset($rev_resellers)) $channel = 'Channel : '. $rev_resellers->name .'<br>';
		
		switch($book->status)
		{
			case 1 :
				$status = 'Status : <span class="badge badge-warning">Pending</span>';
			break;
			case 2 :
				$status = 'Status : <span class="badge badge-success">Confirmed</span>';
			break;
			case 3 :
				$status = 'Status : <span class="badge badge-danger">Cancelled</span>';
			break;	
		}
		
		$html = '<div class="bd-callout bd-callout-danger">'.$ticket . $name . $traveller . $phone . $email . $date_text . $channel.$status.'</div><div><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Cancel Booking</button></div>';
		
		return response()->json([
					"id" => "1",
					"message" => $html
				]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
