<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_carts;
use App\Models\Rev\rev_carts_detail;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Classes\Rev\BookClass;
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
		
		
		//========================================================================
		
		$lastsessionBooking = $request->session()->get('sessionBooking');
		if($request->session()->has('sessionBooking')){
			$sessionBooking = $request->session()->get('sessionBooking');
		}else{
			$sessionBooking = Uuid::uuid4()->toString();
			$request->session()->put('sessionBooking',$sessionBooking);
		}
		
		//========================================================================
		rev_carts::where('bookingStatus','CART')->where('sessionId',$id)->delete();
		$activity = $contents->activityBookings;
		
		
		//========================================================================
		for($i=0;$i<count($activity);$i++)
		{
			$product_invoice = $contents->customerInvoice->productInvoices;
			$lineitems = $product_invoice[$i]->lineItems;
			
			$rev_carts = new rev_carts();
			$rev_carts->sessionId = $id;
			$rev_carts->sessionBooking = $sessionBooking;
			$rev_carts->productConfirmationCode = $activity[$i]->productConfirmationCode;
			$rev_carts->bookingId = $activity[$i]->id;
			$rev_carts->image = $product_invoice[$i]->product->keyPhoto->derived[2]->url;
			$rev_carts->title = $activity[$i]->activity->title;
			$rev_carts->rate = $activity[$i]->rate->title;
			$rev_carts->date = $product_invoice[$i]->dates;
			$rev_carts->save();
			
			
			$grand_total = 0;
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
						$rev_carts_detail = new rev_carts_detail();
						$rev_carts_detail->cart_id = $rev_carts->id;
						
					
						$rev_carts_detail->type = $type_product;
						$rev_carts_detail->title = $activity[$i]->activity->title;
						$rev_carts_detail->qty = $lineitems[$z]->quantity;
						$rev_carts_detail->price = $lineitems[$z]->unitPrice;
						$rev_carts_detail->unitPrice = $unitPrice;
						
						$subtotal = $lineitems[$z]->unitPrice * $rev_carts_detail->qty;
						$rev_carts_detail->subtotal = $subtotal;
						$rev_carts_detail->total = $subtotal;
						
						$rev_carts_detail->save();
						$grand_total += $subtotal;
					}
					
					if($type_product=="pickup")
					{
						$rev_carts_detail = new rev_carts_detail();
						$rev_carts_detail->cart_id = $rev_carts->id;
						
						
						$rev_carts_detail->type = $type_product;
						$rev_carts_detail->title = 'Pick-up and drop-off services';
						$rev_carts_detail->qty = 1;
						$rev_carts_detail->price = $lineitems[$z]->total;
						$rev_carts_detail->unitPrice = $unitPrice;
						$rev_carts_detail->subtotal = $lineitems[$z]->total;
						$rev_carts_detail->total = $lineitems[$z]->total;
						
						$rev_carts_detail->save();
						$grand_total += $lineitems[$z]->total;
					}
					
			}
					
			if($activity[$i]->extrasPrice>0)
			{
				for($k=0;$k<count($activity[$i]->extraBookings);$k++)
				{	
					$rev_carts_detail = new rev_carts_detail();
					$rev_carts_detail->cart_id = $rev_carts->id;
						
					$rev_carts_detail->type = 'extra';
					$rev_carts_detail->title = $activity[$i]->extraBookings[$k]->extra->title;
					$rev_carts_detail->qty = 1;
					$rev_carts_detail->price = $activity[$i]->extraBookings[$k]->extra->price;
					$rev_carts_detail->unitPrice = $unitPrice;
					$rev_carts_detail->subtotal = $activity[$i]->extraBookings[$k]->extra->price;
					$rev_carts_detail->total = $activity[$i]->extraBookings[$k]->extra->price;
						
					$rev_carts_detail->save();
					$grand_total += $activity[$i]->extraBookings[$k]->extra->price;
				}
			}
			rev_carts::where('id',$rev_carts->id)->update(['subtotal'=>$grand_total,'total'=>$grand_total]);
		}
		
		
		//========================================================================
		
		
		$bookingChannelUUID = '93a137f0-bb95-4ea0-b4a8-9857824a2e79';
		$rev_resellers = rev_resellers::where('status',1)->first();
		if(isset($rev_resellers)) $bookingChannelUUID = $rev_resellers->id;
		if(env("APP_ENV")=="production")
		{
			$widget = '<div id="bokun-w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2">Loading...</div><script type="text/javascript">
var w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111929?bookingChannelUUID='.$bookingChannelUUID.'&amp;lang=en&amp;ccy=USD&amp;hash=w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2 = new BokunWidgetEmbedder(); w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2.initialize(options); w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		else
		{
			$widget = '<div id="bokun-w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0">Loading...</div><script type="text/javascript">
var w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0;
(function(d, t) {
  var host = \'widgets.bokuntest.com\';
  var frameUrl = \'https://\' + host + \'/widgets/2530?bookingChannelUUID='.$bookingChannelUUID.'&amp;lang=en&amp;ccy=USD&amp;hash=w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0 = new BokunWidgetEmbedder(); w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0.initialize(options); w2530_63d268fd_7751_45f2_aa8c_3d02e7c40bf0.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		
		$rev_carts = rev_carts::where('sessionId', $id)
						->where('sessionBooking', $sessionBooking)
						->where('bookingStatus','CART')->get();
		
		
		
		return view('blog.frontend.shopping-cart')->with(['rev_carts'=>$rev_carts,'widget'=>$widget]);
	}
	
	public function receipt(Request $request)
    {
		$bookingId = $request->input('bookingId');
		$sessionId = $request->input('sessionId');
		$bookingHash = $request->input('bookingHash');
		
		if($request->session()->has('sessionBooking')){
			$sessionBooking = $request->session()->get('sessionBooking');
			
			rev_carts::where('sessionId', $sessionId)->where('bookingStatus','CART')->where('sessionBooking',$sessionBooking)->update(['bookingStatus'=>'CONFIRMED','parrentId'=>$bookingId]);
			
			$request->session()->forget('sessionBooking');
		}
		
		//=========================================================
		$rev_carts = rev_carts::where('sessionId', $sessionId)->where('bookingStatus','CONFIRMED')->where('parrentId',$bookingId)->get();
		if(!isset($rev_carts))
		{
			//return redirect('/');
		}
		//=========================================================
		
		$customer = new \StdClass();
		foreach($rev_carts as $rev_cart)
		{
			
			$contents = BokunClass::get_productbooking($rev_cart->bookingId);
				
				
				rev_carts::where('id', $rev_cart->id)
				->update([
					'parrentId'=>$contents->parentBookingId,
					'parrentConfirmationCode'=>$contents->confirmationCode,
					
					'firstName'=>$contents->parentBooking->customer->firstName,
					'lastName'=>$contents->parentBooking->customer->lastName,
					'email'=>$contents->parentBooking->customer->email,
					'phoneNumber'=>$contents->parentBooking->customer->phoneNumberCountryCode . $contents->parentBooking->customer->phoneNumber
				]);
			
				$customer->bookingId = $contents->parentBookingId;
				$customer->sessionId = $sessionId;
				$customer->confirmationCode = $contents->confirmationCode;
				$customer->firstName = $contents->parentBooking->customer->firstName;
				$customer->lastName = $contents->parentBooking->customer->lastName;
				$customer->email = $contents->parentBooking->customer->email;
				$customer->phoneNumber = $contents->parentBooking->customer->phoneNumberCountryCode . $contents->parentBooking->customer->phoneNumber;
		}
		
		
        return view('page.receipt')->with(['rev_carts'=>$rev_carts,'customer'=>$customer]);
    }
	
	public function get_invoice($id="",$sessionId="")
    {
		$rev_carts = rev_carts::where('sessionId',$sessionId)->where('parrentId',$id)->where('bookingStatus','CONFIRMED')->get();
		if(count($rev_carts))
		{
			$contents = BokunClass::get_invoice($id);
			header('Cache-Control: public'); 
			header('Content-type: application/pdf');
			header('Content-Disposition: attachment; filename="Invoice-'.$id.'.pdf"');
			header('Content-Length: '.strlen($contents));
			echo $contents;
		}
	}
	
	public function get_ticket($id="",$sessionId="")
    {
		$rev_carts = rev_carts::where('sessionId',$sessionId)->where('productConfirmationCode',$id)->where('bookingStatus','CONFIRMED')->get();
		if(count($rev_carts))
		{
			$contents = BokunClass::get_ticket($id);
			header('Cache-Control: public'); 
			header('Content-type: application/pdf');
			header('Content-Disposition: attachment; filename="Ticket-'.$id.'.pdf"');
			header('Content-Length: '.strlen($contents));
			echo $contents;
		}
	}
}
