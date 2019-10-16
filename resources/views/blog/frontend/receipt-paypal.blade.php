@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')


@endpush
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a href="https://www.paypal.com/id/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/id/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img class="rounded" style="margin-top:5px; margin-bottom:5px;" src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" alt="How PayPal Works" height="40" /></a>
        
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link" href="/">Home</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link" href="/#services">Services</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link" href="/#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#review">Reviews</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#guide">Tour Guide</a>
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
                
<div id="bokun-w79921_0f036067_520d_42dd_a995_3988570f1eec">Loading...</div><script type="text/javascript">
var w79921_0f036067_520d_42dd_a995_3988570f1eec;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/79921?bookingChannelUUID=af09519a-6eee-4a10-b127-5bd5edb0f3ce&amp;lang=en&amp;ccy=USD&amp;hash=w79921_0f036067_520d_42dd_a995_3988570f1eec';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w79921_0f036067_520d_42dd_a995_3988570f1eec', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try { 
      w79921_0f036067_520d_42dd_a995_3988570f1eec = new BokunWidgetEmbedder(); w79921_0f036067_520d_42dd_a995_3988570f1eec.initialize(options); w79921_0f036067_520d_42dd_a995_3988570f1eec.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');
</script>
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection