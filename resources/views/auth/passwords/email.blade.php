@extends('layouts.app')
@section('content')
<script language="javascript">
function AUTH_REQUEST()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	$('#label-email').remove();
	$('#alert').fadeOut();
	
	var input = ["email"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"email": $('#email').val()
        },
		type: 'POST',
		url: '{{ route('password.email') }}'
		}).done(function( data ) {
			
				if(data.id==1)
				{
					
					$('.card-body').prepend('<div id="alert" class="alert alert-success" role="alert">'+ data.message +'</div>');
					$("#submit").attr("disabled", false);
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
					$('#submit').html('{{ __('Send Password Reset Link') }}');
				}
		});	
	
	
	return false;
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form onSubmit="return AUTH_REQUEST()">
                       
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
