
<script type="text/javascript">
function close_window()
{
	$.fancybox.close();	
}

function UPDATE()
{
	$('#submit').prop('disabled', true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	
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
			content: $('#content').val(),
			date: $('#date').val(),
			layout: $('#layout').val(),
			key: '{{ $setting->key }}'
        },
		type: 'PUT',
		url: "/blog/photo/{{ $result->id }}"
		}).done(function( data ) {
			if(data.id=="1")
			{
				$('#dataTables-example').DataTable().ajax.reload( null, false );
				$.fancybox.close();
			}
			else
			{
				$("#result").empty().append(data).hide().fadeIn();
				$('#submit').prop('disabled', false);
				$('#submit').html('<i class="fa fa-save"></i> Save');
			}
		});	
		
	return false;
}
</script>
<div class="h-100" style="width:99%">		

    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
                <div class="card-header">Edit photo</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">

<div id="result"></div>
@if(!$result->attachments->isEmpty())
<div class="container">
	<div class="row">
		@foreach($result->attachments->sortBy('sort') as $attachment)
				
				<div class="col-auto" style="margin-top:10px;">
                	<img style=" height:150px; " class="image-photo rounded" src="{{ \App\Classes\Blog\BlogClass::cloudinary_url(Auth::user()->id.'/images/original/'. $attachment->file_name,'250') }}">
                    
					<!-- img style=" height:150px; " class="image-photo rounded" src="/storage/{{ Auth::user()->id }}/images/250/{{ $attachment->file_name }}" -->
				
					
					<div class="form-row align-items-center pt-1">
						<div class="col-auto">
							<input type="text" class="form-control text-center" style="width:50px;" id="attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="{{ $attachment->sort }}">
						</div>
    
						<div class="col-auto">
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" name="del_attachment_{{ str_ireplace("-","_",$attachment->id) }}" value="hapus">
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
@endif
<div class="form-group">
<label>Photo :</label>
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
	<label for="content">Caption :</label>
    <textarea class="form-control" id="content" name="content" rows="3" placeholder="Caption">{{$result->content}}</textarea>
</div>

<div class="form-group">
	<label for="layout">Layout :</label>
	<input type="text" id="layout" name="layout" value="{{$result->layout}}" class="form-control" placeholder="Layout" autocomplete="off">
</div>
		
<div class="form-group">	
<label for="datetimepicker1">Date :</label>
                <div class='input-group' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="{{$result->date}}" class="form-control bg-white" readonly>
                    <div class="input-group-append input-group-addon text-muted">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    
                </div>
 		<script type="text/javascript">
            $(function () {
                $('#date').datetimepicker({
					format: 'YYYY-MM-DD HH:mm:00',
					showTodayButton: true,
					showClose: true,
					ignoreReadonly: true,
					icons: {
                    	time: "fa fa-clock"
                	},
					widgetPositioning: {
            			horizontal: 'left',
            			vertical: 'top'
        			}
				});
            });
        </script>    
</div>
<button  class="btn btn-danger" type="button" onClick="close_window();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>