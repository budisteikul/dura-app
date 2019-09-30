<?php

namespace App\Http\Controllers\SMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SMS\sms;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $msisdn =  $request->input('msisdn');
		$to =  $request->input('to');
		$messageId =  $request->input('messageId');
		$type =  $request->input('type');
		$text =  $request->input('text');
		$keyword =  $request->input('keyword');
		$message_timestamp =  $request->input('message-timestamp');
		
		$sms = new sms();
		$sms->msisdn = $msisdn;
		$sms->to = $to;
		$sms->messageId = $messageId;
		$sms->type = $type;
		$sms->text = $text;
		$sms->keyword = $keyword;
		$sms->message_timestamp = $message_timestamp;
		$sms->save();
		
		
				curl_setopt_array($ch = curl_init(), array(
  				CURLOPT_URL => "https://api.pushover.net/1/messages.json",
  				CURLOPT_POSTFIELDS => array(
    			"token" => 'afDgcjDe5pnQRXY9oMxyj77Rkbt6go',
    			"user" => 'uTxTwZoiLin9vLZJkP3rRPf32xghXu',
				"title" => $msisdn,
    			"message" => $text,
  				),
				));
				curl_exec($ch);
				curl_close($ch);
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
