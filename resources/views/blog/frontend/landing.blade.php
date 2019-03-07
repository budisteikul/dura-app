@inject('blog', 'App\Classes\Blog\BlogClass')
@extends('layouts.landing')
@section('title', $setting->title1)
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

@media (min-width: 768px) {
  section {
    padding: 150px 0;
  }
}

.service-heading {
  margin: 15px 0;
  text-transform: none;
}



#portfolio .portfolio-item {
  right: 0;
  margin: 0 0 15px;
}

#portfolio .portfolio-item .portfolio-link {
  position: relative;
  display: block;
  max-width: 400px;
  margin: 0 auto;
  cursor: pointer;
}

#portfolio .portfolio-item .portfolio-link .portfolio-hover {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-transition: all ease 0.5s;
  transition: all ease 0.5s;
  opacity: 0;
  background: rgba(254, 209, 54, 0.9);
}

#portfolio .portfolio-item .portfolio-link .portfolio-hover:hover {
  opacity: 1;
}

#portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content {
  font-size: 20px;
  position: absolute;
  top: 50%;
  width: 100%;
  height: 20px;
  margin-top: -12px;
  text-align: center;
  color: white;
}

#portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content i {
  margin-top: -12px;
}

#portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h3,
#portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h4 {
  margin: 0;
}

#portfolio .portfolio-item .portfolio-caption {
  max-width: 400px;
  margin: 0 auto;
  padding: 25px;
  text-align: center;
  background-color: #fff;
}

#portfolio .portfolio-item .portfolio-caption h4 {
  margin: 0;
  text-transform: none;
}

#portfolio .portfolio-item .portfolio-caption p {
  font-size: 16px;
  font-style: italic;
  margin: 0;
  font-family: 'Droid Serif', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}

#portfolio * {
  z-index: 2;
}

@media (min-width: 767px) {
  #portfolio .portfolio-item {
    margin: 0 0 30px;
  }
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
</style>
@endpush
    
   <!-- ################################################################### -->
   <!-- Navigation -->
  <nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ $setting->title1 }}</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          
          {!! $setting->facebook!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->facebook .'"><i class="fa fa-facebook-square"></i> Facebook</a>
          </li>' : '' !!}
          
           {!! $setting->twitter!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->twitter .'"><i class="fa fa-twitter-square"></i> Twitter</a>
          </li>' : '' !!}
          
           {!! $setting->instagram!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->instagram .'"><i class="fa fa-instagram"></i> Instagram</a>
          </li>' : '' !!}
          
          {!! Auth::check() ? '
          <li class="nav-item">
          	<a class="nav-link" href="/blog/photo"><i class="fa fa-user"></i> Admin</a>
          </li>' : '' !!}
          
        </ul>
      </div>
    </div>
  </nav>
   
<!-- ################################################################### -->
	<header id="page-top" class="intro-header" style="background-image: url('{{ $setting->header }}'); background-color:#000000">
    	<div class="site-heading">
        	<div class="transbox">
				<h1 style="padding-top:50px;">{{ $setting->title }}</h1>
				<hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<p class="text-faded mb-5" style="margin-left:10px; margin-right:10px; margin-bottom:20px; padding:5px; ">
					{!! nl2br($setting->description) !!}
				</p>
			</div>
             <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       </div>
    </header>
<!-- ################################################################### -->


<section id="services" style="background-image:url('devel/section-2-bg.jpg'); background-position:center; background-repeat:no-repeat; background-size:cover; padding-top:35px; padding-bottom:35px; ">
      <div class="container">
        <div class="row" style="padding-bottom:0px;">
          <div class="col-lg-12 text-center">
            <h3 class="section-heading text-uppercase">Services</h3>
            <h4 class="section-subheading text-muted">Why choose us?</h4>
            <hr style="max-width:50px;border-color: #e2433b;border-width: 3px;">
          </div>
        </div>
        <div class="row text-center">
                    <div class="col-md-4">
            <span class="fa-stack fa-5x">
                            <img class="img-fluid" style="border-radius: 50%;" src="devel/trek.png" alt="">
               
            </span>
            <h4 class="service-heading">Trek for a Cause</h4>
            <p class="text-muted">Not leaving our moral conscience behind, Vertikal Trip is involved in hosting treks keeping in mind the benefit of the society. Setting up medical camps, supporting women empowerment, opting eco- friendly trekking options are some of it.</p>
          </div>
                    <div class="col-md-4">
            <span class="fa-stack fa-5x">
                            <img class="img-fluid" style="border-radius: 50%;" src="devel/custom.png" alt="">
               
            </span>
            <h4 class="service-heading">Customized Your Adventure</h4>
            <p class="text-muted">Vertikal Trip brings to you customized trekking, a venture out in the wilderness just how you want it to be. With a group, without one; fun-filled activities; special teenage oriented treks; a romantic isolated candle-lit dinner in the mountains for that perfect proposal; ask for anything and it will be served. As they say, &quot;Your Wish, will be Our Command.&quot;</p>
          </div>
                    <div class="col-md-4">
            <span class="fa-stack fa-5x">
                            <img class="img-fluid" style="border-radius: 50%;" src="devel/experienced.png" alt="">
               
            </span>
            <h4 class="service-heading">Experienced Trip Leaders</h4>
            <p class="text-muted">Vertikal Trip enlists among few travel and tour operators that have been founded by the team of experts. Our trek leaders have personally traveled to every popular trekking destinations of Java and thus are well familiar with the things that should be considered while trekking to each specific region. Our experienced wilderness first responders are well trained in first aid and have got leading potentiality. They can devise the best alternative itinerary package for you in case the trekking does not go on schedule due to bad weather and other unforeseen circumstances. Our staffs are professionals who will get focused on the sole purpose of making your stay in the destination as pleasant as it can get.</p>
          </div>
                </div>
    </section>
     



<!-- Portfolio Grid -->
        <section class="bg-light" id="portfolio" style=" padding-top:35px; padding-bottom:35px;">
      <div class="container">
        <div class="row" style="padding-bottom:0px;">
          <div class="col-lg-12 text-center">
            <h3 class="section-heading text-uppercase">Destinations</h3>
            <h4 class="section-subheading text-muted">Need help finding the right trek for you ?</h4>
            <hr style="max-width:50px;border-color: #e2433b;border-width: 3px;">
          </div>
        </div>
        
        <div class="row">
                 <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="devel/merapi.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Merapi</h4>
              <p class="text-muted">2.968 mdpl<br />
Via Selo</p>
            </div>
          </div>
                  <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="devel/merbabu.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Merbabu</h4>
              <p class="text-muted">3.145 mdpl<br />
Via Selo</p>
            </div>
          </div>
                  <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="devel/sindoro.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Sindoro</h4>
              <p class="text-muted">3.136 mdpl<br />
Via Kledung</p>
            </div>
          </div>
                  <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="/devel/sumbing.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Sumbing</h4>
              <p class="text-muted">3.371 mdpl<br />
Via Kledung</p>
            </div>
          </div>
                  <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="devel/prau.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Prau</h4>
              <p class="text-muted">2.565 mdpl<br />
Via Pathak Banteng</p>
            </div>
          </div>
                  <div class="col-md-4 col-sm-6 portfolio-item">
          	                <img class="img-fluid" src="devel/lawu.jpg" alt="">
            <div class="portfolio-caption">
              <h4>Lawu</h4>
              <p class="text-muted">3.265 mdpl<br />
Via Cemoro Sewu</p>
            </div>
          </div>
          
          
        </div>
      </div>
    </section>
    
    
    
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 text-left">
            <span class="copyright"><strong>Phone :</strong> +1 505 585 2112</span><br>
            <span class="copyright"><strong>Email :</strong> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="2245574b464762544750564b49434e56504b520c414d4f">[email&#160;protected]</a></span><br>
            <span class="copyright"><strong>Address :</strong>SUTODIRJAN GT2/837 YOGYAKARTA 55272</span><br>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <img src="devel/mastercard.jpg">
              </li>
              <li class="list-inline-item">
                <img src="devel/paypal.jpg">
              </li>
              <li class="list-inline-item">
                <img src="devel/visa.jpg">
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                Terms and Cancellation Policy
              </li>
              <li class="list-inline-item">
                Safety and Emergency
              </li>
              <li class="list-inline-item">
                Privacy Policy
              </li>
              <li class="list-inline-item">
                Disclaimer
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