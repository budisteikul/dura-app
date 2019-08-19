@extends('layouts.frontend')
@section('title', $act_name .' | '. $app_name)
@section('content')
@push('scripts')
<script type="text/javascript">
			jQuery(document).ready(function($) {	
			
     		//$.fn.dataTable.ext.errMode = () => window.parent.location = '/login';
			var table = $('#dataTables-example').DataTable(
			{
				
				"processing": true,
       			"serverSide": true,
        		"ajax": '/',
				"scrollX": true,
				"language": {
    				"paginate": {
      					"previous": "<i class='fa fa-step-backward'></i>",
						"next": "<i class='fa fa-step-forward'></i>",
						"first": "<i class='fa fa-fast-backward'></i>",
						"last": "<i class='fa fa-fast-forward'></i>"
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytics }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $google_analytics }}');
</script>
@endpush
    
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<div class="container">
		<a class="btn btn-danger" href="/order"><i class="fa fa-bolt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Instant Book</strong></span></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#about">The Tour</a>
				</li>
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#review">Reviews</a>
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

<header id="page-top" class="intro-header" style="background-image: url('https://static.budi.my.id/assets/foodtour/tugu-dark-1.0.1.jpg'); background-color: #B0B0B0">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:20px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img alt="{{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/logo-jogja-istimewa-png-4.png" width="250">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555;">{{ $act_name }}</h1>
				<p class="text-faded">
                    Book for tonight? It's Ok!
         			<br>
         			Because we can start the tour every day at 6.30 pm.
		 			And our meeting point is Tugu Yogyakarta Monument (Tugu Pal Putih).
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
		</div>
    </div>
</header>



 <!-- Post Content -->
<article id="about">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
        
        
        <div>
        
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:0px;">About The Tour</h3>
					<h4 class="section-subheading text-muted">And So Our Adventure Begins</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			
			<p>
            	
				<div>
					<span style="width:30px;" class="fa fa-store"></span><strong> Name :</strong> 
                    <span itemprop="name" content="{{ $act_name }}">{{ $act_name }}</span><br />
                    <span style="width:30px;" class="fa fa-walking"></span><strong> Tour Mode :</strong> Walk and Trishaw<br />
					<span style="width:30px;" class="fa fa-stopwatch"></span><strong> Duration :</strong> 3 hours start at 6.30 pm<br />
					<span style="width:30px;" class="fa fa-bars"></span><strong> Type :</strong> Open Trip<br />
					<span style="width:30px;" class="fa fa-language"></span><strong> Language :</strong> Offered in English<br />
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    	<span style="width:30px;" class="fa fa-tags"></span><strong> Price :</strong>
                    	<span itemprop="priceCurrency" content="USD">$</span>
                    	<span itemprop="price" content="37.70">37.70</span>
    					<link itemprop="availability" href="http://schema.org/InStock" /> / person
                        <meta itemprop="priceValidUntil" content="2020-11-05" />
                        <link itemprop="url" href="https://www.vertikaltrip.com" />
                	</div>
                    
                   
                    <div itemprop="brand" itemtype="http://schema.org/Thing" itemscope>
      					<meta itemprop="name" content="VERTIKAL TRIP" />
    				</div>
                    
                    <br>
                    
                    
                    
                    <meta itemprop="sku" content="15055852112" />
                    <meta itemprop="mpn" content="15055852112" />
                    <div class="bd-callout bd-callout-danger w-100" style="margin-right:5px;">
						<span style="width:30px;" class="fa fa-map-marked-alt"></span><strong> Meeting point :</strong>
						<br>
                        <a href="https://goo.gl/maps/bsk9cGSh9iuUX7e46"><img src="https://static.budi.my.id/assets/foodtour/google-maps.jpg" height="45" alt="Book {{ $act_name }} via Google Maps"></a><br>
                        <a class="text-danger" href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">
                        
						Tugu Yogyakarta Monument (Tugu Pal Putih)<br />	
						Cokrodiningratan, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233</a>
                    	<br>
						<small class="form-text text-muted">
                        <a class="text-muted" href="https://goo.gl/maps/bsk9cGSh9iuUX7e46">
                        You can also buy tickets through on Google Maps. Click to open Map
                        </a>
                        </small>
                    </div>
                    
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
				Yogyakarta’s Imaginary Line is an imaginary straight line drawn from the southern beach Parang Kusumo with Mount Merapi. Journey through a part of the city's imaginary line, from Tugu Yogyakarta Monument to Southern City Square. <span itemprop="description"> Enjoy Jogja in Local Ways. Join us on this experience to try authentic Javanese dishes, play traditional games, travel on a becak, learn interesting fun facts about city, interact with locals and many more.</span>
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
				<h2 class="section-heading">What to bring</h2>
				- Please be hungry, because a lot of food is to be tried out during this tour.<br />
				- Wear comfortable and relax clothing.<br />
				- And don't forget to bring your camera to take some nice pictures.<br />
                </div>
			</p>
          	
            <div>
			<center>
				<br>
				<img width="400" itemprop="image" alt="Malioboro Street | {{ $act_name }}" class="img-fluid rounded" src="https://static.budi.my.id/assets/foodtour/malioboro-street.jpg">
				<span class="caption text-muted">Malioboro Street</span>
				<br>
			</center>
            </div>
          
			<p>
            	<div>
				<b>Tugu Yogyakarta Monument - Southern City Square</b><br />
				From our meeting point Tugu Yogyakarta Monument, we go to the south through a part of the Yogyakarta's imaginary line ( Malioboro Road, Nirboyo Gate, Yogyakarta Palace, East Fortess Corner etc). Along the journey, we will enjoying the nighttime atmosphere of Yogyakarta and discover a variety of activities and food until we reach the Southern City Square ( Alun - Alun Kidul ).
                </div>
			</p>
			
		
        </div>
        
        
        
        </div>
    </div>
</div>
</article> 

<section id="review" style="background-color:#ffffff">
<div class="container">
	<div class="row">
    
    	<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">New Friend Reviews</h3>
					<h4 class="section-subheading text-muted">They are not guests, they are our new friends</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
		</div>
    
    	<div class="col-lg-8 col-md-10 mx-auto">
        
    				<div  itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">	
		    			<strong> Rating :</strong>
                    	<span class="text-warning">
		        			<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <span class="text-danger" itemprop="ratingValue">(4.9)</span>
		    			</span>‎
                    	<br>
                    	<!-- a href="https://www.airbnb.com/experiences/434368" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/airbnb-button.jpg" height="45" alt="Book {{ $act_name }} via AirBNB" ></a>
						<a href="https://www.tripadvisor.com/AttractionProductDetail-g294230-d15646790.html" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/tripadvisor-button.jpg" height="45" alt="Book {{ $act_name }} via TripAdvisor" ></a>
                    	<br --><small class="form-text text-muted">Based on <span itemprop="reviewCount">27</span> our new friend reviews</small>
                    	<br>
                    </div>
                    
                    <div itemprop="review" itemtype="http://schema.org/Review" itemscope>
      					<div itemprop="author" itemtype="http://schema.org/Person" itemscope>
       						 <meta itemprop="name" content="New friends" />
      					</div>
      					<div itemprop="reviewRating" itemtype="http://schema.org/Rating" itemscope>
        					<meta itemprop="ratingValue" content="5" />
        					<meta itemprop="bestRating" content="5" />
      					</div>
    				</div>
                    
    </div>
        
    <div class="col-lg-8 col-md-10 mx-auto">
    <table id="dataTables-example" style="width:100%">
			<tbody>           
			</tbody>
	</table>
    </div>
    
    </div>
</div>
<div style="height:50px;"></div>
</section>

<section id="gallery" style="background-color:#f7f8f9">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">A Snapshot of Happiness</h3>
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
					<img class="img-fluid rounded" alt="Becak | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/becak.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Alun - alun kidul | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/paddle-car.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/masangin.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/customer2.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/customer3.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Small Groups | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/small-groups.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        		
               
			</div>
		</div>
	</div>
</div>
</section>



<section id="guide" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row">
				<div class="col-lg-12 text-center">
				<h3 class="section-heading" style="margin-top:50px;">Our Amazing Team</h3>
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
					<img alt="Tour Guide | {{ $act_name }}" class="mx-auto rounded-circle" width="200" src="https://static.budi.my.id/assets/foodtour/ratna.jpg" >
					<h4>Kalika Ratna</h4>
					<p class="text-muted">Your Local Friend<br /><span class="text-danger">On duty</span></p>
                    
					<br><br>
				</div>
			</div>
           
            
            
            <div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | {{ $act_name }}" class="mx-auto rounded-circle" width="200" src="https://static.budi.my.id/assets/foodtour/vella.jpg" >
					<h4>Vella Sekar</h4>
					<p class="text-muted">Your Local Friend</p>
					<br><br>
				</div>
			</div>
        	
            
            
        </div></div>
        
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