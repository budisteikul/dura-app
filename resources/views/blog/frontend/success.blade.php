@extends('layouts.index')
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="https://static.budi.my.id/js/vertikaltrip-1.0.3.js"></script>
<link href="https://static.budi.my.id/css/vertikaltrip-1.0.3.css" rel="stylesheet">
@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/"><span class="fa fa-angle-double-left"></span> Back</a>
	</div>
</nav>   
<div style="height:50px;"></div>
<!-- Navigation -->
<!-- ################################################################### -->
<section id="success" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">Thank you for booking our tour</h3>
                    <h4 class="section-subheading text-muted">
                    	
                    </h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
     	 </div>
        
         <div class="col-lg-8 col-md-10 mx-auto">
         	<div class="row" style="padding-bottom:80px; padding-top:30px;">
				<div class="col-lg-12 text-center">
         			Yogyakarta Night Walking and Food Tours will start at 6.30pm.<br>
						Our meeting point is Tugu Yogyakarta Monument.<br>
						We will contact you immediately.<br>
<br>
<br>
<br>
<span class="caption text-muted">If you not using payment gateway, we will send you invoice to your email address.</span>
         		</div>
             </div>
          </div>
          

    </div>
</div>
</section>


<footer class="py-5 bg-dark">
<div class="container">
    <div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<p class="m-0 text-center text-white">
				<span style="font-family:'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; font-size:32px" class="text-danger">Vertikal Trip</span>
				<br>
				<span class="fa fa-map-marked-alt"></span> <a class="text-white" href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">Tugu Yogyakarta Monument <br />(Tugu Pal Putih)<br />
				Cokrodiningratan, Kec. Jetis, Kota Yogyakarta<br /> Daerah Istimewa Yogyakarta 55233
				</a><br>
				<span class="fab fa-whatsapp"></span> Whatsapp : <a class="text-white" href="https://wa.me/+6285743112112">+62 857-4311-2112</a> <br>
				<span class="fa fa-envelope"></span> Email : <a href="mailto:guide@vertikaltrip.com" class="text-white" target="_blank">guide@vertikaltrip.com</a><br />
				<br>
 <script type="text/javascript"> //<![CDATA[
  var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
  document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]></script>
<script language="JavaScript" type="text/javascript">
  TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_sm_124x32.png", "POSDV", "none");
</script>              
			</p>
        </div>
    </div>
</div>
</footer>
@endsection