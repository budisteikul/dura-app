<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="AtDcFU1Yadtr8qSpQQL86nxPnXGXAgveC60d4oZq0U0" />
    <meta name="description" content="
	@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
	Enjoy Jogja in Local Ways. Join us on this experience to try authentic Javanese dishes, play traditional games, travel on a becak, learn interesting fun facts about city, interact with locals and many more.
	@else
		Vertikal Trip connects travelers with local tour operators from all around the world
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
	@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
		Yogyakarta Night Walking and Food Tours
	@else
		Amazing Food Tour in The World | Book Online Now
	@endif
	</title>
    
	
	
	
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,700" rel="stylesheet" type="text/css" media="screen,handheld">
	<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css' media="screen,handheld">
	<script src="/js/vertikaltrip-1.0.9.js"></script>
	<link href="/css/vertikaltrip-1.0.9.css" rel="stylesheet" media="screen,handheld">
    
    
  
    
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

<footer class="py-5 bg-dark">
<div class="container">
    <div class="row">
		<div class="row col-md-8">
           	
            	<div class="col-sm-6 first-column mb-4">
                	<p class="m-0 text-left text-white">
                    	<!-- img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50" -->
					
						
						
						INFO AND RESERVATION
						<br>
						We're happy to help
						<br>
						<span class="fab fa-whatsapp"></span> Whatsapp : <a class="badge badge-danger" href="https://wa.me/+6285743112112">+62 857-4311-2112</a> <br>
						<span class="fa fa-envelope"></span> Email : <a href="mailto:guide@jogjafoodtour.com" class="badge badge-danger" target="_blank">guide@vertikaltrip.com</a>
						
                    </p>
                </div>
                
                <div class="col-sm-5 second-column">
                	<p class="m-0 text-left text-white">
                    	PAYMENT CHANNEL
						
						
						<br>
						<img src="/assets/foodtour/PP_AcceptanceMarkTray-NoDiscover_243x40.png" height="35" alt="Buy now with PayPal"  style="margin-top:10px;margin-bottom:5px;">
					
                    </p>
					@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour")
					<p class="m-0 text-left text-white">
					<small> <a class="text-danger" target="_blank" href="/page/terms-and-conditions">Terms and Conditions</a> </small>
					</p>
					@endif
					<p class="m-0 text-left text-white">
					<small> 2020 &copy; VERTIKAL TRIP LLC </small>
					</p>
                </div>
			
        </div>
        
       
        
    </div>
</div>
</footer>


</body>
</html>