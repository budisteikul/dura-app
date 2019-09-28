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
use App\Mail\Rev\BookingTour;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
	
	
	
	public function ticket($id)
	{
		if($id=="")
		{
			return redirect("/");	
		}
		
		$id = strtoupper($id);
		//$id = str_ireplace("BR-","",$id);
		
		$rev_books = rev_books::where('ticket',$id)->first();
		if(isset($rev_books))
		{
			$blog_posts = blog_posts::find($rev_books->post_id);
			return view('rev.ticket.view',['rev_books'=>$rev_books,'blog_posts'=>$blog_posts]);
		}
		else
		{
			return view('rev.ticket.index');
		}
	}
	
	public function book(Request $request)
    {
		
		
        $name =  $request->input('name');
		$email =  $request->input('email');
		$os0 =  $request->input('os0');
		$country =  $request->input('country');
		$phone =  $request->input('phone');
		$date =  $request->input('date');
		$post_id =  $request->input('post_id');
		
		
		$domain = preg_replace('#^https?://#', '', Http::root());
		$phone = "+". $country ." ". $phone;
		
		$from = explode(" ",$os0);
		$date1 = Carbon::parse($date)->formatLocalized('%d %b %Y %I:%M %p');
		
		$ticket = BookClass::ticket();
		
		$rev_books = new rev_books();
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $domain;
		$rev_books->traveller = $from[0];
		$rev_books->status = 1;
		$rev_books->ticket = $ticket;
		$rev_books->save();
		
		Mail::to('guide@vertikaltrip.com')->send(new BookingTour($rev_books->id));	
		
		return response()->json([
					"id" => "1",
					"message" => $ticket
				]);
    }
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
					return $rev_resellers->name;
				})
				->addColumn('product', function ($book) {
					$post = blog_posts::find($book->post_id);
					return $post->title;
				})
				->editColumn('name', function ($book) {
					return '['.$book->ticket .'] '. $book->name .'<br>Phone : '. $book->phone .'<br>Email : '. $book->email; 
				})
				->addColumn('action', function ($book) {
					
						if($book->status==1)
						{
							$label = ""	;
							$status = 2;
							$button = "btn-primary";
							$icon = "fa-toggle-off";
							$text = " Pending";
							$disabled = "";
						}
						else
						{
							$label = "";
							$status = 1;
							$button = "btn-primary";
							$icon = "fa-toggle-on";
							$text = " Confirmed";
							$disabled = "disabled";
						}
						return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div></div>';
					
				})
				->rawColumns(['action','name','date','ticket'])
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
		$blog_post = blog_posts::where('content_type','standard')->where('user_id', Auth::user()->id)->orderBy('created_at')->get();
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
		$ticket = $request->input('ticket');
		$status = $request->input('status');
		
		if($ticket=="") $ticket = BookClass::ticket();
		
		$rev_books = new rev_books();
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $source;
		$rev_books->traveller = $traveller;
		$rev_books->ticket = $ticket;
		$rev_books->status = $status;
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
		$blog_post = blog_posts::where('content_type','standard')->where('user_id', Auth::user()->id)->orderBy('created_at')->get();
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
          			'update' => 'in:1,2'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$rev_books = rev_books::find($id);
			$rev_books->status = $request->input('update');
			$rev_books->save();
			
			if($rev_books->email!="")
			{
				Mail::to($rev_books->email)->send(new BookingTour($id));
			}
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
		$ticket = $request->input('ticket');
		$status = $request->input('status');
		
		if($ticket=="") $ticket = BookClass::ticket();
		
		$rev_books = rev_books::findOrFail($id);
		$rev_books->post_id = $post_id;
		$rev_books->name = $name;
		$rev_books->email = $email;
		$rev_books->phone = $phone;
		$rev_books->date = $date;
		$rev_books->source = $source;
		$rev_books->traveller = $traveller;
		$rev_books->ticket = $ticket;
		$rev_books->status = $status;
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
}
