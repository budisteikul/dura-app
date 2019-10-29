@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="/">Jogja Food Tour</a>
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
							<h4 class="section-subheading text-muted">TERMS AND CONDITIONS</h4>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
						</div>
					</div>
					
                    <div class="row col-md-8  mx-auto text-left">
    
					<ul>
						<li>We use PayPal (paypal.com) as payment gateway to securely transact payments using their respective payment systems.</li>
						<li>If a booking is canceled 24 hours prior to the tour, we will refund the booking minus administration of payment gateway approximate 10% of booking fee. Refunds cannot be given for cancellations less than 24 hours in advance or no-shows.</li>
						<li>No-shows will be charged the full price. </li>
						<li>Customers will provide a full refund (100%) or reschedule in case of operator cancellation due to weather or other unforeseen circumstances. </li>
						<li>By purchasing ticket, I have read and understood the Company’s <a class="text-danger" href="/page/waiver-and-release">Waiver and Release</a> of Claims.</li>
					</ul>
	
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