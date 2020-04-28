@extends('layouts.app')
@section('content')
@push('scripts')
	<script type="text/javascript">
	jQuery(document).ready(function($) {	
     
			var table = $('#dataTables-example').DataTable(
			{
				
				"processing": true,
       			"serverSide": true,
        		"ajax": '/blog/photo',
				"scrollX": true,
				"language": {
    				"paginate": {
      					"previous": "<i class='fa fa-step-backward'></i>",
						"next": "<i class='fa fa-step-forward'></i>",
						"first": "<i class='fa fa-fast-backward'></i>",
						"last": "<i class='fa fa-fast-forward'></i>"
    				}
  				},
				"order": [[ 0, "desc" ]],
				"columns": [
					{data: 'title', name: 'title', className: 'auto', orderable: false},
					{data: 'contents', name: 'contents', orderable: false},
					{data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'}
        		],
				
				"pagingType": "full_numbers",
				"fnDrawCallback": function () {
					
				}
			});
			
			
	});
	
	function STATUS(id, status)
	{
		var table = $('#dataTables-example').DataTable();
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"status":status
        },
		type: 'PUT',
		url: "/blog/photo/"+ id
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
     						url: '/blog/photo/'+ id
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
       	 	src: 'https://widgets.bokun.io/widgets/111662?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&activityId=319494&lang=en&ccy=USD&hash=w111662_1caddfc1_76b8_499c_959f_fcb6d96159df&sessionId=54760b6b-58d7-431c-aa68-db02817f87de&bokunSessionId=54760b6b-58d7-431c-aa68-db02817f87de&',
			touch: false,
			modal: true,
			beforeShow : function() {
            	$('body').css({'overflow':'hidden'});
        	},
			afterClose : function() {
            	$('body').css({'overflow':'visible'});
        	}
   		});
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('blog_photo.index') }}/'+ id +'/edit',
			touch: false,
			modal: true,
			beforeShow : function() {
            	$('body').css({'overflow':'hidden'});
        	},
			afterClose : function() {
            	$('body').css({'overflow':'visible'});
        	}
   		});
		
	}
	</script>
 @endpush

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Galleries</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-secondary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add photo</button>
        <hr>
		<table class="table table-hover" id="dataTables-example" style="width:100%">
			<thead style="visibility:hidden">
				<tr>
					<th style="width:100px"></th>
					<th></th>
					<th style="width:280px"></th>
				</tr>
			</thead>
			<tbody>           
			</tbody>
            <tfoot style="visibility:hidden">
            	<tr>
     				<td></td>
                    <td></td>
                    <td></td>
    			</tr>
            </tfoot>
		</table>
		
                </div>
            </div>
        </div>
    </div>
  

        
@endsection