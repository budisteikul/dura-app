@extends('layouts.app')
@section('title', 'Blog Post')
@section('user', $user->name )
@section('content')
<script language="javascript">
function general_setting()
{
	$('#submit_general').prop('disabled', true);
	
	var judul1 = $('#judul1').val();
	var judul2 = $('#judul2').val();
	var deskripsi = $('#deskripsi').val();
	var facebook = $('#facebook').val();
	var twitter = $('#twitter').val();
	var instagram = $('#instagram').val();
	var github = $('#github').val();
	var path = $('#path').val();
	var key = $('#key').val();
	var _token = $('#_token').val();
	$.post("/blog/setting", { 
	judul1: judul1,
	judul2: judul2,
	deskripsi: deskripsi,
	facebook: facebook,
	twitter: twitter,
	instagram: instagram,
	github: github,
	path: path,
	key: key,
	tipe: "general_setting",
	_token:_token,
	submit: "Update"
	} )
	.done(function( data ) {
			$("#result").empty().append(data).hide().fadeIn();
			$('#submit_general').prop('disabled', false);
			window.location='/blog/setting#top';
  	});
	
	return false;
}
</script>


    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Setting</div>
                <div class="card-body">
                

        
    <div id="result"></div>
        
                    
    <form method="post" action="/blog/setting" onSubmit="return general_setting()">

    
	<div class="form-group">
		<b>Judul 1 :</b>
		<input id="judul1" type="text" name="judul1" class="form-control" value="{{ $setting->judul1 }}" placeholder="Judul">
	</div>
    
	<div class="form-group">
		<b>Judul 2 :</b>
		<input id="judul2" type="text" name="judul2" class="form-control" value="{{ $setting->judul2 }}" placeholder="Judul">
	</div>
    
	<div class="form-group">
		<b>Deskripsi :</b>
		<textarea id="deskripsi" name="deskripsi" class="form-control" style="height:200px;">{{ $setting->deskripsi }}</textarea>
	</div>
    
	<div class="form-group">
		<div id="status"></div>
		<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload </b></div>
		<script>
		$(document).ready(function()
		{
			var settings = {
   		 		url: "/blog/file/add",
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
		 		formData: { key: 'header_file', _token: '{{csrf_token()}}' },
		 		deleteCallback: function(data,pd)
		 		{
	     			for(var i=0;i<data.length;i++)
		 			{
						$.post("/blog/file/delete",{_token:"{{csrf_token()}}",name:data[i]},
        				function(resp, textStatus, jqXHR)
        				{
            				//Show Message  
            				//$("#status").append("<div>File Deleted</div>");      
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
    
	
	<input type="hidden" id="tipe" name="tipe" value="general_setting">
	<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
	<input type="hidden" id="key" name="key" value="header_file">
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
                                     





