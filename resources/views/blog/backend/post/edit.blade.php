
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["title"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	var category_id = $('input[name="category_id\\[\\]"]:checked').map(function(i, elem) { return $(this).val(); }).get();
	
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
			"title": $('#title').val(),
			"category_id": category_id,
        	"content": $('#content').val(),
			"date": $('#date').val(),
			"key": '{{ $setting->key }}'
        },
		type: 'PUT',
		url: "{{ route('blog_post.index') }}/{{ $result->id }}"
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				
       				$('#dataTables-example').DataTable().ajax.reload( null, false );
					$.fancybox.close();	
   				
				
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
				$('#submit').html('<i class="fa fa-save"></i> {{ __('Save') }}');
			}
		});
	
	
	return false;
}
</script>

<div class="container h-100">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add post</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">

<div id="result"></div>

<div class="form-group">
	<label for="title">Title :</label>
	<input type="text" id="title" name="title" class="form-control" placeholder="Title" value="{{ $result->title }}">
</div>

<div class="form-group">
	<label for="content">Content :</label>
    <textarea class="form-control" id="content" name="content" rows="8" placeholder="Content">{{ $result->content }}</textarea>
</div>

<div class="form-group">
	<div class="row">
		@foreach($result->attachments->sortBy('sort') as $attachment)
				<div class="col-auto" style="margin-top:10px;">
					<img style=" height:150px; " class="image-photo rounded" src="/storage/images/{{ Auth::user()->id }}/250/{{ $attachment->file_name }}" >
				
					
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

<div class="form-group">
	<label>Image :</label>
<div id="status"></div>
<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload Photo </b></div>
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
		$.each( data, function( index, value ) {
						
					});	
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
	<div>
    <label for="category_id">Category :</label>
    
    </div>
    @php
    $i = 1;
    @endphp
    @foreach($result_categories->sortBy('name') as $result_category)
    @php
    $i++;
    @endphp
   	
	<div class="form-check form-check-inline">
  
  		<input class="form-check-input" type="checkbox" name="category_id[]" id="category_id_{{ $i }}" value="{{ $result_category->id }}" {{ ($result->categories->contains($result_category->id)) ? 'checked' : '' }}>
  		<label class="form-check-label" for="category_id_{{ $i }}">{{ $result_category->name }}</label>
	</div>
    @endforeach
</div>

<div class="form-group">   
	<label for="datetimepicker1">Date :</label>
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
     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>







    </div>
</div>       
			
        </div>
    </div>
</div>       
