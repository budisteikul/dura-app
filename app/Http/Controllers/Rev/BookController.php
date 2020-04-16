<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_shoppingcarts;

use App\Classes\Rev\BookClass;
use App\Classes\Rev\PaypalClass;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as Http;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Mail\Rev\Booking;

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
					$product = '';
					$status = '';
					$note = '------';
					
					if($book->ticket!='') $ticket = $book->ticket .'<br>';
					if($book->name!='') $name = 'Name : '. $book->name .'<br>';
					if($book->phone!='') $phone = 'Phone : '.$book->phone .'<br>';
					if($book->email!='') $email = 'Email : '.$book->email .'<br>';
					if($book->date_text!='') $date_text = 'Date : '.$book->date_text .'<br>';
					$rev_resellers = rev_resellers::find($book->source);
					if(isset($rev_resellers)) $channel = 'Channel : '. $rev_resellers->name .'<br>';
					$post = blog_posts::find($book->post_id);
					if(isset($post)) $product = 'Product : '. $post->title .'<br>';
					if($book->status==1) $status = 'Status : Pending<br>';
					if($book->status==2) $status = 'Status : Confirmed<br>';
					if($book->status==3) $status = 'Status : Cancelled<br>';
					
					if(isset($book->ticket))
					{
					$rev_shoppingcarts = rev_shoppingcarts::where('confirmationCode',$book->ticket)->first();
					if(isset($rev_shoppingcarts))
					{
						$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
						$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->orderBy('order')->get();
						if(count($pickup_questions))
						{
							foreach($pickup_questions as $pickup_question)
							{
								$note .= '<br>'. $pickup_question->label .' : '. $pickup_question->answer;
							}
						}
						
						if(count($activityBookings))
						{
							foreach($activityBookings as $activityBooking)
							{
								$note .= '<br>'. $activityBooking->label .' : '. $activityBooking->answer;
							}
						}
						
					}
					}
					
					return  $ticket . $name . $traveller . $phone . $email . $date_text . $channel . $product . $status . $note; 
				})
				->addColumn('action', function ($book) {
					
						$button = '';
						if($book->status==1)
						{
							$check_ticket = rev_shoppingcarts::where('confirmationCode',$book->ticket)->first();
							if(isset($check_ticket))
							{
								return '<div class="btn-toolbar justify-content-end"><div class="btn-group mb-2" role="group"><button onClick="STATUS(\''.$book->id.'\',\'capture\')" id="capture-'.$book->id.'" type="button" class="btn btn-primary"><i class="far fa-money-bill-alt"></i> Capture</button><button onClick="STATUS(\''.$book->id.'\',\'void\')" id="void-'.$book->id.'" type="button" class="btn btn-secondary"><i class="far fa-money-bill-alt"></i> Void</button></div></div>';
							}
							else
							{
								return '<div class="btn-toolbar justify-content-end">
									<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
									</div>';
							}
						}
						else
						{
							return '<div class="btn-toolbar justify-content-end">
									<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
									</div>';
						}
						
						
					
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
