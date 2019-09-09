@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/"><span class="fa fa-angle-double-left"></span> Back to home</a>
	</div>
</nav>   
<div style="height:25px;"></div>


<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:45px;"></div>	
                
                	<div class="row" style="padding-bottom:0px;">
						<div class="col-lg-12 text-center">
							<h3 class="section-heading" style="margin-top:0px;">Please select your payment method first</h3>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
						</div>
					</div>
                
                
					<div class="bd-callout bd-callout-danger w-100 text-left" style="margin-right:5px;">
						<strong class="text-danger"> CREDIT CARD</strong>
                        <br>Your payment information is securely encrypted using <a href="https://stripe.com" target="_blank">Stripe</a>. Neither us nor any third party has access to your credit card details.
                        <br><br>
                        <a class="btn btn-danger" href="/payment/stripe"><span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong><span class="fa fa-credit-card"></span> Pay with credit card</strong></span></a>
					</div>
                    <div class="bd-callout bd-callout-danger w-100 text-left" style="margin-right:5px;">
						<strong class="text-danger"> PAYPAL</strong>
                        <br>Securely connect to <a href="https://paypal.com" target="_blank">PayPal</a> to complete your transaction.
                        <br><br>
                        <a class="btn btn-danger" href="/payment/paypal"><span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong><span class="fab fa-paypal"></span> Pay with PayPal</strong></span></a>
					</div>
					
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection