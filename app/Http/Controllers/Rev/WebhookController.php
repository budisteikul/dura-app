<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Rev\rev_books;
use App\Classes\Rev\BookClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WebhookController extends Controller
{
	
	
	public function store(Request $request)
    {
		$data = $request->all();
		
		//$time = date("Y-m-d H:i:s",$data['activityBookings'][0]['startDateTime']);
		//print_r(date('Y-m-d',(int)'1582156800000'));
		//$startTime =  $data['activityBookings'][0]['startTime'];
		
		//$date = 15821568000;
		
 		
		$timestamp = $data['activityBookings'][0]['startDateTime'];
		
		$dt = new \DateTime(date('Y-m-d h:i:s', floor($timestamp / 1000)));
		$dt->modify('+7 hours');
		
		
		
		$post_id = '7d435e1b-3fa8-470b-aaaf-f43a4b6fe947';
		$name = $data['customer']['firstName'] .' '. $data['customer']['lastName'];
		$email = $data['customer']['email'];
		$phone = $data['customer']['phoneNumberCountryCode'] .' '. $data['customer']['phoneNumber'];
		$date = $dt->format('Y-m-d H:i:s');
		$source = 'cfd05b44-9863-47fe-b88f-2453140fa276';
		$traveller = '2';
		$ticket = $data['confirmationCode'];
		$status = '1';
		
		
		
		$rev_books = new rev_books();
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $source;
		$rev_books->traveller = $traveller;
		$rev_books->ticket = $ticket;
		$rev_books->status = $status;
		$rev_books->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }
   
}
