@extends('layouts.frontend')
@section('content')
@push('scripts')
@endpush
  
 <div  itemscope itemtype="http://schema.org/Product" style="background-color:#FFFFFF"> 
    
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav">
	<div class="container">

@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="aaa.com")
<noscript><a href="https://shinjukufoodtour.eventbrite.com" rel="noopener noreferrer" target="_blank"></noscript>
<button class="btn btn-danger text-white" id="eventbrite-widget-modal-trigger-89790045443" type="button"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></button>
<noscript></a>Book now on Eventbrite</noscript>
<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<script type="text/javascript">
    var exampleCallback = function() {
        console.log('Order complete!');
    };

    window.EBWidgets.createWidget({
        widgetType: 'checkout',
        eventId: '89790045443',
        modal: true,
        modalTriggerElementId: 'eventbrite-widget-modal-trigger-89790045443',
        onOrderComplete: exampleCallback
    });
</script>
@else
<a class="btn btn-danger text-white " href="/booking/izakaya-food-tour-in-shinjuku/"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></a>	

@endif

		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#services">Why Shinjuku Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#gallery">Snapshot</a>
				</li>

                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#guide">Tour Guide</a>
				</li>
				
				
				
			</ul>
		</div>
		
		
		
		
    </div>
  </nav>

<header id="page-top" class="intro-header" style="background-image: url('/assets/shinjuku-food-tour/shinjuku-at-night.jpg'); background-color: #000000">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:20px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/shinjuku.png">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555;">Shinjuku Night Walking and Food Tours</h1>
				<p class="text-faded">
                   Enjoy classic Japanese experience at our selected restaurants. Local food & drinks as we journey through Tokyo’s busiest area in Shinjuku.
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
					<h3 class="section-heading" style="margin-top:50px;">Why Shinjuku Food Tour?
        <br>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
      
      <div class="row text-left">
        
        <div class="col-md-8 mx-auto">
        	Have you been to an izakaya style restaurant back home? It maybe a fancy dining restaurant. Izakaya means a Japanese gastropub and it plays a big role in the Japanese food and drink culture. We believe that izakaya are one of the best ways to try great Japanese food and drinks. Do you want to eat good food? Go to an izakaya.
<br><br>
A little bit of (boring) history… It is said that the izakaya style originally started as a standing sake shop or bar. Some stores started using sake barrels as stools and later on, these stores started serving food and snacks. 
<br><br>
Here is what is unique about izakaya:
<br>
- Sit-down dinner with drinks<br>
- Dish portions are relatively large, so dishes are shared within the group. <br>
- A small appetizer, “otoshi” is automatically served and added to your bill in lieu of a cover or table charge. <br>
- Most izakaya restaurants specialize in certain types of dishes to differentiate themselves. <br>
<br>
In Japan, it is very common to dine and drink with coworkers. It is expected to go out, socialize, and build better working relationships as a team, so almost everybody goes out even on weekdays. You will probably want to take advantage of the competitive restaurant industry in Japan. Even chain restaurants serve relatively good quality food and drinks. 
<br><br>
We spent a lot of time evaluating those izakaya restaurants to take you to hidden gems and popular places among locals. On our Shinjuku Izakaya tour, you will eat and drink like a local and indulge in the local izakaya style. The tour also comes with two drinks (e.g. beer, Japanese whiskey, or seasonal sake, etc). 
<br><br>
Why do a tour in Shinjuku? Shinjuku has a lot of offer given its rich history and culture. Shinjuku station is the biggest station in the world by passenger size. It is not just big but is a hub for entertainment, sub-culture, and food and drink industry. You will see a lot of aspects of Shinjuku you would not see by yourself. 
<br><br>
Are ready to explore Shinjuku with us?
       
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
					<h3 class="section-heading" style="margin-top:0px;">Explore Japan Through our Shinjuku Food Tour</h3>
					<h4 class="section-subheading text-muted">And So Our Adventure Begins</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			
			<p>
            	
				<div>
					<span style="width:30px;" class="fa fa-store"></span><strong> Name :</strong> 
                    <span itemprop="name" content="Shinjuku Night Walking and Food Tours">Shinjuku Night Walking and Food Tours</span><br />
                    <span style="width:30px;" class="fa fa-walking"></span><strong> Tour Mode :</strong> Walk<br />
					<span style="width:30px;" class="fa fa-stopwatch"></span><strong> Duration :</strong> 3 hours start at 5.00 pm<br />
					<span style="width:30px;" class="fa fa-bars"></span><strong> Type :</strong> Open Trip<br />
					<span style="width:30px;" class="fa fa-language"></span><strong> Language :</strong> Offered in English<br />
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    	<span style="width:30px;" class="fa fa-tags"></span><strong> Price :</strong>
						
                    	<span itemprop="priceCurrency" content="USD"></span>
                    	<span itemprop="price" content="99.00"></span>
						
				
				 99 USD / person
				
			
    					<link itemprop="availability" href="http://schema.org/InStock" />
                        <meta itemprop="priceValidUntil" content="2020-11-05" />
                        <link itemprop="url" href="https://www.shinjukufoodtour.com" />
                	</div>
                    
                   
                    <div itemprop="brand" itemtype="http://schema.org/Thing" itemscope>
      					<meta itemprop="name" content="VERTIKAL TRIP" />
    				</div>
                    
                    <br>
                    
                    
                    
                    <meta itemprop="sku" content="15055852112" />
                    <meta itemprop="mpn" content="15055852112" />
                    <meta itemprop="image" content="/assets/shinjuku-food-tour/picture/d07edfbc-0d99-4260-b595-0cc0dba324d5.jpeg" />
                    
                    
				</div>
			</p>
            <p>
            	<div>
				<h2 class="section-heading">Highlights</h2>
				- Taste authentic Izakaya food tastings at popular restaurants <br />
				- Enjoy local drinks paired with food <br />
				- Learn Japanese history, customs and culture with a fun guide <br />
				- Visit popular landmarks of Shinjuku (e.g. Goden Gai) <br />
				- Get travel & restaurant tips from your guide for your trip <br />
                </div>
			</p>
            <p>
            	<div>
				<h2 class="section-heading">Overview</h2>
				Enjoy classic Japanese experience at our selected restaurants. Local food & drinks as we journey through Tokyo’s busiest area in Shinjuku.
<br><br>
- 7+ mouth-watering Japanese food tastings, enough for a full dinner meal, served from three selected restaurants.<br>
- Drinks to taste great Izakaya style dinner. You may also choose your drinks (Beer, Sake & other drinks). Non-alcoholic beverage also available.<br>
- Explore Shinjuku visiting famous must-see spots as well as hidden gems. Enjoy unique views of Tokyo’s neon town, Kabukicho.<br>
<br>
Please let us know if you have any food restrictions beforehand. 
                <meta itemprop="description" content="Enjoy classic Japanese experience at our selected restaurants. Local food & drinks as we journey through Tokyo’s busiest area in Shinjuku." />
                </div>
			</p>

			<p>
            	<div>
				<h2 class="section-heading">Inclusions</h2>
				- Dinner - 7+ Japanese Izakaya Food Course Meal<br>
				- Alcoholic Beverages - Two Drinks of your choice <br />
                </div>
			</p>
          
			<p>
            	<div>
				<h2 class="section-heading">Little things to remember</h2>
- Confirmation will be received at time of booking<br>
- Not wheelchair accessible<br>
- Stroller accessible<br>
- Near public transportation<br>
- Infants must sit on laps<br>
- Infant seats available<br>
- Most travelers can participate<br>
- This experience requires good weather. If it’s canceled due to poor weather, you’ll be offered a different date or a full refund<br>
                </div>
			</p>
          	
        	<br>
            <div class="bd-callout bd-callout-danger w-100" style="margin-right:5px;">
						<span style="width:30px;" class="fa fa-map-marked-alt text-danger"></span><strong class="text-danger"> Meeting/Redemption  point</strong><br>
                        <br>
                        - You will receive a confirmation email and voucher instantly after booking
						<br>
                        - You can present a mobile voucher for this activity to our tour guide
                        <br>
<br>
                        <img src="/assets/foodtour/google-maps.jpg" height="45" alt="Book Shinjuku Night Walking and Food Tours via Google Maps"><br>
                        
                        <br>
                        <div class="map-responsive">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.317305444635!2d139.69599171474655!3d35.69380853689047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188be3a966f1a7%3A0xe00102a92dab54eb!2sIbis%20Tokyo%20Shinjuku!5e0!3m2!1sen!2sid!4v1579885466638!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>
                        
                        <br>
                        
						Ibis Tokyo Shinjuku<br>
						7-10-5 Nishi-Shinjuku, 160-0023 Nishishinjuku, Japan
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
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/0fdcb556-8a15-46e9-87e3-289a32d50ea4.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/43b7efab-1e07-4b5f-ad3a-fd6cedf1917f.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/573ef11d-f664-44e2-8899-082e2baac88e.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/57e52a5b-1c15-4c57-ae61-69c3822e8220.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/8a037aa6-6527-4845-b704-08308c5673c0.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/928dad26-9733-40e7-b777-a9e35645a24f.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/d07edfbc-0d99-4260-b595-0cc0dba324d5.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/da77635b-4cbd-4373-bef5-5ef917b138a8.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
                
                <div class="col-lg-4 col-sm-6">
					<img class="img-fluid shadow p-1 bg-white rounded" alt="Shinjuku Night Walking and Food Tours" src="/assets/shinjuku-food-tour/picture/fed1ece9-d573-4097-bb8c-0f4225f7db5e.jpeg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        		
               
			</div>
		</div>
	</div>
</div>
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
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/food-tour-japan-yuma-wada-200x200.jpg" >
					<h4>Yuma</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
           
            
            
            <div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/Osaka_Tour_Guide_Foodie-200x200.jpg" >
					<h4>Rino</h4>
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