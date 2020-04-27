<?php
namespace App\Classes\Rev;
use Illuminate\Http\Request;

use App\Models\Rev\rev_books;
use App\Models\Blog\blog_posts;

use App\Classes\Rev\BokunClass;
use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use App\Models\Rev\rev_shoppingcart_rates;
use App\Models\Rev\rev_shoppingcart_questions;
use App\Models\Rev\rev_shoppingcart_question_options;

use Illuminate\Support\Str;
use Session;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class BookClass {
	
	public static function webhook_insert_shoppingcart($data)
	{
			$rev_shoppingcarts = new rev_shoppingcarts();
			$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
			$rev_shoppingcarts->confirmationCode = $data['confirmationCode'];
			$rev_shoppingcarts->sessionBooking = Uuid::uuid4()->toString();
			$rev_shoppingcarts->sessionId = Uuid::uuid4()->toString();
			$rev_shoppingcarts->save();
			
			// main contact questions
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'firstName';
			$rev_shoppingcart_questions->order = 1;
			$rev_shoppingcart_questions->answer = $data['customer']['firstName'];
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'lastName';
			$rev_shoppingcart_questions->order = 2;
			$rev_shoppingcart_questions->answer = $data['customer']['lastName'];
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'email';
			$rev_shoppingcart_questions->order = 3;
			$rev_shoppingcart_questions->answer = $data['customer']['email'];
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'phoneNumber';
			$rev_shoppingcart_questions->order = 4;
			$rev_shoppingcart_questions->answer = $data['customer']['phoneNumberCountryCode'] .' '. $data['customer']['phoneNumber'];
			$rev_shoppingcart_questions->save();
			
			// product
			$grand_total = 0;
			$grand_subtotal = 0;
			$grand_discount = 0;
			for($i=0;$i<count($data['activityBookings']);$i++)
			{
				$rev_shoppingcart_products = new rev_shoppingcart_products();
				$rev_shoppingcart_products->shoppingcarts_id = $rev_shoppingcarts->id;
				$rev_shoppingcart_products->bookingId = $data['activityBookings'][$i]['bookingId'];
				$rev_shoppingcart_products->productConfirmationCode = $data['activityBookings'][$i]['productConfirmationCode'];
				$rev_shoppingcart_products->productId = $data['activityBookings'][$i]['productId'];
				$rev_shoppingcart_products->image = $data['activityBookings'][$i]['invoice']['product']['keyPhoto']['derived'][2]['url'];
				$rev_shoppingcart_products->title = $data['activityBookings'][$i]['product']['title'];
				$rev_shoppingcart_products->rate = $data['activityBookings'][$i]['rateTitle'];
				$rev_shoppingcart_products->date = $data['activityBookings'][$i]['invoice']['dates'];
				$rev_shoppingcart_products->save();
				
				$lineitems = $data['activityBookings'][$i]['invoice']['lineItems'];
				$subtotal_product = 0;
				$total_discount = 0;
				$total_product = 0;
				for($j=0;$j<count($lineitems);$j++)
				{
					
					$itemBookingId = $lineitems[$j]['itemBookingId'];
					$itemBookingId = explode("_",$itemBookingId);
					
					$type_product = '';
					$unitPrice = 'Price per booking';
					
					
					if($itemBookingId[1]!="pickup")
					{
						$type_product = 'product';
						if($lineitems[$j]['title']!="Passengers")
						{
							$unitPrice = $lineitems[$j]['title'];
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
						$rev_shoppingcart_rates->title = $data['activityBookings'][$i]['product']['title'];
						$rev_shoppingcart_rates->qty = $lineitems[$j]['quantity'];
						$rev_shoppingcart_rates->price = $lineitems[$j]['unitPrice'];
						$rev_shoppingcart_rates->unitPrice = $unitPrice;
						$subtotal = $lineitems[$j]['unitPrice'] * $rev_shoppingcart_rates->qty;
						$discount = $subtotal - ($lineitems[$j]['discountedUnitPrice'] * $rev_shoppingcart_rates->qty);
						$total = $subtotal - $discount;
						$rev_shoppingcart_rates->currency = $data['currency'];
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
						$rev_shoppingcart_rates->price = $lineitems[$j]['total'];
						$rev_shoppingcart_rates->unitPrice = $unitPrice;
						$subtotal = $lineitems[$j]['total'];
						$discount = $subtotal - $lineitems[$j]['discountedUnitPrice'];
						$total = $subtotal - $discount;
						$rev_shoppingcart_rates->currency = $data['currency'];
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
				'currency'=>$data['currency'],
				'subtotal'=>$subtotal_product,
				'discount'=>$total_discount,
				'total'=>$total_product
				]);
				
				// activity question
				if(isset($data['activityBookings'][$i]['answers']))
				{
				$order = 1;
				for($k=0;$k<count($data['activityBookings'][$i]['answers']);$k++)
				{
						$rev_shoppingcart_questions = new rev_shoppingcart_questions();
						$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
						$rev_shoppingcart_questions->type = 'activityBookings';
						$rev_shoppingcart_questions->bookingId = $data['activityBookings'][$i]['bookingId'];
						$rev_shoppingcart_questions->questionId = $data['activityBookings'][$i]['answers'][$k]['id'];
						$rev_shoppingcart_questions->label = $data['activityBookings'][$i]['answers'][$k]['question'];
						$rev_shoppingcart_questions->order = $order;
						$rev_shoppingcart_questions->answer = $data['activityBookings'][$i]['answers'][$k]['answer'];
						$rev_shoppingcart_questions->save();
						$order++;
				}
				}
			}
			
			$grand_discount += $total_discount;
			$grand_subtotal += $subtotal_product;
			$grand_total += $total_product;
			
			rev_shoppingcarts::where('id',$rev_shoppingcarts->id)->update([
				'currency'=>$data['currency'],
				'subtotal'=>$grand_subtotal,
				'discount'=>$grand_discount,
				'total'=>$grand_total
			]);
			
			return $rev_shoppingcarts->id;
	}
	
	public static function get_shoppingcart($id)
	{
		$contents = BokunClass::get_shoppingcart($id);
		$questions = BokunClass::get_questionshoppingcart($id);
		
		//========================================================================
		
		$lastsessionBooking = Session::get('sessionBooking');
		if(Session::has('sessionBooking')){
			$sessionBooking = Session::get('sessionBooking');
		}else{
			$sessionBooking = Uuid::uuid4()->toString();
			Session::put('sessionBooking',$sessionBooking);
		}
		
		//========================================================================
		$rev_shoppingcarts = rev_shoppingcarts::where('bookingStatus','CART')->where('sessionId',$id)->delete();
		
		$activity = $contents->activityBookings;
		
		
		$rev_shoppingcarts = new rev_shoppingcarts();
		
		
		$rev_shoppingcarts->sessionId = $id;
		$rev_shoppingcarts->sessionBooking = $sessionBooking;
		if(isset($contents->promoCode)) $rev_shoppingcarts->promoCode = $contents->promoCode->code;
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
						$discount = $subtotal - ($lineitems[$z]->discountedUnitPrice * $rev_shoppingcart_rates->qty);
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
					
						if(isset($activity[$i]->pickupPlace->title))
						{
							$rev_shoppingcart_questions = new rev_shoppingcart_questions();
							$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
							$rev_shoppingcart_questions->type = 'pickupQuestions';
							$rev_shoppingcart_questions->questionId = 'pickupPlace';
							$rev_shoppingcart_questions->label = 'Pickup Place';
							$rev_shoppingcart_questions->dataType = 'READ_ONLY';
							$rev_shoppingcart_questions->answer = $activity[$i]->pickupPlace->title;
							$rev_shoppingcart_questions->order = 1;
							$rev_shoppingcart_questions->save();
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
					
					$rev_shoppingcart_question_options->shoppingcart_questions_id = $rev_shoppingcart_questions->id;
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
				$order = 2;
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
							
							$rev_shoppingcart_question_options->shoppingcart_questions_id = $rev_shoppingcart_questions->id;
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
	}
	
	public static function check_status_invoice($id)
	{
		$status = "-";
		$rev_books = rev_books::where('ticket',$id)->first();	
		if(isset($rev_books))
		{
			if($rev_books->status==1) $status = "Paid in full";
			if($rev_books->status==2) $status = "Paid in full";
			if($rev_books->status==3) $status = "Refunded";	
		}
		return $status;
	}
	
	public static function get_ticket(){
    	$uuid = "VER-". rand(100000,999999);
    	while( rev_shoppingcarts::where('confirmationCode','=',$uuid)->first() ){
        	$uuid = "VER-". rand(100000,999999);
    	}
    	return $uuid;
	}
	
	public static function get_id($product_id)
	{
		$slug = blog_posts::where('product_id',$product_id)->first();
		if(isset($slug))
		{
			$product_id = $slug->id;	
		}
		else
		{
			$product_id = '';
		}
		return $product_id;
	}
	
	public static function get_slug($id)
	{
		$slug = blog_posts::where('product_id',$id)->first();
		if(isset($slug))
		{
			$url = '/tour/'. $slug->slug;	
		}
		else
		{
			$url = '/tour?activityId='.$id;	
		}
		return $url;
	}
	
	public static function texttodate($str){
		$text = $str;
		$text = explode('@',$text);
		if(isset($text[1]))
		{
			$date = \DateTime::createFromFormat('D d.M Y ', $text[0]);
			$time = \DateTime::createFromFormat(' H:i', $text[1]);
			$hasil = $date->format('Y-m-d') .' '. $time->format('H:i:00');
		}
		else
		{
			$date = \DateTime::createFromFormat('D d.M Y', $text[0]);
			$hasil = $date->format('Y-m-d') .' 00:00:00';
		}
		return $hasil;
	}
	
	public static function datetotext($str){
		$date = \DateTime::createFromFormat('Y-m-d H:i:s', $str);
		return $date->format('D d.M Y @ H:i');
	}
	
	public static function lang($type,$str){
		$hasil = '';
		if($type=='categories')
		{
			$hasil = str_ireplace("_"," ",ucwords(strtolower($str)));
			
		}
		if($type=='dificulty')
		{
			$hasil = str_ireplace("_"," ",ucwords(strtolower($str)));
			
		}
		if($type=='accessibility')
		{
			$hasil = str_ireplace("_"," ",ucwords(strtolower($str)));
			
		}
		if($type=='type')
		{
			switch($str)
			{
				case 'ACTIVITIES':
					$hasil = 'Day tour/Activity';
				break;
			}
			
		}
		if($type=='language')
		{
			switch($str)
			{
				case 'ja':
					$hasil = 'Japanese';
				break;
				case 'ja':
					$hasil = 'Italian';
				break;
				case 'fr':
					$hasil = 'French';
				break;
				case 'en':
					$hasil = 'English';
				break;
			}
			
		}
		return $hasil;
	}
}
?>
