@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function($) {	
var table = $('#dataTables-example').DataTable(
{
	"processing": true,
	"serverSide": true,
	"beforeSend": function(request) {
    	request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  	},
	"ajax": 
	{
		"url": "/review",
		"type": "POST"
	},
	"scrollX": true,
	"language": 
	{
		"paginate": 
		{
			"previous": "<i class='fa fa-step-backward'></i>",
			"next": "<i class='fa fa-step-forward'></i>",
			"first": "<i class='fa fa-fast-backward'></i>",
			"last": "<i class='fa fa-fast-forward'></i>"
		},
		"aria": 
		{
			"paginate": 
			{
				"first":    'First',
				"previous": 'Previous',
				"next":     'Next',
				"last":     'Last'
			}
		}
	},
	"pageLength": 5,
	"order": [[ 0, "desc" ]],
	"columns": [
		{data: 'date', name: 'date', orderable: true, searchable: false, visible: false},
		{data: 'style', name: 'style', className: 'auto', orderable: false},
		],
	"dom": 'rtp',
	"pagingType": "full_numbers",
	"fnDrawCallback": function () {
					
	}
});
			
	var table = $('#dataTables-example').DataTable();
	$('#dataTables-example').on('page.dt', function(){
	var target = $('#review');
	target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	if (target.length) {
	$('html, body').animate({
		scrollTop: (target.offset().top - 54)
	}, 1000, "easeInOutExpo");
		return false;
	}
	});
			
			});			
</script>
@endpush

<section id="review" style="background-color:#ffffff">
<div class="container mb-6">
	<div class="row">
    	<div class="col-lg-8 col-md-10 mx-auto">
			<div class="col-lg-12 text-center">
				<h3 class="section-heading" style="margin-top:50px;">How Our New Friend Talk About The Tour</h3>
				<h4 class="section-subheading text-muted"><a href="/review" target="_blank" class="text-theme"><i class="fab fa-tripadvisor" aria-hidden="true"></i>  Review us on Trip Advisor</a></h4>
				<strong> Rating :</strong>
				<span class="text-warning">
					<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <span class="text-secondary" itemprop="ratingValue">(4.9)</span>
				</span>‎
				<br>
				<small class="form-text text-muted">Based on <span itemprop="reviewCount">{{ $count }}</span> our new friend reviews</small>
				<hr style="max-width:50px;border-color:#1D57C7;border-width:3px;">
			</div>
			<table id="dataTables-example" style="width:100%">
				<tbody>           
				</tbody>
			</table>
		</div>
    </div>
</div>
<div style="height:50px;"></div>
</section>