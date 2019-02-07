@extends('layouts.app')
@section('content')
<style>
.ajax-file-upload-statusbar {
border: 1px solid #c7ced5;
margin-top: 10px;
width: 99%;
margin-right: 10px;
margin-left:1px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
padding: 5px 5px 5px 5px
}
.ajax-file-upload-preview {
margin-left:13px;
margin-top:10px;	
}
.ajax-file-upload-filename {
width: 100%;
height: auto;
margin: 10px 5px 5px 10px;
color: #616a7a
}
.ajax-file-upload-progress {
margin: 0 10px 5px 10px;
position: relative;
width: 80%;
border: 1px solid #ddd;
padding: 1px;
border-radius: 3px;
display: inline-block;

}
.ajax-file-upload-bar {
background-color: #007bff;
width: 0;
height: 20px;
border-radius: 3px;
color:#FFFFFF;
}
.ajax-file-upload-percent {
position: absolute;
display: inline-block;
top: 3px;
left: 48%
}
.ajax-file-upload-red {
-moz-box-shadow: inset 0 39px 0 -24px #df2d29;
-webkit-box-shadow: inset 0 39px 0 -24px #df2d29;
box-shadow: inset 0 39px 0 -24px #df2d29;
background-color: #df2d29;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
display: inline-block;
color: #fff;
font-family: arial;
font-size: 13px;
font-weight: normal;
padding: 4px 15px;
text-decoration: none;
text-shadow: 0 1px 0 #df2d29;
cursor: pointer;
vertical-align: top;
margin-right:5px;
}
.ajax-file-upload-green {
background-color: #249d3d;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
margin: 0;
padding: 0;
display: inline-block;
color: #fff;
font-family: arial;
font-size: 13px;
font-weight: normal;
padding: 4px 15px;
text-decoration: none;
cursor: pointer;
text-shadow: 0 1px 0 #249d3d;
vertical-align: top;
margin-right:5px;
}
.ajax-file-upload {
	background-color: #616a72;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
margin: 0;
padding: 0;
display: inline-block;
color: #fff;
font-family: arial;
font-size: 13px;
font-weight: normal;
padding: 4px 15px;
text-decoration: none;
cursor: pointer;
text-shadow: 0 1px 0 #616a72;
vertical-align: top;
margin-right:5px;
  }
  
.ajax-file-upload:hover {
      background: #50575d;
      -moz-box-shadow: 0 0px 0 0 #50575d;
      -webkit-box-shadow: 0 0px 0 0 #50575d;
}

.ajax-upload-dragdrop
{

	border:2px dotted #c7ced5;
	width:100%;
	color: #DADCE3;
	text-align:left;
	padding:10px 10px 10px 10px;
}
</style>
<script language="javascript">
function STORE()
{
	$('#submit').prop('disabled', true);
	$('#submit').val('Saving...');
	
	$.ajax({
			data: {
        		"_token": $("meta[name=csrf-token]").attr("content"),
        		post_type: '{{ $setting->post_type }}',
				content_type: '{{ $setting->content_type }}',
				content: $('#content').val(),
				layout: $('#layout').val(),
				date: $('#date').val(),
				key: '{{ $setting->key }}',
				title: $('#title').val()
        	},
			type: 'POST',
			url: '/blog/post'
			}).done(function( data ) {
			if(data.id=="1")
			{
				window.location='/blog/post';
			}
			else
			{
				$("#result").empty().append(data).hide().fadeIn();
				$('#submit').prop('disabled', false);
				$('#submit').val('Save');
			}
		});
	
	return false;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-camera"></i> Add Photo</div>
                <div class="card-body">
				
<form method="post" action="/blog/post" onSubmit="return STORE()">
<!-- input type="hidden" name="post_type" value="{{ $setting->post_type }}">
<input type="hidden" name="content_type" value="{{ $setting->content_type }}">
<input type="hidden" name="key" value="{{ $setting->key }}" -->
<div id="result"></div>

<div class="form-group">
<div id="status"></div>
<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload Photo </b></div>
<script>
$(document).ready(function()
{
var settings = {
    url: "/blog/file",
    multiple:false,
	dragDrop:true,
	maxFileCount:-1,
    fileName: "myfile",
    allowedTypes:"jpg,jpeg,png",	
    returnType:"json",
	acceptFiles:"image/*",
	uploadStr:"<i class=\"fa fa-camera fa-fw\"></i> Capture",
	onSuccess:function(files,data,xhr)
    {
		
    },
    showDelete:true,
	formData: { key: '{{ $setting->key }}' , _token: $("meta[name=csrf-token]").attr("content") },
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
	<input type="text" id="content" name="content" class="form-control" placeholder="Caption" autocomplete="off">
</div>
<div class="form-group">
	<input type="text" id="layout" name="layout" class="form-control" placeholder="Layout" autocomplete="off">
</div>

				
                
<div class="form-group">   
				            
                <div class='input-group date' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="{{$setting->date}}" id="date1" class="form-control" readonly>
                    <div class="input-group-append input-group-addon text-muted">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    
                </div>
 		<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
					format: 'YYYY-MM-DD HH:mm:00',
					showTodayButton: true,
					showClose: true,
					ignoreReadonly: true
				});
            });
        </script>    
</div>
     
<input  class="btn btn-danger" type="button" onClick="window.location='/blog/post'" name="submit" value="Cancel">&nbsp;<input  class="btn btn-primary" id="submit" type="submit" name="submit" value="Save">
</form>







    </div>
</div>       
			
        </div>
    </div>
</div>       
@endsection