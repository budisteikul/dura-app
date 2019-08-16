function BOOKING()
{
	if($('#name').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The name field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#name').focus();
				
			});
		return false;	
	}
	
	if($('#email').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The email field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#email').focus();
				
			});
		return false;
	}
	
	if($('#phone').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The phone field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#phone').focus();
				
			});
		return false;	
	}
	
	$.ajax({
			data: {
        		"_token": $("meta[name=csrf-token]").attr("content"),
				'name': $('#name').val(),
				'country': $('#country').val(),
				'os0': $('#os0').val(),
				'phone': $('#phone').val(),
				'email': $('#email').val(),
				'date': $('#date').val(),
				'post_id': $('#post_id').val(),
        	},
			type: 'POST',
			url: '/book'
			}).done(function( data ) {
			if(data.id=="1")
			{
				
			}
			else
			{
				return false;	
			}
		});
}