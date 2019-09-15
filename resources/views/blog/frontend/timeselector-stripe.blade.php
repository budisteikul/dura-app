@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush

<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
$(window).on('load', function(){
	$(".se-pre-con").fadeOut("slow");
});
</script>
<style>
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(/img/LoadingMountains.svg) center no-repeat #fff;
	background-size: 10% 10%;
}
@media(max-width:767px) {
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(/img/LoadingMountains.svg) center no-repeat #fff;
		background-size: 50% 50%;
	}
}
</style>
<div class="se-pre-con"></div>
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/">Vertikal Trip</a>
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
                
<div id="bokun-w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727">Loading...</div>
<script type="text/javascript">
var w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/79312?bookingChannelUUID=35a387d2-81a7-4216-a53c-19df335afba9&amp;activityId=208273&amp;lang=en&amp;ccy=USD&amp;hash=w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try { 
      w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727 = new BokunWidgetEmbedder(); w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727.initialize(options); w79312_d37b1543_3ba9_4aa9_8624_7a4fdbafe727.display();
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