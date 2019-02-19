
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"name": $('#name').val(),
			"parent_id": $('#parent_id').val(),
        	"description": $('#description').val()
        },
		type: 'PUT',
		url: '{{ route('blog_category.update',['category'=>$category->id]) }}'
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
                <div class="card-header">Edit category</div>
                <div class="card-body">
				
<form  onSubmit="UPDATE(); return false;">
<div id="result"></div>

<div class="form-group">
	<label for="name">Name :</label>
	<input type="text" id="name" name="name" class="form-control" value="{{  $category->name }}" placeholder="Name">
</div>

<div class="form-group">
	<label for="description">Description :</label>
    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Description">{{  $category->description }}</textarea>
</div>

<div class="form-group">
    <label for="parent_id">Parent category :</label>
    <select class="form-control" id="parent_id">
      <option value="">None</option>
      @foreach($categories->sortBy('name') as $cat)
      	<option value="{{ $cat->id }}" {{ ($cat->id==$category->parent_id) ? 'selected' : '' }}>{{ $cat->name }}</option>
      @endforeach
    </select>
</div>
       
     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>
</div>