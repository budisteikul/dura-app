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
use App\Models\Rev\rev_shoppingcarts;

class WebhookController extends Controller
{
	
	
	public function store(Request $request)
    {
		$data = $request->all();
		switch($request->input('action'))
		{
		case 'BOOKING_CONFIRMED':
		
		BookClass::webhook_insert_shoppingcart($data);
		
		break;
		case 'BOOKING_ITEM_CANCELLED':
			rev_shoppingcarts::where('confirmationCode',$data['confirmationCode'])->update(['bookingStatus'=>'CANCELLED']);
		break;
		}
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }
   
}
