@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	
	
	
	<div class="container">
		<ul class="navbar-nav text-uppercase">
            	<li class="nav-item">
					@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
						<a class="nav-link js-scroll-trigger"  href="/"><i class="fa fa-ticket-alt"></i>&nbsp;&nbsp;YOGYAKARTA NIGHT WALKING AND FOOD TOURS</a>
					@else
						<a class="nav-link js-scroll-trigger" href="/"><i class="fas fa-home"></i>&nbsp;&nbsp;VERTIKAL TRIP</a>
					@endif
					
				</li>
		</ul>
		
        
        <!-- button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button -->
		<!-- div class="stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="https://www.vertikaltrip.com/"><i class="fas fa-list"></i>&nbsp;&nbsp;LIST TOUR</a>
				</li>
			</ul>
		</div -->
        
        
	</div>
</nav>   
<div style="height:25px;"></div>


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