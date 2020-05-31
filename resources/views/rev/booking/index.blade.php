@extends('layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">





	function DELETE(id)
	{
		$.confirm({
    		title: 'Delete this booking',
    		content: 'Are you sure?',
    		type: 'red',
			icon: 'fa fa-trash-alt',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-danger',
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTableBuilder').DataTable();
							$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '{{ route('bookings.index') }}/'+ id
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
	
	function CANCEL(id)
	{
		$.confirm({
    		title: 'Cancel this booking',
    		content: 'Are you sure?',
    		type: 'red',
			icon: 'fa fa-ban',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-danger',
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTableBuilder').DataTable();
							$.ajax({
     						type: 'PUT',
							data: {
        						"_token": $("meta[name=csrf-token]").attr("content"),
        						"cancel":"cancel"
        					},
     						url: '{{ route('bookings.index') }}/'+ id
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
       	 	src: '{{ route('bookings.create') }}',
			touch: false,
			modal: true,
			autoFocus:false,
   		});	
	}
	
	function STATUS(id, status)
	{
		
		$("#capture-"+ id).attr("disabled", true);
		$("#void-"+ id).attr("disabled", true);
		if(status=="capture")
		{
			$("#capture-"+ id).html('<i class="fa fa-spinner fa-spin"></i>');
		}
		if(status=="void")
		{
			$("#void-"+ id).html('<i class="fa fa-spinner fa-spin"></i>');
		}
		var table = $('#dataTableBuilder').DataTable();
		$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
        	"update":status
        },
		type: 'PUT',
		url: "{{ route('bookings.index') }}/"+ id
		}).done(function( data ) {
			if(data.id=="1")
			{
				$("#capture-"+ id).attr("disabled", false);
				$("#void-"+ id).attr("disabled", false);
				$("#capture-"+ id).html('<i class="far fa-money-bill-alt"></i> Capture');
				$("#void-"+ id).html('<i class="far fa-money-bill-alt"></i> Void');
				table.ajax.reload( null, false );
			}
		});
	}
	
	</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Booking</div>
                <div class="card-body">
      
       
       <a class="btn btn-secondary mb-2" href="/rev/experiences"><b class="fa fa-plus-square"></b> Create booking</a>
        <hr>
      
        <style>
		#dataTableBuilder thead {
    		display: none;
		}
		</style>
		{!! $dataTable->table(['class'=>'table table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}

@endsection
