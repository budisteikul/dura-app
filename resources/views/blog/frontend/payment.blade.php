@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav-back">
	<div class="container">

		<a class="navbar-brand js-scroll-trigger" href="/">Vertikal Trip</a>
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
							<h3 class="section-heading" style="margin-top:0px;">Payment method</h3>
							<h4 class="section-subheading text-muted">Please choose a payment method</h4>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
						</div>
					</div>
				
					
					<div class="d-flex justify-content-center col-12">
					
					<a href="/book/stripe" class="text-decoration-none">
					<div class="bd-callout bd-callout-danger text-left text-dark" style="margin-right:5px;">
						<strong> Credit Card</strong>
						<br>
						<i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-discover fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> <i class="fab fa-cc-diners-club fa-2x"></i>
					</div>
					</a>
					
					<a href="/book/paypal" class="text-decoration-none">
					<div class="bd-callout bd-callout-danger text-left text-dark" style="margin-right:5px;">
						<strong> PayPal</strong>
						<br>
						<i class="fab fa-cc-paypal fa-2x"></i>
						
                    </div>
					</a>
						
					</div>
					
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection