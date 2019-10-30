@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
    
<!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav">
	<div class="container">
		<noscript><a href="https://jogjafoodtour.eventbrite.com" rel="noopener noreferrer" target="_blank"></noscript>

<button style="margin-top:4px; margin-bottom:4px;" class="btn btn-danger text-white" id="eventbrite-widget-modal-trigger-77732854059" type="button"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></button>
<noscript></a>Book now on Eventbrite</noscript>
<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<script type="text/javascript">
    var exampleCallback = function() {
        console.log('Order complete!');
    };

    window.EBWidgets.createWidget({
        widgetType: 'checkout',
        eventId: '77732854059',
        modal: true,
        modalTriggerElementId: 'eventbrite-widget-modal-trigger-77732854059',
        onOrderComplete: exampleCallback
    });
</script>


<!-- a class="btn btn-danger text-white" href="/tour/yogyakarta-night-walking-and-food-tours/time_selector"><i class="fa fa-ticket-alt"></i> <span style="font-family: 'Barlow','Helvetica Neue',Arial,sans-serif;"><strong>Book now</strong></span></a -->
        
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link" href="/">Home</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link" href="/#services">Why Jogja Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link" href="/#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#review">Reviews</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link" href="/#guide">Tour Guide</a>
				</li>
			</ul>
		</div>
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
						<li>We use <a class="text-danger" target="_blank" href="https://www.eventbrite.com">Eventbrite</a> as payment gateway to securely transact payments using their respective payment systems.</li>
						<li><strong>Non-refundable</strong></li>
						<li><strong>No-shows</strong> will be charged the full price. </li>
						<li>Customers will provide a <strong>full refund</strong> (100%) or <strong>re-schedule</strong> in case of operator cancellation due to weather or other unforeseen circumstances. </li>
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