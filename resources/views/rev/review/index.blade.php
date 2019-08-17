@extends('layouts.app')
@section('content')
@push('scripts')
	<script type="text/javascript">
		jQuery(document).ready(function($) {	
     		//$.fn.dataTable.ext.errMode = () => window.parent.location = '/login';
			var table = $('#dataTables-example').DataTable(
			{
				
				"processing": true,
       			"serverSide": true,
        		"ajax": '{{ route('rev_review.index') }}',
				"scrollX": true,
				"language": {
    				"paginate": {
      					"previous": "<i class='fa fa-step-backward'></i>",
						"next": "<i class='fa fa-step-forward'></i>",
						"first": "<i class='fa fa-fast-backward'></i>",
						"last": "<i class='fa fa-fast-forward'></i>"
    				}
  				},
				"order": [[ 6, "desc" ]],
				"columns": [
					{data: 'created_at', name: 'created_at', orderable: true, searchable: false, visible: false},
					{data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'auto', searchable: false, orderable: false},
					{data: 'user', name: 'user', className: 'auto'},
					{data: 'title', name: 'title', className: 'auto'},
					{data: 'text', name: 'text', className: 'auto'},
					{data: 'rating', name: 'rating', className: 'auto'},
					{data: 'date', name: 'date', className: 'auto'},
					{data: 'source', name: 'source', className: 'auto'},
					{data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
        		],
				
				"pagingType": "full_numbers",
				"fnDrawCallback": function () {
					
				}
			});
			
			
	});
	
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
     						url: '{{ route('rev_review.index') }}/'+ id
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
	
	function CREATE()
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('rev_review.create') }}',
			touch: false,
			modal: true,
   		});	
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('rev_review.index') }}/'+ id +'/edit',
			touch: false,
			modal: true,
   		});
		
	}
	
	function VIEW(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '/ticket/'+ id,
			//src: '/ticket/',
			touch: false,
   		});
		
	}
	
	
	</script>  
@endpush   

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Review</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-secondary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add review</button>
        <hr>
        
		<table class="table table-hover table-striped" id="dataTables-example" style="width:100%">
			<thead>
				<tr>
                	<th></th>
                	<th style="width:20px">No</th>
					
                    <th>User</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Source</th>
					<th style="width:280px"></th>
				</tr>
			</thead>
			<tbody>           
			</tbody>
            
		</table>
		
                </div>
            </div>
        </div>
    </div>
       

@endsection