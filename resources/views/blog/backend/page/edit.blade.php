<script>
$( document ).ready(function() {
    	tinymce.init({
  		selector: 'textarea.tinymce',
 		height: 500,
  		menubar: false,
  		plugins: [
    	'advlist autolink lists link image charmap print preview anchor',
    	'searchreplace visualblocks code fullscreen',
    	'insertdatetime media table paste code help wordcount'
  		],
  		toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  		content_css: [
    	'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    	'//www.tiny.cloud/css/codepen.min.css'
  		]
		});	
});
</script>
<script language="javascript">
function UPDATE()
{
	tinymce.triggerSave();
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["title","content"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"title": $('#title').val(),
			"content": $('#content').val(),
			"description": $('#description').val(),
        },
		type: 'PUT',
		url: '{{ route('page.update',$blog_posts->id) }}'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
					tinymce.remove();
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
                <div class="card-header">Edit page</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">

<div class="form-group">
	<label for="title">title :</label>
	<input type="text" id="title" name="title" class="form-control" placeholder="title" value="{{ $blog_posts->title }}">
</div>

<div class="form-group">
	<label for="description">description :</label>
	<input type="text" id="description" name="description" class="form-control" placeholder="description" value="{{ $blog_posts->description }}">
</div>

<div class="form-group">
	<label for="content">content :</label>
    <textarea class="form-control tinymce" id="content" name="content" rows="8"> {!! $blog_posts->content !!}</textarea>
</div>

     
<button  class="btn btn-danger" type="button" onClick="tinymce.remove();$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>