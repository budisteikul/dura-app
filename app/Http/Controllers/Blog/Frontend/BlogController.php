<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_reviews;
use Illuminate\Support\Facades\Request as Http;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
			<option value="1 person">1 person $38,40 USD</option>
	<option value="2 persons">2 persons $76,80 USD</option>
	<option value="3 persons">3 persons $115,20 USD</option>
	<option value="4 persons">4 persons $153,60 USD</option>
	<option value="5 persons">5 persons $192,00 USD</option>
	<option value="6 persons">6 persons $230,40 USD</option>
	<option value="7 persons">7 persons $268,80 USD</option>
	<option value="8 persons">8 persons $307,20 USD</option>';
			
			$this->hosted_button_id = '2BE57XRPLVX2N';
			
			$this->price = '
			<span class="badge badge-success">Special Offer</span>
				<div class="style-4">
  					<del>
    					<span class="amount">$48 USD</span>
  					</del>
  				<ins>
    				<span class="amount">$38.40 USD</span>
  				</ins>
				  / person
				</div>
			<small class="form-text text-success"><b>Book by August 31 to save 20% off our previously offered price!</b></small>';
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
			<small class="form-text text-success"><b>Book by August 31 to save 20% off our previously offered price!</b></small>';
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
	
	public function tour($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post]);
    }
	
	public function bokun()
    {
        return view('blog.frontend.bokun');
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.frontend.eventbrite')
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
	
	public function eventbrite()
    {
        return view('blog.frontend.eventbrite')
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
	
	public function paypal()
    {
        return view('blog.frontend.paypal')
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
	
	
	public function success()
	{
		
		return view('blog.frontend.success')
		->with('app_name',$this->app_name)
		->with('act_name',$this->act_name)
		->with('google_analytics',$this->google_analytics);
	}
	
	public function foodtour(Request $request)
    {
		if($request->ajax())
		{
			$resources = rev_reviews::query();
			return Datatables::eloquent($resources)
				->addColumn('style', function ($resource) {
					
					$rating = $resource->rating;
					switch($rating)
					{
						case '1':
							$star ='<i class="fa fa-star"></i>';	
						break;
						case '2':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '3':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '4':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						case '5':
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
						break;
						default:
							$star ='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';	
					}
					
					
					$source = $resource->source;
					switch($source)
					{
						case 'www.airbnb.com':
							$link = 'https://www.airbnb.com/experiences/434368';
						break;
						case 'www.tripadvisor.com':
							$link = 'https://www.tripadvisor.com/AttractionProductDetail-g294230-d15646790.html';
						break;
						case 'www.viator.com':
							$link = 'https://www.viator.com/tours/Yogyakarta/Food-Journey-in-Yogyakarta-at-Night/d22560-110844P2';
						break;
						default:
							$link ='#';	
					}
					
					$title = "";
					if(isset($resource->title))
					{
						$title = '<b>'.$resource->title.'</b><br>';
					}
					
					$date = Carbon::parse($resource->date)->formatLocalized('%b, %Y');
					
					//$user = '<a href="'.$link.'" target="_blank" rel="noreferrer" class="text-danger"><b>'. $resource->user .'</b></a> <small><span class="text-muted">'.$date.'</span></small><br>';
					$user = '<b class="text-danger">'. $resource->user .'</b> <small><span class="text-muted">'.$date.'</span></small><br>';
					$rating = '<span class="text-warning">'. $star .'</span>‎<br>';
					$text = nl2br($resource->text) .'<br>';
					//$from = '<small><strong>From</strong> : <a href="'. $link .'" class="text-danger" target="_blank" rel="noreferrer">'.$link.'</a></small>';
					$from = '';
					$output = $user.$rating.$title.$text.$from;
					return '<div style="margin-bottom:20px;" >'. $output .'</div>';
				})
				->rawColumns(['style'])
				->toJson();
		}
		
		$count = rev_reviews::count();
		
        return view('blog.frontend.foodtour')
		->with('count',$count)
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
