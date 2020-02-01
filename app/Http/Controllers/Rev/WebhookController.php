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
		
		$product_id = BookClass::get_id($data['activityBookings'][0]['product']['id']);
		$date = BookClass::texttodate($data['invoice']['productInvoices'][0]['dates']);
		
		
		$post_id = $product_id;
		$name = $data['customer']['firstName'] .' '. $data['customer']['lastName'];
		$email = $data['customer']['email'];
		$phone = $data['customer']['phoneNumberCountryCode'] .' '. $data['customer']['phoneNumber'];
		$date = $date;
		$source = 'cfd05b44-9863-47fe-b88f-2453140fa276';
		$traveller = $data['invoice']['productInvoices'][0]['lineItems'][0]['people'];
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
