<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_widgets;
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
	
	public function index_product()
	{
		$post = blog_posts::where('slug','experience')->first();
        return view('blog.frontend.product')->with(['post'=>$post->widgets->product]);
	}
	
	public function product($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post->widgets->product]);
    }
	
	/*
	public function time_selector($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post->widgets->time_selector]);
    }
	*/
	
	public function time_selector($id,Request $request)
    {
		$activityId = $request->input('activityId');
		
		$first = '<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
     
    <div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience/';
	
		$last = '"></div>
    <noscript>Please enable javascript in your browser to book</noscript>
';
		
		$first2 = '<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
     
    <div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/';
	
		$last2 = '"></div>
    <noscript>Please enable javascript in your browser to book</noscript>
';
		
        return view('blog.frontend.product')->with(['post'=>$first.$activityId.$last.$first2.$activityId.$last2]);
    }
	

    public function product_tour(Request $request)
    {
        $activityId = $request->input('activityId');
        $first = '<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
            <div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience/';
        $last = '"></div><noscript>Please enable javascript in your browser to book</noscript>';
		
		$first2 = '<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
            <div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/';
        $last2 = '"></div><noscript>Please enable javascript in your browser to book</noscript>';
       
        if(empty($activityId))
        {
            $render = '<div id="bokun-w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d">Loading...</div><script type="text/javascript">
var w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/98904?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d = new BokunWidgetEmbedder(); w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d.initialize(options); w98904_0292896c_6db2_49e0_bfb4_7ea495c1527d.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        }
        else
        {
            $render = $first.$activityId.$last.$first2.$activityId.$last2;
        }


        
        return view('blog.frontend.product')->with(['post'=>$render]);
    }

	public function checkout($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post->widgets->checkout]);
    }
	
	public function receipt($id)
    {
		$post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['post'=>$post->widgets->receipt]);
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
