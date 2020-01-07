@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')


@endpush

@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="budi.my.id")

					
@elseif(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	
	
	
	<div class="container">
		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50" style="margin-top:2px;margin-bottom:2px;"></a>

	</div>
</nav>							
@else   
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	
	
	
	<div class="container">
		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>

		
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/indonesia-food-tour/">Indonesia Food Tour</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/japan-food-tour/">Japan Food Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/france-food-tour/">France Food Tour</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/mexico-food-tour/">Mexico Food Tour</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/trinidad-and-tobago-food-tour/">Trinidad and Tobago Food Tour</a>
				</li>
				
			</ul>
		</div>
        
        
	</div>
</nav>
@endif 
<div style="height:15px;"></div>


<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>	
                
{!! $post !!}
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection