@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush

@php
    $thedomain = "VERTIKAL TRIP";
@endphp

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/assets/logo/logo.webp" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		@include('layouts.vt-menu')
        
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
        

                    
					<div class="row" style="padding-bottom:0px;">
						<div class="col-lg-12 text-center">
							<!-- h3 class="section-heading" style="margin-top:0px;">Payment method</h3 -->
							<h4 class="section-subheading text-muted">THANK YOU!</h4>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
						</div>
					</div>
					
                    <div class="row col-md-8  mx-auto text-left">
					<div class="textwidget" style=" min-height:250px;">
                    <p>&nbsp;</p>
<p>

Thank you for your booking with VERTIKAL TRIP.
 
Receipt and ticket will be sent to your email address

</p>						
	
                    </div>
    </div> 
  </div>
                    
                    
					
					
					
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection