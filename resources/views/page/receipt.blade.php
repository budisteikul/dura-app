@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')
@endpush



<!-- ################################################################### -->

<!-- Navigation -->
@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a href="/"><img src="/assets/logo/jogjafoodtour.png" alt="JOGJA FOOD TOUR" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
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
					<a class="nav-link js-scroll-trigger" href="/#guide">Tour Guide</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#review">Reviews</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div style="height:25px;"></div>	
@else
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/assets/logo/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		@include('layouts.vt-menu')
        
	</div>
</nav>
<div style="height:25px;"></div>
@endif

<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-left">
				<div style="height:70px;"></div>
				
           <div class="card mb-8 shadow p-2">
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
				 </div>
                 
                 
					<div class="row" style="padding-bottom:0px;">
						<div class="col-lg-12 text-center">
							<h1 class="section-heading">THANK YOU!</h1>
							<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
							<h4 class="section-subheading text-muted">
								
							</h4>
						</div>
					</div>
					<div class="row col-md-8  mx-auto text-left">
					<div class="textwidget" style=" min-height:250px;">
						
                        <p>
                        <h4>Your booking references is {{ $customer->confirmationCode }}</h4>
						Thank you for your booking with <b>VERTIKAL TRIP</b>, a confirmation will be sent to your email address.
						</p>
                        <br>
                        <p>
                        <h4>Customer info</h4>
						<h3>Full Name</h3>
						{{ $customer->firstName }} {{ $customer->lastName }}
                        <h3>Phone</h3>
						{{ $customer->phoneNumber }}
                        <h3>Email</h3>
						{{ $customer->email }}
                        </p>
                        <br>
						<p>
                        <h4>Travel Documents</h4>
						<h3>Receipt</h3>
						<a target="_blank" href={{ $link }}><i class="fas fa-file-pdf"></i> Invoice.pdf</a>
						<h3>Experience tickets</h3>
                        @foreach($rev_shoppingcarts as $rev_shoppingcart)
                        <a target="_blank" href=/booking/ticket/{{ $rev_shoppingcart->productConfirmationCode }}><i class="fas fa-file-pdf"></i> Ticket-{{ $rev_shoppingcart->productConfirmationCode }}.pdf</a>
                        <br>
                        @endforeach
                        </p>
                        
                        
                        
					</div>
					</div>
			</div>
			</div>

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection