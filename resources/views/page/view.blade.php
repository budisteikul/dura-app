@extends('layouts.frontend')
@section('title','Cancellation')
@section('content')
@include('layouts.loading')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Receipt Section -->
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
                   <h4>Booking reference {{ $rev_shoppingcarts->confirmationCode }}</h4>
                   <strong>Status : {{ $rev_shoppingcarts->bookingStatus }}</strong>
				 </p>
				</div>
				 </div>
			</div>

			
			<div class="row mb-2">
			<!-- ################################################################### --> 
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	  
                <div class="card shadow">
					<div class="card-header bg-dark text-white pb-1">
						<h4><i class="fas fa-file"></i> Booking Detail</h4>
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
                         <p>
						<h3>Product</h3>
                        <ul>
                       	@foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
                        <li>{{ $shoppingcart_products->title }} ({{ $shoppingcart_products->rate }})</li>
                        @endforeach
                        </ul>
                        </p>
					</div>
                    
                  
					
				</div>
			</div>
			<!-- ################################################################### -->
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	  
                <div class="card shadow">
					<div class="card-header bg-dark text-white pb-1">
						<h4>Action</h4>
					</div>
                	
					<div class="card-body">
                    
@if($canCancel)
<!-- ################################################################### -->                   
<script language="javascript">
$( document ).ready(function() {
	$('#alert-success').hide();
});

function CANCEL()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"id": '{{ $rev_shoppingcarts->id }}',
        },
		type: 'GET',
		url: '/booking/view/{{ $rev_shoppingcarts->id }}'
		}).done(function( data ) {
			if(data.id=="1")
			{
				window.location.href = '/booking/view/{{ $rev_shoppingcarts->id }}';
				$("#proses").hide();
				$('#alert-success').fadeIn("slow");
       				
			}
			else
			{
				$("#submit").attr("disabled", false);
				$('#submit').html('<i class="fas fa-trash"></i> Yes sure!');
			}
		});
	return false;
}
</script>
                    	<form onSubmit="CANCEL(); return false;">

<div id="alert-success" class="alert alert-danger text-center" role="alert">
  <h2 style="margin-bottom:10px; margin-top:10px;"><i class="far fa-frown"></i> Booking has been cancelled!</h2>
</div>
                    	<label for="submit"><strong>Are you sure want to cancel this booking?</strong></label>
                	 	<button id="submit" type="submit" style="height:47px;" class="btn btn-block btn-danger"><i class="fas fa-trash"></i> Yes I sure!</button>
                        </form>
<!-- ################################################################### --> 
@else
 No action needed
@endif                     
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