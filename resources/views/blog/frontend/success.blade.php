@extends('layouts.index')
@section('title', $act_name .' | '. $app_name)
@section('google_analytics', $google_analytics)
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="/js/ratnawahyu.js"></script>
<link href="/css/ratnawahyu.css" rel="stylesheet">
<style>
.style-1 del {
  color: rgba(255, 0, 0, 0.5);
  text-decoration: none;
  position: relative;
}
.style-1 del:before {
  content: " ";
  display: block;
  width: 100%;
  border-top: 2px solid rgba(255, 0, 0, 0.8);
  height: 12px;
  position: absolute;
  bottom: 0;
  left: 0;
  transform: rotate(-7deg);
}
.style-1 ins {
  color: green;
  font-size: 28px;
  text-decoration: none;
  padding: 1em .11em 1em .5em;
}

.style-2 del {
  color: rgba(128, 128, 128, 0.5);
  text-decoration: none;
  position: relative;
  font-size: 40px;
  font-weight: 100;
}
.style-2 del:before {
  content: " ";
  display: block;
  width: 100%;
  border-top: 2px solid rgba(128, 128, 128, 0.8);
  border-bottom: 2px solid rgba(128, 128, 128, 0.8);
  height: 4px;
  position: absolute;
  bottom: 22px;
  left: 0;
  transform: rotate(-11deg);
}
.style-2 ins {
  font-size: 80px;
  font-weight: 100;
  text-decoration: none;
  padding: 1em 1em 1em .5em;
}

.style-3 del {
  color: rgba(255, 165, 0, 0.5);
  text-decoration: none;
  position: relative;
  font-size: 30px;
  font-weight: 100;
}
.style-3 del:before {
  content: " ";
  display: block;
  width: 100%;
  border-top: 8px double rgba(255, 165, 0, 0.8);
  height: 4px;
  position: absolute;
  bottom: 20px;
  left: 0;
  transform: rotate(-11deg);
}
.style-3 ins {
  font-size: 30px;
  font-weight: 800;
  text-decoration: none;
  padding: 1em .11em 1em .5em;
}

.style-4 del {
  color: rgba(169, 169, 169, 0.5);
  text-decoration: none;
  position: relative;
  font-size: 30px;
  font-weight: 100;
}
.style-4 del:before {
  content: " ";
  display: block;
  width: 100%;
  border-top: 3px solid rgba(169, 169, 169, 0.8);
  height: 4px;
  position: absolute;
  bottom: 20px;
  left: 0;
  transform: rotate(-11deg);
}
.style-4 del:after {
  content: " ";
  display: block;
  width: 100%;
  border-top: 3px solid rgba(169, 169, 169, 0.8);
  height: 4px;
  position: absolute;
  bottom: 20px;
  left: 0;
  transform: rotate(11deg);
}
.style-4 ins {
  font-size: 30px;
  font-weight: 800;
  text-decoration: none;
  padding: 1em .11em 1em .5em;
}

</style>
<script language="javascript">

function BOOKING()
{
	//$('#submit').prop('disabled', true);
	//$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	
	if($('#name').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The name field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#name').focus();
				
			});
		return false;	
	}
	
	if($('#email').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The email field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#email').focus();
				
			});
		return false;
	}
	
	if($('#phone').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The phone field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#phone').focus();
				
			});
		return false;	
	}
	
	$.ajax({
			data: {
        		"_token": '{{ csrf_token() }}',
				'name': $('#name').val(),
				'country': $('#country').val(),
				'os0': $('#os0').val(),
				'phone': $('#phone').val(),
				'email': $('#email').val(),
				'date': $('#date').val(),
        	},
			type: 'POST',
			url: '/booking'
			}).done(function( data ) {
			if(data.id=="1")
			{
				
			}
			else
			{
				return false;	
			}
		});
	
}
</script>

@endpush
    
   <!-- ################################################################### -->
   
<!-- ################################################################### -->
    
<!-- ################################################################### -->

<section id="contactus" style="background-color:#ffffff; margin-top:30px;">
<div class="container">
      <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h3 class="section-heading" style="margin-top:50px;">Thank you for booking our tour</h3>
            <h4 class="section-subheading text-muted">Our team will contact you immediately.</h4>
            <hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
          </div>
         
        </div>
        <p class="m-0 text-center">
        <a href="https://wa.me/+6285743112112"><img src="/assets/foodtour/whatsapp.jpg"></a>
        <br /><br />
        
        <span class="fa fa-location-arrow"></span> Tugu Yogyakarta Monument<br />Gowongan, Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233<br>
        <!-- span class="fa fa-phone"></span> +62 857-4311-2112<br / -->
        <span class="fa fa-envelope"></span> guide@vertikatrip.com<br />
        </p>
<br><br>
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