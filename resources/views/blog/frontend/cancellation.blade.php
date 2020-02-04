@extends('layouts.frontend')
@section('content')
@push('scripts')
<script language="javascript">
function CHECK()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["email","code"];
	$('#result').empty();
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"email": $('#email').val(),
			"code": $('#code').val(),
        },
		type: 'POST',
		url: '/booking/check'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				$('#result').append(data.message);
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
				
			}
			
			//$('#code').val('');
			//$('#email').val('');
			
			$("#submit").attr("disabled", false);
			$('#submit').html('<i class="fa fa-save"></i> {{ __('Save') }}');
		});
	
	
	return false;
}

function DELETE(id)
	{
		$.confirm({
    		title: 'Warning',
    		content: 'Are you sure?',
    		type: 'red',
			icon: 'fa fa-warning',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-danger',
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTableBuilder').DataTable();
							$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '{{ route('experiences.index') }}/'+ id
						}).done(function( msg ) {
							table.ajax.reload( null, false );
						});	
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
        		}
    		}
		});
		
	}
</script>
@endpush



<!-- ################################################################### -->

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
	
		<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img height="40" style="margin-top:14px;margin-bottom:14px;" src="/assets/foodtour/9_bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a>
		

	</div>
</nav>

<div style="height:25px;"></div>



<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-left">
				<div style="height:70px;"></div>
				
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
<div style="height:40px;"></div>		   
<form action="{{ route('experiences.store') }}" method="post" onSubmit="CHECK(); return false;">
@csrf

<div class="form-group">
	<input type="text" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
</div>

<div class="form-group">
	<input type="text" id="code" name="code" class="form-control" placeholder="Confirmation Code" autocomplete="off">
</div>
	
	<button id="submit" type="submit" class="btn btn-danger">Check</button>
	</form>
	
	<div style="height:20px;"></div>
	
	
	<div id="result"></div>
	
	
	
	
	
	
	</div>
</div>


				
			</div></div>

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection