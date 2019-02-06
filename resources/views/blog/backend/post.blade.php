@extends('layouts.app')
@section('content')
    
	<script type="text/javascript">
	jQuery(document).ready(function($) {	
			var table = $('#dataTables-example').DataTable(
			{
				"processing": true,
       			"serverSide": true,
        		"ajax": '/blog/post',
				"order": [[ 0, "desc" ]],
				columns: [
					{data: 'title', name: 'title', className: 'auto', orderable: false},
					{data: 'contents', name: 'contents', orderable: false},
					{data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
        		],
				"pagingType": "first_last_numbers",
				"fnDrawCallback": function () {
					
				}
			});
			
			
	});
	
	function UPDATE(id, status)
	{
		var table = $('#dataTables-example').DataTable();
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"status":status
        },
		type: 'PUT',
		url: "/blog/post/"+ id
		}).done(function( data ) {
			if(data.id=="1")
			{
				table.ajax.reload( null, false );
			}
		});
	}
	
	
	
	function DELETE(id)
	{
		$.confirm({
    		title: 'Warning',
    		content: 'Are you sure?',
    		type: 'red',
			icon: 'fa fa-warning',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-danger btn-flat',
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTables-example').DataTable();
							$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '/blog/post/'+ id
						}).done(function( msg ) {
							table.ajax.reload( null, false );
						});	
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
        		}
    		}
		});
				
	}
	
	
	</script>

          
         
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-image"></i> Gallery</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-secondary"  onclick="window.location='/blog/post/create?content_type=photo'"><b class="fa fa-camera"></b> Add photo</button>
        <hr>
		<table class="table table-hover" id="dataTables-example" style="width:100%">
			<thead style="display:none">
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>           
			</tbody>
		</table>
		
                </div>
            </div>
        </div>
    </div>
</div>       
        
@endsection