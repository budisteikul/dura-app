
<script language="javascript">
function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name","ipOrGpio"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"name": $('#name').val(),
			"ipOrGpio": $('#ipOrGpio').val(),
			"username": $('#username').val(),
			"password": $('#password').val(),
			"type": $('#type').val(),
        },
		type: 'POST',
		url: '{{ route('relay.store') }}'
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
             
	<div class="card-header">Add relay</div>
	<div class="card-body">
				
<form onSubmit="STORE(); return false;">

<div id="result"></div>

<div class="form-group">
	<label for="type">Type :</label>
    <select class="form-control" id="type">
      <option value="tasmota">tasmota</option>
      <option value="gpio">gpio</option>
	</select>
</div>

<div class="form-group">
	<label for="name">name :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="name" autocomplete="off">
</div>

<div class="form-group">
	<label for="ipOrGpio">IP or GPIO :</label>
	<input type="text" id="ipOrGpio" name="ipOrGpio" class="form-control" placeholder="IP or GPIO" autocomplete="off">
</div>

<div class="form-group">
	<label for="username">username :</label>
	<input type="text" id="username" name="username" class="form-control" placeholder="username" autocomplete="off">
</div>

<div class="form-group">
	<label for="password">password :</label>
	<input type="password" id="password" name="password" class="form-control" placeholder="password" autocomplete="off">
</div>




       
	<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>

</div>