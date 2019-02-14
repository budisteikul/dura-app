@extends('layouts.app')
@section('content')
<script language="javascript">
function STORE()
{
	$('#submit').prop('disabled', true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.ajax({
			data: {
        		"_token": $("meta[name=csrf-token]").attr("content"),
				content: $('#content').val(),
				layout: $('#layout').val(),
				date: $('#date').val(),
				key: '{{ $setting->key }}',
				title: $('#title').val()
        	},
			type: 'POST',
			url: '/blog/photo'
			}).done(function( data ) {
			if(data.id=="1")
			{
				window.location='/blog/photo';
			}
			else
			{
				$("#result").empty().append(data).hide().fadeIn();
				$('#submit').prop('disabled', false);
				$('#submit').html('<i class="fa fa-save"></i> Save');
			}
		});
	
	return false;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-camera"></i> Add Photo</div>
                <div class="card-body">
				
<form onSubmit="return STORE()">
<div id="result"></div>

<div class="form-group">
<div id="status"></div>
<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload Photo </b></div>
<script>
$(document).ready(function()
{
var settings = {
    url: "/blog/file",
    multiple:true,
	dragDrop:true,
	maxFileCount:-1,
    fileName: "myfile",
    allowedTypes:"jpg,jpeg,png",	
    returnType:"json",
	acceptFiles:"image/*",
	uploadStr:"<i class=\"fa fa-folder-open\"></i> Browse",
	onSuccess:function(files,data,xhr)
    {
		$.each( data, function( index, value ) {
						
					});	
    },
    showDelete:true,
	formData: { key: '{{ $setting->key }}' , _token: $("meta[name=csrf-token]").attr("content") },
    deleteCallback: function(data,pd)
	{
		
    for(var i=0;i<data.length;i++)
    {
						
						$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '/blog/file/'+ data[i]
						}).done(function( msg ) {
							
						});	
     }      
    pd.statusbar.hide();
	}
}
var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
});
</script>

</div>




<div class="form-group">
	<input type="text" id="content" name="content" class="form-control" placeholder="Caption" autocomplete="off">
</div>
<div class="form-group">
	<input type="text" id="layout" name="layout" class="form-control" placeholder="Layout" autocomplete="off">
</div>

				
                
<div class="form-group">   
				            
                <div class='input-group date' id='datetimepicker1'>
                    <input type="text" id="date" name="date" value="{{$setting->date}}" id="date1" class="form-control" readonly>
                    <div class="input-group-append input-group-addon text-muted">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    
                </div>
 		<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
					format: 'YYYY-MM-DD HH:mm:00',
					showTodayButton: true,
					showClose: true,
					ignoreReadonly: true
				});
            });
        </script>    
</div>
     
<button  class="btn btn-danger" type="button" onClick="window.location='/blog/photo'"><i class="fa fa-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>







    </div>
</div>       
			
        </div>
    </div>
</div>       
@endsection