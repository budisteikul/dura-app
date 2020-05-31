@extends('layouts.app')
@section('content')

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
<h3>Booking Channel</h3>
<div class="form-group">
<label for="bookingChannel"><strong>Channel</strong></label>
<select style="font-size:16px;height:47px;"  class="form-control" id="bookingChannel" name="bookingChannel">
        <option value="Internal Booking">Internal Booking</option>
        @foreach($rev_resellers as $rev_reseller)
        <option value="{{$rev_reseller->name}}">{{$rev_reseller->name}}</option>
        @endforeach
</select>
</div>
<h3>Main Contact</h3>   
	@php
    	$main_contacts = $rev_shoppingcarts->shoppingcart_questions()->where('type','mainContactDetails')->orderBy('order')->get()
    @endphp
    @foreach($main_contacts as $main_contact)        
<div class="form-group">
	<label for="{{ $main_contact->questionId }}"><strong>{{ $main_contact->label }}</strong></label>
    @if($main_contact->dataFormat=="EMAIL_ADDRESS")
	<input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="email" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;">
    @elseif($main_contact->dataFormat=="PHONE_NUMBER")
    <input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="tel" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;">
    @else
    @if($main_contact->selectOption)
    <select style="font-size:16px;height:47px;"  class="form-control" id="{{ $main_contact->questionId }}" name="{{ $main_contact->questionId }}">
    	<option value=""></option>
    	@foreach($main_contact->shoppingcart_question_options()->orderBy('order')->get() as $shoppingcart_question_option)
    	<option value="{{ $shoppingcart_question_option->value }}" {{ $shoppingcart_question_option->answer==1 ? "selected" : "" }}>{{ $shoppingcart_question_option->label }}</option>
        @endforeach
    </select>
    @else
    <input name="{{ $main_contact->questionId }}" value="{{ $main_contact->answer }}" type="text" class="form-control" id="{{ $main_contact->questionId }}" style="height:47px;">
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
	<input type="hidden" id="{{ $pickup_question->questionId }}" value="{{ $pickup_question->answer }}" style="height:47px;" name="{{ $pickup_question->questionId }}" class="form-control">
	</div>
    @else
    <div class="form-group">
	<label for="{{ $pickup_question->questionId }}"><strong>{{ $pickup_question->label }}</strong></label>
	<input type="text" id="{{ $pickup_question->questionId }}" value="{{ $pickup_question->answer }}" style="height:47px;" name="{{ $pickup_question->questionId }}" class="form-control">
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
	<label for="{{ $activityBooking->questionId }}"><strong>{{ $activityBooking->label }}</strong></label>
    @if($activityBooking->selectOption)
    <select style="font-size:16px;height:47px;" class="form-control" id="{{ $activityBooking->questionId }}" name="{{ $activityBooking->questionId }}">
    	<option value=""></option>
    	@foreach($activityBooking->shoppingcart_question_options()->orderBy('order')->get() as $shoppingcart_question_option)
    	<option value="{{ $shoppingcart_question_option->value }}" {{ $shoppingcart_question_option->answer==1 ? "selected" : "" }}>{{ $shoppingcart_question_option->label }}</option>
        @endforeach
    </select>
    @else
    <input type="text" id="{{ $activityBooking->questionId }}" value="{{ $activityBooking->answer }}" style="height:47px;" name="{{ $activityBooking->questionId }}" class="form-control">
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
            "bookingChannel": $("#bookingChannel").val(),
			
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
