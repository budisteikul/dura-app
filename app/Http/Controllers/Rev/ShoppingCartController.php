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
		
		$bookingChannelUUID = '93a137f0-bb95-4ea0-b4a8-9857824a2e79';
		$rev_resellers = rev_resellers::where('status',1)->first();
		if(isset($rev_resellers)) $bookingChannelUUID = $rev_resellers->id;
		if(env("APP_ENV")=="production")
		{
			$calendar = '<div id="bokun-w111662_1caddfc1_76b8_499c_959f_fcb6d96159df">Loading...</div><script type="text/javascript">
var w111662_1caddfc1_76b8_499c_959f_fcb6d96159df;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111662?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$product_id->product_id.'&amp;lang=en&amp;ccy=USD&amp;hash=w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w111662_1caddfc1_76b8_499c_959f_fcb6d96159df = new BokunWidgetEmbedder(); w111662_1caddfc1_76b8_499c_959f_fcb6d96159df.initialize(options); w111662_1caddfc1_76b8_499c_959f_fcb6d96159df.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		else
		{
			$calendar = '<div id="bokun-w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c">Loading...</div><script type="text/javascript">
var w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c;
(function(d, t) {
  var host = \'widgets.bokuntest.com\';
  var frameUrl = \'https://\' + host + \'/widgets/2531?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$product_id->product_id.'&amp;lang=en&amp;ccy=USD&amp;hash=w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c = new BokunWidgetEmbedder(); w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c.initialize(options); w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		return view('blog.frontend.booking')->with(['product'=>$calendar]);
	}
	
	public function get_shoppingcart(Request $request)
    {
		$id = $request->input('sessionId');
		BookClass::get_shoppingcart($id);
		return redirect("/booking/checkout");
	}
	
	public function get_checkout(Request $request)
	{
		
		if(!Session::has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Shooping cart empty'
				]);
		}
		
		$sessionBooking = Session::get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('sessionBooking', $sessionBooking)
						->where('bookingStatus','CART')->first();
		
		
		
		return view('blog.frontend.shopping-cart')
				->with([
						'rev_shoppingcarts'=>$rev_shoppingcarts
					]);
	}
	
	public function createPayment(Request $request)
	{
		if(!Session::has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Shooping cart empty'
				]);
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
					$rev_shoppingcart_question_options = rev_shoppingcart_question_options::where('shoppingcart_question_id',$rev_shoppingcart_questions->id)->get();
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
		$rev_shoppingcarts->subtotal = $grand_total;
		$rev_shoppingcarts->total = $grand_total;
		$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
		$rev_shoppingcarts->save();
		
		foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
		{
			//BokunClass::get_removeshoppingcart($rev_shoppingcarts->sessionId,$shoppingcart_products->bookingId);
			//=============================================================
			$rev_books = new rev_books();
			$rev_books->post_id = BookClass::get_id($shoppingcart_products->productId);
			$shoppingcart = $shoppingcart_products->shoppingcarts()->first(); 
			$rev_books->name = $shoppingcart->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer .' '. $shoppingcart->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer;
			$email = $shoppingcart->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer;
			$rev_books->email = $email;
			$rev_books->phone = $shoppingcart->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer;;
			$rev_books->date = BookClass::texttodate($shoppingcart_products->date);
			$rev_resellers = rev_resellers::where('status',1)->first();
			$rev_books->source = $rev_resellers->id;
			
			$traveller = 0;
			foreach($shoppingcart_products->shoppingcart_rates()->get() as $shoppingcart_rates)
			{
				$traveller += $shoppingcart_rates->qty;
			}
			
			$rev_books->traveller = $traveller;
			$rev_books->status = 1;
			$rev_books->ticket = $shoppingcart->confirmationCode;
			$rev_books->date_text = $shoppingcart_products->date;
			$rev_books->save();
			//=============================================================
		}
		
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
		return view('blog.frontend.receipt')->with(['rev_shoppingcarts'=>$rev_shoppingcarts]);
    }
	
	public function get_invoice($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
		return view('components.vertikaltrip.invoice')->with(['rev_shoppingcarts'=>$rev_shoppingcarts]);
	}
	
	public function get_ticket($id)
    {
		$watermark = false;
		$rev_shoppingcart_products = rev_shoppingcart_products::where('id',$id)->first();
		if(BookClass::check_status_invoice($rev_shoppingcart_products->shoppingcarts()->first()->confirmationCode)=="Refunded")
		{
			$watermark = true;
		}
		
		return view('components.vertikaltrip.ticket')->with(['rev_shoppingcart_products'=>$rev_shoppingcart_products,'watermark'=>$watermark]);
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
			BookClass::get_shoppingcart($rev_shoppingcarts->sessionId);
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
		BookClass::get_shoppingcart($rev_shoppingcarts->sessionId);
		
			return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->sessionId
				]);
	}
	
	public function get_invoicePDF($id)
	{
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
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
	
}
