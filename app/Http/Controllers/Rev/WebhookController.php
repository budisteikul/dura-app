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
		
		$text = 'Wed 31.Jul 2019';
		$text = explode('@',$text);
		if(isset($text[1]))
		{
			$date = \DateTime::createFromFormat('D d.M Y ', $text[0]);
			$time = \DateTime::createFromFormat(' H:i', $text[1]);
			print($date->format('Y-m-d'));
			print($time->format('H:i:00'));
		}
		else
		{
			$date = \DateTime::createFromFormat('D d.M Y', $text[0]);
			print($date->format('Y-m-d'));
			print('00:00:00');
		}
		
		
		/*
		$books = rev_books::all();
		foreach($books as $book)
		{
			$date = \DateTime::createFromFormat('Y-m-d H:i:s', $book->date);
			$rev_books = rev_books::findOrFail($book->id);
			$rev_books->date_text = $date->format('D d.M Y @ H:i');
			$rev_books->save();
			echo $date->format('D d.M Y @ H:i');
		}
		*/
		
		exit();
		
		
		/*
		
		
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
		*/
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }
   
}
