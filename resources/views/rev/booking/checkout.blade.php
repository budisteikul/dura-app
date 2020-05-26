@extends('layouts.app')
@section('content')
<style>
.btn-theme{
    background-color: #1D57C7;
    border-color:#1D57C7;
    color:#FFFFFF;
    
    display: inline-block;
    vertical-align: middle;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    overflow: hidden;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-property: color, background-color, border-color;
    transition-property: color, background-color, border-color;
}

.btn-theme:hover{
    background-color: #2870fd;
    border-color:#2870fd;
    color:#FFFFFF;
}

.btn-theme:focus{
    background-color:#2870fd;
    border-color:#2870fd;
    color:#FFFFFF;
}
.btn-theme:active{
    background-color:#2870fd;
    border-color:#2870fd;
    color:#FFFFFF;
}
.btn-theme:not(:disabled):not(.disabled):active{
    color: #FFFFFF;
    background: #1D57C7;
    border-color: #1D57C7;
    outline: 0 none;
}
.btn-theme:not(:disabled):not(.disabled):focus{
    box-shadow: 0 0 5px #1D57C7;
}
.btn-theme[disabled] {
    background: #1D57C7 !important;
    border-color:#1D57C7 !important;
}
.btn-theme[disabled]:hover {
    background: #1D57C7 !important;
    border-color:#1D57C7 !important;
}
</style>
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Checkout Booking</div>
                <div class="card-body">






	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-left">
				
            	<div class="row mb-2">  
				<div class="col-lg-6 col-lg-auto mb-6 mt-4">
                
            	<!-- ################################################################### -->  
                @include('rev.booking.withremove-shoppingcart')
                <!-- ################################################################### -->
				@include('rev.booking.promo-code')
                <!-- ################################################################### --> 
            	</div>
            
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
            <div class="card mb-8 p-2">
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


<button id="submit" type="submit" style="height:47px;" class="btn btn-lg btn-block btn-theme"><i class="fas fa-save"></i> Save</button>
</form>


			</div>
            </div>
            </div>
        	</div>
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
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
		url: '/rev/booking/checkout'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				window.location.href = '/rev/booking';
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
				$('#submit').html('<i class="fas fa-save"></i> Save');
				
			}
		});
	
	
	return false;
}
</script>


















      
		
                </div>
            </div>
        </div>
 </div>
@endsection
