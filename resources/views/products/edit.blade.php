
<script language="javascript">
function UPDATE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["sku","name","price"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"name": $('#name').val(),
			"sku": $('#sku').val(),
			"price": $('#price').val()
        },
		type: 'PUT',
		url: '{{ route('route_products.update',$product->id) }}'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
       				$('#dataTableBuilder').DataTable().ajax.reload( null, false );
					$.fancybox.close();	
			}
			else
			{
				$.each( data, function( index, value ) {
					$('#'+ index).addClass('is-invalid');
						if(value!="")
						{
							$('#'+ index).after('<span id="span-'+ index  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
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

    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
                <div class="card-header">Ubah Produk</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">
<div id="result"></div>


<div class="form-group">
	<label for="sku">SKU :</label>
	<input type="text" id="sku" name="sku" class="form-control" placeholder="SKU" autocomplete="off" value="{{ $product->sku }}">
</div>

<div class="form-group">
	<label for="name">Nama :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="Nama" autocomplete="off" value="{{ $product->name }}">
</div>

<div class="form-group">
	<label for="price">Harga :</label>
	<input type="number" id="price" name="price" class="form-control" placeholder="Harga" autocomplete="off" value="{{ $product->price }}">
</div>
     
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Batal</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>