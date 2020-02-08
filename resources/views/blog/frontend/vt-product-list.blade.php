@extends('layouts.frontend')
@section('title',$contents->title)
@section('content')
@push('scripts')
<script type="text/javascript">
			jQuery(document).ready(function($) {	
			var table = $('#dataTables-example').DataTable(
			{
				
				"processing": true,
       			"serverSide": true,
        		"ajax": {
            			"url": "/review",
            			"type": "POST"
        			},
				"scrollX": true,
				"language": {
    				"paginate": {
      					"previous": "<i class='fa fa-step-backward'></i>",
						"next": "<i class='fa fa-step-forward'></i>",
						"first": "<i class='fa fa-fast-backward'></i>",
						"last": "<i class='fa fa-fast-forward'></i>"
    				},
					"aria": {
            			"paginate": {
                			"first":    'First',
                			"previous": 'Previous',
                			"next":     'Next',
                			"last":     'Last'
            			}
        			}
  				},
				"pageLength": 5,
				"order": [[ 0, "desc" ]],
				"columns": [
					{data: 'date', name: 'date', orderable: true, searchable: false, visible: false},
					{data: 'style', name: 'style', className: 'auto', orderable: false},
        		],
				"dom": 'rtp',
				"pagingType": "full_numbers",
				"fnDrawCallback": function () {
					
				}
			});
			
			var table = $('#dataTables-example').DataTable();
			$('#dataTables-example').on('page.dt', function(){
    			var target = $('#review');
      			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      			if (target.length) {
        			$('html, body').animate({
          				scrollTop: (target.offset().top - 54)
        			}, 1000, "easeInOutExpo");
        			return false;
      			}
			});
			
			});
			
			
</script>
@endpush
<style>
#mainNav {
  	border-color: rgba(34,34,34,.05);
    font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;
    background-color:#2e3338;
    -webkit-transition: all .35s;
    -moz-transition: all .35s;
    transition: all .35s;
}

.navbar-toggler {
  padding: 0.25rem 0.75rem;
  font-size: 1.25rem;
  line-height: 1;
  background-color: transparent;
  border: 2px solid transparent;
  border-radius: 0.25rem;
}

.navbar-toggler:hover, .navbar-toggler:focus {
  text-decoration: none !important;
  outline: none;
  box-shadow: none;
}


.navbar-toggler-icon {
  display: inline-block;
  width: 1.5em;
  height: 1.5em;
  vertical-align: middle;
  content: "";
  background: no-repeat center center;
  background-size: 100% 100%;
}

#mainNav .navbar-brand {
  font-family: 'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
  font-weight: 700;
  color: #ccd0d5;
  text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
  filter: alpha(opacity=60);
}

#mainNav .navbar-brand.active, #mainNav .navbar-brand:hover {
  color: #FFFFFF;
}

#mainNav .navbar-nav .nav-item .nav-link {
  	text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    color: #FFFFFF;
}

#mainNav .navbar-nav .nav-item .nav-link.active, #mainNav .navbar-nav .nav-item .nav-link:hover {
  color: #dadada;
  
}
#mainNav-back {
  	padding-top: 0;
    padding-bottom: 0;
  	border-color: rgba(34,34,34,.05);
    font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;
    background-color:#2e3338;
    background: #2e3338;
	filter: alpha(opacity=30);
    -webkit-transition: all .35s;
    -moz-transition: all .35s;
    transition: all .35s;
}

#mainNav-back .navbar-brand {
  font-family: 'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
  font-weight: 700;
  color: #ccd0d5;
  text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
  filter: alpha(opacity=60);
  font-size: 1.25em;
  padding: 12px 0;
}

#mainNav-back .navbar-brand.active, #mainNav-back .navbar-brand:hover {
  color: #dadada;
}

#mainNav-back .navbar-nav .nav-item .nav-link {
  	text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    color: #FFFFFF;
}

#mainNav-back .navbar-nav .nav-item .nav-link.active, #mainNav-back .navbar-nav .nav-item .nav-link:hover {
  color: #c03b44;
  
}
@media(min-width:768px) {
  #mainNav {
    padding-top: 25px;
    padding-bottom: 25px;
    -webkit-transition: padding-top 0.3s, padding-bottom 0.3s;
    transition: padding-top 0.3s, padding-bottom 0.3s;
    border: none;
    background-color: transparent;
  }
  #mainNav .navbar-brand {
    font-size: 1.75em;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
  }
  #mainNav .navbar-nav .nav-item .nav-link {
    padding: 1.1em 1em !important;
  }
  #mainNav.navbar-shrink {
    padding-top: 7px;
    padding-bottom: 7px;
    background-color:#2e3338;
    background:#2e3338;
	filter: alpha(opacity=30);
  }
  #mainNav.navbar-shrink .navbar-brand {
    font-size: 1.25em;
    padding: 12px 0;
  }
  #mainNav-back {
    border-color: rgba(34,34,34,.05);
    font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;
    background-color:#2e3338;
    background: #2e3338;
	filter: alpha(opacity=30);
    -webkit-transition: all .35s;
    -moz-transition: all .35s;
    transition: all .35s;
  }
  #mainNav-back .navbar-brand {
    font-size: 1.25em;
    padding: 12px 0;
  }
  #mainNav-back .navbar-nav .nav-item .nav-link {
    padding: 1.1em 1em !important;
  }
}
</style>
 <!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav">
	<div class="container">

<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>

		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#services">Why Choose us?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#tour">The Tour</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#review">Reviews</a>
				</li>
              
			</ul>
		</div>
		
		
		
		
    </div>
	
  </nav>

<header id="page-top" class="intro-header" style="background-image: url('/assets/foodtour/tugu-dark-1.0.1.jpg'); background-color: #000000">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:20px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img alt="Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/logo-jogja-istimewa-png-4.png" width="250">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555;">Enjoy Jogja in Local Ways!</h1>
				<p class="text-faded">
                    Hi we are from the Vertikal Trip team, we will give you complete Yogyakarta atmosphere, tradition, food, and culture. Along the journey we will accompany you so you can feel the real with locals experience with us, share our stories, experiences and traditions.
                    <br>
                    Get 10% discount with promotional code <span class="badge badge-success">HAPPYHOLIDAY</span> at checkout
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
		</div>
    </div>
</header>


  <!-- Services Section -->
  <section class="page-section" id="services" style="background-color:#FFFFFF">
    <div class="container">
    <div style="height:70px;"></div>
      
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fa fa-4x fa-ticket-alt text-danger mb-4"></i>
            <h3 class="h4 mb-2">Instant Booking</h3>
            <p class="text-muted mb-0">Your booking are confirmed automatically!</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-phone-alt text-danger mb-4"></i>
            <h3 class="h4 mb-2">24/7 Support</h3>
            <p class="text-muted mb-0">Whatsapp : +62 857 4311 2112</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-history text-danger mb-4"></i>
            <h3 class="h4 mb-2">Free Cancellation</h3>
            <p class="text-muted mb-0">You can cancel the booking up to 24 hours in advance!</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fab fa-4x fa-paypal text-danger mb-4"></i>
            <h3 class="h4 mb-2">Secure Payments</h3>
            <p class="text-muted mb-0">We use PayPal as payment gateway to make it secure and simple!</p>
          </div>
        </div>
      </div>
      <div style="height:45px;"></div>	
    </div>
  </section>


<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">

            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
                    <div style="height:70px;"></div>
                    
                    <h3 class="section-heading" style="margin-top:0px;">Explore Yogyakarta Through our Tour Packages</h3>
                    <h4 class="section-subheading text-muted">Get 10% discount with promotional code <span class="badge badge-success">HAPPYHOLIDAY</span> at checkout</h4>
                    <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
                    
                    <div style="height:30px;"></div>
                </div>
            </div>

			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					
        		<div class="row">

        			@foreach($contents->items as $content)
        			<div class="col-sm-4 col-sm-auto  mb-4">
    						<div class="card  h-100 shadow card-block rounded">
  				 				<img class="card-img-top" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}">
  				 				
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
    								<a href="{{ \App\Classes\Rev\BookClass::get_slug($content->activity->id) }}" class="btn btn-primary btn-lg btn-block text-white" style=" cursor: pointer; background-color: #2C97DE; border-color: #2C97DE;"><i class="fas fa-info-circle"></i> More info</a>
  								</div>
							</div>
    				</div>
					@endforeach

				</div>
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


<section id="review" style="background-color:#ffffff">
<div class="container">
	<div class="row">
    
    	<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">How Our New Friend Talk About The Tour</h3>
                    <!-- h4 class="section-subheading text-muted"><a href="https://www.tripadvisor.com/UserReview-g12872450-d15646790-Yogyakarta_Night_Walking_and_Food_Tours-Sleman_District_Yogyakarta_Region_Java.html" target="_blank" class="text-danger"><i class="fab fa-tripadvisor" aria-hidden="true"></i>  Review us on Trip Advisor</a></h4 -->
<div  itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">	
		    			<strong> Rating :</strong>
                    	<span class="text-warning">
		        			<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <span class="text-danger" itemprop="ratingValue">(4.9)</span>
		    			</span>‎
                    	<br>
                    	<small class="form-text text-muted">Based on <span itemprop="reviewCount">{{ $count }}</span> our new friend reviews</small>
                    	
                    </div>
					
                    
                    
                    
                                        
                    <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
					

                    
				</div>
			</div>
		</div>
    
    <div class="col-lg-8 col-md-10 mx-auto">
    <br>
    <table id="dataTables-example" style="width:100%">
			<tbody>           
			</tbody>
	</table>
    </div>
    </div>
</div>
<div style="height:50px;"></div>
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