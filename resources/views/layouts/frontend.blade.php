<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="
	@hasSection('description')
		@yield('description')
	@else
			@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
				Enjoy Jogja in Local Ways. Join us on this experience to try authentic Javanese dishes, play traditional games, travel on a becak, learn interesting fun facts about city, interact with locals and many more.
			@else
				Hi we are from the Vertikal Trip team, we will give you complete Yogyakarta atmosphere, tradition, food, and culture. Along the journey we will accompany you so you can feel the real with locals experience with us, share our stories, experiences and traditions.
			@endif
	@endif
	">
    <meta name="author" content="Vertikal Trip LLC">
    <meta name="robots" content="all,index,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#2e3237">
	<meta name="msapplication-TileColor" content="#2e3237">
	<meta name="theme-color" content="#2e3237">
    <title>
	@hasSection('title')
		@yield('title')
	@else
		@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
			Yogyakarta Night Walking and Food Tours
		@else
			Book Amazing Things to do in Yogyakarta
		@endif
	@endif
	</title>
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet" type="text/css" media="screen,handheld">
	<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css' media="screen,handheld">
	<script src="/js/vertikaltrip-1.1.0.js"></script>
	<link href="/css/vertikaltrip-1.1.3.css" rel="stylesheet" media="screen,handheld">
    
    
  
    
<!-- script>
          if ('serviceWorker' in navigator ) {
            window.addEventListener('load', function() {
				caches.delete('sw-precache-v3-pwa-');
                navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
</script -->    
    
    @stack('scripts')
	
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d1810cb22d70e36c2a3697f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();


</script>
<!--End of Tawk.to Script-->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     

</head>
<body class=" bg-dark">


	@yield('content')

<footer class="py-5" style="font-size:16px; background-color:#dedede">
<div class="container">
    <div class="row">
		<div class="row col-md-12">
           	
            	<div class="col-sm-4 first-column mb-4">
                	<p class="m-0 text-left text-dark">
					
						<img src="/logo-dark.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;">
						<br>
						
						INFO AND RESERVATION
						<br>
						We're happy to help
						<br>
						
							<span class="fab fa-whatsapp"></span> Whatsapp : <a class="badge badge-danger" href="https://wa.me/+6285743112112">+62 857-4311-2112</a> <br>
							<span class="fa fa-envelope"></span> Email : <a href="mailto:guide@vertikaltrip.com" class="badge badge-danger" target="_blank">guide@vertikaltrip.com</a>
						
						
						
                    </p>
                </div>
                
                <div class="col-sm-4 second-column">
                	<p class="m-0 text-left text-dark">
                    	PAYMENT CHANNEL
                    	<br>
                        
						<img src="/assets/foodtour/PP_Acceptance.png" height="35" alt="Buy now with PayPal"  style="margin-top:10px;margin-bottom:8px;">
					</p>
					
					<p class="m-0 text-left text-dark">
                    
					<small> 2020 &copy; VERTIKAL TRIP LLC</small>
                    
					</p>
                </div>
                
                <div class="col-sm-4 second-column align-middle">
                	
					
					<p class="mt-2 text-left text-dark align-middle">
                    
                    <div id="TA_cdswritereviewnew823" class="TA_cdswritereviewnew"><ul id="9UuVMjnO" class="TA_links pDIwwf3D"><li id="BIEq7gLF" class="zLcMli"><a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/medium-logo-29834-2.png" alt="TripAdvisor"/></a></li></ul></div><script async src="https://www.jscache.com/wejs?wtype=cdswritereviewnew&amp;uniq=823&amp;locationId=17523331&amp;lang=en_US&amp;lang=en_US&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
					</p>
                </div>
			
        </div>
        
       
        
    </div>
</div>
</footer>


</body>
</html>