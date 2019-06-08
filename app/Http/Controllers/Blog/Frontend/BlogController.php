<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Blog\Frontend\BookingTour;
use Illuminate\Support\Facades\Request as Http;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.frontend.blog');
    }
	
	public function book()
	{
		$app_name = "Vertikal Trip";
		$act_name = "Yogyakarta Night Walking and Food Tours";
		$logo_name = "/assets/foodtour/logo.jpg";
		
		$option_button = '
	<option value="1 person">1 person $37,00 USD</option>
	<option value="2 persons">2 persons $74,00 USD</option>
	<option value="3 persons">3 persons $111,00 USD</option>
	<option value="4 persons">4 persons $148,00 USD</option>
	<option value="5 persons">5 persons $185,00 USD</option>
	<option value="6 persons">6 persons $222,00 USD</option>
	<option value="7 persons">7 persons $259,00 USD</option>
	<option value="8 persons">8 persons $296,00 USD</option>';
		
		$hosted_button_id = 'JM5KAR8MDQEBA';
		$google_analytics = 'UA-141588873-1';
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="www.vertikaltrip.com") $google_analytics = 'UA-141588873-1';
		if($domain=="www.jogjafoodtour.com") $google_analytics = 'UA-141588873-2';
		
		return view('blog.frontend.booking')
		->with('app_name',$app_name)
		->with('act_name',$act_name)
		->with('logo_name',$logo_name)
		->with('option_button',$option_button)
		->with('hosted_button_id',$hosted_button_id)
		->with('google_analytics',$google_analytics);
	}
	
	public function success()
	{
		$app_name = "Vertikal Trip";
		$act_name = "Yogyakarta Night Walking and Food Tours";
		$logo_name = "/assets/foodtour/logo.jpg";
		
		$google_analytics = 'UA-141588873-1';
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="www.vertikaltrip.com") $google_analytics = 'UA-141588873-1';
		if($domain=="www.jogjafoodtour.com") $google_analytics = 'UA-141588873-2';
		
		return view('blog.frontend.success')
		->with('app_name',$app_name)
		->with('act_name',$act_name)
		->with('logo_name',$logo_name)
		->with('google_analytics',$google_analytics);
	}
	
	public function foodtour()
    {
		
		$app_name = "Vertikal Trip";
		$act_name = "Yogyakarta Night Walking and Food Tours";
		$logo_name = "/assets/foodtour/logo.jpg";
		
		$price = '<div class="style-4">
  <del>
    <span class="amount">48 USD</span>
  </del>
  <ins>
    <span class="amount">37 USD</span>
  </ins>
  / person
</div>
<small class="form-text text-danger"><b>Try it first, get 23% off for a limited time</b></small>';
		
		$option_button = '
	<option value="1 person">1 person $&#x336;4&#x336;8&#x336;,0&#x336;0&#x336; $37,00 USD</option>
	<option value="2 persons">2 persons $&#x336;9&#x336;6&#x336;,0&#x336;0&#x336; $74,00 USD</option>
	<option value="3 persons">3 persons $&#x336;1&#x336;4&#x336;4&#x336;,0&#x336;0&#x336; $111,00 USD</option>
	<option value="4 persons">4 persons $&#x336;1&#x336;9&#x336;2&#x336;,0&#x336;0&#x336; $148,00 USD</option>
	<option value="5 persons">5 persons $&#x336;2&#x336;4&#x336;0&#x336;,0&#x336;0&#x336; $185,00 USD</option>
	<option value="6 persons">6 persons $&#x336;2&#x336;8&#x336;8&#x336;,0&#x336;0&#x336; $222,00 USD</option>
	<option value="7 persons">7 persons $&#x336;3&#x336;3&#x336;6&#x336;,0&#x336;0&#x336; $259,00 USD</option>
	<option value="8 persons">8 persons $&#x336;3&#x336;8&#x336;4&#x336;,0&#x336;0&#x336; $296,00 USD</option>';
	
		$hosted_button_id = 'JM5KAR8MDQEBA';
		
		$google_analytics = 'UA-141588873-1';
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="www.vertikaltrip.com") $google_analytics = 'UA-141588873-1';
		if($domain=="www.jogjafoodtour.com") $google_analytics = 'UA-141588873-2';
		
        return view('blog.frontend.foodtour')
		->with('app_name',$app_name)
		->with('act_name',$act_name)
		->with('logo_name',$logo_name)
		->with('option_button',$option_button)
		->with('hosted_button_id',$hosted_button_id)
		->with('price',$price)
		->with('google_analytics',$google_analytics);
    }
	
	
	public function ipn(Request $request)
    {
		$uuid =  $request->input('custom');
		DB::table('orders')->where('id',$uuid)->update([
			'status' => '2'
			]);
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
		
		$domain = preg_replace('#^https?://#', '', Http::root());
		$phone = "+". $country ." ". $phone;
		
		
		DB::table('orders')->insert([
			'id' => $uuid,
			'product' => $product,
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'amount' => $os0,
			'date' => $date,
			'referer' => $domain
			]);
		
		Mail::to('guide@vertikaltrip.com')->send(new BookingTour($product,$name,$email,$phone,$date,$os0));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
