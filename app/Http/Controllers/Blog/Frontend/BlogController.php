<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Blog\Frontend\BookingTour;
use Illuminate\Support\Facades\Request as Http;

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
	
	public function foodtour()
    {
		$app_name = "Vertikal Trip";
		$domain = preg_replace('#^https?://#', '', Http::root());
		if($domain=="vertikaltrip.com") $app_name = "Vertikal Trip";
		if($domain=="www.vertikaltrip.com") $app_name = "Vertikal Trip";
		if($domain=="jogjafoodtour.com") $app_name = "Jogja Food Tour";
		if($domain=="www.jogjafoodtour.com") $app_name = "Jogja Food Tour";
        return view('blog.frontend.foodtour')->with('app_name',$app_name);
    }
	
	public function booking(Request $request)
    {
        $name =  $request->input('name');
		$email =  $request->input('email');
		$os0 =  $request->input('os0');
		$country =  $request->input('country');
		$phone =  $request->input('phone');
		$date =  $request->input('date');
		
		$tour = "Yogyakarta Night Activity and Food Tour";
		$phone = "+". $country ." ". $phone;
		
		Mail::to('guide@vertikaltrip.com')->send(new BookingTour($tour,$name,$email,$phone,$date,$os0));
		
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
