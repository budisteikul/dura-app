<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Classes\Rev\BookClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Classes\Rev\BokunClass;

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
        if(isset($widget)){
			if(isset($widget->widgets->time_selector)){
               $render = $widget->widgets->time_selector;
            }
        }
		return view('blog.frontend.booking')->with(['product'=>$render]);
	}
	

    public function checkout()
    {
        $render = '<div id="bokun-w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc">Loading...</div><script type="text/javascript">
var w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97537?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc = new BokunWidgetEmbedder(); w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc.initialize(options); w97537_681697e7_ab93_4ad2_9d95_55128ee5a8bc.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
    }

    public function receipt()
    {
        $render = '<div id="bokun-w97536_f6820178_ae16_4095_b0ec_4c203e94f898">Loading...</div><script type="text/javascript">
var w97536_f6820178_ae16_4095_b0ec_4c203e94f898;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97536?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97536_f6820178_ae16_4095_b0ec_4c203e94f898\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97536_f6820178_ae16_4095_b0ec_4c203e94f898\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97536_f6820178_ae16_4095_b0ec_4c203e94f898 = new BokunWidgetEmbedder(); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.initialize(options); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
    }
	
	
	public function get_cart(Request $request)
    {
		$id = $request->input('sessionId');
		$contents = BokunClass::get_shopping_cart($id);
		$contents = $contents->options[0]->invoice->productInvoices;
		if(empty($contents))
		{
			return redirect("/");
			exit();
		}
		$cart_start = '
		
    		<div class="card shadow">
  				<div class="card-header bg-dark text-white pt-0 pb-1">
    				<h3>Order Summary</h3>
  				</div>
  				<div class="card-body">';
				
		$cart_center = '';
		
		$cart_end = '
					<!-- hr>
                	<div class="row mb-4">
                		<div class="col-8">
                    		<span style="font-size:18px">Items</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">'. $contents[0]->totalDiscountedAsText .'</span>
                    	</div>
                	</div -->
                	<hr>    
                    <div class="row mb-4">
                		<div class="col-8">
                    		<b style="font-size:18px">Total (USD)</b>
                    	</div>
                    	<div class="col-4 text-right">
                    	<b style="font-size:18px">'. $contents[0]->totalDiscountedAsText .'</b>
                    	</div>
                	</div>
				</div>
			</div>
        ';
		
		$cart_line = '';
		for($i=0;$i<	count($contents); $i++)
		{
			
			$cart_line_start = '<div class="card">
                        		<div class="card-body">
								';
			$cart_line_center = '';
			$cart_line_end = '
							
							</div>
                   			</div>';
			$items = $contents[$i]->lineItems;
			for($j=0;$j<	count($items); $j++)
			{
				$title = $items[$j]->title;
				$quantity= $items[$j]->people;
				if($items[$j]->costItemTitle=="Price per booking") $quantity = 1;
				$unit_price = $items[$j]->unitPriceAsText;
				$discount = $items[$j]->calculatedDiscount;
				$tax = $items[$j]->taxAsText;
				$totalDiscountedAsText = $items[$j]->totalDiscountedAsText;
				
				if($j==0)
				{
					$cart_center  .= '
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>'. $contents[$i]->product->title .'</b>
                    			</div>
                    			<div class="col-4 text-right">
                    				<b>'. $totalDiscountedAsText .'</b>
                    			</div>
                			 </div>
                    
                    		 <div class="row mb-4">
                				<div class="ml-4">
                    				<img class="img-fluid" src="'.$contents[$i]->product->keyPhoto->derived[2]->url.'">
                    			</div>
                    			<div class="col-8">
                    				'.$contents[$i]->dates.'<br>
                        			'.$quantity.' x '.$items[$j]->costItemTitle.' ('.$unit_price.')
                    			</div>
                			</div>
							';
				}
				else
				{
					$cart_line_center  .= '
							<div class="row mb-4">
                				<div class="col-8">
                    					'.$items[$j]->costItemTitle.'<br>
                                per booking
                    			</div>
                    			<div class="col-4 text-right">
                    				<b>'.$totalDiscountedAsText.'</b>
                    			</div>
                			</div>
							';
				}
				
				
			}
			
			if($cart_line_center!='') $cart_line = $cart_line_start.$cart_line_center.$cart_line_end;
			$cart_center = $cart_center.$cart_line;
		}
		
		
		/*
		$contents = BokunClass::get_shopping_cart($id);
		$contents = $contents->options[0]->invoice->productInvoices;
		
		$web_invoice_center = '';
		$mobile_invoice_center = '';	
		for($i=0;$i<	count($contents); $i++)
		{
			$items = $contents[$i]->lineItems;
			$web_line_items = '';
			$mobile_line_items = '';
			for($j=0;$j<	count($items); $j++)
			{
				$title = $items[$j]->title;
				$quantity= $items[$j]->people;
				if($quantity==0) $quantity = $items[$j]->quantity;
				$unit_price = $items[$j]->totalAsText;
				$discount = $items[$j]->calculatedDiscount;
				$tax = $items[$j]->taxAsText;
				$totalDiscountedAsText = $items[$j]->totalDiscountedAsText;
				
				$web_line_items .= '
				<tr class="product-line-item ">
                	<td class="title">
                    	'. $title .'
                    </td>
                    <td class="quantity amount">
                    	'. $quantity .'
                    </td>
                    <td class="unit-price amount">
                    	'. $unit_price .'
                    </td>
                    <td class="discount amount">
                    	<div>
                        	<span>
                        		<span>'. $discount .'</span>
                                <span>%</span>
                            </span>
                       </div>
                    </td>
                    <td class="tax amount">
                    	<span>'. $tax .'</span>
                    </td>
                    <td class="item-total amount">'. $totalDiscountedAsText .'</td>
              </tr>
        	   ';
			   
			   $mobile_line_items .= '
			   		<div class="zebraRow" style="border:1px solid #ddd;margin-bottom:10px;">
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Title</span>
            				<span class="itemlabel">'. $title .'</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Quantity</span>
            				<span class="itemlabel">'. $quantity .'</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Unit price</span>
            				<span class="itemlabel">'. $unit_price .'</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Discount</span>
            				<span class="itemlabel">'. $discount .'%</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;flex:1;">Tax</span>
            				<span class="itemlabel">'. $tax .'</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Amount</span>
            				<span class="itemlabel">'. $totalDiscountedAsText .'</span>
            			</div>
					</div>';
			}
			
			$web_invoice_center .= '<tbody class="product-invoice">
            	<tr class="product-header">
                	<td class="title" colspan="6">
                    	<span>'. $contents[$i]->title .'</span>
                    </td>
                </tr>
				'. $web_line_items .'
				</tbody>';
				
			$mobile_invoice_center .= $mobile_line_items;
		}
		
		$web_invoice_start = '<table class="table customer-invoice">
        	<tbody class="headers">
            	<tr class="header">
                	<th></th>
                    <th class="amount">Quantity</th>
                    <th class="amount">Unit price</th>
                    <th class="amount">Discount</th>
                    <th class="amount">Tax</th>
                    <th class="amount">Amount</th>
                </tr>
            </tbody>';
		
		$mobile_invoice_start = '
		<div class="customer-invoice mobile">
            	<div>
            		<div>
            			<div style="border:1px solid #DDD;padding:10px;margin:10px 0;">
            				<span>Yogyakarta Merapi Lava Tour Admission Ticket</span>
            				<span>&nbsp; - &nbsp;</span>
            				<span>Thu 11.Jun 2020</span>
            			</div>
            		';
					
		$web_invoice_end = '<tbody></tbody>
        <tbody class="totals">
        	<tr class="first invoice-subtotal">
            	<td class="empty" colspan="4">&nbsp;</td>
                <td class="subtotal amount">
                	<span>Subtotal</span>
                    <span>:</span>
                </td>
                <td class="subtotal amount">'. $contents[0]->totalDiscountedAsText .'</td>
            </tr>
            <tr class="invoice-total">
            	<td class="empty" colspan="4">&nbsp;</td>
                <td class="total amount">
                	<span>Amount due</span>
                    <span>:</span>
                </td>
                <td class="total amount">'. $contents[0]->totalDiscountedAsText .'</td>
            </tr>
            </tbody>
            </table>';
		
		$mobile_invoice_end = '
            	</div>
            <div class="zebraRow" style="border:1px solid #ddd;margin-bottom:10px;">
            	<div style="padding:10px;">
            		<span style="font-weight:600;">Subtotal</span>
            		<span class="itemlabel">'. $contents[0]->totalDiscountedAsText .'</span>
            	</div>
            	<div style="padding:10px;">
            		<span style="font-weight:600;">Amount due</span>
            		<span class="itemlabel">'. $contents[0]->totalDiscountedAsText .'</span>
            	</div>
            </div>
            
         </div>
       </div>';
			
		$web_invoice = $web_invoice_start . $web_invoice_center . $web_invoice_end;
		$mobile_invoice = $mobile_invoice_start . $mobile_invoice_center . $mobile_invoice_end;
		
		
		$container = '<div class="customer-invoice booking-invoice invoice-container" >'. 
					  	$web_invoice .
						$mobile_invoice
					 .'</div>';	
		*/
		return view('blog.frontend.shopping-cart')->with(['cart'=>$cart_start.$cart_center.$cart_end]);
	}
	
	public function get_ticket($id)
    {
		$contents = BokunClass::get_ticket($id);
		header('Cache-Control: public'); 
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$id.'.pdf"');
		header('Content-Length: '.strlen($contents));
		echo $contents;
		
	}
}
