@extends('layouts.frontend')
@section('title','Book Amazing Food Tour With VERTIKAL TRIP')
@section('content')

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNav">
	<div class="container">
		<a href="/"><img id="brand" src="/img/logo.png" alt="VERTIKAL TRIP" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>
		
		
		@include('layouts.ft-menu')
		
    </div>
</nav>

<!-- Header Section -->
<header id="page-top" class="intro-header" style="background-image: url('/img/foodtours-background.jpg'); background-color: #000000">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center ">
			<div class="transbox" style=" min-height:100px; padding-top:5px; padding-bottom:35px; padding-left:10px; padding-right:10px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555; font-size:36px">Book Amazing Food Tour With VERTIKAL TRIP</h1>
                <hr class="hr-theme">
                <a class="btn btn-lg btn-theme js-scroll-trigger" href="/#tour">DISCOVER FOOD TOURS</a>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
		</div>
    </div>
</header>

<!-- Services Section -->
@include('components.vertikaltrip.services')

@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('27270');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>

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
                            		@if($content->activity->excerpt!="")
									<div class="card-body pt-0">
										<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
  									</div>
                                	@endif
									<div class="card-body pt-0">
    									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  									</div>
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span>
                                    			</div>
                                    			<div>
                                    				<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    		</div>
  											<div class="ml-auto p-0">
                                    			<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-theme btn-md "><i class="fas fa-info-circle"></i> More info</a>
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

@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('26778');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>

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
                            		@if($content->activity->excerpt!="")
									<div class="card-body pt-0">
										<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
  									</div>
                                	@endif
									<div class="card-body pt-0">
    									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  									</div>
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span>
                                    			</div>
                                    			<div>
                                    				<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    		</div>
  											<div class="ml-auto p-0">
                                    			<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-theme btn-md "><i class="fas fa-info-circle"></i> More info</a>
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

@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('27272');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>

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
                            		@if($content->activity->excerpt!="")
									<div class="card-body pt-0">
										<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
  									</div>
                                	@endif
									<div class="card-body pt-0">
    									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  									</div>
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span>
                                    			</div>
                                    			<div>
                                    				<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    		</div>
  											<div class="ml-auto p-0">
                                    			<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-theme btn-md "><i class="fas fa-info-circle"></i> More info</a>
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


@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('27271');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>

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
                            		@if($content->activity->excerpt!="")
									<div class="card-body pt-0">
										<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
  									</div>
                                	@endif
									<div class="card-body pt-0">
    									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  									</div>
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span>
                                    			</div>
                                    			<div>
                                    				<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    		</div>
  											<div class="ml-auto p-0">
                                    			<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-theme btn-md "><i class="fas fa-info-circle"></i> More info</a>
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

@php
$contents = \App\Classes\Rev\BokunClass::get_product_list_byid('27273');
@endphp
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $contents->title }}</h3>
                    <h4 class="section-subheading text-muted">{!! $contents->description !!}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>

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
                            		@if($content->activity->excerpt!="")
									<div class="card-body pt-0">
										<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
  									</div>
                                	@endif
									<div class="card-body pt-0">
    									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
  									</div>
  									<div class="card-footer bg-white pt-0" style="border:none;">
                                		<div class="d-flex align-items-end mb-2">
  											<div class="p-0 ml-0">
                                    			<div class="text-left">
                                    				<span class="text-muted">Price from</span>
                                    			</div>
                                    			<div>
                                    				<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    			</div>
                                    		</div>
  											<div class="ml-auto p-0">
                                    			<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-theme btn-md "><i class="fas fa-info-circle"></i> More info</a>
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

@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
<!-- Reviews Section -->
@include('components.vertikaltrip.reviews')
@endif

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