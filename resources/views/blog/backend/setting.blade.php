@extends('layouts.app')
@section('content')
@push('scripts')
<script language="javascript">
function UPDATE()
{
	
	$('#submit_general').prop('disabled', true);
	$('#submit_general').html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			title1: $('#title1').val(),
			title2: $('#title2').val(),
			description: $('#description').val(),
			facebook: $('#facebook').val(),
			twitter: $('#twitter').val(),
			instagram: $('#instagram').val(),
			domain: $('#domain').val(),
			key: 'header_file',
			tipe: "general_setting"
        },
		type: 'PUT',
		url: "/blog/setting/{{ $setting->user_id }}"
		}).done(function( data ) {
			if(data.id=="1")
			{
				window.location='/blog/setting/{{ $setting->user_id }}/edit#top';
				$("#result").empty().append('<div class="alert alert-success"  role="alert">'+ data.message +'</div>').hide().fadeIn();
				
				$('.ajax-file-upload-statusbar').remove();
				
				$('#domain').val(data.domain);
				$('#title1').val(data.title1);
				$('#title2').val(data.title2);
				$('#description').val(data.description);
				$('#facebook').val(data.facebook);
				$('#twitter').val(data.twitter);
				$('#instagram').val(data.instagram);
				
				$('#div_header').removeClass('d-none');
				$("#header").attr("src","/storage/{{ Auth::user()->id }}/images/header/"+ data.header);
				
				$('#submit_general').prop('disabled', false);
				$('#submit_general').html('<i class="fa fa-save"></i> Save');
			}
		});	
	
	return false;
}
</script>
@endpush

    

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Setting</div>
                <div class="card-body">
                

        
    <div id="result"></div>
        
                    
    <form onSubmit="UPDATE(); return false;">
    <div class="form-group">
		<b>Domain :</b>
		<input id="domain" type="text" name="domain" class="form-control" value="{{ $setting->domain }}" placeholder="http://www.domain.com/">
	</div>
    
    <div class="form-group">
		<b>Header :</b>
		<input id="title2" type="text" name="title2" class="form-control" value="{{ $setting->title2 }}" placeholder="Header">
	</div>
    
	<div class="form-group">
		<b>Title :</b>
		<input id="title1" type="text" name="title1" class="form-control" value="{{ $setting->title1 }}" placeholder="Judul">
	</div>
    
	<div class="form-group">
		<b>Description :</b>
		<textarea id="description" name="description" class="form-control" style="height:200px;">{{ $setting->description }}</textarea>
	</div>
    
    <div id="div_header" class="form-group {{ empty($setting->header) ? 'd-none' : '' }}">
		<img id="header" src="/storage/{{ Auth::user()->id }}/images/header/{{ $setting->header }}" width="200" height="100">
	</div>
    
	<div class="form-group">
		<div id="status"></div>
		<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload </b></div>
		<script>
		
		$(document).ready(function()
		{
			var settings = {
   		 		url: "/blog/file",
   		 		dragDrop:true,
   		 		fileName: "myfile",
   		 		allowedTypes:"jpg,jpeg,png",	
   		 		returnType:"json",
				acceptFiles:"image/*",
		 		allowDuplicates: true,
		 		multiple: false,
				uploadStr:"<i class=\"fa fa-folder-open\"></i> Browse",
		 		onSuccess:function(files,data,xhr)
   				 {
		
   				 },
    	 		showDelete:true,
		 		formData: { key: 'header_file', _token: $("meta[name=csrf-token]").attr("content") },
		 		deleteCallback: function(data,pd)
		 		{
	     			for(var i=0;i<data.length;i++)
		 			{
						$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '/blog/file/'+ data[i]
						}).done(function( msg ) {
							
						});	
    				}      
    				pd.statusbar.hide();
				}
			}
			
			var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
			
		});
		</script>
	</div>

	<div class="form-group">
		<b>Facebook :</b>
		<input type="text" id="facebook" name="facebook" class="form-control" value="{{ $setting->facebook }}" placeholder=	"Facebook link">
	</div>
    
	<div class="form-group">
		<b>Twitter :</b>
		<input type="text" id="twitter" name="twitter" class="form-control" value="{{ $setting->twitter }}" placeholder="Twitter link">
	</div>
    
	<div class="form-group">
		<b>Instagram :</b>
		<input type="text" id="instagram" name="instagram" class="form-control" value="{{ $setting->instagram }}" placeholder="Instagram link">
	</div>
    
	
    <button id="submit_general" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
</form>
                    
                    <!-- ################################################### -->
                    </div>
				</div>
                </div>
            </div>
        </div>
        
        </div>
     </div>
     
     
     
     
    			</div>
            </div>
        </div>
    </div>

                  
@endsection
                                     





