<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Blog\Frontend\BookingTour;
use App\Models\Rev\rev_availability;
use Illuminate\Support\Facades\Request as Http;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;

class BlogController extends Controller
{
	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
	{
		$this->app_name = "Vertikal Trip";
		$this->act_name = "Yogyakarta Night Walking and Food Tours";
		$this->logo_name = "/assets/foodtour/logo-jogja-istimewa-png-4.png";
		
		$this->option_button = '
			<option value="1 person">1 person $37,00 USD</option>
			<option value="2 persons">2 persons $74,00 USD</option>
			<option value="3 persons">3 persons $111,00 USD</option>
			<option value="4 persons">4 persons $148,00 USD</option>
			<option value="5 persons">5 persons $185,00 USD</option>
			<option value="6 persons">6 persons $222,00 USD</option>
			<option value="7 persons">7 persons $259,00 USD</option>
			<option value="8 persons">8 persons $296,00 USD</option>';
		
		$this->hosted_button_id = 'JM5KAR8MDQEBA';
		$this->google_analytics = 'UA-141588873-1';
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="www.vertikaltrip.com") $this->google_analytics = 'UA-141588873-1';
		if($domain=="www.jogjafoodtour.com") $this->google_analytics = 'UA-141588873-2';
		
		$this->price = '
			<span class="badge badge-danger">Special Offer</span>
				<div class="style-4">
  					<del>
    					<span class="amount">48 USD</span>
  					</del>
  				<ins>
    				<span class="amount">37 USD</span>
  				</ins>
				  / person
				</div>
			<small class="form-text text-danger"><b>Book by August 4 to save 23% off our previously offered price!</b></small>';
		
		$this->option_button_2 = '
			<option value="1 person">1 person $&#x336;4&#x336;8&#x336;,0&#x336;0&#x336; $37,00 USD</option>
			<option value="2 persons">2 persons $&#x336;9&#x336;6&#x336;,0&#x336;0&#x336; $74,00 USD</option>
			<option value="3 persons">3 persons $&#x336;1&#x336;4&#x336;4&#x336;,0&#x336;0&#x336; $111,00 USD</option>
			<option value="4 persons">4 persons $&#x336;1&#x336;9&#x336;2&#x336;,0&#x336;0&#x336; $148,00 USD</option>
			<option value="5 persons">5 persons $&#x336;2&#x336;4&#x336;0&#x336;,0&#x336;0&#x336; $185,00 USD</option>
			<option value="6 persons">6 persons $&#x336;2&#x336;8&#x336;8&#x336;,0&#x336;0&#x336; $222,00 USD</option>
			<option value="7 persons">7 persons $&#x336;3&#x336;3&#x336;6&#x336;,0&#x336;0&#x336; $259,00 USD</option>
			<option value="8 persons">8 persons $&#x336;3&#x336;8&#x336;4&#x336;,0&#x336;0&#x336; $296,00 USD</option>';
	
		$this->disabledDates = array();
		$rev_availability = rev_availability::get();
		foreach($rev_availability as $avalaibility)
		{
			array_push($this->disabledDates,$avalaibility->date);
		}
		$str1 = date('YmdHis');
		$str2 = date('Ymd173000');
		if($str1>=$str2) array_push($this->disabledDates,date('Y-m-d'));
		
	}
	
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
		
		return view('blog.frontend.booking')
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('logo_name',$this->logo_name)
		->with('option_button',$this->option_button_2)
		->with('hosted_button_id',$this->hosted_button_id)
		->with('google_analytics',$this->google_analytics)
		->with('disabledDates',$this->disabledDates)
		->with('price',$this->price);
	}
	
	public function success()
	{
		
		return view('blog.frontend.success')
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('logo_name',$this->logo_name)
		->with('google_analytics',$this->google_analytics);
	}
	
	public function foodtour()
    {
		
        return view('blog.frontend.foodtour')
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('logo_name',$this->logo_name)
		->with('option_button',$this->option_button_2)
		->with('hosted_button_id',$this->hosted_button_id)
		->with('price',$this->price)
		->with('google_analytics',$this->google_analytics)
		->with('disabledDates',$this->disabledDates);
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
