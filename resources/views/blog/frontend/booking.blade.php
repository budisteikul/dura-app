@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')
<style>
html, body {
    font-size: 14px;
    font-family: -apple-system, BlinkMacSystemFont, Roboto, "Helvetica Neue", sans-serif;
}
body {
    background-color: transparent;
    color: rgb(52, 64, 78);
    font-style: normal;
    font-variant-ligatures: normal;
    font-variant-caps: normal;
    font-variant-numeric: normal;
    font-variant-east-asian: normal;
    font-weight: normal;
    font-stretch: normal;
    line-height: normal;
    touch-action: manipulation;
    margin: 0px;
    overflow: auto !important;
}
h1 {
    display: block;
    font-size: 2em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    margin-bottom: 8px;
}
h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    margin-bottom: 8px;
}

div {
    line-height: 1.5;
    color: rgba(0, 0, 0, 0.7);
}
</style>
@endpush



<!-- ################################################################### -->

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
	
	
	
		@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>
		@else
		<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img height="40" style="margin-top:9px;margin-bottom:9px;" src="/assets/foodtour/9_bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a>
		@endif
		
		@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="budi.my.id" || str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")

		<!-- button class="navbar-toggler navbar-toggler-right border-dark" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-search text-white"></span>
		</button>
		
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<div class="form-group has-search text-uppercase ml-auto">
				<input type="text" style="margin-top:15px;" class="form-control" placeholder="Search">
			</div>
		</div -->
		
		
		@else

        <!-- button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/indonesia/"><i class="fa fa-map-marker-alt"></i>  Indonesia</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/japan/"><i class="fa fa-map-marker-alt"></i> Japan</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/france/"><i class="fa fa-map-marker-alt"></i> France</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/mexico/"><i class="fa fa-map-marker-alt"></i> Mexico</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/trinidad/"><i class="fa fa-map-marker-alt"></i> Trinidad</a>
				</li>


				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/india/"><i class="fa fa-map-marker-alt"></i> India</a>
				</li>

				
			</ul>
		</div -->
        
        @endif

	</div>
</nav>

<div style="height:25px;"></div>


@if($product_page)
<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row">
  	
    <div class="col-sm-8 col-sm-auto">
    	<div style="height:66px;"></div>
      		{!! $product !!}
    </div>
    <div class="col-sm-4">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
  			<div class="card-header text-white bg-danger"><h5>Book Now</h5></div>
 				 <div class="card-body" style="padding-left:0px;padding-right:0px;padding-top:5px;padding-bottom:15px;">
    				{!! $calendar !!}
  				</div>
			</div>
     		
        <div style="height:35px;"></div>
    </div>
    
  </div>
</div>
</section>

@else
<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>	
           
				{!! $product !!}
				
					
				<div style="height:10px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endif

@endsection