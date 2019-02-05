@extends('layouts.app')
@section('title', 'Blog Post')
@section('user', $user->name )
@section('content')
    
	<script type="text/javascript">
	jQuery(document).ready(function($) {	
			var table = $('#dataTables-example').DataTable(
			{
				"processing": true,
       			"serverSide": true,
        		"ajax": '/blog/post/data',
				"order": [[ 0, "desc" ]],
				columns: [
					{data: 'judul', name: 'judul', className: 'auto', orderable: false},
					{data: 'contents', name: 'contents', orderable: false},
					{data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
        		],
				"pagingType": "first_last_numbers",
				"fnDrawCallback": function () {
					
				}
			});
			
			
	});
	
	function upPost(id, status)
	{
		var table = $('#dataTables-example').DataTable();
		$.ajax({
     	async: false,
     	type: 'GET',
     	url: '/blog/post/publish/'+ id +'/'+ status
		}).done(function( msg ) {
			table.ajax.reload( null, false );
		});	
	}
	
	
	
	function delPost(id)
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
     					async: false,
     					type: 'GET',
     					url: '/blog/post/delete/'+ id
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
                <div class="card-header">Gallery</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-primary"  onclick="window.location='/blog/post/add/photo'"><b class="fa fa-camera"></b> Add photo</button>
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