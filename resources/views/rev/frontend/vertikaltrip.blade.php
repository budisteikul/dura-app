@extends('layouts.frontend')
@section('title','Book Amazing Things to Do With VERTIKAL TRIP')
@section('content')

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNav">
  <div class="container">
    <a href="/"><img id="brand" src="/img/logo.png" alt="VERTIKAL TRIP" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>
    @include('layouts.all-menu')
    </div>
</nav>

<!-- Header Section -->
<header id="page-top" class="intro-header" style="background-image: url('/img/background.jpg'); background-color: #000000">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center ">
			<div class="transbox" style=" min-height:100px; padding-top:5px; padding-bottom:35px; padding-left:10px; padding-right:10px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555; font-size:36px">Book Amazing Things to Do With VERTIKAL TRIP</h1>
                <hr class="hr-theme">
                <a class="btn btn-lg btn-theme js-scroll-trigger" href="/#tour" style="border-radius:0;">DISCOVER TOURS</a>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
		</div>
    </div>
</header>


@include('components.vertikaltrip.services')

@include('components.vertikaltrip.all-tour')

@include('components.vertikaltrip.reviews')


<script>
(function($) {
  "use strict";
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
  
  $('body').scrollspy({
    target: '#mainNav',
    offset: 75
  });
  
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100 && $(window).width() > 768) {
      $("#mainNav").addClass("navbar-shrink shadow");
	  //$("#brand").attr("src", "/img/logo-blue.png");
    } else {
      $("#mainNav").removeClass("navbar-shrink shadow");
	  //$("#brand").attr("src", "/img/logo.png");
    }
  };
  
  navbarCollapse();
  
  $(window).scroll(navbarCollapse);
  
})(jQuery);
</script>
@endsection