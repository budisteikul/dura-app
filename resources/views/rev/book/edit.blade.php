
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
			"post_id": $('#post_id').val(),
			"name": $('#name').val(),
			"email": $('#email').val(),
			"phone": $('#phone').val(),
			"source": $('#source').val(),
			"date": $('#date').val(),
			"status": $('#status').val(),
        	"traveller": $('#traveller').val(),
        },
		type: 'PUT',
		url: '{{ route('rev_book.update',$book->id) }}'
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
<div class="h-100" style="width:99%">		

    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
                <div class="card-header">Edit book</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">

<div id="result"></div>



<div class="form-group">   
				 <label for="datetimepicker1">Date :</label>           
                <div class='input-group' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="{{ $book->date }}" class="form-control bg-white" readonly>
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
	<label for="post_id">Product :</label>
    <select class="form-control" name="post_id" id="post_id">
       @foreach($blog_post as $post)
        <option value="{{ $post->id }}" {{ ($post->id==$book->post_id) ? 'selected' : '' }}>{{ $post->title }}</option>
       @endforeach
	</select>
</div>

<div class="form-group">
	<label for="source">Chennel :</label>
    <select class="form-control" id="source">
       @foreach($rev_resellers as $rev_reseller)
       	<option value="{{ $rev_reseller->id }}" {{ ($rev_reseller->id==$book->source) ? 'selected' : '' }}>{{ $rev_reseller->name }}</option>
       @endforeach
	</select>
    
</div>



<div class="form-group">
	<label for="traveller">Traveller :</label>
	<input type="number" id="traveller" name="traveller" class="form-control" value="{{$book->traveller}}">
</div>

<div class="form-group">
	<label for="name">Name :</label>
	<input type="text" id="name" name="name" class="form-control" value="{{ $book->name }}" placeholder="Name">
</div>

<div class="form-group">
	<label for="phone">Phone :</label>
	<input type="tel" id="phone" name="phone" class="form-control" value="{{ $book->phone }}" placeholder="Phone">
</div>

<div class="form-group">
	<label for="email">Email :</label>
	<input type="email" id="email" name="email" class="form-control" value="{{ $book->email }}" placeholder="Email">
</div>

<div class="form-group">
	<label for="status">Status :</label>
    <select class="form-control" id="status">
       	<option value="2" {{ ($book->status==2) ? 'selected' : '' }}>Confirmed</option>
        <option value="3" {{ ($book->status==3) ? 'selected' : '' }}>Cancelled</option>
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