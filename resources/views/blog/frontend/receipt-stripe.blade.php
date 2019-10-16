@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')


@endpush 
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/">Jogja Food Tour</a>
        
        
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
                
<div id="bokun-w79314_1bb70590_36b3_491f_a85d_e884b35c43e0">Loading...</div>
<script type="text/javascript">
var w79314_1bb70590_36b3_491f_a85d_e884b35c43e0;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/79314?bookingChannelUUID=35a387d2-81a7-4216-a53c-19df335afba9&amp;lang=en&amp;ccy=USD&amp;hash=w79314_1bb70590_36b3_491f_a85d_e884b35c43e0';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w79314_1bb70590_36b3_491f_a85d_e884b35c43e0', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try { 
      w79314_1bb70590_36b3_491f_a85d_e884b35c43e0 = new BokunWidgetEmbedder(); w79314_1bb70590_36b3_491f_a85d_e884b35c43e0.initialize(options); w79314_1bb70590_36b3_491f_a85d_e884b35c43e0.display();
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