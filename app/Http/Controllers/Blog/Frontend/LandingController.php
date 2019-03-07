<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Http;
use App\Classes\Blog\BlogClass;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_attachments;
use App\Models\Blog\blog_settings;
use App\User;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		
		$user_id = '93e56719-6e48-4d96-b7bb-be93c23b8c24';
		$get_user = User::where('id',$user_id)->whereNotNull('email_verified_at')->first();
		
		
		$stdClass = app();
    	$setting = $stdClass->make('stdClass');
		
		$setting->title1 = BlogClass::getConf('title1',$user_id);
		if($setting->title1=="") $setting->title1 = str_ireplace("www.","",$_SERVER['HTTP_HOST']);
		$setting->title2 = BlogClass::getConf('title2',$user_id);
		$setting->description = BlogClass::getConf('description',$user_id);
		$setting->gravatar = $get_user->picture_url;
		//===========================================================================
		$header = BlogClass::getConf('header',$user_id);
		$setting->header = '/storage/'. $user_id .'/images/header/'. $header ;
		//===========================================================================
		$setting->facebook = BlogClass::getConf('facebook',$user_id);
		$setting->twitter = BlogClass::getConf('twitter',$user_id);
		$setting->instagram = BlogClass::getConf('instagram',$user_id);
		
		$url = Http::url();
		$setting->url = $url;
		$setting->image = $setting->url . $setting->header;
		$setting->title = $setting->title2;
		$setting->user_id = $user_id;
        return view('blog.frontend.landing')->with('setting',$setting);
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
