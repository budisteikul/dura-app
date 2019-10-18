
<script language="javascript">
function STORE()
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
			"product": $('#product').val(),
			"time_selector": $('#time_selector').val(),
			"checkout": $('#checkout').val(),
			"receipt": $('#receipt').val()
        },
		type: 'POST',
		url: '{{ route('widgets.store') }}'
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
             
	<div class="card-header">Add widgets</div>
	<div class="card-body">
				
<form action="{{ route('widgets.store') }}" method="post" onSubmit="STORE(); return false;">
@csrf
<div id="result"></div>


<div class="form-group">
	<label for="post_id">Product :</label>
    <select class="form-control" id="post_id" name="post_id">
       @foreach($blog_post as $post)
       	<option value="{{ $post->id }}">{{ $post->title }}</option>
       @endforeach
	</select>
</div>

<div class="form-group">
	<label for="product">product :</label>
    <textarea class="form-control tinymce" id="product" name="product" rows="8" placeholder="product"></textarea>
</div>

<div class="form-group">
	<label for="time_selector">time_selector :</label>
    <textarea class="form-control tinymce" id="time_selector" name="time_selector" rows="8" placeholder="time_selector"></textarea>
</div>

<div class="form-group">
	<label for="checkout">checkout :</label>
    <textarea class="form-control tinymce" id="checkout" name="checkout" rows="8" placeholder="checkout"></textarea>
</div>

<div class="form-group">
	<label for="receipt">receipt :</label>
    <textarea class="form-control tinymce" id="receipt" name="receipt" rows="8" placeholder="receipt"></textarea>
</div>


       
	<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>

</div>