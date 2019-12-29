@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a href="/"><img class="rounded" style="margin-top:5px; margin-bottom:5px;" src="/logo.png" alt="How PayPal Works" height="40" /></a>
        
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#services">Why Jogja Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#review">Reviews</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#guide">Tour Guide</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#another">Another Tour</a>
				</li>
			</ul>
		</div>
        
        
	</div>
</nav>   
<div style="height:25px;"></div>


<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>	
                
{!! $post !!}
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>

<section id="another" style="background-color:#ffffff">
<div class="container">
	<div class="row">
    
    	<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">Another Tour</h3>
					<h4 class="section-subheading text-muted">Let's Check it Out Another Our Tour</h4>
                    <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
					

                    
				</div>
			</div>
		</div>
    
    <div class="col-lg-12 col-md-10 mx-auto">
   
   
   <div id="bokun-w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db">Loading...</div><script type="text/javascript">
var w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/98904?bookingChannelUUID=0b17d17f-9551-42e2-b39b-1c076ea5ccf6&amp;lang=en&amp;ccy=USD&amp;hash=w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try {
      w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db = new BokunWidgetEmbedder(); w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db.initialize(options); w98904_c65931f1_fa73_467b_8ec7_0c58e5bb76db.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');
</script>
   
    </div>
    </div>
</div>
<div style="height:50px;"></div>
</section>

@endsection