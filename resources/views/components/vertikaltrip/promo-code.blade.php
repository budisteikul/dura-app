@if(!isset($rev_shoppingcarts->promoCode))
<script language="javascript">
function PROMOCODE()
{
	$('#alert-promocode-success').fadeOut("slow");
	$('#alert-promocode-failed').fadeOut("slow");
	$("#apply").attr("disabled", true);
	$('#apply').html('<i class="fa fa-spinner fa-spin"></i>');
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"promocode": $('#promocode').val(),
        },
		type: 'POST',
		url: '/booking/promo-code'
		}).done(function( data ) {
			if(data.id=="1")
			{
				window.location.href = '/booking/shoppingcart?sessionId='+ data.message;
				$('#alert-promocode-success').fadeIn("slow");
			}
			else
			{
				$('#promocode').val('');
				$('#alert-promocode-failed').fadeIn("slow");
				$("#apply").attr("disabled", false);
				$('#apply').html('Apply');
			}
		});
	
	
	return false;
}
</script>
<!-- ################################################################### -->
 <script>
$( document ).ready(function() {
	$('#alert-promocode-success').hide();
	$('#alert-promocode-failed').hide();
});
</script>
                <div class="card shadow mt-2">
                	<div class="card-body">
                    		<div id="alert-promocode-success" class="alert alert-primary text-center" role="alert">
  								<i class="far fa-smile"></i> Promo code applied
							</div>
                            <div id="alert-promocode-failed" class="alert alert-danger text-center" role="alert">
  								<i class="far fa-frown"></i> Promo code not valid
							</div>
                    	<form onSubmit="PROMOCODE(); return false;" class="form-inline">
  							<div class="form-row align-items-center">
    							<div class="col-auto">
      								<input type="text" class="form-control" id="promocode" placeholder="Promo code">
    							</div>
    							<div class="col-auto">
      								<button id="apply" type="submit" class="btn btn-secondary ">Apply</button>
    							</div>
  							</div>
						</form>
                	</div>
                </div>
 <!-- ################################################################### --> 
 @else
 				<div class="card shadow mt-2">
                	<div class="card-body">
                    		<strong>Promo code : {{ $rev_shoppingcarts->promoCode }}</strong>
                	</div>
                </div>
 @endif         