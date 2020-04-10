<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Classes\Rev\BookClass;

use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use App\Models\Rev\rev_shoppingcart_rates;
use App\Models\Rev\rev_shoppingcart_questions;

use App\Classes\Rev\PaypalClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Classes\Rev\BokunClass;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class BookController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
		{
			$books = rev_books::query();
			return Datatables::eloquent($books)
				->addIndexColumn()
				->editColumn('date', function ($book) {
					$dateint = str_ireplace("-","",$book->date);
					$dateint = str_ireplace(":","",$dateint);
					$dateint = str_ireplace(" ","",$dateint);
					
					$st1 = date('YmdHis');
					$st2 = $dateint;
					$date = Carbon::parse($book->date)->formatLocalized('%d %b %Y %I:%M %p');
					if($st2 >= $st1)
					{
						return '<span class="badge badge-danger">'. $date .'</span>';
					}
					else
					{
						return '<span class="badge badge-success">'. $date .'</span>';
					}
				})
				->editColumn('source', function ($book) {
					$rev_resellers = rev_resellers::find($book->source);
					if(isset($rev_resellers)) return $rev_resellers->name;
					return '';
				})
				->addColumn('product', function ($book) {
					$post = blog_posts::find($book->post_id);
					return $post->title;
				})
				->editColumn('name', function ($book) {
					
					
					
					$ticket = '';
					$name = '';
					$phone = '';
					$email = '';
					$date_text = '';
					$traveller = 'People : '. $book->traveller .'<br>';
					$channel = '';
					
					if($book->ticket!='') $ticket = $book->ticket .'<br>';
					if($book->name!='') $name = 'Name : '. $book->name .'<br>';
					if($book->phone!='') $phone = 'Phone : '.$book->phone .'<br>';
					if($book->email!='') $email = 'Email : '.$book->email .'<br>';
					if($book->date_text!='') $date_text = 'Date : '.$book->date_text .'<br>';
					$rev_resellers = rev_resellers::find($book->source);
					if(isset($rev_resellers)) $channel = 'Channel : '. $rev_resellers->name .'<br>';
					$post = blog_posts::find($book->post_id);
					if(isset($post)) $channel = 'Product : '. $post->title .'<br>';
					
					return  $ticket . $name . $traveller . $phone . $email . $date_text . $channel; 
				})
				->addColumn('action', function ($book) {
					
						if($book->status==3)
						{
							$label = ""	;
							$status = 1;
							$button = "btn-light";
							$icon = "fa-toggle-off";
							$text = " Cancelled";
							$disabled = "";
						}
						else if($book->status==2)
						{
							$label = "";
							$status = 3;
							$button = "btn-light";
							$icon = "fa-toggle-on";
							$text = " Confirmed";
							$disabled = "disabled";
						}
						else
						{
							$label = ""	;
							$status = 2;
							$button = "btn-light";
							$icon = "fa-toggle-off";
							$text = " Pending";
							$disabled = "";
						}
						return '<div class="btn-toolbar justify-content-end">
						
						<div class="btn-group mb-2" role="group"><button id="btn-update" type="button" onClick="STATUS(\''. $book->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div>
						
						<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
						
						</div>';
					
				})
				->rawColumns(['action','name','date','status'])
				->toJson();
		}
        return view('rev.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$rev_resellers = rev_resellers::orderBy('name')->get();
		$blog_post = blog_posts::where('content_type','experience')->orderBy('created_at')->get();
        return view('rev.book.create',['blog_post'=>$blog_post,'rev_resellers'=>$rev_resellers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'post_id' => ['required'],
          	'name' => ['required', 'string', 'max:255'],
			'source' => ['required'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id = $request->input('post_id');
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$date = $request->input('date');
		$source = $request->input('source');
		$traveller = $request->input('traveller');
		$status = $request->input('status');
		
		
		
		$rev_books = new rev_books();
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $source;
		$rev_books->traveller = $traveller;
		$rev_books->status = $status;
		$rev_books->date_text = BookClass::datetotext($date);
		$rev_books->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = rev_books::findOrFail($id);
		$rev_resellers = rev_resellers::orderBy('name')->get();
		$blog_post = blog_posts::where('content_type','experience')->orderBy('created_at')->get();
        return view('rev.book.edit',['book'=>$book,'blog_post'=>$blog_post,'rev_resellers'=>$rev_resellers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
        if($request->input('update')!="")
		{
			$validator = Validator::make($request->all(), [
          			'update' => 'in:1,2,3'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$rev_books = rev_books::find($id);
			$rev_books->status = $request->input('update');
			$rev_books->save();
			
			
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
		
		
		$validator = Validator::make($request->all(), [
			'post_id' => ['required'],
          	'name' => ['required', 'string', 'max:255'],
			'source' => ['required'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id = $request->input('post_id');
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$date = $request->input('date');
		$source = $request->input('source');
		$traveller = $request->input('traveller');
		$status = $request->input('status');
		
		
		
		$rev_books = rev_books::findOrFail($id);
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $source;
		$rev_books->traveller = $traveller;
		$rev_books->status = $status;
		$rev_books->date_text = BookClass::datetotext($date);
		$rev_books->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rev_books = rev_books::find($id);
		$rev_books->delete();
    }
	
	public function time_selector($id)
	{
		$render = '';
		$widget = blog_posts::with('widgets')->where('slug',$id)->first();
        if(!isset($widget)){
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
  var frameUrl = \'https://\' + host + \'/widgets/111662?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$widget->widgets->product_id.'&amp;lang=en&amp;ccy=USD&amp;hash=w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\';
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
  var frameUrl = \'https://\' + host + \'/widgets/2531?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$widget->widgets->product_id.'&amp;lang=en&amp;ccy=USD&amp;hash=w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\';
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
		
		$grandtotal = 0;
		for($i=0;$i<count($activity);$i++)
		{
			$product_invoice = $contents->customerInvoice->productInvoices;
			$lineitems = $product_invoice[$i]->lineItems;
			
			$rev_shoppingcart_products = new rev_shoppingcart_products();
			$rev_shoppingcart_products->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_products->productConfirmationCode = $activity[$i]->productConfirmationCode;
			$rev_shoppingcart_products->bookingId = $activity[$i]->id;
			$rev_shoppingcart_products->productId = $activity[$i]->activity->id;
			$rev_shoppingcart_products->image = $product_invoice[$i]->product->keyPhoto->derived[2]->url;
			$rev_shoppingcart_products->title = $activity[$i]->activity->title;
			$rev_shoppingcart_products->rate = $activity[$i]->rate->title;
			$rev_shoppingcart_products->date = $product_invoice[$i]->dates;
			$rev_shoppingcart_products->save();
			
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
						$rev_shoppingcart_rates->subtotal = $subtotal;
						$rev_shoppingcart_rates->total = $subtotal;
						
						$rev_shoppingcart_rates->save();
						$total_product += $subtotal;
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
						$rev_shoppingcart_rates->subtotal = $lineitems[$z]->total;
						$rev_shoppingcart_rates->total = $lineitems[$z]->total;
						
						$rev_shoppingcart_rates->save();
						$total_product += $lineitems[$z]->total;
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
					$rev_shoppingcart_rates->subtotal = $activity[$i]->extraBookings[$k]->extra->price;
					$rev_shoppingcart_rates->total = $activity[$i]->extraBookings[$k]->extra->price;
						
					$rev_shoppingcart_rates->save();
					$total_product += $activity[$i]->extraBookings[$k]->extra->price;
				}
			}
			
			rev_shoppingcart_products::where('id',$rev_shoppingcart_products->id)->update(['subtotal'=>$total_product,'total'=>$total_product]);
			$grandtotal += $total_product;
		}
		
		rev_shoppingcarts::where('id',$rev_shoppingcarts->id)->update(['subtotal'=>$grandtotal,'total'=>$grandtotal]);
		
		
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
					$rev_shoppingcart_questions->required = $questions[$i]->required;
					$rev_shoppingcart_questions->selectOption = $questions[$i]->selectFromOptions;
					$rev_shoppingcart_questions->selectMultiple = $questions[$i]->selectMultiple;
					$rev_shoppingcart_questions->order = $order;
					$rev_shoppingcart_questions->save();
					$order += 1;
				}
			}
		}
		
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
			$rev_books->email = $shoppingcart->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer;
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
		
		$request->session()->forget('sessionBooking');
		
		return response()->json([
					"id" => "1",
					"message" => $rev_shoppingcarts->id
				]);
		
	}
	
	public function receipt($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
		return view('page.receipt')->with(['rev_shoppingcarts'=>$rev_shoppingcarts]);
    }
	
	public function get_invoice($id)
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$id)->where('bookingStatus','CONFIRMED')->first();
		return view('page.invoice')->with(['rev_shoppingcarts'=>$rev_shoppingcarts]);
	}
	
	
	public function get_ticket($id)
    {
		$rev_shoppingcart_products = rev_shoppingcart_products::where('id',$id)->first();
		return view('page.ticket')->with(['rev_shoppingcart_products'=>$rev_shoppingcart_products]);
	}
}
