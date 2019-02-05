@extends('layouts.app')
@section('title', 'Blog Post')
@section('user', $user->name )
@section('content')
<script type="text/javascript">
function postEditPost()
{
	$('#submit').prop('disabled', true);
	$('#submit').val('Saving...');
	
	var tipe_post = $('#tipe_post').val();
	var tipe_konten = $('#tipe_konten').val();
	var _token = $('#_token').val();
	var post = $('#post').val();
	var judul = $('#judul').val();
	var konten = $('#konten').val();
	var tanggal = $('#tanggal').val();
	var layout = $('#layout').val();
	var id = $('#id').val();
	var key = $('#key').val();
	@foreach($result_attachments as $attachment)
	var attachment_{{ str_ireplace("-","_",$attachment->id) }} = $('#attachment_{{ str_ireplace("-","_",$attachment->id) }}').val();
	if($('#del_attachment_{{ str_ireplace("-","_",$attachment->id) }}').is(':checked'))
	{
		var del_attachment_{{ str_ireplace("-","_",$attachment->id) }} = $('#del_attachment_{{ str_ireplace("-","_",$attachment->id) }}').val();
	}
	@endforeach
	var table = $('#dataTables-example').DataTable();
	$.post("/blog/post/edit", {
	judul:judul,
	tipe_post: tipe_post,
	tipe_konten: tipe_konten,
	post: post, konten: konten,
	tanggal: tanggal,
	layout: layout,
	key: key, 
	@foreach($result_attachments as $attachment)
	attachment_{{ str_ireplace("-","_",$attachment->id) }}: attachment_{{ str_ireplace("-","_",$attachment->id) }}, del_attachment_{{ str_ireplace("-","_",$attachment->id) }}: del_attachment_{{ str_ireplace("-","_",$attachment->id) }},
	@endforeach
	id: id,
	 _token:_token,
	 submit: "Update" } )
	.done(function( data ) {
    	if(data=="")
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
                <div class="card-header">Edit Photo</div>
                <div class="card-body">
                
                
                
                
                
                
                
                
                
                
                
                
                
<form method="post" action="/blog/post/edit"  onSubmit="return postEditPost()">
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div id="result"></div>

<div class="container">
	<div class="row">
		@foreach($result_attachments as $attachment)
				<div class="col-auto" style="margin-top:10px;">
					<img style="padding-bottom:5px; height:150px;" class="image-photo" src="/storage/images/250/{{ $attachment->public_id .".". $attachment->format }}" >
				
					
   <div class="form-row align-items-center">
    <div class="col-auto">
      <input type="text" class="form-control text-center" style="width:50px;" id="attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="{{ $attachment->sort }}">
    </div>
    
    <div class="col-auto">
      <div class="form-check mb-2">
        <input type="checkbox" id="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="hapus">
        <label class="form-check-label" for="autoSizingCheck">
          Delete
        </label>
      </div>
    </div>
    
  </div>
				</div>
		@endforeach
	</div>
</div>
<br><br>
<div class="form-group">
<div id="status"></div>
<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload </b></div>
<script>
$(document).ready(function()
{
var settings = {
    url: "/blog/file/add",
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
	formData: { key: $('#key').val() , _token: $('#_token').val() },
    deleteCallback: function(data,pd)
	{
    for(var i=0;i<data.length;i++)
    {
		$.post("/blog/file/delete",{_token:$('#_token').val(),name:data[i]},
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
	<input type="text" id="konten" name="konten" value="{{$result->konten}}" class="form-control" placeholder="Caption" autocomplete="off">
</div>

<div class="form-group">
	<input type="text" id="layout" name="layout" value="{{$result->layout}}" class="form-control" placeholder="Layout" autocomplete="off">
</div>
		
<div class="form-group">	
                <div class='input-group date' id='datetimepicker1'>
                    <input type="text" id="tanggal" name="tanggal" value="{{$result->tanggal}}" id="date1" class="form-control" readonly>
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

<input type="hidden" id="tipe_post" name="tipe_post" value="post">
<input type="hidden" id="tipe_konten" name="tipe_konten" value="{{ $result->tipe_konten }}">
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="key" id="key" value="{{ md5(date('YmdHis')) }}">
<input type="hidden" name="id" id="id" value="{{$result->id}}">
<input  class="btn btn-danger" type="button" onClick="window.location='/blog/post'" name="submit" value="Cancel">&nbsp;<input  class="btn btn-primary" id="submit" type="submit" name="submit" value="Save">
</form>








    </div>
</div>       




				
        </div>
    </div>
</div>
@endsection