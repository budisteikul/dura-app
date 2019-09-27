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
        		"ajax": '{{ route('rev_book.index') }}',
				"scrollX": true,
				"language": {
    				"paginate": {
      					"previous": "<i class='fa fa-step-backward'></i>",
						"next": "<i class='fa fa-step-forward'></i>",
						"first": "<i class='fa fa-fast-backward'></i>",
						"last": "<i class='fa fa-fast-forward'></i>"
    				}
  				},
				"order": [[ 4, "desc" ]],
				"columns": [
					{data: 'created_at', name: 'created_at', orderable: true, searchable: false, visible: false},
					{data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'auto', searchable: false, orderable: false},
					{data: 'name', name: 'name', className: 'auto'},
					/* {data: 'email_phone', name: 'email_phone', className: 'auto'}, */
					{data: 'traveller', name: 'traveller', className: 'auto'},
					{data: 'date', name: 'date', className: 'auto'},
					{data: 'source', name: 'source', className: 'auto'},
					/* {data: 'ticket', name: 'ticket', className: 'auto'}, */
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
     						url: '{{ route('rev_book.index') }}/'+ id
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
       	 	src: '{{ route('rev_book.create') }}',
			touch: false,
			modal: true,
			autoFocus:false,
   		});	
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('rev_book.index') }}/'+ id +'/edit',
			touch: false,
			modal: true,
			autoFocus:false,
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
	
	function STATUS(id, status)
	{
		var table = $('#dataTables-example').DataTable();
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"update":status
        },
		type: 'PUT',
		url: "/rev/book/"+ id
		}).done(function( data ) {
			if(data.id=="1")
			{
				table.ajax.reload( null, false );
			}
		});
	}
	</script>  
@endpush   

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Order</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-secondary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add order</button>
        <hr>
        
		<table class="table table-hover table-striped" id="dataTables-example" style="width:100%">
			<thead>
				<tr>
                	<th></th>
                	<th style="width:20px">No</th>
                    <th>Lead</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Channel</th>
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