
<script language="javascript">
function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name","phone"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"post_id": $('#post_id').val(),
			"name": $('#name').val(),
			"email": $('#email').val(),
			"phone": $('#phone').val(),
			"source": $('#source').val(),
			"date": $('#date').val(),
			"status": $('#status').val(),
        	"traveller": $('#traveller').val(),
			"ticket": $('#ticket').val(),
        },
		type: 'POST',
		url: '{{ route('rev_book.store') }}'
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
 
<div class="container-fluid h-100">		
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
             
	<div class="card-header">Add order</div>
	<div class="card-body">
				
<form action="{{ route('rev_book.store') }}" method="post" onSubmit="STORE(); return false;">

<div id="result"></div>

<div class="form-group">
	<label for="post_id">Product :</label>
    <select class="form-control" id="post_id">
       @foreach($blog_post as $post)
       	<option value="{{ $post->id }}">{{ $post->title }}</option>
       @endforeach
	</select>
</div>

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
	<label for="name">Name :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="Name">
</div>

<div class="form-group">
	<label for="email">Email :</label>
	<input type="email" id="email" name="email" class="form-control" placeholder="Email">
</div>

<div class="form-group">
	<label for="phone">Phone :</label>
	<input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
</div>

<div class="form-group">
	<label for="traveller">Traveller :</label>
    <select class="form-control" id="traveller">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
	</select>
</div>

<div class="form-group">
	<label for="source">Source :</label>
    <select class="form-control" id="source">
      <option value="www.vertikaltrip.com">www.vertikaltrip.com</option>
      <option value="www.jogjafoodtour.com">www.jogjafoodtour.com</option>
      <option value="www.airbnb.com">www.airbnb.com</option>
      <option value="www.tripadvisor.com">www.tripadvisor.com</option>
      <option value="www.telegram.com">www.telegram.com</option>
      <option value="www.tourhq.com">www.tourhq.com</option>
	</select>
</div>

<div class="form-group">
	<label for="ticket">Ticket :</label>
	<input type="text" id="ticket" name="ticket" class="form-control" placeholder="Ticket">
</div>

<div class="form-group">
	<label for="status">Status :</label>
    <select class="form-control" id="status">
    
      <option value="1">Pending</option>
      <option value="2">Confirmed</option>
	</select>
</div>   
       
	<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>
</div>
</div>