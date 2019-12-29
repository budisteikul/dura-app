@extends('layouts.frontend')
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
  
 <div  itemscope itemtype="http://schema.org/Product" style="background-color:#FFFFFF"> 
    
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav">
	<div class="container">

@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="aaa.com")
<noscript><a href="https://jogjafoodtour.eventbrite.com" rel="noopener noreferrer" target="_blank"></noscript>
<button class="btn btn-danger text-white" id="eventbrite-widget-modal-trigger-77732854059" type="button"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></button>
<noscript></a>Book now on Eventbrite</noscript>
<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<script type="text/javascript">
    var exampleCallback = function() {
        console.log('Order complete!');
    };

    window.EBWidgets.createWidget({
        widgetType: 'checkout',
        eventId: '77732854059',
        modal: true,
        modalTriggerElementId: 'eventbrite-widget-modal-trigger-77732854059',
        onOrderComplete: exampleCallback
    });
</script>
@else
<a class="btn btn-danger text-white" href="/tour/yogyakarta-night-walking-and-food-tours/time_selector"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></a>
@endif






       
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#services">Why Jogja Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#review">Reviews</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#guide">Tour Guide</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="https://www.vertikaltrip.com">Another Tour</a>
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
				<h1 id="title" style="text-shadow: 2px 2px #555555;">Yogyakarta Night Walking and Food Tours</h1>
				<p class="text-faded">
                    Book for tonight? It's Ok! We can start the tour every day.
		 			<br>
                    Use promotional code <span class="badge badge-danger">HAPPYNIGHT</span> to save <span class="badge badge-danger">10%</span> off our previously offered price!
					<br>
					Valid for Yogyakarta Night Walking and Food Tours
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
		</div>
    </div>
</header>



<!-- Services -->
  <section class="page-section" id="services" style="background-color:#f2f2f2">
    <div class="container">
      
        	<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-8 text-center mx-auto">
					<h3 class="section-heading" style="margin-top:50px;">Yogyakarta: The way to this city’s heart is through its food</h3>
                    Perhaps better known for being a bastion of history and culture,<br>
Yogyakarta is also the unofficial culinary capital of Indonesia
        <br>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
      
      <div class="row text-center">
        
        <div class="col-md-8 mx-auto">
        
        <img src="/assets/foodtour/silkwinds.jpg" class="img-fluid rounded">
        <span class="caption text-muted"><a class="text-muted"  target="_blank" href="https://www.silverkris.com/yogyakarta-the-way-to-this-citys-heart-is-through-its-food/">Silkwinds Magazine</a></span>
        </div>
        
        
      </div>
    </div>
    <br><br>
  </section>







 <!-- Post Content -->
<article id="about">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
        
        
        <div>
        
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:0px;">Explore Yogyakarta Through our Jogja Food Tour</h3>
					<h4 class="section-subheading text-muted">And So Our Adventure Begins</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			
			<p>
            	
				<div>
					<span style="width:30px;" class="fa fa-store"></span><strong> Name :</strong> 
                    <span itemprop="name" content="Yogyakarta Night Walking and Food Tours">Yogyakarta Night Walking and Food Tours</span><br />
                    <span style="width:30px;" class="fa fa-walking"></span><strong> Tour Mode :</strong> Walk and Trishaw<br />
					<span style="width:30px;" class="fa fa-stopwatch"></span><strong> Duration :</strong> 3 ~ 4 hours start at 6.30 pm<br />
					<span style="width:30px;" class="fa fa-bars"></span><strong> Type :</strong> Open Trip<br />
					<span style="width:30px;" class="fa fa-language"></span><strong> Language :</strong> Offered in English<br />
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    	<span style="width:30px;" class="fa fa-tags"></span><strong> Price :</strong>
						
                    	<span itemprop="priceCurrency" content="USD"></span>
                    	<span itemprop="price" content="40.00"></span>
						
				
				 40 USD / person
				
			
    					<link itemprop="availability" href="http://schema.org/InStock" />
                        <meta itemprop="priceValidUntil" content="2020-11-05" />
                        <link itemprop="url" href="https://www.jogjafoodtour.com" />
                	</div>
                    
                   
                    <div itemprop="brand" itemtype="http://schema.org/Thing" itemscope>
      					<meta itemprop="name" content="VERTIKAL TRIP" />
    				</div>
                    
                    <br>
                    
                    
                    
                    <meta itemprop="sku" content="15055852112" />
                    <meta itemprop="mpn" content="15055852112" />
                    
                    
				</div>
			</p>
            <p>
            	<div>
				<h2 class="section-heading">Highlights</h2>
				- If you like food and want to experience Jogja culture <br />
				- The walking tour part was a good introduction to the city <br />
				- Travel on a becak (Traditional Public Transportation) <br />
				- Learn interesting fun facts about Yogyakarta <br />
				- Enjoying the nighttime atmosphere of Yogyakarta <br />
                </div>
			</p>
            <p>
            	<div>
				<h2 class="section-heading">Overview</h2>
				See a different side of Yogyakarta, Indonesia’s cultural capital, on this fun night tour jam-packed with street food delights. Join your guide and no more than seven other travelers in the city center, then board a “becak” rickshaw to tour the sights. Savor the light, sweet flavors of Javanese cuisine; soak up the vibrant atmosphere of this university city; try traditional games; and enjoy fairground rides at Alun-Alun Kidul.
                <meta itemprop="description" content="Enjoy Jogja in Local Ways. Join us on this experience to try authentic Javanese dishes, play traditional games, travel on a becak, learn interesting fun facts about city, interact with locals and many more." />
                </div>
			</p>

			<p>
            	<div>
				<h2 class="section-heading">Inclusions</h2>
				- Local Guide (English Speaking) <span class="fa fa-user"></span><br>
				- Mineral water 600 ml <span class="fa fa-prescription-bottle"></span><br />
				- Fee of all activities at Alun - Alun Kidul (masangin, paddle car, etc) <span class="fa fa-ticket-alt"></span><br />
				- Becak (Yogyakarta traditional trishaw) <span class="fa fa-car"></span><br />
				- Raincoat, if it's rain <span class="fa fa-briefcase"></span><br />
				- Many types of Javanese authentic snack, food and drink <span class="fa fa-utensils"></span><br />
                </div>
			</p>
          
			<p>
            	<div>
				<h2 class="section-heading">Little things to remember</h2>
				- Please be hungry, because a lot of food is to be tried out during this tour.<br />
				- Wear comfortable footwear and relax clothing.<br />
				- And don't forget to bring your camera to take some nice pictures.<br />
                </div>
			</p>
          	
            <p>
            	<div>
				<h2 class="section-heading">Aditional Info</h2>
				- Free for infant (Age under 5 years old) and must be accompanied by adult <br />
				- Not wheelchair accessible <br />
				- No minimum booking number of person <br />
				- This tour/activity will have a maximum of 8 travelers <br />
				- Most travelers can participate <br />
                </div>
			</p>
            
			<center>
				<br>
				<img width="400" itemprop="image" alt="Gudeg Jogja | Yogyakarta Night Walking and Food Tours" class="img-fluid rounded" src="/assets/foodtour/gudeg-jogja.jpg">
				<span class="caption text-muted">Gudeg Jogja</span>
			</center>
            
		
        	<br>
            <div class="bd-callout bd-callout-danger w-100" style="margin-right:5px;">
						<span style="width:30px;" class="fa fa-map-marked-alt text-danger"></span><strong class="text-danger"> Meeting/Redemption  point</strong><br>
                        <br>
                        - You will receive a confirmation email and voucher instantly after booking
						<br>
                        - You can present a mobile voucher for this activity to our tour guide
                        <br>
<br>
                        <img src="/assets/foodtour/google-maps.jpg" height="45" alt="Book Yogyakarta Night Walking and Food Tours via Google Maps"><br>
                        
                        <br>
                        <div class="map-responsive">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0649523361567!2d110.36486611421002!3d-7.7829383793810685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58373fffffff%3A0xffb2d5ffd8a9bd10!2sTugu%20Pal%20Putih!5e0!3m2!1sen!2sid!4v1566909137586!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>
                        
                        <br>
                        
						Tugu Yogyakarta Monument (Tugu Pal Putih)<br />	
						Cokrodiningratan, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233
                    	<br>
						<!-- small class="form-text text-muted">
                        <a class="text-muted" href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">
                        You can also buy tickets through on Google Maps via Google Reservation. Click to open Map
                        </a>
                        </small -->
                    </div>
        </div>
        
        
        
        </div>
    </div>
</div>
</article> 



<section id="gallery" style="background-color:#f2f2f2">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">The Snapshot of Happiness</h3>
					<h4 class="section-subheading text-muted">Enjoy the Little Things</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row text-center" style="padding-bottom:0px;">
				
                	
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/becak.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/5.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/masangin.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/1.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/4.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/small-groups.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/2.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/6.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="New Friend | Yogyakarta Night Walking and Food Tours" src="/assets/foodtour/3.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
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
					
                    
                    
                    
                    <div itemprop="review" itemtype="http://schema.org/Review" itemscope>
      					<div itemprop="author" itemtype="http://schema.org/Person" itemscope>
       						 <meta itemprop="name" content="Airbnb and Trip Advisor user" />
      					</div>
      					<div itemprop="reviewRating" itemtype="http://schema.org/Rating" itemscope>
        					<meta itemprop="ratingValue" content="5" />
        					<meta itemprop="bestRating" content="5" />
      					</div>
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

<section id="guide" style="background-color:#f2f2f2">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row">
				<div class="col-lg-12 text-center">
				<h3 class="section-heading" style="margin-top:50px;">Our Amazing Tour Guide</h3>
				<h4 class="section-subheading text-muted">Wholeheartedly as a Local Friend</h4>
				<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			<br>
		</div>
        
     </div>
     <div class="row justify-content-center"> 
     <div class="row col-8">       
        
            
        	<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Yogyakarta Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/foodtour/ratna.jpg" >
					<h4>Kalika Prajna</h4>
					<p class="text-muted">Your Local Friend<br /><span class="text-danger">On duty</span></p>
                    
					<br><br>
				</div>
			</div>
           
            
            
            <div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Yogyakarta Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/foodtour/vella.jpg" >
					<h4>Vella Sekar</h4>
					<p class="text-muted">Your Local Friend</p>
					<br><br>
				</div>
			</div>
        	
            
            
        </div></div>
        
	</div>
</div>
</section>







</div>

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