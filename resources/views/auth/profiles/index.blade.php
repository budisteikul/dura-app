@extends('layouts.admin-lte.login')
@section('content')
@push('scripts')
<script language="javascript">
function RESEND()
{
	$("#submit").attr("disabled", true);
	$("#submit").html('<i class="fa fa-spinner fa-spin"></i>');
	$('#alert').fadeOut();
	$.ajax({
		type: 'GET',
		url: '{{ route('verification.resend') }}'
		}).done(function( data ) {
			if(data.id==1)
			{
				$('#div-email').prepend('<div id="alert" class="alert alert-success" role="alert">'+ data.message +'</div>');
				$("#submit").attr("disabled", false);
				$("#submit").html('{{ __('Click here to request another') }}');
			}
			else
			{
				$('#div-email').prepend('<div id="alert" class="alert alert-danger" role="alert">'+ data.message +'</div>');
				$("#submit").attr("disabled", false);
				$("#submit").html('{{ __('Click here to request another') }}');
			}
		});	
	
	
	return false;
}
</script>
@endpush
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="card-body">
		<p class="login-box-msg"></p>
		{!! $message !!}
            
		<div class="row">
			<div class="col-xs-4">
			</div>
			<div class="col-xs-8">
			</div>
		</div>
	</div>
    
    </div>
  

@endsection
