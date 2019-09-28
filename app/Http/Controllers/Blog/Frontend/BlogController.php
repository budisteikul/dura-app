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
		
	}
	
	public function tour($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post]);
    }
	
	//====================================================================================
	public function payment()
    {
        return view('blog.frontend.payment');
    }
	public function timeselector_stripe()
    {
        return view('blog.frontend.timeselector-stripe');
    }
	public function checkout_stripe()
    {
        return view('blog.frontend.checkout-stripe');
    }
	public function receipt_stripe()
    {
        return view('blog.frontend.receipt-stripe');
    }
	
	public function timeselector_paypal()
    {
        return view('blog.frontend.timeselector-paypal');
    }
	public function checkout_paypal()
    {
        return view('blog.frontend.checkout-paypal');
    }
	public function receipt_paypal()
    {
        return view('blog.frontend.receipt-paypal');
    }
	//====================================================================================
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
	
	public function index()
    {
		$count = rev_reviews::count();
        return view('blog.frontend.foodtour')
		->with('count',$count);
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
