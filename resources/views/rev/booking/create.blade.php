

<script language="javascript">
function STORE()
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
			"productId": $('#productId').val(),
			"name": $('#name').val(),
			"email": $('#email').val(),
			"phone": $('#phone').val(),
			"bookingChannel": $('#bookingChannel').val(),
			"date": $('#date').val(),
			"status": $('#status').val(),
        	"traveller": $('#traveller').val()
        },
		type: 'POST',
		url: '{{ route('bookings.store') }}'
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
        <div class="col-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
             
	<div class="card-header">Add booking</div>
	<div class="card-body">
				
<form onSubmit="STORE(); return false;">

<div id="result"></div>



<div class="form-group">   
				 <label for="datetimepicker1">Date :</label>           
                <div class='input-group' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="<?= date('Y-m-d 18:30:00') ?>" class="form-control bg-white" readonly>
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
            			vertical: 'bottom'
        			}
				});
            });
        </script>    
</div>

<div class="form-group">
	<label for="productId">Product :</label>
    <select class="form-control" id="productId">
       @foreach($rev_experiences as $experiences)
       	<option value="{{ $experiences->productId }}">{{ $experiences->title }}</option>
       @endforeach
	</select>
    
</div>

<div class="form-group">
	<label for="bookingChannel">Channel :</label>
    <select class="form-control" id="bookingChannel">
       @foreach($rev_resellers as $rev_reseller)
       	<option value="{{ $rev_reseller->name }}">{{ $rev_reseller->name }}</option>
       @endforeach
	</select>
    
</div>

<div class="form-group">
	<label for="traveller">Traveller :</label>
	<input type="number" id="traveller" name="traveller" class="form-control" value="1">
</div>

<div class="form-group">
	<label for="name">Name :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="Name">
</div>

<div class="form-group">
	<label for="phone">Phone :</label>
	<input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone">
</div>

<div class="form-group">
	<label for="email">Email :</label>
	<input type="email" id="email" name="email" class="form-control" placeholder="Email">
</div>

<!-- div class="form-group">
	<label for="status">Status :</label>
    <select class="form-control" id="status">
       	<option value="CONFIRMED">Confirmed</option>
        <option value="CANCELLED">Cancelled</option>
	</select>
</div -->


       
	<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>

</div>