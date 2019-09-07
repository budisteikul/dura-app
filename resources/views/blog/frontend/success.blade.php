@extends('layouts.frontend')
@section('content')
@push('scripts')
@endpush
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/"><span class="fa fa-angle-double-left"></span> Back to home</a>
	</div>
</nav>   
<div style="height:55px;"></div>
<section id="success" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">Thank you for booking our tour</h3>
                    <h4 class="section-subheading text-muted">
                    We will contact you immediately	
                    </h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
     	 </div>
        
         <div class="col-lg-8 col-md-10 mx-auto">
         	<div class="row" style="padding-bottom:80px; padding-top:30px;">
				<div class="col-lg-12 text-center">
         			Yogyakarta Night Walking and Food Tours will start at 6.30pm.<br>
						Our meeting point is Tugu Yogyakarta Monument.<br>
                        
         		</div>
             </div>
        </div>
          
</div>
</section>
@endsection