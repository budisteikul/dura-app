@extends('layouts.admin-lte.blank',['folder' => 'profiles'])
@section('title', 'Profiles')
@section('content')
@push('scripts')
<script language="javascript">
function UPDATE_EMAIL()
{
	var error = false;
	var input = ["new_email","password"];
	
	$("#result_email").empty();
	$("#submit_email").attr("disabled", true);
	$("#submit_email").html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.each(input, function( index, value ) {
  		$('#label-'+ value).remove();
		$('#div-'+ value).removeClass('form-group has-error').addClass('form-group');
		$('#span-'+ value).removeClass('input-group-addon has-error').addClass('input-group-addon');
	});
	
	$.each(input, function( index, value ) {
		if($('#'+ value).val()=="" || $('#'+ value).val()==null)
		{
			$('#div-'+ value).removeClass('form-group').addClass('form-group has-error');
			$('#div-'+ value).prepend('<label id="label-'+ value +'" class="control-label" for="'+ value +'"><i class="fa fa-times-circle-o"></i> The '+ $('#'+ value).attr('placeholder') +' field is required.</label>');
			$('#span-'+ value).removeClass('input-group-addon').addClass('input-group-addon has-error');
			error = true;
		}
	});
	
	if(error)
	{
		$("#submit_email").attr("disabled", false);
		$("#submit_email").html('<span class="fa fa-save"></span> {{ __('Save') }}');
		return false;	
	}
	
	if(!error)
	{
		
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"new_email": $('#new_email').val(),
			"password": $('#password').val(),
			"setting": 'email'
        },
		type: 'PUT',
		url: '{{ route('profiles.update',[ 'profile' => Auth::user()->id ]) }}'
		}).done(function( data ) {
			console.log(data);
			if(data.id=="1")
			{
				$("#result_email").empty().append('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success!</h4>'+ data.message +'</div>').hide().fadeIn();
				$("#submit_email").attr("disabled", false);
				$("#submit_email").html('<span class="fa fa-save"></span> {{ __('Save') }}');
			}
			else
			{
				$.each( data, function( key, value ) {
					$('#div-'+ key).removeClass('form-group').addClass('form-group has-error');
					if(value!="")
					{
						$('#div-'+ key).prepend('<label id="label-'+ key +'" class="control-label" for="'+ key +'"><i class="fa fa-times-circle-o"></i> '+ value +'</label>');
					}
					$('#span-'+ key).removeClass('input-group-addon').addClass('input-group-addon has-error');
				});
				
				$("#submit_email").attr("disabled", false);
				$("#submit_email").html('<span class="fa fa-save"></span> {{ __('Save') }}');
			}
		});	
	}
	
	return false;
}
</script>
<script language="javascript">
function UPDATE_PROFILE()
{
	//$("#input-file").attr("style", "color:#A12022;border-color:#A12022;");
	
	var error = false;
	var input = ["name"];
	
	$("#result_profile").empty();
	$("#submit_profile").attr("disabled", true);
	$("#submit_profile").html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.each(input, function( index, value ) {
  		$('#label-'+ value).remove();
		$('#div-'+ value).removeClass('form-group has-error').addClass('form-group');
		$('#span-'+ value).removeClass('input-group-addon has-error').addClass('input-group-addon');
	});
	
	$.each(input, function( index, value ) {
		if($('#'+ value).val()=="" || $('#'+ value).val()==null)
		{
			$('#div-'+ value).removeClass('form-group').addClass('form-group has-error');
			$('#div-'+ value).prepend('<label id="label-'+ value +'" class="control-label" for="'+ value +'"><i class="fa fa-times-circle-o"></i> The '+ $('#'+ value).attr('placeholder') +' field is required.</label>');
			$('#span-'+ value).removeClass('input-group-addon').addClass('input-group-addon has-error');
			error = true;
		}
	});
	
	
	if(error)
	{
		$("#submit_profile").attr("disabled", false);
		$("#submit_profile").html('<span class="fa fa-save"></span> {{ __('Save') }}');
		return false;	
	}
	
	if(!error)
	{
		
		
		
		
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"name": $('#name').val(),
			"setting": 'profile'
        },
		type: 'PUT',
		url: '{{ route('profiles.update',[ 'profile' => Auth::user()->id ]) }}'
		}).done(function( data ) {
			//alert(data);
			if(data.id=="1")
			{
				
				if($("#file")[0].files.length>0)
				{
					var input = ["file"];
					$.each(input, function( index, value ) {
						$('#label-'+ value).remove();
						$('#div-'+ value).removeClass('form-group has-error').addClass('form-group');
						$('#span-'+ value).removeClass('input-group-addon has-error').addClass('input-group-addon');
						$('#clear-'+ value).removeClass('btn btn-default has-error').addClass('btn btn-default');
						$('#input-'+ value).removeClass('btn btn-default upload-input has-error').addClass('btn btn-default upload-input');
					});
					
					var formData = new FormData();
					formData.append("file",$("#file")[0].files[0]);
					formData.append("_token",$("meta[name=csrf-token]").attr("content"));
					
					$.ajax({
						data : formData,
						type: 'POST',
						processData: false,
						contentType: false,
						url: '{{ route('profiles.store') }}'
						}).done(function( data1 ) {
							if(data1.id=="1")
							{
								
								$.each(input, function( index, value ) {
									$('#filename-'+ value).val("");
									$('#clear-'+ value).hide();
									$('#'+ value).val("");
									$('#title-'+ value).text("Browse");
								});
								
								$('#old_img').val(data1.message);
								$('#img').attr('src', data1.message);
								
								$("#result_profile").empty().append('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success!</h4>'+ data.message +'</div>').hide().fadeIn();
								$("#submit_profile").attr("disabled", false);
								$("#submit_profile").html('<span class="fa fa-save"></span> {{ __('Save') }}');
								
							}
							else
							{
								$.each( data1, function( key, value ) {
								$('#div-'+ key).removeClass('form-group').addClass('form-group has-error');
								if(value!="")
								{
									$('#div-'+ key).prepend('<label id="label-'+ key +'" class="control-label" for="'+ key +'"><i class="fa fa-times-circle-o"></i> '+ value +'</label>');
								}
									$('#span-'+ key).removeClass('input-group-addon').addClass('input-group-addon has-error');
									$('#clear-'+ key).removeClass('btn btn-default').addClass('btn btn-default has-error');
									$('#input-'+ key).removeClass('btn btn-default upload-input').addClass('btn btn-default upload-input has-error');
								});
								
								$.each(input, function( index, value ) {
									$('#filename-'+ value).val("");
									$('#clear-'+ value).hide();
									$('#'+ value).val("");
									$('#title-'+ value).text("Browse");
								});
								
								$('#img').attr('src', $('#old_img').val());
								
								
								$("#submit_profile").attr("disabled", false);
								$("#submit_profile").html('<span class="fa fa-save"></span> {{ __('Save') }}');
							}
					});	
				}
				else
				{
					$("#result_profile").empty().append('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success!</h4>'+ data.message +'</div>').hide().fadeIn();
					$("#submit_profile").attr("disabled", false);
					$("#submit_profile").html('<span class="fa fa-save"></span> {{ __('Save') }}');
				}
				
				
				
			}
			else
			{
				$.each( data, function( key, value ) {
					$('#div-'+ key).removeClass('form-group').addClass('form-group has-error');
					if(value!="")
					{
						$('#div-'+ key).prepend('<label id="label-'+ key +'" class="control-label" for="'+ key +'"><i class="fa fa-times-circle-o"></i> '+ value +'</label>');
					}
					$('#span-'+ key).removeClass('input-group-addon').addClass('input-group-addon has-error');
				});
				
				$("#submit_profile").attr("disabled", false);
				$("#submit_profile").html('<span class="fa fa-save"></span> {{ __('Save') }}');
			}
		});	
	}
	
	return false;
}
</script>
<script language="javascript">
function UPDATE_PASSWORD()
{
	
	var error = false;
	var input = ["current_password","new_password","password_confirmation"];
	
	$("#result_password").empty();
	$("#submit_password").attr("disabled", true);
	$("#submit_password").html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.each(input, function( index, value ) {
  		$('#label-'+ value).remove();
		$('#div-'+ value).removeClass('form-group has-error').addClass('form-group');
		$('#span-'+ value).removeClass('input-group-addon has-error').addClass('input-group-addon');
	});
	
	$.each(input, function( index, value ) {
		if($('#'+ value).val()=="" || $('#'+ value).val()==null)
		{
			$('#div-'+ value).removeClass('form-group').addClass('form-group has-error');
			$('#div-'+ value).prepend('<label id="label-'+ value +'" class="control-label" for="'+ value +'"><i class="fa fa-times-circle-o"></i> The '+ $('#'+ value).attr('placeholder') +' field is required.</label>');
			$('#span-'+ value).removeClass('input-group-addon').addClass('input-group-addon has-error');
			error = true;
		}
	});
	
	if(!error)
	{
		if($('#new_password').val()!=$('#password_confirmation').val())
		{
			$('#div-new_password').removeClass('form-group').addClass('form-group has-error');
			$('#div-new_password').prepend('<label id="label-new_password" class="control-label" for="new_password"><i class="fa fa-times-circle-o"></i> The password and password confirm field must be same.</label>');
			$('#span-new_password').removeClass('input-group-addon').addClass('input-group-addon has-error');
			$('#div-password_confirmation').removeClass('form-group').addClass('form-group has-error');
		
			$('#span-password_confirmation').removeClass('input-group-addon').addClass('input-group-addon has-error');					
			error = true;
		}
	}
	
	if(error)
	{
		$("#submit_password").attr("disabled", false);
		$("#submit_password").html('<span class="fa fa-save"></span> {{ __('Save') }}');
		return false;	
	}
	
	if(!error)
	{
		
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"current_password": $('#current_password').val(),
			"new_password": $('#new_password').val(),
			"password_confirmation": $('#password_confirmation').val(),
			"setting": 'password'
        },
		type: 'PUT',
		url: '{{ route('profiles.update',[ 'profile' => Auth::user()->id ]) }}'
		}).done(function( data ) {
			//alert(data);
			if(data.id=="1")
			{
				$("#result_password").empty().append('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success!</h4>'+ data.message +'</div>').hide().fadeIn();
				$("#current_password").val('');
				$("#new_password").val('');
				$("#password_confirmation").val('');
				$("#submit_password").attr("disabled", false);
				$("#submit_password").html('<span class="fa fa-save"></span> {{ __('Save') }}');
			}
			else
			{
				$.each( data, function( key, value ) {
					$('#div-'+ key).removeClass('form-group').addClass('form-group has-error');
					if(value!="")
					{
						$('#div-'+ key).prepend('<label id="label-'+ key +'" class="control-label" for="'+ key +'"><i class="fa fa-times-circle-o"></i> '+ value +'</label>');
					}
					$('#span-'+ key).removeClass('input-group-addon').addClass('input-group-addon has-error');
					
					
				});
				$("#submit_password").attr("disabled", false);
				$("#submit_password").html('<span class="fa fa-save"></span> {{ __('Save') }}');
			}
		});	
	}
	
	return false;
}
</script>
<script>
$(function() {
    // Clear event
    $('#clear-file').click(function(){
        $('#filename-file').val("");
        $('#clear-file').hide();
        $('#file').val("");
        $("#title-file").text("Browse");
		$('#img').attr('src', $('#old_img').val());
		$('#img').attr('width', 160);
		$('#img').attr('height', 160);
    }); 
    // Create the preview image
    $("#file").change(function (){
        var file = this.files[0];
        $("#title-file").text("Change");
		$("#clear-file").show();
		$("#filename-file").val(file.name);
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#img').attr('src', e.target.result);
			$('#img').attr('width', 160);
			$('#img').attr('height', 160);
		}
		reader.readAsDataURL(file);
	});
});
</script>
@endpush
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
  
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profiles
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profiles</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div id="result" class="box-header">
         	
        </div>
        <div class="box-body">
        
        
        
        
        <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
              <li><a href="#tab_2" data-toggle="tab">Email</a></li>
              <li><a href="#tab_3" data-toggle="tab">Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              <p>
                <form  onSubmit="return UPDATE_PROFILE()">
                    <div id="result_profile"></div>
                    
					<input type="hidden" id="old_img" value="{{ asset(Auth::user()->picture_url) }}">
                    <div class="form-group row">
    					<label for="file" class="col-sm-2 col-form-label">Picture</label>
    					<div class="col-sm-5">
							<div class="form-group">
								<img id="img" src="{{ asset(Auth::user()->picture_url) }}" width="160" height="160">
							</div>
							<div id="div-file" class="form-group">
								
								<div class="input-group">
										<input type="text" id="filename-file" class="form-control" disabled="disabled">
										<span class="input-group-btn">
											<button id="clear-file" type="button" class="btn btn-default" style="display:none;">
												<span class="glyphicon glyphicon-remove"></span> Clear
											</button>
											<div id="input-file" class="btn btn-default upload-input" style="">
												<span class="glyphicon glyphicon-folder-open"></span>
												<span id="title-file" class="upload-input-title">Browse</span>
												<input id="file" type="file" accept="image/png, image/jpeg, image/gif" name="file"/>
											</div>
                                        </span>
								</div>
	 						</div>
    					</div>
  					</div>
                    
			
            
                	<div class="form-group row">
    					<label for="name" class="col-sm-2 col-form-label">Full Name</label>
    					<div class="col-sm-5">
                        	<div id="div-name" class="form-group">
                            <div class="input-group">
									<input type="text" name="name" class="form-control" id="name" placeholder="Full name" value="{{ Auth::user()->name }}">
									<span id="span-name" class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								</div>
	 						</div>
                            <button id="submit_profile" type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span> {{ __('Save') }}</button>
    					</div>
  					</div>
                    
                </form>
                </p>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
               	<p>
                <form onSubmit="return UPDATE_EMAIL()">
                	<div id="result_email"></div>
                    <div class="form-group row">
    					<label for="email" class="col-sm-2 col-form-label">Email</label>
    					<div class="col-sm-5">
                        	<div id="div-email" class="form-group">
								<div class="input-group">
									<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ Auth::user()->email }}" disabled>
									<span id="span-email" class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								</div>
	 						</div>
    					</div>
  					</div>
                	<div class="form-group row">
    					<label for="new_email" class="col-sm-2 col-form-label">New Email</label>
    					<div class="col-sm-5">
                        	<div id="div-new_email" class="form-group">
								<div class="input-group">
									<input type="email" name="new_email" class="form-control" id="new_email" placeholder="Email">
									<span id="span-new_email" class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								</div>
	 						</div>
    					</div>
  					</div>
                    <div class="form-group row">
    					<label for="password" class="col-sm-2 col-form-label">Password</label>
    					<div class="col-sm-5">
                        	<div id="div-password" class="form-group">
								<div class="input-group">
									<input type="password" name="password" class="form-control" id="password" placeholder="Password" value="">
									<span id="span-password" class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								</div>
	 						</div>
                            <button id="submit_email" type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span> {{ __('Save') }}</button>
    					</div>
  					</div>
                    
                    
                    
                </form>
                </p>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <p>
                <form id="form-password" onSubmit="return UPDATE_PASSWORD()">
                	<div id="result_password"></div>
                	<div class="form-group row">
    					<label for="current_password" class="col-sm-2 col-form-label">Current password</label>
    					<div class="col-sm-5">
                        	<div id="div-current_password" class="form-group">
								<div class="input-group">
									<input type="password" name="current_password" class="form-control" id="current_password" placeholder="Current password">
									<span id="span-current_password" class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								</div>
	 						</div>
    					</div>
  					</div>
                    <div class="form-group row">
    					<label for="new_password" class="col-sm-2 col-form-label">New password</label>
    					<div class="col-sm-5">
                        	<div id="div-new_password" class="form-group">
								<div class="input-group">
									<input type="password" name="new_password" class="form-control" id="new_password" placeholder="New password">
									<span id="span-new_password" class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								</div>
	 						</div>
                            
    					</div>
  					</div>
                    <div class="form-group row">
    					<label for="password_confirmation" class="col-sm-2 col-form-label">Password confirmation</label>
    					<div class="col-sm-5">
                        	<div id="div-password_confirmation" class="form-group">
								<div class="input-group">
									<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password confirmation">
									<span id="span-password_confirmation" class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
								</div>
	 						</div>
                            <button id="submit_password" type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span> {{ __('Save') }}</button>
    					</div>
  					</div>
                    
                    
                    
                </form>
                </p>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        
        
        
        
        
        
        
        
        

  

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
    
    
    
  </div>
  <!-- /.content-wrapper -->
@endsection
