<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use App\Models\Rev\rev_shoppingcart_rates;
use App\Models\Rev\rev_shoppingcart_questions;
use App\Models\Rev\rev_shoppingcart_question_options;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;

use App\Classes\Rev\BookClass;
use App\Classes\Rev\PaypalClass;
use App\Classes\Rev\BokunClass;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\Mail\Rev\Booking;
use Session;

use PDF;

class ShoppingCartController extends Controller
{
    public function time_selector($id)
	{
		$render = '';
		$product_id = blog_posts::where('slug',$id)->first();
		
        if(!isset($product_id)){
			return redirect("/");
        }
		
		$calendar = BokunClass::get_widget($product_id->product_id);
		
		return view('blog.frontend.booking')->with(['product'=>$calendar,'product_id'=>$product_id]);
	}
	
	public function get_shoppingcart(Request $request)
    {
		$id = $request->input('sessionId');
		BookClass::get_shoppingcart($id,"insert");
		return redirect("/booking/checkout");
	}
	
	public function get_checkout(Request $request)
	{
		
		if(!Session::has('sessionBooking')){
			return redirect("/booking/shoppingcart/empty");
		}
		
		$sessionBooking = Session::get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('sessionBooking', $sessionBooking)
						->where('bookingStatus','CART')->first();
		
		if(!isset($rev_shoppingcarts))
		{
			return redirect("/booking/shoppingcart/empty");
		}
		
		return view('blog.frontend.shopping-cart')
				->with([
						'rev_shoppingcarts'=>$rev_shoppingcarts
					]);
	}
	
	public function createPayment(Request $request)
	{
		if(!Session::has('sessionBooking')){
			return redirect("/booking/shoppingcart/empty");
		}
		$sessionBooking = Session::get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('sessionBooking', $sessionBooking)
						->where('bookingStatus','CART')->first();
		$value = number_format((float)$rev_shoppingcarts->total, 2, '.', '');		
		
		$name = '';
		foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
		{
			$name = $shoppingcart_products->title;
		}		
		$response = PaypalClass::createOrder($value,$name);
		
		return response()->json($response);
	}
	
	public function post_checkout(Request $request)
	{
		if(!Session::has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionBooking = Session::get('sessionBooking');
		
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionBooking',$sessionBooking)->first();
		
		
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
		
		return response()->json([
						"id" => "1",
						"message" => 'sukses'
					]);
	}
	
	public function payment(Request $request)
	{
		
		$orderID = $request->input('orderID');
		$authorizationID = $request->input('authorizationID');
		
		$validator = Validator::make($request->all(), [
          	'orderID' => ['required', 'string', 'max:255'],
			'authorizationID' => ['required', 'string', 'max:255'],
       	]);
		
		
		
        if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		if(!Session::has('sessionBooking')){
			
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		
		$sessionBooking = Session::get('sessionBooking');
		
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionBooking',$sessionBooking)->first();
		
		$grand_total = $rev_shoppingcarts->total;
		
		$payment_total = PaypalClass::getOrder($orderID);
		
		
		if($payment_total!=$grand_total)
		{
			PaypalClass::voidPaypal($authorizationID);
			return response()->json([
					"id" => "2",
					"message" => 'Payment Not Valid'
				]);
		}
		
		$rev_shoppingcarts->orderID = $orderID;
		$rev_shoppingcarts->authorizationID = $authorizationID;
		$rev_shoppingcarts->confirmationCode = BookClass::get_ticket();
		$rev_shoppingcarts->bookingChannel = 'WEBSITE';
		$rev_shoppingcarts->paymentStatus = 1;
		$rev_shoppingcarts->subtotal = $grand_total;
		$rev_shoppingcarts->total = $grand_total;
		$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
		$rev_shoppingcarts->save();
		
		$email = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer;
		Mail::to($email)->send(new Booking($rev_shoppingcarts->id));
		BokunClass::get_removepromocode($rev_shoppingcarts->sessionId);
		
		Session::forget('sessionBooking');
		
		return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->id
				]);
		
	}
	
	public function receipt($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
		if(isset($rev_shoppingcarts))
		{
			return view('blog.frontend.receipt')->with(['rev_shoppingcarts'=>$rev_shoppingcarts]);
		}
	}
	
	public function applypromocode(Request $request)
	{
		if(!Session::has('sessionBooking')){
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
		$sessionBooking = Session::get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionBooking',$sessionBooking)->first();
		
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
		if(!Session::has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionBooking = Session::get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionBooking',$sessionBooking)->first();
		
		BokunClass::get_removepromocode($rev_shoppingcarts->sessionId);
		BookClass::get_shoppingcart($rev_shoppingcarts->sessionId,"update");
		
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->sessionId
				]);
	}
	
	public function get_invoice($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
		if(isset($rev_shoppingcarts))
		{
			print("Invoice Valid");
		}
		else
		{
			print("Invoice NOT Valid");
		}
	}
	
	public function get_ticket($id)
    {
		$rev_shoppingcart_products = rev_shoppingcart_products::where('id',$id)->first()->shoppingcarts()->where('bookingStatus','CONFIRMED')->first();
		if(isset($rev_shoppingcart_products))
		{
			print("Ticket Valid");
		}
		else
		{
			print("Ticket NOT Valid");
		}
	}
	
	public function get_invoicePDF($id)
	{
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->first();
		$pdf = PDF::loadView('components.vertikaltrip.invoice-pdf', compact('rev_shoppingcarts'))->setPaper('a4', 'portrait');
		return $pdf->download('Invoice-'. $rev_shoppingcarts->confirmationCode .'.pdf');
	}
	
	public function get_ticketPDF($id)
    {
		$rev_shoppingcart_products = rev_shoppingcart_products::where('id',$id)->first();
		$customPaper = array(0,0,300,540);
		$pdf = PDF::loadView('components.vertikaltrip.ticket-pdf', compact('rev_shoppingcart_products'))->setPaper($customPaper);
		return $pdf->download('Ticket-'. $rev_shoppingcart_products->productConfirmationCode .'.pdf');
	}
	
	public function selfservice($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->first();
		$canCancel = BookClass::canCancel($rev_shoppingcarts->confirmationCode);
		return view('page.view')->with(['rev_shoppingcarts'=>$rev_shoppingcarts,'canCancel'=>$canCancel]);
	}
	
}
