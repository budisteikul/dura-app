<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_categories;
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
	
	
	public function product($id)
    {
		    $post = blog_posts::where('slug',$id)->first();
        return view('blog.frontend.booking')->with(['product'=>$post->widgets->time_selector,'jscript'=>'','product_page'=>false]);
    }
	
	public function product_list($id)
    {
      $title = '';
		$cat = blog_categories::where('slug',$id)->first();
        return view('blog.frontend.product')->with(['title'=>$title,'product'=>$cat->description,'jscript'=>'','product_page'=>false]);
    }
	

    public function index_shinjuku(Request $request,$id="")
    {
        $activityId = "";
        $title = '';
        $description = '';
		$categories = '<div id="bokun-w101289_0ce31b80_d625_4740_84d3_107105eeb027">Loading...</div><script type="text/javascript">
var w101289_0ce31b80_d625_4740_84d3_107105eeb027;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/101289?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w101289_0ce31b80_d625_4740_84d3_107105eeb027\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w101289_0ce31b80_d625_4740_84d3_107105eeb027\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w101289_0ce31b80_d625_4740_84d3_107105eeb027 = new BokunWidgetEmbedder(); w101289_0ce31b80_d625_4740_84d3_107105eeb027.initialize(options); w101289_0ce31b80_d625_4740_84d3_107105eeb027.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		
        if($id=="")
        {
            $post = rev_widgets::with('posts')->where('product_id', $request->input('activityId'))->first();
            if(isset($post)) return redirect('/tour/'. $post->posts->slug .'/');
            $activityId = $request->input('activityId');

        }
        else
        {
            $post = blog_posts::with('widgets')->where('slug',$id)->first();
            if(isset($post))
              {
                $activityId = $post->widgets->product_id;
                $title = $post->title;
                $description = $post->content;
				$cat = blog_posts::with('categories')->where('slug',$id)->first();
				if(isset($cat)) $categories = $cat->categories[0]->description;
              }
        }

        $jscript = '<script type="text/javascript" src="https://vertikaltrip.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>';
        $product = '';
        $calendar = '';
        
        if(empty($activityId))
        {
           $activityId = '284167';
           $title = 'Izakaya Food Tour in Shinjuku';
           $description = 'Enjoy classic Japanese experience at our selected restaurants. Local food & drinks as we journey through Tokyo’s busiest area in Shinjuku.';
        }

        
        $product = '<div id="productId" class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience/'.$activityId.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
        $calendar = '<div id="calendarId" class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/'.$activityId.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
       

        $widget = rev_widgets::where('product_id',$activityId)->first();
        if(isset($widget)){
            if(isset($widget->calendar_id)){
               $calendar = '<div class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/'.$widget->calendar_id.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
            }
        }
        
		
		
        return view('blog.frontend.foodtour_shinjuku')->with([
          'title'=>$title,
          'jscript'=>$jscript,
          'product'=>$product,
          'calendar'=>$calendar,
          'description'=>$description,
		  'categories'=>$categories,
        ]);

    }

    public function product_tour(Request $request,$id="")
    {
        $activityId = "";
        $title = '';
        if($id=="")
        {
            $post = rev_widgets::with('posts')->where('product_id', $request->input('activityId'))->first();
            if(isset($post)) return redirect('/tour/'. $post->posts->slug .'/');
            $activityId = $request->input('activityId');

        }
        else
        {
            $post = blog_posts::with('widgets')->where('slug',$id)->first();
            if(isset($post))
              {
                $activityId = $post->widgets->product_id;
                $title = $post->title;
              }
        }
        
        
        $jscript = '<script type="text/javascript" src="https://vertikaltrip.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>';
        $product = '';
        $calendar = '';
        $product_page = true;
       
        if(empty($activityId))
        {
            $product_page = false;
			      $cat = blog_categories::where('slug','front-page')->first();
            $product = $cat->description;
        }
        else
        {
              $product = '<div class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience/'.$activityId.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
$calendar = '<div class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/'.$activityId.'"></div><noscript>Please enable javascript in your browser to book</noscript>';

        }

        $widget = rev_widgets::where('product_id',$activityId)->first();
        if(isset($widget)){
            if(isset($widget->calendar_id)){
               $calendar = '<div class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/'.$widget->calendar_id.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
            }
        }
        
        return view('blog.frontend.product')->with(['title'=>$title,'jscript'=>$jscript,'product'=>$product,'calendar'=>$calendar,'product_page'=>$product_page]);
    }

	

    public function checkout()
    {
        $render = '<div id="bokun-w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa">Loading...</div><script type="text/javascript">
var w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97537?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa = new BokunWidgetEmbedder(); w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa.initialize(options); w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render,'jscript'=>'','product_page'=>false]);
    }

    public function receipt()
    {
        $render = '<div id="bokun-w97536_f6820178_ae16_4095_b0ec_4c203e94f898">Loading...</div><script type="text/javascript">
var w97536_f6820178_ae16_4095_b0ec_4c203e94f898;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97536?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97536_f6820178_ae16_4095_b0ec_4c203e94f898\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97536_f6820178_ae16_4095_b0ec_4c203e94f898\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97536_f6820178_ae16_4095_b0ec_4c203e94f898 = new BokunWidgetEmbedder(); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.initialize(options); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render,'jscript'=>'','product_page'=>false]);
    }

	 public function checkout_tmt()
    {
        $render = '<div id="bokun-w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213">Loading...</div><script type="text/javascript">
var w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97537?bookingChannelUUID=bc161c64-7fa4-4143-8f98-c7f43ab806c1&amp;lang=en&amp;ccy=USD&amp;hash=w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213 = new BokunWidgetEmbedder(); w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213.initialize(options); w97537_41e75e05_9ad1_4b9e_86f4_601c995bd213.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render,'jscript'=>'','product_page'=>false]);
    }
	

    public function receipt_tmt()
    {
        $render = '<div id="bokun-w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b">Loading...</div><script type="text/javascript">
var w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97536?bookingChannelUUID=bc161c64-7fa4-4143-8f98-c7f43ab806c1&amp;lang=en&amp;ccy=USD&amp;hash=w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b = new BokunWidgetEmbedder(); w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b.initialize(options); w97536_6fbc3c6c_bf2b_4569_be58_36fabcca477b.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render,'jscript'=>'','product_page'=>false]);
    }

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
