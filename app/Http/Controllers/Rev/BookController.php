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
        $render = '<div id="bokun-w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749">Loading...</div><script type="text/javascript">
var w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111567?bookingChannelUUID=27a58f40-93e3-4305-b54e-6679758958de&amp;lang=en&amp;ccy=USD&amp;hash=w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749 = new BokunWidgetEmbedder(); w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749.initialize(options); w111567_7a61b9f2_cca5_4f8c_8ab7_710c513d0749.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
    }

    public function receipt()
    {
        $render = '<div id="bokun-w111566_68390d54_69bf_4779_be93_1e6b54677f5c">Loading...</div><script type="text/javascript">
var w111566_68390d54_69bf_4779_be93_1e6b54677f5c;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111566?bookingChannelUUID=27a58f40-93e3-4305-b54e-6679758958de&amp;lang=en&amp;ccy=USD&amp;hash=w111566_68390d54_69bf_4779_be93_1e6b54677f5c\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w111566_68390d54_69bf_4779_be93_1e6b54677f5c\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w111566_68390d54_69bf_4779_be93_1e6b54677f5c = new BokunWidgetEmbedder(); w111566_68390d54_69bf_4779_be93_1e6b54677f5c.initialize(options); w111566_68390d54_69bf_4779_be93_1e6b54677f5c.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
    }
	
}
