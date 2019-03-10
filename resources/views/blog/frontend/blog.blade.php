@extends('layouts.landing')
@section('title', 'Title')
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="/js/ratnawahyu.js"></script>
<link href="/css/ratnawahyu.css" rel="stylesheet">
<style>
body {
  overflow-x: hidden;
  font-family: 'Roboto Slab', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

p {
  line-height: 1.75;
}

a {
  color: #e2433b;
}

a:hover {
  color: #be3e36;
}

.text-primary {
  color: #e2433b !important;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-weight: 700;
  font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

section {
  padding: 100px 0;
}

section h2.section-heading {
  font-size: 40px;
  margin-top: 0;
  margin-bottom: 15px;
}

section h3.section-subheading {
  font-size: 16px;
  font-weight: 400;
  font-style: italic;
  margin-bottom: 75px;
  text-transform: none;
  font-family: 'Droid Serif', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

.service-heading {
  margin: 15px 0;
  text-transform: none;
}


footer {
  padding: 25px 0;
  text-align: center;
}

footer span.copyright {
  font-size: 90%;
  line-height: 30px;
  text-transform: none;
  font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

footer ul.quicklinks {
  font-size: 90%;
  line-height: 30px;
  margin-bottom: 0;
  text-transform: none;
  font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

#service .service-item {
  right: 0;
  margin: 0 0 15px;
}


#service .service-item .service-caption {
  max-width: 400px;
  margin: 0 auto;
  padding: 25px;
  text-align: center;
  background-color: #fff;
}

#service .service-item .service-caption h4 {
  margin: 0;
  text-transform: none;
  margin-bottom:10px;
}

#service .service-item .service-caption p {
  font-size: 16px;
  margin: 0;
  
}

#service * {
  z-index: 2;
}

@media (min-width: 767px) {
  #service .service-item {
    margin: 0 0 30px;
  }
}
</style>
@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<!-- ################################################################### -->
  <nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Title</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          {!! Auth::check() ? '
          <li class="nav-item">
          	<a class="nav-link" href="/blog/photo"><i class="fa fa-user"></i> Admin</a>
          </li>' : '' !!}
        </ul>
      </div>
    </div>
  </nav>
<!-- ################################################################### -->
<!-- Header -->   
<!-- ################################################################### -->
	<header id="page-top" class="intro-header" style=" background-color:#646464">
    	<div class="site-heading">
        	<div class="transbox">
				<h1 style="padding-top:50px;">Find your holiday today with Vertikal Trip</h1>
				<hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<p class="text-faded mb-5" style="margin-left:10px; margin-right:10px; margin-bottom:20px; padding:5px; ">
					<button type="button" class="btn btn-sm btn-danger">GET STARTED</button>
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       </div>
    </header>
<!-- ################################################################### -->
<!-- Section -->
<!-- ################################################################### -->
<section>
      <div class="container">
        <!-- ################################################################### -->
        <div class="row" style="padding-bottom:0px;">
          <div class="col-lg-12 text-center">
            <h3 class="section-heading text-uppercase">QUALITIES</h3>
            <h4 class="section-subheading text-muted">Why choose us?</h4>
            <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
          </div>
        </div>
        <!-- ################################################################### -->
        <div class="row text-center justify-content-center">
        	<!-- ################################################################### -->
        	<div class="col-lg-3 col-sm-6">
            	<span class="fa-stack fa-5x">
            		<img class="img-fluid" style="border-radius: 50%;" src="devel/trek.png" alt="">
            	</span>
            	<h4 class="service-heading">Responsible hosting</h4>
            	<p class="text-muted">You are the main focus of our company, all of our activities are focusing on how we can bring ultimate satisfaction for you</p>
            </div>
            <!-- ################################################################### -->
            <div class="col-lg-3 col-sm-6">
            	<span class="fa-stack fa-5x">
            		<img class="img-fluid" style="border-radius: 50%;" src="devel/trek.png" alt="">
            	</span>
            	<h4 class="service-heading">Social Impact</h4>
            	<p class="text-muted">We care about our local community. We guarantee your journey with us will give benefits to them in one or any other way</p>
            </div>
            <!-- ################################################################### -->
            <div class="col-lg-3 col-sm-6">
            	<span class="fa-stack fa-5x">
            		<img class="img-fluid" style="border-radius: 50%;" src="devel/trek.png" alt="">
            	</span>
            	<h4 class="service-heading">Extraordinary</h4>
            	<p class="text-muted">We have customized each activity with considering all aspects so you will get the maximum first-class experience in each trip</p>
            </div>
            <!-- ################################################################### -->
            <div class="col-lg-3 col-sm-6">
            	<span class="fa-stack fa-5x">
            		<img class="img-fluid" style="border-radius: 50%;" src="devel/trek.png" alt="">
            	</span>
            	<h4 class="service-heading">Local &amp; Professional</h4>
            	<p class="text-muted">We are a group of locals who bring our own expertise to the table to provide the best travel and event experience for you</p>
            </div>
        	<!-- ################################################################### -->  
        </div>
        <!-- ################################################################### -->
    </div>
</section>
<!-- ################################################################### -->
<!-- Section -->
<!-- ################################################################### -->
<section id="service" style="background-color:#EEEDED">
      <div class="container">
        <!-- ################################################################### -->
        <div class="row" style="padding-bottom:0px; margin-bottom:25px;">
          <div class="col-lg-12 text-center">
            <h3 class="section-heading text-uppercase">Our Services</h3>
            <h4 class="section-subheading text-muted">Tour packages holiday in Yogyakarta</h4>
            <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
          </div>
        </div>
        <!-- ################################################################### -->
        <div class="row justify-content-center">
        	<!-- ################################################################### -->
        	<div class="col-lg-4 col-sm-6  service-item">
            		<img class="img-fluid" src="devel/merbabu.jpg" alt="">
            		<div class="service-caption text-left">
                		<h4 class="service-heading">Yogyakarta Night Food Tour</h4>
            			<p class="text-muted">We will invite you enjoying the nighttime atmosphere of Yogyakarta, and discover a variety of distinctive traditional Yogyakarta dishes. Learn interesting fun facts about this city, interact with locals, travel on a becak (Yogyakarta traditional tuk-tuk), and more.</p>
                        <button type="button" class="btn btn-danger btn-sm" style="margin-top:20px;">Learn more and booking via AirBNB</button>
                        <button type="button" class="btn btn-warning btn-sm" style="margin-top:20px;">Learn more and booking via Viator</button>
                	</div>
            </div>
        	<!-- ################################################################### -->
            <div class="col-lg-4 col-sm-6  service-item">
            		<img class="img-fluid" src="devel/merbabu.jpg" alt="">
            		<div class="service-caption text-left">
                		<h4 class="service-heading">Ullen Sentalu & Merapi Lava Tour</h4>
            			<p class="text-muted">We will invite you to learn about javanese culture and royal family's life story, explore the javanese hidden treasure, stone architecture and accompany you to enjoy views of the Merapi Mountain's slope by Merapi Lava Tour Jeep</p>
                        <button type="button" class="btn btn-danger btn-sm" style="margin-top:20px;">Learn more and booking via AirBNB</button>
                        <button type="button" class="btn btn-warning btn-sm" style="margin-top:20px;">Learn more and booking via Viator</button>
                	</div>
            </div>
        	<!-- ################################################################### -->
        </div>
        <!-- ################################################################### -->
    </div>
</section>
<!-- ################################################################### --> 
<!-- Footer -->
<!-- ################################################################### -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 text-left">
            <span class="copyright"><strong>Phone :</strong> +1 505 585 2112</span><br>
            <span class="copyright"><strong>Email :</strong> guide@vertikaltrip.com</span><br>
            <span class="copyright"><strong>Address :</strong> SUTODIRJAN GT2/837 YOGYAKARTA 55272</span><br>
          </div>
          <div class="col-md-4">
            <ul class="list-inline">
              <li class="list-inline-item">
                <img width="80" src="devel/mastercard.jpg">
              </li>
              <li class="list-inline-item">
                <img width="80" src="devel/paypal.jpg">
              </li>
              <li class="list-inline-item">
                <img width="80" src="devel/visa.jpg">
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <a href="#">Terms and Cancellation Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Safety and Emergency</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Disclaimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
<!-- ################################################################### -->
<a href="#page-top" class="cd-top js-scroll-trigger">Top</a>
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