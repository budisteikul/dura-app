
<script language="javascript">
function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name","date2_a"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"post_id": $('#post_id').val(),
			"date": $('#date').val(),
			"date2": $('#date2').val(),
        },
		type: 'POST',
		url: '{{ route('rev_availability.store') }}'
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
								if(index=='date2')
								{
									$('#'+ index +'_a').after('<span id="span-'+ index  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
								}
								else
								{
									$('#'+ index).after('<span id="span-'+ index  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
								}
							
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
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
             
	<div class="card-header">Add disable date</div>
	<div class="card-body">
				
<form action="{{ route('rev_availability.store') }}" method="post" onSubmit="STORE(); return false;">
@csrf
<div id="result"></div>

<div class="form-group">
	<label for="post_id">Product :</label>
    <select class="form-control" id="post_id">
       @foreach($blog_posts as $blog_post)
       	<option value="{{ $blog_post->id }}">{{ $blog_post->title }}</option>
       @endforeach
	</select>
</div>

<div class="form-group ">   
	<label for="datetimepicker1">Date :</label>    
	<div id="form-inline" class="form-inline d-flex align-items-start">     
		
        <div class='input-group' id='datetimepicker1'>
			<input type="text" id="date" name="date" value="<?= date('Y-m-d') ?>" class="form-control bg-white" readonly>
				<div class="input-group-append input-group-addon text-muted">
					<div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
                    
        </div>
 		<script type="text/javascript">
            $(function () {
                $('#date').datetimepicker({
					format: 'YYYY-MM-DD',
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
		&nbsp;&nbsp;-&nbsp;&nbsp;
		<div class='input-group' id='datetimepicker2'>
			<input type="text" id="date2" name="date2" value="<?= date('Y-m-d') ?>" class="form-control bg-white" readonly>
			<div id="date2_a" class="input-group-append input-group-addon text-muted">
				<div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
			
		</div>
 		<script type="text/javascript">
            $(function () {
                $('#date2').datetimepicker({
					format: 'YYYY-MM-DD',
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