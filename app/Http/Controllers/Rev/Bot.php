<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Rev\BookingTour;
use Illuminate\Support\Facades\Request as Http;
use Telegram;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;
use DB;
use Carbon\Carbon;
use App\Models\Rev\rev_orders;

class Bot extends Controller
{
	public function index()
	{
		
		$act_name = "Yogyakarta Night Walking and Food Tours";
		
		$disabledDates = array('2019-06-16','2019-07-20','2019-07-21','2019-07-22','2019-07-23','2019-07-24','2019-10-08','2019-10-09','2019-10-10','2019-10-11');
		
		$str1 = date('YmdHis');
		$str2 = date('Ymd173000');
		if($str1>=$str2) array_push($disabledDates,date('Y-m-d'));
		
		$option_button = '
	<option value="1 person">1 person $37,00 USD</option>
	<option value="2 persons">2 persons $74,00 USD</option>
	<option value="3 persons">3 persons $111,00 USD</option>
	<option value="4 persons">4 persons $148,00 USD</option>
	<option value="5 persons">5 persons $185,00 USD</option>
	<option value="6 persons">6 persons $222,00 USD</option>
	<option value="7 persons">7 persons $259,00 USD</option>
	<option value="8 persons">8 persons $296,00 USD</option>';
		
		
		
		$telegram_chat_id = NULL;
		if(isset($_GET['telegram_chat_id'])) $telegram_chat_id = $_GET['telegram_chat_id'];
		
		if($telegram_chat_id=="") return redirect('https://t.me/VertikalTrip_Bot');
		$orders = rev_orders::where('telegram_chat_id',$telegram_chat_id)->get();
		if($orders->count()>0)
		{
			$keyboard = [
    			['View my order'],
				['Tell me about the tour!']
			];
		
			$reply_markup = Telegram::replyKeyboardMarkup([
				'keyboard' => $keyboard, 
				'resize_keyboard' => true, 
				'one_time_keyboard' => true
			]);
			
			$response = Telegram::sendMessage([
					'chat_id' => $telegram_chat_id, 
					'text' => 'You already have an order',
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
			return redirect('https://t.me/VertikalTrip_Bot');	
		}
		
		return view('rev.form-order')
		->with('telegram_chat_id',$telegram_chat_id)
		->with('act_name',$act_name)
		->with('option_button',$option_button)
		->with('disabledDates',$disabledDates);
	}
	
	public function success()
	{
		
		
		return view('rev.success');
	}
	
	public function order(Request $request)
    {
		$name =  $request->input('name');
		$email =  $request->input('email');
		$os0 =  $request->input('os0');
		$country =  $request->input('country');
		$phone =  $request->input('phone');
		$date =  $request->input('date');
		$uuid =  $request->input('uuid');
		$product =  $request->input('product');
		$telegram_chat_id =  $request->input('telegram_chat_id');
		$from =  $request->input('from');
		
		$phone = "+". $country ." ". $phone;
		$traveller = explode(" ",$os0);
		$date1 = Carbon::parse($date)->formatLocalized('%d %b %Y %I:%M %p');
		
		DB::table('rev_orders')->where('id',$uuid)->delete();
		DB::table('rev_orders')->insert([
			'id' => $uuid,
			'product' => $product,
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'traveller' => $traveller[0],
			'date' => $date,
			'from' =>$from,
			'telegram_chat_id' => $telegram_chat_id
			]);
		
			$keyboard = [
    			['View my order'],
				['Tell me about the tour!']
			];
		
			$reply_markup = Telegram::replyKeyboardMarkup([
				'keyboard' => $keyboard, 
				'resize_keyboard' => true, 
				'one_time_keyboard' => true
			]);
			
			$response = Telegram::sendMessage([
					'chat_id' => $telegram_chat_id, 
					'text' => 'Thank you for booking our tour, I will send you PayPal invoice to your email address. You can view order by select <b>View my order</b> menu',
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
		
	}
	
	
    public function Telegram(Request $request)
    {
		$command = NULL;
		$text = '';
		$update = Telegram::getWebhookUpdates();
		$callbackQuery = $update->getCallbackQuery();
    	if ( $callbackQuery !== NULL ) {
			
				$data = $callbackQuery->getData();
    			$action = explode("_",$data);
				$message_id = $callbackQuery->getMessage()->getMessageId();
    			$chat_id = $callbackQuery->getFrom()->getId();
				$callback_query_id = $callbackQuery->getId();
				
				switch($action[0])
				{
					case 'delOrder':
					$sendto = 'https://api.telegram.org/bot'. env("TELEGRAM_BOT_TOKEN") .'/answerCallbackQuery?callback_query_id='.$callback_query_id;
					file_get_contents($sendto);
					
					/*
						Telegram::answerCallbackQuery([
							'callback_query_id' => $callback_query_id,
							'text' => 'Success'
						]);
					*/
						Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => 'Okay I will remove that order.'
						]);
						rev_orders::where('telegram_chat_id', $chat_id)->where('id',$action[1])->delete();
						$command = '/view_order';
					break;	
				}
				
   				
				
				
				
    	}
		else
		{
			$chat_id = $update->getMessage()->getChat()->getId();
			$text = $update->getMessage()->getText();
		}
			
		
		
		if($text=="Please tell me about the tour!") $command = '/about';
		if($text=="Where is the tour location?") $command = '/location';
		if($text=="Any photo documentation?") $command = '/gallery';
		if($text=="How to book this tour?") $command = '/book_tour';
		
		if($text=='Who\'s my tour guide?') $command = '/tour_guide';
		if($text=="Where is the meeting point?") $command = '/meeting_point';
		
		if($text=="New order") $command = '/new_order';
		if($text=="View my order") $command = '/view_order';
		
		$orders = rev_orders::where('telegram_chat_id',$chat_id)->get();
			
			if($orders->count()>0)
			{
				$keyboard = [
    				['Please tell me about the tour!'],
    				['Where is the tour location?'],
    				['Any photo documentation?'],
         			['View my order']
				];
			}
			else
			{
				$keyboard = [
    				['Please tell me about the tour!'],
    				['Where is the tour location?'],
    				['Any photo documentation?'],
         			['How to book this tour?']
				];
				
			}
		
		
		$reply_markup = Telegram::replyKeyboardMarkup([
			'keyboard' => $keyboard, 
			'resize_keyboard' => true, 
			'one_time_keyboard' => true
		]);
		
		//===============================================================
		switch($command)
		{
			case '/tour_guide':
			
			$keyboard = [
    				['View my order'],
					['Who\'s my tour guide?'],
					['Where is the meeting point?'],
					['Tell me about the tour!'],
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
				
				$response = Telegram::sendChatAction([
					'chat_id' => $chat_id,
					'action' => 'upload_photo'
				]);
			
			$response = Telegram::sendPhoto([
				'chat_id' => $chat_id,
				'photo' => 'https://www.vertikaltrip.com/assets/foodtour/tour-guide.jpg'
			]);
			
			$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Her name is Kalika, she is a one of the Vertikal Trip team. She will accompany you during the trip as tour guide', 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
			break;
			case '/meeting_point':
			
				$keyboard = [
    				['View my order'],
					['Who\'s my tour guide?'],
					['Where is the meeting point?'],
					['Tell me about the tour!'],
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
				
				$response = Telegram::sendChatAction([
					'chat_id' => $chat_id,
					'action' => 'find_location'
				]);
				
				$response = Telegram::sendLocation([
					'chat_id' => $chat_id, 
					'latitude' => '-7.7831516', 
					'longitude' => '110.3672341'
				]);	
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Our meeting point is <b>Tugu Yogyakarta Monument</b>, Gowongan, Jetis, Yogyakarta 55233', 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
				
			break;
			case '/view_order':
			
			$orders = rev_orders::where('telegram_chat_id',$chat_id)->get();
			
			if($orders->count()>0)
			{
			
				$keyboard = [
    				['View my order'],
					['Who\'s my tour guide?'],
					['Where is the meeting point?'],
					['Tell me about the tour!'],
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
			
				Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Here is your order :'
				]);
						
				
					foreach($orders as $order)
					{
$price = 37 * $order->traveller;	
$date1 = Carbon::parse($order->date)->formatLocalized('%d %b %Y %I:%M %p');				
$status = '<i>Pending</i>';
if($order->status==2) $status = 'Confirmed';
$text = '
<b>Name :</b> '. $order->name .'
<b>Phone :</b> '. $order->phone .'
<b>Email :</b> '. $order->email .'
<b>Date :</b> '. $date1 .'
<b>Number of traveller :</b> '. $order->traveller .'
<b>Total price :</b> $'. $price .' USD
<b>Status :</b> '. $status .'
';
						
						if($order->status==1)
						{
						$inline_keyboard = [
    						'inline_keyboard' => [
        					[
								['text' => 'Cancel', 'callback_data' => 'delOrder_'. $order->id]
            					
       						]
   				 			]
						];
						$inline_keyboard = json_encode($inline_keyboard);
						
			
						$response = Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => $text, 
							'reply_markup' => $inline_keyboard,
							'parse_mode' => 'HTML'
						]);
						
						$response = Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => 'Please check your email address to pay order via <b>PayPal Invoice</b> app. Select <b>Cancel</b> to cancel your order', 
							'reply_markup' => $reply_markup,
							'disable_web_page_preview' => 'true',
							'parse_mode' => 'HTML'
						]);
						
						}
						else
						{
							$response = Telegram::sendMessage([
								'chat_id' => $chat_id, 
								'text' => $text,
								'reply_markup' => $reply_markup,
								'parse_mode' => 'HTML'
							]);
						}
					}
				
					
			}
			else
			{
			
				$keyboard = [
    				['New order'],
					['Tell me about the tour!']
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
			
				Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'You don\'t have any order. Select <b>New order</b> to make new order',
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
				
			}
			break;
			
			case '/new_order':
			
			$orders = rev_orders::where('telegram_chat_id',$chat_id)->get();
			if($orders->count()>0)
			{
				$keyboard = [
    				['View my order'],
					['Tell me about the tour!']
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
				$response = Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => 'You already have an order. Select <b>View my order</b> to view your order detail', 
							'reply_markup' => $reply_markup,
							'disable_web_page_preview' => 'true',
							'parse_mode' => 'HTML'
						]);
			}
			else
			{
			$keyboard = [
    			['Tell me about the tour!']
			];
		
			$reply_markup = Telegram::replyKeyboardMarkup([
				'keyboard' => $keyboard, 
				'resize_keyboard' => true, 
				'one_time_keyboard' => true
			]);
			
			
			$inline_keyboard = [
    			'inline_keyboard' => [
        			[
            			['text' => 'Open booking form', 'url' => 'https://www.vertikaltrip.com/bot/order?telegram_chat_id='. $chat_id]
       				]
   				 ]
			];
			$inline_keyboard = json_encode($inline_keyboard);
			
			$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Ok, to create new order please fill this booking form bellow', 
					'parse_mode' => 'HTML',
					'reply_markup' => $inline_keyboard
				]);
			
			$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'I\'m waiting for the new order :)', 
					'reply_markup' => $reply_markup,
					'disable_web_page_preview' => 'true',
					'parse_mode' => 'HTML'
				]);
			}
			break;
			
			case '/book_tour':
			
			$orders = rev_orders::where('telegram_chat_id',$chat_id)->get();
			
			if($orders->count()>0)
			{
				$keyboard = [
    				['View my order'],
					['Who\'s my tour guide?'],
					['Where is the meeting point?'],
					['Tell me about the tour!'],
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
			
				Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Here is your order :'
				]);
						
				
					foreach($orders as $order)
					{
$price = 37 * $order->traveller;	
$date1 = Carbon::parse($order->date)->formatLocalized('%d %b %Y %I:%M %p');				
$status = '<i>Pending</i>';
if($order->status==2) $status = 'Confirmed';
$text = '
<b>Name :</b> '. $order->name .'
<b>Phone :</b> '. $order->phone .'
<b>Email :</b> '. $order->email .'
<b>Date :</b> '. $date1 .'
<b>Number of traveller :</b> '. $order->traveller .'
<b>Total price :</b> $'. $price .' USD
<b>Status :</b> '. $status .'
';
						
						if($order->status==1)
						{
						$inline_keyboard = [
    						'inline_keyboard' => [
        					[
								['text' => 'Cancel', 'callback_data' => 'delOrder_'. $order->id]
            					
       						]
   				 			]
						];
						$inline_keyboard = json_encode($inline_keyboard);
						
			
						$response = Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => $text, 
							'reply_markup' => $inline_keyboard,
							'parse_mode' => 'HTML'
						]);
						
						$response = Telegram::sendMessage([
							'chat_id' => $chat_id, 
							'text' => 'Please check your email address to pay order via <b>PayPal Invoice</b> app. Select <b>Cancel</b> to cancel your order', 
							'reply_markup' => $reply_markup,
							'disable_web_page_preview' => 'true',
							'parse_mode' => 'HTML'
						]);
						
						}
						else
						{
							$response = Telegram::sendMessage([
								'chat_id' => $chat_id, 
								'text' => $text,
								'reply_markup' => $reply_markup,
								'parse_mode' => 'HTML'
							]);
						}
					}
			}
			else
			{
				$keyboard = [
    				['New order'],
					['Tell me about the tour!']
				];
		
				$reply_markup = Telegram::replyKeyboardMarkup([
					'keyboard' => $keyboard, 
					'resize_keyboard' => true, 
					'one_time_keyboard' => true
				]);
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'Okay, I will assist you to book this tour. 
Select <b>New order</b> to create order', 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
			}
			
			
			
			
			break;
			
			case '/gallery':
			
			$response = Telegram::sendChatAction([
				'chat_id' => $chat_id,
				'action' => 'upload_photo'
			]);
			
			$response = Telegram::sendPhoto([
				'chat_id' => $chat_id,
				'photo' => 'https://www.vertikaltrip.com/assets/foodtour/becak.jpg',
				'caption' => 'Travel on Becak'
			]);
			
			$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => 'You can view more photos by visiting <a href="https://instagram.com/vertikaltrip">VertikalTrip Instagram</a> account', 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);	
			
			break;
			
			case '/location':

$text3 = "
From our meeting point Tugu Yogyakarta Monument. We go to the south through part of the Yogyakarta's imaginary line ( Malioboro Road, Yogyakarta Palace, East Fortess Corner, etc), and along the journey we will enjoying the nighttime atmosphere of Yogyakarta, and discover a variety of activities and food. Until we reach at Southern City Square (Alun - Alun Kidul)
";
				
				$response = Telegram::sendChatAction([
					'chat_id' => $chat_id,
					'action' => 'find_location'
				]);
				
				$response = Telegram::sendLocation([
					'chat_id' => $chat_id, 
					'latitude' => '-7.7831516', 
					'longitude' => '110.3672341'
				]);	
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => '<b>Tugu Yogyakarta Monument</b>, Gowongan, Jetis, Yogyakarta 55233', 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text3, 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);	
			
			break;
			
			case '/about':

// =========================================================================================================
$text1 = "<b>Name :</b> Yogyakarta Night Walking and Food Tours
<b>Duration :</b> 3 hours start at 6.30 pm
<b>Meeting point :</b> Tugu Yogyakarta Monument
<b>Tour mode(s) :</b> Walking and pedicab
<b>Theme(s) :</b> Night Walking and Food Tours
<b>Type :</b> Open Trip
<b>Language :</b> English
<b>Price :</b> 37 USD
";

$text2 = "
<b>Yogyakarta Night Walking and Food Tours Through Historical Route</b>
Yogyakarta’s Imaginary Line, Is An imaginary straight line drawn from the southern beach is Parang Kusumo with Mount Merapi. Through part of the imaginary line, from Tugu Yogyakarta Monument to Southern City Square (Alun - Alun Kidul), we invite you to join an experience to try some Javanese authentic dishes (gudeg, Javanese noodle, traditional herbal drink, charcoal coffee, etc), play some traditional games at Southern City Square (masangin, paddle car, etc), travel on a becak, learn interesting fun facts about this city, interact with locals, and many more.
";

$text3 = "
From our meeting point Tugu Yogyakarta Monument. We go to the south through part of the Yogyakarta's imaginary line ( Malioboro Road, Yogyakarta Palace, East Fortess Corner, etc), and along the journey we will enjoying the nighttime atmosphere of Yogyakarta, and discover a variety of activities and food. Until we reach at Southern City Square (Alun - Alun Kidul)
";

$text4 = "
<b>Inclusions</b>
- Local Guide (English Speaking) 
- Mineral water 600 ml 
- Fee of all activities at Alun - Alun Kidul (masangin, paddle car, etc) 
- Becak (Yogyakarta traditional rickshaw) 
- Raincoat, if the weather is rainy 
- Many types of Javanese authentic snack, food and drink 
";

$text5 = "
<b>What else you should know</b>
- Please be hungry, because a lot of food in this tour.
- Wear comfortable and relax clothing.
- And don't forget to bring your camera to take some nice pictures.";
// =========================================================================================================
				
				$response = Telegram::sendChatAction([
					'chat_id' => $chat_id,
					'action' => 'typing'
				]);
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text1, 
					'parse_mode' => 'HTML'
				]);	
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text2, 
					'parse_mode' => 'HTML'
				]);	
				
				/*
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text3, 
					'parse_mode' => 'HTML'
				]);	
				*/
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text4, 
					'parse_mode' => 'HTML'
				]);	
				
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text5, 
					'reply_markup' => $reply_markup,
					'parse_mode' => 'HTML'
				]);	
			break;
			default:
				$text = 'Hello, VertikalTrip_Bot here and I will assist you today. How can I help you?';
				$response = Telegram::sendMessage([
					'chat_id' => $chat_id, 
					'text' => $text, 
					'reply_markup' => $reply_markup
				]);	
		}
		
	}
}
