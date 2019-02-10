@extends('layouts.app')
@section('content')
<script type="text/javascript">
function UPDATE()
{
	$('#submit').prop('disabled', true);
	$('#submit').val('Saving...');
	
	@foreach($result->attachments as $attachment)
	var attachment_{{ str_ireplace("-","_",$attachment->id) }} = $('#attachment_{{ str_ireplace("-","_",$attachment->id) }}').val();
	if($('#del_attachment_{{ str_ireplace("-","_",$attachment->id) }}').is(':checked'))
	{
		var del_attachment_{{ str_ireplace("-","_",$attachment->id) }} = $('#del_attachment_{{ str_ireplace("-","_",$attachment->id) }}').val();
	}
	@endforeach
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			@foreach($result->attachments as $attachment)
				attachment_{{ str_ireplace("-","_",$attachment->id) }}: attachment_{{ str_ireplace("-","_",$attachment->id) }}, del_attachment_{{ str_ireplace("-","_",$attachment->id) }}: del_attachment_{{ str_ireplace("-","_",$attachment->id) }},
			@endforeach
        	title:$('#title').val(),
			post_type: '{{ $result->post_type }}',
			content_type: '{{ $result->content_type }}',
			content: $('#content').val(),
			date: $('#date').val(),
			layout: $('#layout').val(),
			key: '{{ $setting->key }}'
        },
		type: 'PUT',
		url: "/blog/post/{{ $result->id }}"
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
                <div class="card-header"><i class="fa fa-camera"></i> Edit Photo</div>
                <div class="card-body">
				
<form onSubmit="return UPDATE()">

<div id="result"></div>

<div class="container">
	<div class="row">
		@foreach($result->attachments->sortBy('sort') as $attachment)
				
				<div class="col-auto" style="margin-top:10px;">
					<img style="padding-bottom:5px; height:150px;" class="image-photo" src="/storage/images/{{ Auth::user()->id }}/250/{{ $attachment->file_name }}" >
				
					
					<div class="form-row align-items-center">
						<div class="col-auto">
							<input type="text" class="form-control text-center" style="width:50px;" id="attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="{{ $attachment->sort }}">
						</div>
    
						<div class="col-auto">
							<div class="form-check">
								<input type="checkbox" id="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="hapus">
								<label class="form-check-label" for="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}">
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
    url: "/blog/file",
    multiple:true,
	dragDrop:true,
	maxFileCount:-1,
    fileName: "myfile",
    allowedTypes:"jpg,jpeg,png",	
    returnType:"json",
	acceptFiles:"image/*",
	uploadStr:"<i class=\"fa fa-folder-open\"></i> Browse",
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
	<input type="text" id="content" name="content" value="{{$result->content}}" class="form-control" placeholder="Caption" autocomplete="off">
</div>

<div class="form-group">
	<input type="text" id="layout" name="layout" value="{{$result->layout}}" class="form-control" placeholder="Layout" autocomplete="off">
</div>
		
<div class="form-group">	
                <div class='input-group date' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="{{$result->date}}" id="date1" class="form-control" readonly>
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