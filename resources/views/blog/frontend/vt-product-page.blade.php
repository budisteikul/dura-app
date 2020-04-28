@extends('layouts.frontend')
@section('content')
@section('title',$contents->title)

<!-- Navbar Section -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a class="btn btn-theme text-white js-scroll-trigger" href="#bookingframe" style="margin-top:17px;margin-bottom:17px;" ><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span> <span style="font-size:13px; color:#FFFFFF">TOURS</span>
		</button>
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/25671">Jogja Car Rentals</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/20041">Jogja Things to do</a>
				</li>
            </ul>
		</div>
	</div>
</nav>
<div style="height:25px;"></div>	

<!-- Single Page Section -->
@include('components.vertikaltrip.single-page')

@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('20041');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            

			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">	
        			<div class="row">
        					@foreach($contents->items as $content)
        					<div class="col-lg-4 col-md-6 mb-4">
    							<div class="card h-100 shadow card-block rounded">
                            		@if(isset($content->activity->keyPhoto->fileName))
  				 					<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="text-decoration-none"><img class="card-img-top" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}"></a>
  				 					@endif	
  									<div class="card-header bg-white border-0 text-left pb-0">
        								<h3 class="mb-4"><a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="text-dark text-decoration-none">{{ $content->activity->title }}</a></h3>
      								</div>
									
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span> <b>${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    			<div>
                                    				
                                    			</div>
                                    		</div>
  											
										</div>
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

 
})(jQuery);
</script>
@endsection