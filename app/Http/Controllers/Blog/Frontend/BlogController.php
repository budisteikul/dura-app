<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use Illuminate\Support\Facades\Request as Http;

class BlogController extends Controller
{
	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
	{
		$this->post_id = '7d435e1b-3fa8-470b-aaaf-f43a4b6fe947';
		$blog_posts = blog_posts::find($this->post_id);
		
		
		$this->app_name = config('APP_NAME');
		$this->act_name = $blog_posts->title;
		
		
		$this->currency = 'USD';
		
		if($this->currency=='USD')
		{
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
			
			$this->price = '
			<span class="badge badge-success">Special Offer</span>
				<div class="style-4">
  					<del>
    					<span class="amount">$48 USD</span>
  					</del>
  				<ins>
    				<span class="amount">$37 USD</span>
  				</ins>
				  / person
				</div>
			<small class="form-text text-success"><b>Book by August 31 to save 23% off our previously offered price!</b></small>';
		}
		else
		{
			$this->option_button = '
			<option value="1 person">1 person €34,00 EUR</option>
			<option value="2 persons">2 persons €68,00 EUR</option>
			<option value="3 persons">3 persons €102,00 EUR</option>
			<option value="4 persons">4 persons €136,00 EUR</option>
			<option value="5 persons">5 persons €170,00 EUR</option>
			<option value="6 persons">6 persons €204,00 EUR</option>
			<option value="7 persons">7 persons €238,00 EUR</option>
			<option value="8 persons">8 persons €272,00 EUR</option>';
			
			$this->hosted_button_id = 'K63UB645GTUE4';
			
			$this->price = '
			<span class="badge badge-success">Special Offer</span>
				<div class="style-4">
  					<del>
    					<span class="amount">€42 EUR</span>
  					</del>
  				<ins>
    				<span class="amount">€34 EUR</span>
  				</ins>
				  / person
				</div>
			<small class="form-text text-success"><b>Book by August 31 to save 23% off our previously offered price!</b></small>';
		}
		
		
		
		$this->google_analytics = 'UA-141588873-1';
		
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="www.vertikaltrip.com") $this->google_analytics = 'UA-141588873-1';
		if($domain=="www.jogjafoodtour.com") $this->google_analytics = 'UA-141588873-2';
		
	
		$this->disabledDates = array();
		$rev_availability = rev_availability::where('post_id',$this->post_id)->get();
		foreach($rev_availability as $avalaibility)
		{
			array_push($this->disabledDates,$avalaibility->date);
		}
		$str1 = date('YmdHis');
		$str2 = date('Ymd173000');
		if($str1>=$str2) array_push($this->disabledDates,date('Y-m-d 00:00:00'));
		
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->option_button = '
			<option value="1 person">1 person €34,00 EUR</option>
			<option value="2 persons">2 persons €68,00 EUR</option>
			<option value="3 persons">3 persons €102,00 EUR</option>
			<option value="4 persons">4 persons €136,00 EUR</option>
			<option value="5 persons">5 persons €170,00 EUR</option>
			<option value="6 persons">6 persons €204,00 EUR</option>
			<option value="7 persons">7 persons €238,00 EUR</option>
			<option value="8 persons">8 persons €272,00 EUR</option>';
			
        return view('blog.frontend.booking')
		->with('disabledDates',$this->disabledDates)
		->with('option_button',$this->option_button);
    }
	
	
	public function success()
	{
		
		return view('blog.frontend.success')
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('google_analytics',$this->google_analytics);
	}
	
	public function foodtour()
    {
		
        return view('blog.frontend.foodtour')
		->with('post_id',$this->post_id)
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('option_button',$this->option_button)
		->with('hosted_button_id',$this->hosted_button_id)
		->with('price',$this->price)
		->with('currency_code',$this->currency)
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
