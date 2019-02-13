@extends('layouts.app')

@section('content')
<script language="javascript">
function RESEND()
{
	$('#alert').fadeOut();
	$('#submit').remove();
	$('#form').prepend('<span id="span">{{ __('click here to request another') }}</span>');
	$.ajax({
		type: 'GET',
		url: '{{ route('verification.resend') }}'
		}).done(function( data ) {
			if(data.id==1)
			{
				$('.card-body').prepend('<div id="alert" class="alert alert-success" role="alert">'+ data.message +'</div>');
				$('#span').remove();
				$('#form').prepend('<a id="submit" href="{{ route('verification.resend') }}" onClick="return RESEND()">{{ __('click here to request another') }}</a>');
			}
			else
			{
				$('.card-body').prepend('<div id="alert" class="alert alert-danger" role="alert">'+ data.message +'</div>');
				$('#span').remove();
				$('#form').prepend('<a id="submit" href="{{ route('verification.resend') }}" onClick="return RESEND()">{{ __('click here to request another') }}</a>');
			}
		});	
	
	
	return false;
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
					
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <span id="form"><a id="submit" href="{{ route('verification.resend') }}" onClick="return RESEND()">{{ __('click here to request another') }}</a>.</span>
					
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
