<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\DataTables\Rev\BookingsDataTable;
use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use App\Models\Rev\rev_shoppingcart_rates;
use App\Models\Rev\rev_shoppingcart_questions;
use App\Models\Rev\rev_shoppingcart_question_options;
use App\Classes\Rev\BookClass;
use App\Classes\Rev\PaypalClass;
use App\Models\Rev\rev_resellers;
use App\Models\Rev\rev_experiences;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class BookingController extends Controller
{
    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render('rev.booking.index');
    }
	
	public function create()
    {
		$rev_resellers = rev_resellers::orderBy('name')->get();
		$rev_experiences = rev_experiences::orderBy('title')->get();
        return view('rev.booking.create',['rev_experiences'=>$rev_experiences,'rev_resellers'=>$rev_resellers]);
    }
	
	
	public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          	'name' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$productId = $request->input('productId');
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$date = $request->input('date');
		$bookingChannel = $request->input('bookingChannel');
		$traveller = $request->input('traveller');
		$ticket = BookClass::get_ticket();
		
		
		
		$rev_shoppingcarts = new rev_shoppingcarts();
		$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
		$rev_shoppingcarts->confirmationCode = $ticket;
		$rev_shoppingcarts->paymentStatus = 0;
		$rev_shoppingcarts->bookingChannel = $bookingChannel;
		$rev_shoppingcarts->sessionId = Uuid::uuid4()->toString();
		$rev_shoppingcarts->currency = 'USD';
		$rev_shoppingcarts->discount = 0;
		$rev_shoppingcarts->subtotal = 0;
		$rev_shoppingcarts->total = 0;
		$rev_shoppingcarts->save();
		
		// main contact questions
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'firstName';
			$rev_shoppingcart_questions->order = 1;
			$rev_shoppingcart_questions->answer = $name;
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'lastName';
			$rev_shoppingcart_questions->order = 2;
			$rev_shoppingcart_questions->answer = '';
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'email';
			$rev_shoppingcart_questions->order = 3;
			$rev_shoppingcart_questions->answer = $email;
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'phoneNumber';
			$rev_shoppingcart_questions->order = 4;
			$rev_shoppingcart_questions->answer = $phone;
			$rev_shoppingcart_questions->save();
			
			$title = rev_experiences::where('productId',$productId)->first()->title;
			$rev_shoppingcart_products = new rev_shoppingcart_products();
			$rev_shoppingcart_products->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_products->productConfirmationCode = $ticket;
			$rev_shoppingcart_products->productId = $productId;
			$rev_shoppingcart_products->title = $title;
			$rev_shoppingcart_products->rate = '';
			$rev_shoppingcart_products->date = $date;
			$rev_shoppingcart_products->currency = 'USD';
			$rev_shoppingcart_products->discount = 0;
			$rev_shoppingcart_products->subtotal = 0;
			$rev_shoppingcart_products->total = 0;
			$rev_shoppingcart_products->save();
			
			$rev_shoppingcart_rates = new rev_shoppingcart_rates();
			$rev_shoppingcart_rates->shoppingcart_products_id = $rev_shoppingcart_products->id;
			$rev_shoppingcart_rates->type = 'product';
			$rev_shoppingcart_rates->title = $title;
			$rev_shoppingcart_rates->qty = $traveller;
			$rev_shoppingcart_rates->price = 0;
			$rev_shoppingcart_rates->unitPrice = 'Person';
			$rev_shoppingcart_rates->currency = 'USD';
			$rev_shoppingcart_rates->discount = 0;
			$rev_shoppingcart_rates->subtotal = 0;
			$rev_shoppingcart_rates->total = 0;
			$rev_shoppingcart_rates->save();
		
			return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }
	
	public function update(Request $request, $id)
    {
		if($request->input('cancel')!="")
		{
			$validator = Validator::make($request->all(), [
          			'cancel' => 'in:cancel'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
			
			$rev_shoppingcarts = rev_shoppingcarts::find($id);
			$rev_shoppingcarts->bookingStatus = 'CANCELLED';
			$rev_shoppingcarts->save();
			
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
			
		}
		
		if($request->input('update')!="")
		{
			$validator = Validator::make($request->all(), [
          			'update' => 'in:capture,void'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$rev_shoppingcarts = rev_shoppingcarts::find($id);
			$update = $request->input('update');
			if($update=="capture")
			{
				PaypalClass::captureAuth($rev_shoppingcarts->authorizationID);
				$rev_shoppingcarts->paymentStatus = 2;
				$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
				$rev_shoppingcarts->save();
			}
			if($update=="void")
			{
				PaypalClass::voidPaypal($rev_shoppingcarts->authorizationID);
				$rev_shoppingcarts->paymentStatus = 3;
				$rev_shoppingcarts->bookingStatus = 'CANCELLED';
				$rev_shoppingcarts->save();
			}
			
			
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
	}
	
	public function destroy($id)
    {
        rev_shoppingcarts::find($id)->delete();
    }
}
