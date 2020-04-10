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
				 <div class="col-md-12  mx-auto text-left">
				 <p>
                        <h4>Your booking references is {{ $rev_shoppingcarts->confirmationCode }}</h4>
						
						Thank you for your booking with <b>VERTIKAL TRIP</b>, a confirmation will be sent to your email address.
						</p>
				</div>
				 </div>
			</div>

			
			<div class="row mb-2">
			<!-- ################################################################### --> 
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	  
                <div class="card shadow">
					<div class="card-header bg-dark text-white pb-1">
						<h4><i class="fas fa-user-tie"></i> Customer Info</h4>
					</div>
                
					<div class="card-body">
                		
                       
                        <p>
						<h3>Name</h3>
						{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer }}
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer }} 
                        <h3>Phone</h3>
						{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer }} 
                        <h3>Email</h3>
						{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer }} 
                        </p>
						
					</div>
					
				</div>
			</div>
			<!-- ################################################################### -->
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	  
                <div class="card shadow">
					<div class="card-header bg-dark text-white pb-1">
						<h4><i class="fas fa-file"></i> Travel Documents</h4>
					</div>
                
					<div class="card-body">
                	 
                        <p>
						<h3>Receipt</h3>
						<a target="_blank" class="text-theme" href="/booking/invoice/{{ $rev_shoppingcarts->id }}"><i class="fas fa-file-invoice"></i> Invoice-{{ $rev_shoppingcarts->confirmationCode }}</a>
						<h3>Experience tickets</h3>
                       	@foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
                        <a target="_blank" class="text-theme" href="/booking/ticket/{{$shoppingcart_products->id}}"><i class="fas fa-ticket-alt"></i> Ticket-{{ $shoppingcart_products->productConfirmationCode }}</a>
                        <br>
                        @endforeach
                        </p>
							
					</div>
					
				</div>
			</div>
			<!-- ################################################################### -->			
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
        

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection