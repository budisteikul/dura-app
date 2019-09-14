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
							<!-- h3 class="section-heading" style="margin-top:0px;">Payment method</h3 -->
							<h4 class="section-subheading text-muted">Which payment would you like to use?</h4>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
						</div>
					</div>
				
					
					
					<div class="row justify-content-center">
					<div>
					
					
					
					<div class="bd-callout bd-callout-danger text-left text-secondary shadow p-3 bg-white rounded" style="margin-right:5px; width:330px;">
                    	<div style="margin-bottom:8px;">
						<strong class="text-danger"> Credit Card</strong>
						</div>
                        <div style="margin-bottom:8px;">
						<i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-discover fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> <i class="fab fa-cc-diners-club fa-2x"></i>
                        </div>
                        <div style="margin-bottom:8px;">
                        <a class="btn btn-danger" href="/book/stripe"><i class="fa fa-credit-card"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Use Credit Card Payment</strong></span></a>
                        </div>
					</div>
					
					
					
					<div class="bd-callout bd-callout-danger text-left text-secondary shadow p-3 bg-white rounded" style="margin-right:5px; width:330px;">
                    	<div style="margin-bottom:8px;">
						<strong class="text-danger"> PayPal</strong>
						</div>
                        <div style="margin-bottom:8px;">
						<i class="fab fa-cc-paypal fa-2x"></i>
                        </div>
                        <div style="margin-bottom:8px;">
                        <a class="btn btn-danger" href="/book/paypal"><i class="fab fa-paypal"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Use PayPal Payment</strong></span></a>
                        </div>
                    </div>
					
                    
					
					</div></div>
					
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection