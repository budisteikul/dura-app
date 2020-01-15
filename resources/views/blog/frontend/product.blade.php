@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')
{!! $jscript !!}

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
		
@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="a.com")

	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#services">Why Jogja Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#review">Reviews</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#guide">Tour Guide</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#partner">Another Tour</a>
				</li>
				
			</ul>
		</div>
		
		

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
    	<div style="height:60px;"></div>
      		{!! $product !!}
    </div>
    <div class="col-sm-4">
    	<div style="height:54px;"></div>
    	<h4>Book Now</h4>
     		{!! $calendar !!}
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
				
					
				<div style="height:35px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>
@endif



@endsection