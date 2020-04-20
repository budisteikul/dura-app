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
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

use App\Mail\Rev\Booking;

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
		$contents = BokunClass::get_shoppingcart($id);
		$questions = BokunClass::get_questionshoppingcart($id);
		//========================================================================
		
		$lastsessionBooking = $request->session()->get('sessionBooking');
		if($request->session()->has('sessionBooking')){
			$sessionBooking = $request->session()->get('sessionBooking');
		}else{
			$sessionBooking = Uuid::uuid4()->toString();
			$request->session()->put('sessionBooking',$sessionBooking);
		}
		//========================================================================
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$id)->delete();
		
		$activity = $contents->activityBookings;
		$rev_shoppingcarts = new rev_shoppingcarts();
		$rev_shoppingcarts->sessionId = $id;
		$rev_shoppingcarts->sessionBooking = $sessionBooking;
		$rev_shoppingcarts->save();
		
		$grand_total = 0;
		$grand_subtotal = 0;
		$grand_discount = 0;
		for($i=0;$i<count($activity);$i++)
		{
			$product_invoice = $contents->customerInvoice->productInvoices;
			$lineitems = $product_invoice[$i]->lineItems;
			
			$rev_shoppingcart_products = new rev_shoppingcart_products();
			$rev_shoppingcart_products->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_products->productConfirmationCode = $activity[$i]->productConfirmationCode;
			$rev_shoppingcart_products->bookingId = $activity[$i]->id;
			$rev_shoppingcart_products->productId = $activity[$i]->activity->id;
			if(isset($product_invoice[$i]->product->keyPhoto->derived[2]->url)) $rev_shoppingcart_products->image = $product_invoice[$i]->product->keyPhoto->derived[2]->url;
			$rev_shoppingcart_products->title = $activity[$i]->activity->title;
			$rev_shoppingcart_products->rate = $activity[$i]->rate->title;
			$rev_shoppingcart_products->date = $product_invoice[$i]->dates;
			$rev_shoppingcart_products->save();
			
			$subtotal_product = 0;
			$total_discount = 0;
			$total_product = 0;
			for($z=0;$z<count($lineitems);$z++)
			{
					$itemBookingId = $lineitems[$z]->itemBookingId;
					$itemBookingId = explode("_",$itemBookingId);
					
					$type_product = '';
					$unitPrice = 'Price per booking';
					
					if($activity[$i]->extrasPrice>0)
					{
						$check_extra = false;
						for($k=0;$k<count($activity[$i]->extraBookings);$k++)
						{
							if($itemBookingId[1]==$activity[$i]->extraBookings[$k]->id)
							{
								$check_extra = true;
							}
							
						}
						if(!$check_extra)
						{
							if($itemBookingId[1]!="pickup")
							{
								$type_product = 'product';
								if($lineitems[$z]->title!="Passengers")
								{
									$unitPrice = $lineitems[$z]->title;
								}
							}
						}
					}
					else
					{
						if($itemBookingId[1]!="pickup")
						{
							$type_product = 'product';
							if($lineitems[$z]->title!="Passengers")
							{
								$unitPrice = $lineitems[$z]->title;
							}
						}
					}
					
					if($itemBookingId[1]=="pickup"){
						$type_product = "pickup";
					}
					
					
					
					if($type_product=="product")
					{
						$rev_shoppingcart_rates = new rev_shoppingcart_rates();
						$rev_shoppingcart_rates->shoppingcart_products_id = $rev_shoppingcart_products->id;
					
						$rev_shoppingcart_rates->type = $type_product;
						$rev_shoppingcart_rates->title = $activity[$i]->activity->title;
						$rev_shoppingcart_rates->qty = $lineitems[$z]->quantity;
						$rev_shoppingcart_rates->price = $lineitems[$z]->unitPrice;
						$rev_shoppingcart_rates->unitPrice = $unitPrice;
						
						$subtotal = $lineitems[$z]->unitPrice * $rev_shoppingcart_rates->qty;
						$discount = $subtotal - $lineitems[$z]->discountedUnitPrice;
						$total = $subtotal - $discount;
						
						$rev_shoppingcart_rates->discount = $discount;
						$rev_shoppingcart_rates->subtotal = $subtotal;
						$rev_shoppingcart_rates->total = $total;
						
						$rev_shoppingcart_rates->save();
						
						$subtotal_product += $subtotal;
						$total_discount += $discount;
						$total_product += $total;
					}
					
					if($type_product=="pickup")
					{
						$rev_shoppingcart_rates = new rev_shoppingcart_rates();
						$rev_shoppingcart_rates->shoppingcart_products_id = $rev_shoppingcart_products->id;
						
						$rev_shoppingcart_rates->type = $type_product;
						$rev_shoppingcart_rates->title = 'Pick-up and drop-off services';
						$rev_shoppingcart_rates->qty = 1;
						$rev_shoppingcart_rates->price = $lineitems[$z]->total;
						$rev_shoppingcart_rates->unitPrice = $unitPrice;
						
						$subtotal = $lineitems[$z]->total;
						$discount = $subtotal - $lineitems[$z]->discountedUnitPrice;
						$total = $subtotal - $discount;
						
						$rev_shoppingcart_rates->discount = $discount;
						$rev_shoppingcart_rates->subtotal = $subtotal;
						$rev_shoppingcart_rates->total = $total;
						
						$rev_shoppingcart_rates->save();
						
						$subtotal_product += $subtotal;
						$total_discount += $discount;
						$total_product += $total;
					}	
			}
			
			if($activity[$i]->extrasPrice>0)
			{
				for($k=0;$k<count($activity[$i]->extraBookings);$k++)
				{	
					$rev_shoppingcart_rates = new rev_shoppingcart_rates();
					$rev_shoppingcart_rates->shoppingcart_products_id = $rev_shoppingcart_products->id;
						
					$rev_shoppingcart_rates->type = 'extra';
					$rev_shoppingcart_rates->title = $activity[$i]->extraBookings[$k]->extra->title;
					$rev_shoppingcart_rates->qty = 1;
					$rev_shoppingcart_rates->price = $activity[$i]->extraBookings[$k]->extra->price;
					$rev_shoppingcart_rates->unitPrice = $unitPrice;
					
					$subtotal = $activity[$i]->extraBookings[$k]->extra->price;
					$discount = $subtotal - $activity[$i]->extraBookings[$k]->extra->discountedUnitPrice;
					$total = $subtotal - $discount;
					
					$rev_shoppingcart_rates->discount = $discount;
					$rev_shoppingcart_rates->subtotal = $subtotal;
					$rev_shoppingcart_rates->total = $total;
						
					$rev_shoppingcart_rates->save();
					
					$subtotal_product += $subtotal;
					$total_discount += $discount;
					$total_product += $total;
				}
			}
			
			
			
			rev_shoppingcart_products::where('id',$rev_shoppingcart_products->id)->update([
				'subtotal'=>$subtotal_product,
				'discount'=>$total_discount,
				'total'=>$total_product
				]);
				
			$grand_discount += $total_discount;
			$grand_subtotal += $subtotal_product;
			$grand_total += $total_product;
		}
		
		rev_shoppingcarts::where('id',$rev_shoppingcarts->id)->update([
				'subtotal'=>$grand_subtotal,
				'discount'=>$grand_discount,
				'total'=>$grand_total
			]);
		
		
		$mainContactDetails = $questions->mainContactDetails;
		$order = 1;
		foreach($mainContactDetails as $mainContactDetail)
		{
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = $mainContactDetail->questionId;
			$rev_shoppingcart_questions->label = $mainContactDetail->label;
			$rev_shoppingcart_questions->dataType = $mainContactDetail->dataType;
			if(isset($mainContactDetail->dataFormat)) $rev_shoppingcart_questions->dataFormat = $mainContactDetail->dataFormat;
			$rev_shoppingcart_questions->required = $mainContactDetail->required;
			$rev_shoppingcart_questions->selectOption = $mainContactDetail->selectFromOptions;
			$rev_shoppingcart_questions->selectMultiple = $mainContactDetail->selectMultiple;
			$rev_shoppingcart_questions->order = $order;
			$rev_shoppingcart_questions->save();
			$order += 1;
			
			if($mainContactDetail->selectFromOptions=="true")
			{
				$order_option = 1;
				foreach($mainContactDetail->answerOptions as $answerOption)
				{
					$rev_shoppingcart_question_options = new rev_shoppingcart_question_options();
					$rev_shoppingcart_question_options->shoppingcart_question_id = $rev_shoppingcart_questions->id;
					$rev_shoppingcart_question_options->label = $answerOption->label;
					$rev_shoppingcart_question_options->value = $answerOption->value;
					$rev_shoppingcart_question_options->order = $order_option;
					$rev_shoppingcart_question_options->save();
					$order_option += 1;
				}
			}
		}
		
		$activityBookings = $questions->activityBookings;
		foreach($activityBookings as $activityBooking)
		{
			
			if(isset($activityBooking->pickupQuestions))
			{
				$order = 1;
				for($i=0;$i<count($activityBooking->pickupQuestions);$i++)
				{
					$rev_shoppingcart_questions = new rev_shoppingcart_questions();
					$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
					$rev_shoppingcart_questions->type = 'pickupQuestions';
					$rev_shoppingcart_questions->questionId = $activityBooking->pickupQuestions[$i]->questionId;
					$rev_shoppingcart_questions->label = $activityBooking->pickupQuestions[$i]->label;
					$rev_shoppingcart_questions->dataType = $activityBooking->pickupQuestions[$i]->dataType;
					$rev_shoppingcart_questions->required = $activityBooking->pickupQuestions[$i]->required;
					$rev_shoppingcart_questions->selectOption = $activityBooking->pickupQuestions[$i]->selectFromOptions;
					$rev_shoppingcart_questions->selectMultiple = $activityBooking->pickupQuestions[$i]->selectMultiple;
					$rev_shoppingcart_questions->order = $order;
					$rev_shoppingcart_questions->save();
					$order += 1;
				}
			}
			
			if(isset($activityBooking->questions))
			{
				$questions = $activityBooking->questions;
				$order = 1;
				for($i=0;$i<count($questions);$i++)
				{
					$rev_shoppingcart_questions = new rev_shoppingcart_questions();
					$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
					$rev_shoppingcart_questions->type = 'activityBookings';
					$rev_shoppingcart_questions->bookingId = $activityBooking->bookingId;
					$rev_shoppingcart_questions->questionId = $questions[$i]->questionId;
					$rev_shoppingcart_questions->label = $questions[$i]->label;
					$rev_shoppingcart_questions->dataType = $questions[$i]->dataType;
					if(isset($questions[$i]->dataFormat)) $rev_shoppingcart_questions->dataFormat = $questions[$i]->dataFormat;
					if(isset($questions[$i]->help)) $rev_shoppingcart_questions->help = $questions[$i]->help;
					$rev_shoppingcart_questions->required = $questions[$i]->required;
					$rev_shoppingcart_questions->selectOption = $questions[$i]->selectFromOptions;
					$rev_shoppingcart_questions->selectMultiple = $questions[$i]->selectMultiple;
					$rev_shoppingcart_questions->order = $order;
					$rev_shoppingcart_questions->save();
					$order += 1;
					
					if($questions[$i]->selectFromOptions=="true")
					{
						$order_option = 1;
						foreach($questions[$i]->answerOptions as $answerOption)
						{
							$rev_shoppingcart_question_options = new rev_shoppingcart_question_options();
							$rev_shoppingcart_question_options->shoppingcart_question_id = $rev_shoppingcart_questions->id;
							$rev_shoppingcart_question_options->label = $answerOption->label;
							$rev_shoppingcart_question_options->value = $answerOption->value;
							$rev_shoppingcart_question_options->order = $order_option;
							$rev_shoppingcart_question_options->save();
							$order_option += 1;
						}
					}
			
				}
			}
		}
		
		//exit();
		return redirect("/booking/checkout");
	}
	
	public function get_checkout(Request $request)
	{
		
		if(!$request->session()->has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Shooping cart empty'
				]);
		}
		
		$sessionBooking = $request->session()->get('sessionBooking');
		$rev_shoppingcarts = rev_shoppingcarts::where('sessionBooking', $sessionBooking)
						->where('bookingStatus','CART')->first();
		
		
		
		return view('blog.frontend.shopping-cart')
				->with([
						'rev_shoppingcarts'=>$rev_shoppingcarts
					]);
	}
	
	public function createPayment(Request $request)
	{
		if(!$request->session()->has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Shooping cart empty'
				]);
		}
		$sessionBooking = $request->session()->get('sessionBooking');
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
		if(!$request->session()->has('sessionBooking')){
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		$sessionBooking = $request->session()->get('sessionBooking');
		
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
		
		if(!$request->session()->has('sessionBooking')){
			
			return response()->json([
					"id" => "2",
					"message" => 'Variable Not Valid'
				]);
		}
		
		
		$sessionBooking = $request->session()->get('sessionBooking');
		
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
		
		$request->session()->forget('sessionBooking');
		
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
		$watermark = '';
		$rev_shoppingcart_products = rev_shoppingcart_products::where('id',$id)->first();
		if(BookClass::check_status_invoice($rev_shoppingcart_products->shoppingcarts()->first()->confirmationCode)=="Refunded")
		{
			$watermark = '.aa-theme:after {
  							content: "";
  							display: block;
  							width: 100%;
  							height: 100%;
  							position: absolute;
  							top: 0;
  							left: 50;
  							background-image: url("/assets/logo/cancelled.png");
  							background-position: 10px 80px;
  							background-repeat: no-repeat;
  							opacity: 0.9;
							}';
		}
		
		return view('components.vertikaltrip.ticket')->with(['rev_shoppingcart_products'=>$rev_shoppingcart_products,'watermark'=>$watermark]);
	}
	
}
