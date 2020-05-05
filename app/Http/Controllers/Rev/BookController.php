<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\Rev\BooksDataTable;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use App\Models\Rev\rev_shoppingcart_rates;
use App\Models\Rev\rev_shoppingcart_questions;
use App\Models\Rev\rev_shoppingcart_question_options;

use App\Classes\Rev\BookClass;
use App\Classes\Rev\PaypalClass;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

use Illuminate\Support\Facades\Auth;

use App\Mail\Rev\Booking;

class BookController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BooksDataTable $dataTable)
    {
        return $dataTable->render('rev.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/*
		$rev_shoppingcart_products = rev_shoppingcart_products::get();
		foreach($rev_shoppingcart_products as $shoppingcart_products)
		{
			$shoppingcart_products = rev_shoppingcart_products::find($shoppingcart_products->id);
			$shoppingcart_products->date = BookClass::texttodate($shoppingcart_products->dateAsText);
			$shoppingcart_products->save();
		}
		*/
		/*
		$rev_books = rev_books::get();
		
		foreach($rev_books as $book)
		{
			$rev_shoppingcarts = new rev_shoppingcarts();
			$bookingStatus = 'CONFIRMED';
			if($book->status==1) $bookingStatus = 'PENDING';
			if($book->status==2) $bookingStatus = 'CONFIRMED';
			if($book->status==3) $bookingStatus = 'CANCELLED';
			$rev_shoppingcarts->bookingStatus = $bookingStatus;
			$ticket = $book->ticket;
			if($ticket=="") $ticket = BookClass::get_ticket();
			$rev_shoppingcarts->confirmationCode = $ticket;
			$rev_shoppingcarts->paymentStatus = 0;
			$bookingChannel = '';
			$rev_resellers = rev_resellers::find($book->source);
			if(isset($rev_resellers)) $bookingChannel = $rev_resellers->name;
			$rev_shoppingcarts->bookingChannel = $bookingChannel;
			$rev_shoppingcarts->sessionBooking = Uuid::uuid4()->toString();
			$rev_shoppingcarts->sessionId = Uuid::uuid4()->toString();
			$rev_shoppingcarts->currency = 'USD';
			$rev_shoppingcarts->discount = 0;
			$rev_shoppingcarts->subtotal = 0;
			$rev_shoppingcarts->total = 0;
			$rev_shoppingcarts->save();	
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'firstName';
			$rev_shoppingcart_questions->order = 1;
			$rev_shoppingcart_questions->answer = $book->name;
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'lastName';
			$rev_shoppingcart_questions->order = 2;
			$rev_shoppingcart_questions->answer = '';
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'email';
			$rev_shoppingcart_questions->order = 3;
			$rev_shoppingcart_questions->answer = $book->email;
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_questions = new rev_shoppingcart_questions();
			$rev_shoppingcart_questions->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_questions->type = 'mainContactDetails';
			$rev_shoppingcart_questions->questionId = 'phoneNumber';
			$rev_shoppingcart_questions->order = 4;
			$rev_shoppingcart_questions->answer = $book->phone;
			$rev_shoppingcart_questions->save();
			
			$rev_shoppingcart_products = new rev_shoppingcart_products();
			$rev_shoppingcart_products->shoppingcarts_id = $rev_shoppingcarts->id;
			$rev_shoppingcart_products->productConfirmationCode = $ticket;
			
			$blog_posts = blog_posts::find($book->post_id);
			$rev_shoppingcart_products->productId = $blog_posts->product_id;
			$rev_shoppingcart_products->title = $blog_posts->title;
			$rev_shoppingcart_products->rate = '';
			$rev_shoppingcart_products->date = BookClass::datetotext($book->date);
			$rev_shoppingcart_products->currency = 'USD';
			$rev_shoppingcart_products->discount = 0;
			$rev_shoppingcart_products->subtotal = 0;
			$rev_shoppingcart_products->total = 0;
			$rev_shoppingcart_products->save();
			
			$rev_shoppingcart_rates = new rev_shoppingcart_rates();
			$rev_shoppingcart_rates->shoppingcart_products_id = $rev_shoppingcart_products->id;
			$rev_shoppingcart_rates->type = 'product';
			$rev_shoppingcart_rates->title = $blog_posts->title;
			$rev_shoppingcart_rates->qty = $book->traveller;
			$rev_shoppingcart_rates->price = 0;
			$rev_shoppingcart_rates->unitPrice = 'Person';
			$rev_shoppingcart_rates->currency = 'USD';
			$rev_shoppingcart_rates->discount = 0;
			$rev_shoppingcart_rates->subtotal = 0;
			$rev_shoppingcart_rates->total = 0;
			$rev_shoppingcart_rates->save();
			
		}
		*/
		//$rev_resellers = rev_resellers::orderBy('name')->get();
		//$blog_post = blog_posts::where('content_type','experience')->orderBy('created_at')->get();
        //return view('rev.book.create',['blog_post'=>$blog_post,'rev_resellers'=>$rev_resellers]);
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
          			'update' => 'in:capture,void'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$rev_books = rev_books::find($id);
			$update = $request->input('update');
			if($update=="capture")
			{
				$rev_shoppingcarts = rev_shoppingcarts::where('confirmationCode',$rev_books->ticket)->first();
				PaypalClass::captureAuth($rev_shoppingcarts->authorizationID);
				$rev_books->status = 2;
				$rev_books->save();
			}
			if($update=="void")
			{
				$rev_shoppingcarts = rev_shoppingcarts::where('confirmationCode',$rev_books->ticket)->first();
				PaypalClass::voidPaypal($rev_shoppingcarts->authorizationID);
				$rev_shoppingcarts->bookingStatus = 'CANCELLED';
				$rev_shoppingcarts->save();
				$rev_books->status = 3;
				$rev_books->save();
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
	
	
}
