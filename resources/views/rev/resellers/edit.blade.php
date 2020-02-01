
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name","commission"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"name": $('#name').val(),
			"link": $('#link').val(),
			"uuid": $('#uuid').val(),
			"commission": $('#commission').val()
        },
		type: 'PUT',
		url: '{{ route('resellers.update',$rev_resellers->id) }}'
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
                <div class="card-header">Edit resellers</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">
<div id="result"></div>

<div class="form-group">
	<label for="name">name :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="name" value="{{ $rev_resellers->name }}">
</div>

<div class="form-group">
	<label for="name">uuid :</label>
	<input type="text" id="uuid" name="uuid" class="form-control" placeholder="uuid" value="{{ $rev_resellers->id }}">
</div>

<div class="form-group">
	<label for="link">link :</label>
	<input type="text" id="link" name="link" class="form-control" placeholder="link" value="{{ $rev_resellers->link }}">
</div>

<div class="form-group">
	<label for="commission">commission :</label>
	<input type="number" step="0.01" id="commission" name="commission" class="form-control" placeholder="commission" value="{{ $rev_resellers->commission }}">
</div>
     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>