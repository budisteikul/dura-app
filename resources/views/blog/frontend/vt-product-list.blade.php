@extends('layouts.frontend')
@section('title',$contents->title)
@section('content')
@push('scripts')

@endpush

 <!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/assets/logo/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		@include('layouts.vt-menu')
        
	</div>
</nav>





<div style="height:25px;"></div>
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr style="max-width:50px;border-color:#1D57C7;border-width:3px;">
                    
                    <div style="height:30px;"></div>
                </div>
            </div>

			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					
        		<div class="row">

        			@foreach($contents->items as $content)
        			<div class="col-sm-4 col-sm-auto  mb-4">
    						<div class="card  h-100 shadow card-block rounded">
                            @if(isset($content->activity->keyPhoto->fileName))
  				 				<img class="card-img-top" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}">
  				 			@endif	
  							<div class="card-header bg-white border-0 text-left h-100 pb-0">
        								<h2 class="mb-0">{{ $content->activity->title }}</h2>
      						</div>
								<div class="card-body pt-0 h-100">
    								@if($content->activity->excerpt!="")
									<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
									@endif
  								</div>
								<div class="card-body pt-0">
    								<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  								</div>
  								<div class="card-body pt-0">
    								<p class="card-text text-right"><b>Price from</b><br /><b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b></p>
  								</div>
  								<div class="card-footer bg-primary p-0">
    								<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-primary btn-lg btn-block text-white" style=" cursor: pointer; background-color: #1D57C7; border-color: #1D57C7;"><i class="fas fa-info-circle"></i> More info</a>
  								</div>
							</div>
    				</div>
					@endforeach

				</div>
				<div style="height:25px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>




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