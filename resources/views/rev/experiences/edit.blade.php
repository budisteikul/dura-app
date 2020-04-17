
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["title","product_id"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"title": $('#title').val(),
			"product_id": $('#product_id').val(),
        },
		type: 'PUT',
		url: '{{ route('experiences.update',$blog_posts->id) }}'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
       				$('#dataTableBuilder').DataTable().ajax.reload( null, false );
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
<div class="h-100" style="width:99%">		

    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
                <div class="card-header">Edit experiences</div>
                <div class="card-body">
				
<form method="POST" onSubmit="UPDATE(); return false;" action="{{ route('experiences.update',$blog_posts->id) }}">
@csrf
@method('PUT')
<div id="result"></div>

<div class="form-group">
	<label for="title">Title :</label>
	<input type="text" id="title" name="title" class="form-control" value="{{  $blog_posts->title }}" placeholder="Title">
</div>

@if($limit)
<div class="form-group">
	<label for="product_id">product_id :</label>
	<input type="text" id="product_id" name="product_id" class="form-control" value="{{  $blog_posts->product_id }}" placeholder="product_id" disabled="true">
</div>
@else
<div class="form-group">
	<label for="product_id">product_id :</label>
	<input type="text" id="product_id" name="product_id" class="form-control" value="{{  $blog_posts->product_id }}" placeholder="product_id">
</div>
@endif


     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>