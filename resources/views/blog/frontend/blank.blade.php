@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=af09519a-6eee-4a10-b127-5bd5edb0f3ce" async></script>
      <style> #bokun_1f969eb1_3d73_49e5_8a98_6481cf12b1c5 { display: inline-block; padding: 5px 10px; background: #21d41b; border-radius: 5px; box-shadow: none; font-weight: 600; font-size: 14px; text-decoration: none; text-align: center; color: #FFFFFF; font-family: sans-serif; cursor: pointer; } #bokun_1f969eb1_3d73_49e5_8a98_6481cf12b1c5:hover{ background: #169012; } #bokun_1f969eb1_3d73_49e5_8a98_6481cf12b1c5:active{ background: #1aa715; } </style> <button class="bokunButton" disabled id=bokun_1f969eb1_3d73_49e5_8a98_6481cf12b1c5 data-src="https://widgets.bokun.io/online-sales/af09519a-6eee-4a10-b127-5bd5edb0f3ce/experience-calendar/208273?partialView=1" > Book now </button> 
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
					
                    <div class="row col-md-8  mx-auto">
    <div class="col-sm-6 first-column">
      <div class="bd-callout bd-callout-danger text-left text-secondary shadow p-3 bg-white rounded" style="margin-right:5px; height:180px">
                    	<div style="margin-bottom:8px;">
						<i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-discover fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> <i class="fab fa-cc-diners-club fa-2x"></i>
						</div>
                        <div style="margin-bottom:8px; height:50px;">
						<!-- i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-discover fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> <i class="fab fa-cc-diners-club fa-2x"></i -->
                        <img src="/assets/foodtour/3dsecure.jpg" height="50">
                        </div>
                        <div style="margin-bottom:8px;">
                        <a class="btn btn-danger" href="/book/stripe"><i class="fa fa-credit-card"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Use Credit Card Payment</strong></span></a>
                        </div>
					</div>
    </div>
    <div class="col-sm-6 second-column">
      <div class="bd-callout bd-callout-danger text-left text-secondary shadow p-3 bg-white rounded" style="margin-right:5px; height:180px">
                    	<div style="margin-bottom:8px;">
						<i class="fab fa-cc-paypal fa-2x"></i>
						</div>
                        <div style="margin-bottom:8px; height:50px;">
						<!-- i class="fab fa-cc-paypal fa-2x"></i --><img src="/assets/foodtour/logo-paypal.png" height="40">
                        </div>
                        <div style="margin-bottom:8px;">
                        <a class="btn btn-danger" href="/book/paypal"><i class="fab fa-paypal"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Use PayPal Payment</strong></span></a>
                        </div>
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