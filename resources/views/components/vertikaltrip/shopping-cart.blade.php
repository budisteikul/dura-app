@push('scripts')
<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&intent=authorize"  data-csp-nonce="xyz-123">
  </script>
<script>
$( document ).ready(function() {
    $('#proses').hide();
	$('#alert-success').hide();
	$('#alert-failed').hide();
});
</script>
@endpush

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
                @include('components.vertikaltrip.withremove-shoppingcart')
                <!-- ################################################################### -->
				@include('components.vertikaltrip.promo-code')
                <!-- ################################################################### --> 
            </div>
            
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
            <div class="card mb-8 shadow p-2">
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 
<form onSubmit="STORE(); return false;">             
<!-- ########################################### -->
<h3>Main Contact</h3>   
	@php
    	$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    @endphp
    @foreach($main_contacts as $main_contact)        
<div class="form-group">
	<label for="{{ $main_contact->questionId }}" class="{{ $main_contact->required ? "required" : "" }}"><strong>{{ $main_contact->label }}</strong></label>
    @if($main_contact->dataFormat=="EMAIL_ADDRESS")
	<input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="email" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;" {{ $main_contact->required ? "required" : "" }}>
    @elseif($main_contact->dataFormat=="PHONE_NUMBER")
    <input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="tel" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;" {{ $main_contact->required ? "required" : "" }}>
    @else
    @if($main_contact->selectOption)
    <select style="font-size:16px;height:47px;"  class="form-control" id="{{ $main_contact->questionId }}" name="{{ $main_contact->questionId }}" {{ $main_contact->required ? "required" : "" }}>
    	<option value=""></option>
    	@foreach($main_contact->shoppingcart_question_options()->orderBy('order')->get() as $shoppingcart_question_option)
    	<option value="{{ $shoppingcart_question_option->value }}" {{ $shoppingcart_question_option->answer==1 ? "selected" : "" }}>{{ $shoppingcart_question_option->label }}</option>
        @endforeach
    </select>
    @else
    <input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="text" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;" {{ $main_contact->required ? "required" : "" }}>
    @endif
    @endif
</div>
	@endforeach
 <!-- ########################################### -->  
    @php
    $pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
    @endphp
    @if(count($pickup_questions))
    
    <h3>Pick-up and drop-off questions</h3>
    
    @foreach($pickup_questions as $pickup_question)
    @if($pickup_question->dataType=="READ_ONLY")
    <div class="form-group" style="margin-bottom:3px;">
	<strong>{{ $pickup_question->answer }}</strong>
	<input type="hidden" id="{{ $pickup_question->questionId }}" value="{{ $pickup_question->answer }}" style="height:47px;" name="{{ $pickup_question->questionId }}" class="form-control" {{ $pickup_question->required ? "required" : "" }}>
	</div>
    @else
    <div class="form-group">
	<label for="{{ $pickup_question->questionId }}" class="{{ $pickup_question->required ? "required" : "" }}"><strong>{{ $pickup_question->label }}</strong></label>
	<input type="text" id="{{ $pickup_question->questionId }}" value="{{ $pickup_question->answer }}" style="height:47px;" name="{{ $pickup_question->questionId }}" class="form-control" {{ $pickup_question->required ? "required" : "" }}>
	</div>
	@endif
    @endforeach
    @endif
<!-- ########################################### --> 
    @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
    @php
    	$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('bookingId',$shoppingcart_products->bookingId)->where('type','activityBookings')->orderBy('order')->get();
    @endphp
    @if(count($activityBookings))
    <h2>{{ $shoppingcart_products->title }}</h2>
    
    @foreach($activityBookings as $activityBooking)
    <div class="form-group">
	<label for="{{ $activityBooking->questionId }}" class="{{ $activityBooking->required ? "required" : "" }}"><strong>{{ $activityBooking->label }}</strong></label>
    @if($activityBooking->selectOption)
    <select style="font-size:16px;height:47px;" class="form-control" id="{{ $activityBooking->questionId }}" name="{{ $activityBooking->questionId }}" {{ $activityBooking->required ? "required" : "" }}>
    	<option value=""></option>
    	@foreach($activityBooking->shoppingcart_question_options()->orderBy('order')->get() as $shoppingcart_question_option)
    	<option value="{{ $shoppingcart_question_option->value }}" {{ $shoppingcart_question_option->answer==1 ? "selected" : "" }}>{{ $shoppingcart_question_option->label }}</option>
        @endforeach
    </select>
    @else
    <input type="text" id="{{ $activityBooking->questionId }}" value="{{ $activityBooking->answer }}" style="height:47px;" name="{{ $activityBooking->questionId }}" class="form-control" {{ $activityBooking->required ? "required" : "" }}>
    @endif
    @if(isset($activityBooking->help))
    <small class="form-text text-muted">{{$activityBooking->help}}</small>
    @endif
	</div>
    @endforeach
    @endif
    @endforeach
<!-- ########################################### -->    


<button id="submit" type="submit" style="height:47px;" class="btn btn-lg btn-block btn-theme"><i class="fas fa-lock"></i> <strong>Pay {{ $rev_shoppingcarts->currency }} {{ $rev_shoppingcarts->total }}</strong></button>
</form>
<div id="proses">     
  <h2>Pay with</h2>
  <div id="paypal-button-container"></div>
</div>
<div id="alert-success" class="alert alert-primary text-center" role="alert">
  <h2 style="margin-bottom:10px; margin-top:10px;"><i class="far fa-smile"></i> Payment Successful!</h2>
</div>
<div id="alert-failed" class="alert alert-danger text-center" role="alert">
  <h2 style="margin-bottom:10px; margin-top:10px;"><i class="far fa-frown"></i> Payment Failed!</h2>
</div>
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
		
  	});
	@endforeach


</script>
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
				@if(count($activityBookings))
    				@foreach($activityBookings as $activityBooking)
						"{{ $activityBooking->questionId }}",
					@endforeach
				@endif
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
				@if(count($activityBookings))
    				@foreach($activityBookings as $activityBooking)
						"{{ $activityBooking->questionId }}": $('#{{ $activityBooking->questionId }}').val(),
					@endforeach
				@endif
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
				@if(count($activityBookings))
    				@foreach($activityBookings as $activityBooking)
						$("#{{ $activityBooking->questionId }}").attr("disabled", true);
						$("#{{ $activityBooking->questionId }}").addClass("input-disabled");
					@endforeach
				@endif
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
				//=========================================================
				paypal.Buttons({
    			createOrder: function() {
					
  					return fetch('/booking/create-paypal-transaction', {
    				method: 'POST',
					credentials: 'same-origin',
    				headers: {
      					'content-type': 'application/json',
						'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content")
    					}
  					}).then(function(res) {
						//console.log(res);
    					return res.json();
  					}).then(function(data) {
						//console.log(data);
    					return data.result.id;
  					});
					
				},
				onError: function (err) {
    				$("#proses").hide();
					$('#alert-failed').html("Your browser is not support Paypal");
					$('#alert-failed').fadeIn("slow");
					
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
						}).done(function(data) {
							if(data.id=="1")
							{
								window.location.href = '/booking/receipt/'+ data.message;
								$("#proses").hide();
								$('#alert-success').fadeIn("slow");
								
							}
							else
							{
								$("#proses").hide();
								$('#alert-failed').fadeIn("slow");
							}
						}).fail(function(error) {
							console.log(error);
						});
      				});
    			}
			
  				}).render('#paypal-button-container');
				//=========================================================
				
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
				$('#submit').html('<i class="fas fa-lock"></i> <strong>Pay {{ $rev_shoppingcarts->currency }} {{ $rev_shoppingcarts->total }}</strong>');
				
			}
		});
	
	
	return false;
}
</script>