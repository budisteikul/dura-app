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
<div style="height:50px;"></div>
<!-- Navigation -->
<section id="booking" >
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
<div style="height:50px;"></div>			
<div id="eventbrite-widget-container-66047863939" style="background-color:#ffffff"></div>
<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
<script type="text/javascript">
    var exampleCallback = function() {
        console.log('Order complete!');
    };

    window.EBWidgets.createWidget({
        // Required
        widgetType: 'checkout',
        eventId: '66047863939',
        iframeContainerId: 'eventbrite-widget-container-66047863939',

        // Optional
        iframeContainerHeight: 600,  // Widget height in pixels. Defaults to a minimum of 425px if not provided
        onOrderComplete: exampleCallback  // Method called when an order has successfully completed
    });
</script>     
<div style="height:200px;"></div>		
        </div>
    </div>
</div>
</section>




@endsection