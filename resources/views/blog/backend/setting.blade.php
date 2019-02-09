@extends('layouts.app')
@section('content')
<script language="javascript">
function UPDATE()
{
	$('#submit_general').prop('disabled', true);
	$('#submit_general').val('Saving...');
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			title1: $('#title1').val(),
			title2: $('#title2').val(),
			description: $('#description').val(),
			facebook: $('#facebook').val(),
			twitter: $('#twitter').val(),
			instagram: $('#instagram').val(),
			github: $('#github').val(),
			path: $('#path').val(),
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
				$('#submit_general').prop('disabled', false);
				$('#submit_general').val('Save');
			}
		});	
	
	return false;
}
</script>


    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-gear"></i> Setting</div>
                <div class="card-body">
                

        
    <div id="result"></div>
        
                    
    <form onSubmit="return UPDATE()">
    <div class="form-group">
		<b>Header :</b>
		<input id="title2" type="text" name="title2" class="form-control" value="{{ $setting->title2 }}" placeholder="Judul">
	</div>
    
	<div class="form-group">
		<b>Title :</b>
		<input id="title1" type="text" name="title1" class="form-control" value="{{ $setting->title1 }}" placeholder="Judul">
	</div>
    
	
    
	<div class="form-group">
		<b>Description :</b>
		<textarea id="description" name="description" class="form-control" style="height:200px;">{{ $setting->description }}</textarea>
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
   		 		allowedTypes:"jpg,jpeg",	
   		 		returnType:"json",
		 		allowDuplicates: false,
		 		multiple: false,
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
    
	<div class="form-group">
		<b>Path :</b>
		<input type="text" id="path" name="path" class="form-control" value="{{ $setting->path }}" placeholder="Path link">
	</div>
    
	<div class="form-group">
		<b>Github :</b>
		<input type="text" id="github" name="github" class="form-control" value="{{ $setting->github }}" placeholder="Github link">
	</div>
    
	
	
	<input  class="btn btn-lg btn-primary btn-block" id="submit_general" type="submit" name="submit_general" value="Save">
	
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
</div>
                  
@endsection
                                     





