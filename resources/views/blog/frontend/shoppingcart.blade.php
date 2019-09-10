@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
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
				<div style="height:45px;"></div>	
                
<div id="bokun-w75389_96718448_fa6d_454b_bd20_93e3816559c5">Loading...</div><script type="text/javascript">
var w75389_96718448_fa6d_454b_bd20_93e3816559c5;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/75389?bookingChannelUUID=607cb4b6-0e0e-4946-98b0-6c1902dcfe84&amp;lang=en&amp;ccy=USD&amp;hash=w75389_96718448_fa6d_454b_bd20_93e3816559c5';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w75389_96718448_fa6d_454b_bd20_93e3816559c5', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try { 
      w75389_96718448_fa6d_454b_bd20_93e3816559c5 = new BokunWidgetEmbedder(); w75389_96718448_fa6d_454b_bd20_93e3816559c5.initialize(options); w75389_96718448_fa6d_454b_bd20_93e3816559c5.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');
</script>

<div class="row d-flex justify-content-center" style="padding-bottom:0px;">
						<div class="col-lg-12 text-right">
                        
					
                        <a class="btn btn-outline-dark" href="/payment/stripe/checkout"><span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong><span class="fa fa-credit-card"></span> Checkout with credit card</strong></span></a>
					&nbsp;
                        <a class="btn btn-outline-dark" href="/payment/paypal/checkout"><span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong><span class="fab fa-paypal"></span> Checkout with PayPal</strong></span></a>
					
                    
                    </div>
                    </div>
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection