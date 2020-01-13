
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["post_id"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"post_id": $('#post_id').val(),
			"product_id": $('#product_id').val(),
			"calendar_id": $('#calendar_id').val(),
			"checkout": $('#checkout').val(),
			"receipt": $('#receipt').val()
        },
		type: 'PUT',
		url: '{{ route('widgets.update',$rev_widgets->id) }}'
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
                <div class="card-header">Edit widgets</div>
                <div class="card-body">
				
<form method="POST" onSubmit="UPDATE(); return false;" action="{{ route('widgets.update',$rev_widgets->id) }}">
@csrf
@method('PUT')
<div id="result"></div>

<div class="form-group">
	<label for="post_id">product_id :</label>
    <select class="form-control" name="post_id" id="post_id">
       @foreach($blog_post as $post)
        <option value="{{ $post->id }}" {{ ($post->id==$rev_widgets->post_id) ? 'selected' : '' }}>{{ $post->title }}</option>
       @endforeach
	</select>
</div>

<div class="form-group">
	<label for="product_id">product_id :</label>
    <textarea class="form-control tinymce" id="product_id" name="product_id" rows="8" placeholder="product_id">{{ $rev_widgets->product_id }}</textarea>
</div>

<div class="form-group">
	<label for="calendar_id">calendar_id :</label>
    <textarea class="form-control tinymce" id="calendar_id" name="calendar_id" rows="8" placeholder="calendar_id">{{ $rev_widgets->calendar_id }}</textarea>
</div>

     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>