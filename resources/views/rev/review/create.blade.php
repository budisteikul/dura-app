<script language="javascript">
function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["user","post_id","source","text"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"post_id": $('#post_id').val(),
			"user": $('#user').val(),
			"title": $('#title').val(),
			"text": $('#text').val(),
			"date": $('#date').val(),
			"rating": $('#rating').val(),
			"source": $('#source').val(),
        },
		type: 'POST',
		url: '{{ route('rev_review.store') }}'
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
             
	<div class="card-header">Add review</div>
	<div class="card-body">
				
<form action="{{ route('rev_review.store') }}" method="post" onSubmit="STORE(); return false;">
@csrf
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
	<label for="rating">Rating :</label>
    <select class="form-control" id="rating">
      <option value="5">5</option>
      <option value="4">4</option>
      <option value="3">3</option>
      <option value="2">2</option>
      <option value="1">1</option>
	</select>
</div>

<div class="form-group">
	<label for="user">User :</label>
	<input type="text" id="user" name="user" class="form-control" placeholder="User">
</div>

<div class="form-group">
	<label for="title">Title :</label>
	<input type="text" id="title" name="title" class="form-control" placeholder="Title">
</div>

<div class="form-group">
	<label for="text">Text :</label>
    <textarea class="form-control" id="text" name="text" rows="5" placeholder="Text"></textarea>
</div>

<div class="form-group">
	<label for="source">Channel :</label>
    <select class="form-control" id="source">
       @foreach($rev_resellers as $rev_reseller)
       	<option value="{{ $rev_reseller->id }}">{{ $rev_reseller->name }}</option>
       @endforeach
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