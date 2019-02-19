
<script language="javascript">
function STORE()
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
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"title": $('#title').val(),
			"category_id": category_id,
        	"content": $('#content').val(),
			"date": $('#date').val(),
			"key": '{{ $setting->key }}'
        },
		type: 'POST',
		url: '{{ route('blog_post.store') }}'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				//window.location.href = data.message;
				$("#result").empty().append('<div class="alert alert-success"  role="alert">'+ data.message +'</div>').hide().fadeIn();
				setTimeout(function() {
       				$('#dataTables-example').DataTable().ajax.reload( null, false );
					$.fancybox.close();	
   				},500);
				
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
				
<form onSubmit="STORE(); return false;">

<div id="result"></div>

<div class="form-group">
	<label for="title">Title :</label>
	<input type="text" id="title" name="title" class="form-control" placeholder="Title">
</div>

<div class="form-group">
	<label for="content">Content :</label>
    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Content"></textarea>
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
  		<input class="form-check-input" type="checkbox" name="category_id[]" id="category_id_{{ $i }}" value="{{ $result_category->id }}">
  		<label class="form-check-label" for="category_id_{{ $i }}">{{ $result_category->name }}</label>
	</div>
    @endforeach
</div>

<div class="form-group">   
	<label for="datetimepicker1">Date :</label>
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
     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>







    </div>
</div>       
			
        </div>
    </div>
</div>       
