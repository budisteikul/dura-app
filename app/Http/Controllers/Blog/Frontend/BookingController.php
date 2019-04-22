<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $name =  $request->input('name');
		$email =  $request->input('email');
		$os0 =  $request->input('os0');
		$country =  $request->input('country');
		$phone =  $request->input('phone');
		$date =  $request->input('date');
		
		$title = "New booking from : ". $name ;
		$content = "<strong>Full name :</strong> ". $name ."<br /><strong>Email :</strong> ". $email ."<br /><strong>Phone :</strong> +". $country ." ". $phone ."<br /><strong>Date :</strong> ". $date ."<br /><strong>Number of travellers :</strong> ". $os0 ."<br />";
		
		Mail::send('layouts.mail.booking', ['content' => $content], function ($message) use ($title)
        {
            //$message->from('postmaster@vertikaltrip.com', 'Postmaster');
            $message->to('guide@vertikaltrip.com');
			$message->subject($title);
        });
		
		/*
		$booking = new bookings;
		$booking->email = $email;
		$booking->person = $os0;
		$booking->country = $country;
		$booking->phone = $phone;
		$booking->date = $date;
		$booking->name = $name;
		$booking->save();
		*/
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
