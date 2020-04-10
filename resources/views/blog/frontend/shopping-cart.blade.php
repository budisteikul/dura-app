@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')

@endpush

<script>
$( document ).ready(function() {
    $('#proses').hide();
	$('#alert-success').hide();
	$('#alert-failed').hide();
});
</script>

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
				<div style="height:56px;"></div>
			
            <div class="row mb-2">  
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	<!-- ################################################################### -->   
                <div class="card shadow">
  				<div class="card-header bg-dark text-white pb-1">
    				<h4><i class="fas fa-shopping-cart"></i> Shopping Cart</h4>
  				</div>
                
                <?php
				$grand_total = 0;
				
				?>
                @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_product)
                <!-- Product booking -->
                <div class="card-body">
                
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $shoppingcart_product->title }}</b>
                    			</div>
                    			<div class="col-4 text-right">
                                	<?php
									$product_price = 0;
									foreach($shoppingcart_product->shoppingcart_rates()->where('type','product')->get() as $shoppingcart_rates)
									{
										$product_price += $shoppingcart_rates->total;
									}
									?>
                    				<b>${{ $product_price }}</b>
                    			</div>
                			 </div>
                    
                    		 <div class="row mb-4">
                				<div class="ml-4">
                               		@if(isset($shoppingcart_product->image))
                    				<img class="img-fluid" src="{{ $shoppingcart_product->image }}">
                                	@endif
                    			</div>
                    			<div class="col-8">
                                	{{ $shoppingcart_product->date }}
                                	<br>
                                    {{ $shoppingcart_product->rate }}
                                    <br>
                                    @foreach($shoppingcart_product->shoppingcart_rates()->where('type','product')->get() as $shoppingcart_rates)
                                    {{ $shoppingcart_rates->qty }} x {{ $shoppingcart_rates->unitPrice }} (${{ $shoppingcart_rates->price }})
                                    <br>
                                    @endforeach
                                </div>
                			</div>
                            <!-- Product detail booking -->
                            <!-- Pickup booking $activity -->
                            @php
							$pickups = $shoppingcart_product->shoppingcart_rates()->where('type','pickup')->get();
                            @endphp
                            @if(count($pickups))
                            <div class="card mb-2">
                        		<div class="card-body">
                               		@foreach($pickups as $shopppingcart_rates)
									<div class="row mb-2">
                						<div class="col-8">
                                        <strong>Pick-up and drop-off services</strong>
                                        <br>
                                        {{ $shopppingcart_rates->unitPrice }}
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>${{ $shopppingcart_rates->total }}</b>
                    					</div>
                					</div>
                               		@endforeach
								</div>
                   			</div>
							@endif
                            <!-- Pickup booking $activity -->
							
                            <!-- Extra booking $activity -->
                            @php
                            $extra = $shoppingcart_product->shoppingcart_rates()->where('type','extra')->get();
                            @endphp
                            @if(count($extra))
							<div class="card mb-2">
                            
                        		<div class="card-body">
                                <div class="row col-12 mb-2">
                            		<strong>Extras</strong>
                            	</div>
                                @foreach($extra as $shoppingcart_rates)
									<div class="row mb-2">
                						<div class="col-8">
										{{ $shoppingcart_rates->title }}
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>${{ $shoppingcart_rates->total }}</b>
                    					</div>
                					</div>
                               @endforeach
								</div>
                   			</div>
							<!-- Extra booking -->
                            @endif
                            
				</div>
                <!-- Product booking -->
                <?php
				$grand_total += $shoppingcart_product->total;
				?>
                @endforeach
                
                <div class="card-body pt-0 mt-0">
                	<hr>
                	<div class="row mb-2">
                		<div class="col-8">
                    		<span style="font-size:18px">Subtotal</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">${{ $grand_total }}</span>
                    	</div>
                	</div>
				</div>
                
				
				
				
				
				
                
                
                <div class="card-body pt-0">
                	<!-- hr>
                	<div class="row mb-4">
                		<div class="col-8">
                    		<span style="font-size:18px">Items</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">$0.08</span>
                    	</div>
                	</div -->
                	<hr class="mt-0">    
                    <div class="row mb-4 mt-0">
                		<div class="col-8">
                    		<b style="font-size:18px">Total (USD)</b>
                    	</div>
                    	<div class="col-4 text-right">
                    	<b style="font-size:18px">${{ $grand_total }}</b>
                    	</div>
                	</div>
                </div>
				</div>
                <!-- ################################################################### --> 
            </div>
            
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
            <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 
<script language="javascript">
function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = [
				
				@php
    			$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    			@endphp
    			@foreach($main_contacts as $main_contact)
					"{{ $main_contact->questionId }}",
				@endforeach
				
				@php
    			$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->orderBy('order')->get();
    			@endphp
    			@foreach($activityBookings as $activityBooking)
					"{{ $activityBooking->questionId }}",
				@endforeach
				
				@php
    			$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
    			@endphp
    			@if(count($pickup_questions))
					@foreach($pickup_questions as $pickup_question)
					"{{ $pickup_question->questionId }}",
					@endforeach
				@endif
				
	];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			
				@php
    			$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    			@endphp
    			@foreach($main_contacts as $main_contact)
					"{{ $main_contact->questionId }}": $('#{{ $main_contact->questionId }}').val(),
				@endforeach
				
				@php
    			$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->orderBy('order')->get();
    			@endphp
    			@foreach($activityBookings as $activityBooking)
					"{{ $activityBooking->questionId }}": $('#{{ $activityBooking->questionId }}').val(),
				@endforeach
				
				@php
    			$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
    			@endphp
    			@if(count($pickup_questions))
					@foreach($pickup_questions as $pickup_question)
					"{{ $pickup_question->questionId }}": $('#{{ $pickup_question->questionId }}').val(),
					@endforeach
				@endif
			
        },
		type: 'POST',
		url: '/booking/checkout'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				
				@php
    			$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    			@endphp
    			@foreach($main_contacts as $main_contact)
					$("#{{ $main_contact->questionId }}").attr("disabled", true);
					$("#{{ $main_contact->questionId }}").addClass("input-disabled");
				@endforeach
				
				@php
    			$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->orderBy('order')->get();
    			@endphp
    			@foreach($activityBookings as $activityBooking)
					$("#{{ $activityBooking->questionId }}").attr("disabled", true);
					$("#{{ $activityBooking->questionId }}").addClass("input-disabled");
				@endforeach
				
				@php
    			$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
    			@endphp
    			@if(count($pickup_questions))
					@foreach($pickup_questions as $pickup_question)
					$("#{{ $pickup_question->questionId }}").attr("disabled", true);
					$("#{{ $pickup_question->questionId }}").addClass("input-disabled");
					@endforeach
				@endif
				
				
				
				$("#submit").slideUp("slow");
				$("#proses").fadeIn("slow");
				createPaypalButton('{{$grand_total}}');
				//$("#submit").attr("disabled", false);	
				//$('#submit').html('<i class="fa fa-save"></i> {{ __('Save') }}');
			}
			else
			{
				$.each( data, function( index, value ) {
					$('#'+ index).addClass('is-invalid');
						if(value!="")
						{
							$('#'+ index).after('<span id="span-'+ index  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
						}
					});
					
				$("#submit").attr("disabled", false);
				$('#submit').html('{{ __('Next') }} <i class="fas fa-arrow-right"></i>');
				
			}
		});
	
	
	return false;
}
</script>
                 
<form onSubmit="STORE(); return false;">             
<h3>Main Contact</h3>   


	@php
    	$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    @endphp
    @foreach($main_contacts as $main_contact)        
<div class="form-group">
	<label for="{{ $main_contact->questionId }}" class="{{ $main_contact->required ? "required" : "" }}"><strong>{{ $main_contact->label }}</strong></label>
	<input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="text" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;" {{ $main_contact->required ? "required" : "" }}>
</div>
	@endforeach
    
    
    @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
    @php
    	$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('bookingId',$shoppingcart_products->bookingId)->where('type','activityBookings')->orderBy('order')->get();
    @endphp
    @if(count($activityBookings))
    <h2>{{ $shoppingcart_products->title }}</h2>
    
    @foreach($activityBookings as $activityBooking)
    <div class="form-group">
	<label for="{{ $activityBooking->questionId }}" class="{{ $activityBooking->required ? "required" : "" }}"><strong>{{ $activityBooking->label }}</strong></label>
	<input type="text" id="{{ $activityBooking->questionId }}" value="{{ $activityBooking->answer }}" style="height:47px;" name="{{ $activityBooking->questionId }}" class="form-control" {{ $activityBooking->required ? "required" : "" }}>
</div>
    @endforeach
    @endif
    @endforeach
    
    
    @php
    $pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
    @endphp
    @if(count($pickup_questions))
    
    <h3>Pick-up questions</h3>
    
    @foreach($pickup_questions as $pickup_question)
    <div class="form-group">
	<label for="{{ $pickup_question->questionId }}" class="{{ $pickup_question->required ? "required" : "" }}"><strong>{{ $pickup_question->label }}</strong></label>
	<input type="text" id="{{ $pickup_question->questionId }}" value="{{ $pickup_question->answer }}" style="height:47px;" name="{{ $pickup_question->questionId }}" class="form-control" {{ $pickup_question->required ? "required" : "" }}>
</div>
    @endforeach
    @endif

<button id="submit" type="submit" style="height:47px;" class="btn btn-lg btn-block btn-theme">{{ __('Next') }} <i class="fas fa-arrow-right"></i></button>
</form>
<div id="proses">     
  <h2>Payment</h2>        
  <div id="paypal-button-container"></div>
</div>
<div id="alert-success" class="alert alert-primary text-center" role="alert">
  <h2 style="margin-bottom:10px; margin-top:10px;"><i class="far fa-smile"></i> Payment ${{ $grand_total }} Success!</h2>
</div>
<div id="alert-failed" class="alert alert-danger text-center" role="alert">
  <h2 style="margin-bottom:10px; margin-top:10px;"><i class="far fa-frown"></i> Payment ${{ $grand_total }} Failed!</h2>
</div>

<script>

	
@php
$questions = $rev_shoppingcarts->shoppingcart_questions()->where('required',1)->get()
@endphp
    @foreach($questions as $question)
	$("#{{ $question->questionId }}").focusout(function() {
		$('#{{ $question->questionId }}').removeClass('is-invalid');
  		$('#span-{{ $question->questionId }}').remove();
    	if($("#{{ $question->questionId }}").val()=="")
		{
			$('#{{ $question->questionId }}').addClass('is-invalid');
			$('#{{ $question->questionId }}').after('<span id="span-{{ $question->questionId }}" class="invalid-feedback" role="alert"><strong>Please fill out this field</strong></span>');
		}
		else
		{
			@if($question->dataFormat=="EMAIL_ADDRESS")
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(regex.test($("#{{ $question->questionId }}").val()))
				{
					$('#{{ $question->questionId }}').removeClass('is-invalid');
  					$('#span-{{ $question->questionId }}').remove();
				}
				else
				{
					$('#{{ $question->questionId }}').addClass('is-invalid');
					$('#{{ $question->questionId }}').after('<span id="span-{{ $question->questionId }}" class="invalid-feedback" role="alert"><strong>Invalid email</strong></span>');
				}
			@else
				$('#{{ $question->questionId }}').removeClass('is-invalid');
  				$('#span-{{ $question->questionId }}').remove();
			@endif
		}
		checkForm();
  	});
	@endforeach


</script>

 <style>
 
.loader,
.loader:before,
.loader:after {
  background: #1D57C7;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #1D57C7;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}

 </style>            	
          
                
                
                
                
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




<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&intent=authorize"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>
  <script>
   
  
   
  function createPaypalButton(value)
  {
	  //This function displays Smart Payment Buttons on your web page.
  		paypal.Buttons({
    		createOrder: function(data, actions) {
      			return actions.order.create({
        			purchase_units: [{
         			 	amount: {
            			value: value
          				}
        			}],
					application_context: {
						shipping_preference: 'NO_SHIPPING'
      				}
      			});
    		},
   			onApprove: function(data, actions) {
				$("#proses").addClass("loader");
      			
      			actions.order.authorize().then(function(authorization) {
        			
        			var authorizationID = authorization.purchase_units[0].payments.authorizations[0].id
        			
					
					$.ajax({
						data: {
        					"_token": $("meta[name=csrf-token]").attr("content"),
							"orderID": data.orderID,
							"authorizationID": authorizationID,
        					},
						type: 'POST',
						url: '/booking/payment'
						}).done(function( data ) {
							if(data.id=="1")
							{
								$("#proses").hide();
								$('#alert-success').fadeIn("slow");
								window.location.replace("/booking/receipt/"+ data.message);
							}
							else
							{
								$("#proses").removeClass("loader");
								return actions.restart();
							}
						});
					
					
					//=========================================================
      			});
    		}
  		}).render('#paypal-button-container');
  }
  
  </script>

@endsection