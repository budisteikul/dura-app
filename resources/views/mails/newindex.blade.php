@extends('layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">
function CHANGE(id,status)
{
	var table = $('#dataTableBuilder').DataTable();
	$.ajax({
		data: {
			"_token"  : "{{ csrf_token() }}",
			"request" : "change_status_read",
			"read" 	  : status
		},
		type: 'PUT',
		url: '{{ route('mails.index') }}/'+ id
		}).done(function( msg ) {
			table.ajax.reload( null, false );
		});
	return false;
}
</script>
<script type="text/javascript">

function ARCHIVE()
	{
		$.confirm({
    		title: 'Warning',
    		content: 'Are you sure?',
    		type: 'blue',
			icon: 'fa fa-warning',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-primary btn-flat',
            		keys: ['enter'],
            		action: function(){
						
						var table = $('#dataTableBuilder').DataTable();
						var checkbox_cookies = Cookies.get('checkbox_id');
						
						if(checkbox_cookies=="")
						{
							table.ajax.reload( null, false );
						}
						else
						{
							
							$.ajax({
								data: {
									"_token"  : $("meta[name=csrf-token]").attr("content"),
									"request" : "move_to_archive_selected"
								},
								type: 'PUT',
								url: '{{ route('mails.index') }}/'+ checkbox_cookies
							}).done(function( msg ) {
								RESTART_CHECKBOX();
								table.ajax.reload( null, false );
							});
							
						}
						
						
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
					
        		}
    		}
		});
		
	}
</script>
<script type="text/javascript">

function DELETE()
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
						
						var table = $('#dataTableBuilder').DataTable();
						var checkbox_cookies = Cookies.get('checkbox_id');
						
						if(checkbox_cookies=="")
						{
							table.ajax.reload( null, false );
						}
						else
						{
							@if($folder=="trash")
							$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", '{{csrf_token()}}');
  							},
     							type: 'DELETE',
     							url: '{{ route('mails.index') }}/'+ checkbox_cookies,
								headers: { 'request': 'delete_forever_selected' }
							}).done(function( msg ) {
								RESTART_CHECKBOX();
								table.ajax.reload( null, false );
							});	
							@else
							$.ajax({
								data: {
									"_token"  : $("meta[name=csrf-token]").attr("content"),
									"request" : "move_to_trash_selected"
								},
								type: 'PUT',
								url: '{{ route('mails.index') }}/'+ checkbox_cookies
							}).done(function( msg ) {
								RESTART_CHECKBOX();
								table.ajax.reload( null, false );
							});
							@endif
						}
						
						
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
					
        		}
    		}
		});
		
	}
</script>
		<script type="text/javascript">
		$(document).ready(function() {
			RESTART_CHECKBOX();
		});
		
		
		
		
		function RELOAD_MAIL()
		{
			
			var table = $('#dataTableBuilder').DataTable();
			table.ajax.reload( null, false );
			
		}
		
		function RELOAD_CHECKBOX()
		{
			var checkbox_cookies = Cookies.get("checkbox_id");
			var myStringArray = checkbox_cookies.split(",");
			var arrayLength = myStringArray.length;
			for (var i = 0; i < arrayLength-1; i++) {
    			$("#checkbox_"+ myStringArray[i]).attr("checked", true);
			}
			
			CHECK_STATE();
		}
		
		function RESTART_CHECKBOX()
		{
			Cookies.remove('checkbox_id');
			if(Cookies.get('checkbox_id')==null)
			{
					Cookies.set('checkbox_id', '', { expires: 7 });
			}	
		}
		
		
		
		function SELECTALL_CHECKBOX()
		{
			
			if($('#check_all').attr('class').indexOf("far fa-check-square") >= 0)
			{
				
				$('.icheckbox').each(function() {
					if($("#"+ this.id).is(':checked'))
					{
						
						$('#'+ this.id).iCheck('uncheck');
						var checkbox_cookies = Cookies.get('checkbox_id');
						checkbox_cookies = checkbox_cookies.replace(this.value+',','');
						Cookies.set('checkbox_id', checkbox_cookies, { expires: 7 });
					}
				});
				
				
			}
			
			if($('#check_all').attr('class').indexOf("far fa-square") >= 0)
			{
				
				$('.icheckbox').each(function() {
					
					if(!$("#"+ this.id).is(':checked'))
					{
						
						//$('#'+ this.id).attr('checked','true');
						$('#'+ this.id).iCheck('check');
						var checkbox_cookies = Cookies.get('checkbox_id');
						checkbox_cookies = checkbox_cookies.replace(this.value+',','');
						Cookies.set('checkbox_id', checkbox_cookies + this.value +',', { expires: 7 });
					}
				});
				
				
			}
			
			CHECK_STATE();
		}
		
		function CHECK_STATE()
		{
			var i = 0;
			var j = 0;
			$('.icheckbox').each(function() {
				i = i + 1;
				if($("#"+ this.id).is(':checked'))
				{
					j = j + 1;
				}
			});
			
			if(i==j && i > 0)
			{
				$("#check_all").removeClass("far fa-square").addClass("far fa-check-square");	
			}
			else
			{
				$("#check_all").removeClass("far fa-check-square").addClass("far fa-square");	
			}
		}
		
		function SET_CHECKBOX(name,id)
		{
			var checkbox_cookies = Cookies.get('checkbox_id');
			
			if($("#"+ name).is(':checked'))
			{		
				$('#'+ name).iCheck('uncheck');
			}
			else
			{		
				$('#'+ name).iCheck('check');
			}
			
			var checkbox_cookies = Cookies.get('checkbox_id');
			
			if($("#"+ name).is(':checked'))
			{
				checkbox_cookies = checkbox_cookies.replace(id+',','');
				Cookies.set('checkbox_id', checkbox_cookies + id +',', { expires: 7 });
			}
			else
			{
				checkbox_cookies = checkbox_cookies.replace(id+',','');
				Cookies.set('checkbox_id', checkbox_cookies, { expires: 7 });
			}
			CHECK_STATE();
		}
		</script>
        @endpush

    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!! $template->icon !!}  {{ $template->title }}</div>
                <div class="card-body">
      
		{!! $dataTable->table(['class'=>'table table-hover table-striped table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}
    
    
	@endsection