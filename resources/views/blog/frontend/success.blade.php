@extends('layouts.index')
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="https://static.budi.my.id/js/vertikaltrip-1.0.0.js"></script>
<link href="https://static.budi.my.id/css/vertikaltrip-1.0.0.css" rel="stylesheet">
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d1810cb22d70e36c2a3697f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
@endpush
    
<!-- ################################################################### -->
   
<!-- ################################################################### -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">Vertikal Trip</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span> <span style="font-size:16px">Menu</span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#about">The Tour</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#gallery">Snapshot</a>
				</li>
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#guide">Tour Guide</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#booking">Book Now</a>
				</li>
                <!-- li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#ticket-checker">Ticket Checker</a>
				</li -->
			</ul>
		</div>
    </div>
  </nav>    
<!-- ################################################################### -->
<header id="page-top" class="intro-header" style="background-image: url('https://static.budi.my.id/assets/foodtour/tugu-dark.jpg'); background-color: #B0B0B0">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:20px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img alt="{{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/logo-jogja-istimewa-png-4.png" width="250">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
                
				<h1 id="title" style="text-shadow: 2px 2px #555555;">Thank you for booking our tour</h1>
				<p class="text-faded">
					
                   Our team will proccess your order and contact you immediately.
                    
				</p>
			</div>
            <div style="font-size: 50px; color:#FFFFFF; margin-top:30px; height:120px;"></div>
       
		</div>
    </div>
</header>





<footer class="py-5 bg-dark">
<div class="container">
    <div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<p class="m-0 text-center text-white">
				<span style="font-family:'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; font-size:22px">Vertikal Trip</span>
				<br>
				<span class="fa fa-map-marked-alt"></span> Meeting point : <a class="text-danger" href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">Tugu Yogyakarta Monument (Tugu Pal Putih)<br />
				Cokrodiningratan, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233
				</a><br>
				<span class="fab fa-whatsapp"></span> Whatsapp : <a class="text-danger" href="https://wa.me/+6285743112112">+62 857-4311-2112</a> <br> <!-- span class="fab fa-instagram"></span> IG : <a class="text-danger" href="https://www.instagram.com/vertikaltrip" target="_blank">@vertikaltrip</a> | <span class="fab fa-facebook"></span> FB : <a class="text-danger" href="https://www.facebook.com/vertikaltrip" target="_blank">Vertikal Trip</a><br / -->
				<span class="fa fa-envelope"></span> Email : <a href="mailto:guide@vertikaltrip.com" class="text-danger" target="_blank">guide@vertikaltrip.com</a><br />
				<br>
				<img alt="Payment | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/payment.png">
				<br><br>
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

<script>


(function($) {
        
  "use strict"; // Start of use strict
  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

 
  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 75
  });
 
  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  
  // Collapse now if page is not at top
  navbarCollapse();
  
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);
  
  
})(jQuery);
</script>
@endsection