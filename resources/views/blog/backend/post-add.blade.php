@extends('layouts.app')
@section('title', 'Blog Post')
@section('user', $user->name )
@section('content')

<script language="javascript">
function postPost()
{
	$('#submit').prop('disabled', true);
	$('#submit').val('Saving...');
	
	
	var table = $('#dataTables-example').DataTable();
	$.post("/blog/post/add", {
		tipe_post: $('#tipe_post').val(),
		tipe_konten: $('#tipe_konten').val(),
		konten: $('#konten').val(),
		layout: $('#layout').val(),
		tanggal: $('#tanggal').val(),
		key: $('#key').val(),
		_token: $('#_token').val(),
		judul: $('#judul').val(),
		submit: "Add" } )
	.done(function( data ) {
    	if(data=="")
		{
			//table.ajax.reload( null, false );
			//$.fancybox.close();
			window.location='/blog/post';
		}
		else
		{
			$("#result").empty().append(data).hide().fadeIn();
			$('#submit').prop('disabled', false);
			$('#submit').val('Save');
		}
  	});
	
	
	return false;
}
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Photo</div>
                <div class="card-body">





<form method="post" action="/blog/post/add" onSubmit="return postPost()">

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div id="result"></div>


<div class="form-group">
<div id="status"></div>
<div id="mulitplefileuploader"><b class="fa fa-plus"> Upload Photo </b></div>
<script>
$(document).ready(function()
{
var settings = {
    url: "/blog/file/add",
    multiple:false,
	dragDrop:true,
	maxFileCount:-1,
    fileName: "myfile",
    allowedTypes:"jpg,jpeg,png",	
    returnType:"json",
	acceptFiles:"image/*",
	uploadStr:"<i class=\"fa fa-camera fa-fw\"></i> Capture",
	onSuccess:function(files,data,xhr)
    {
		
    },
    showDelete:true,
	formData: { key: $('#key').val() , _token: $('#_token').val() },
    deleteCallback: function(data,pd)
	{
    for(var i=0;i<data.length;i++)
    {
		$.post("/blog/file/delete",{_token:$('#_token').val(),name:data[i]},
        function(resp, textStatus, jqXHR)
        {
            //Show Message  
            //$("#status").append("<div>File Deleted</div>");      
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
	<input type="text" id="konten" name="konten" class="form-control" placeholder="Caption" autocomplete="off">
</div>
<div class="form-group">
	<input type="text" id="layout" name="layout" class="form-control" placeholder="Layout" autocomplete="off">
</div>

				
                
<div class="form-group">   
				            
                <div class='input-group date' id='datetimepicker1'>
                    <input type="text" id="tanggal" name="tanggal" value="{{$tanggal}}" id="date1" class="form-control" readonly>
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
     
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<input type="hidden" name="key" id="key" value="{{md5(date('YmdHis'))}}">
<input type="hidden" id="tipe_post" name="tipe_post" value="post">
<input type="hidden" id="tipe_konten" name="tipe_konten" value="{{ $tipe_konten }}">
<input  class="btn btn-danger" type="button" onClick="window.location='/blog/post'" name="submit" value="Cancel">&nbsp;<input  class="btn btn-primary" id="submit" type="submit" name="submit" value="Save">
</form>







    </div>
</div>       
			
        </div>
    </div>
</div>       
@endsection