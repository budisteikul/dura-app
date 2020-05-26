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
use App\Classes\Rev\BokunClass;
use App\Classes\Rev\PaypalClass;
use App\Models\Rev\rev_resellers;
use App\Models\Rev\rev_experiences;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Carbon\Carbon;
use Session;

class BookingController extends Controller
{
	public function __construct()
    {
		rev_shoppingcarts::where('bookingStatus','CART')->where('created_at','<=',Carbon::now()->subDays(1))->delete();
	}
	
	public function applypromocode(Request $request)
	{
		if(!Session::has('sessionId')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		$validator = Validator::make($request->all(), [
          	'promocode' => ['required', 'string', 'max:255'],
       	]);
		if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$promocode = $request->input('promocode');
		$sessionId = Session::get('sessionId');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$sessionId)->first();
		
		$contents = BokunClass::get_applypromocode($rev_shoppingcarts->sessionId,$promocode);
		
		if($contents=="400")
		{
			return response()->json([
					"id" => "2",
					"message" => 'Promo code: NOT_FOUND'
				]);
		}
		else
		{
			BookClass::get_shoppingcart($rev_shoppingcarts->sessionId,"update");
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->sessionId
				]);
		}
	}

	public function removepromocode(Request $request)
	{
		if(!Session::has('sessionId')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionId = Session::get('sessionId');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$sessionId)->first();
		
		BokunClass::get_removepromocode($rev_shoppingcarts->sessionId);
		BookClass::get_shoppingcart($rev_shoppingcarts->sessionId,"update");
		
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->sessionId
				]);
	}

	public function removebookingid(Request $request)
	{
		if(!Session::has('sessionId')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionId = Session::get('sessionId');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$sessionId)->first();
		
		$bookingId = $request->input('bookingId');
		BokunClass::get_removeactivity($rev_shoppingcarts->sessionId,$bookingId);
		BookClass::get_shoppingcart($rev_shoppingcarts->sessionId,"update");
		
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->sessionId
				]);
	}

	public function post_checkout(Request $request)
	{

		if(!Session::has('sessionId')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionId = Session::get('sessionId');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$sessionId)->first();

		foreach($rev_shoppingcarts->shoppingcart_questions()->get() as $question)
			{
				
				if($request->input($question->questionId)=="" && $question->required)
				{
					return response()->json([
						"id" => "2",
						"message" => 'Variable Not Valid'
					]);
				}
				
				$rev_shoppingcart_questions = rev_shoppingcart_questions::find($question->id);
				$rev_shoppingcart_questions->answer = $request->input($question->questionId);
				$rev_shoppingcart_questions->save();
				
				if($rev_shoppingcart_questions->selectOption)
				{
					$rev_shoppingcart_question_options = rev_shoppingcart_question_options::where('shoppingcart_questions_id',$rev_shoppingcart_questions->id)->get();
					foreach($rev_shoppingcart_question_options as $rev_shoppingcart_question_option)
					{
						if($rev_shoppingcart_question_option->value==$request->input($question->questionId))
						{
							$rev_shoppingcart_question_options_ = rev_shoppingcart_question_options::find($rev_shoppingcart_question_option->id);
							$rev_shoppingcart_question_options_->answer = 1;
							$rev_shoppingcart_question_options_->save();
						}
						else
						{
							$rev_shoppingcart_question_options_ = rev_shoppingcart_question_options::find($rev_shoppingcart_question_option->id);
							$rev_shoppingcart_question_options_->answer = 0;
							$rev_shoppingcart_question_options_->save();
						}
						
					}
				}
				
			}

			$grand_total = $rev_shoppingcarts->total;
			$rev_shoppingcarts->bookingChannel = 'Internal Booking';
			$rev_shoppingcarts->paymentStatus = 0;
			$rev_shoppingcarts->subtotal = $grand_total;
			$rev_shoppingcarts->total = $grand_total;
			$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
			$rev_shoppingcarts->save();

			BokunClass::get_removepromocode($rev_shoppingcarts->sessionId);
			foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
			{
				BokunClass::get_removeactivity($rev_shoppingcarts->sessionId,$shoppingcart_products->bookingId);
			}
			Session::forget('sessionId');
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->id
				]);
	}

	public function get_checkout(Request $request)
	{
		
		if(!Session::has('sessionId')){
			return redirect("/rev/booking");
		}
		
		$sessionId = Session::get('sessionId');
		$rev_shoppingcarts = rev_shoppingcarts::where('sessionId', $sessionId)
						->where('bookingStatus','CART')->first();
		
		if(!isset($rev_shoppingcarts))
		{
			return redirect("/rev/booking");
		}
		
		if($rev_shoppingcarts->shoppingcart_products()->count()==0)
		{
			return redirect("/rev/booking");
		}
		
		return view('rev.booking.checkout')
				->with([
						'rev_shoppingcarts'=>$rev_shoppingcarts
					]);
	}

	public function get_shoppingcart(Request $request)
    {
		$id = $request->input('sessionId');
		BookClass::get_shoppingcart($id,"insert");
		return redirect("/rev/booking/checkout");
	}

	public function get_calendar(Request $request)
    {
        $id = $request->input('activityId');
        $contents = BokunClass::get_product($id);
        $pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($id);
        }
		
		if(Session::has('sessionId')){
			$sessionId = Session::get('sessionId');
		}else{
			$sessionId = Uuid::uuid4()->toString();
			Session::put('sessionId',$sessionId);
		}
		$bookingChannelUUID = env("BOKUN_BOOKING_CHANNEL");
		
		$availability = BokunClass::get_availabilityactivity($contents->id,1);
		$first = '[{"date":'. $availability[0]->date .',"localizedDate":"'. $availability[0]->localizedDate .'","availabilities":';
		$middle = json_encode($availability);
		$last = '}]';
		$firstavailability = $first.$middle.$last;
		
		$microtime = $availability[0]->date;
		$month = date("n",$microtime/1000);
		$year = date("Y",$microtime/1000);
		$embedded = "false";
        return view('rev.booking.calendar')->with(['embedded'=>$embedded,'contents'=>$contents,'pickup'=>$pickup,'sessionId'=>$sessionId,'bookingChannelUUID'=>$bookingChannelUUID,'firstavailability'=>$firstavailability,'year'=>$year,'month'=>$month]);
    }

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
