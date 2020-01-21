<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
/*
$(window).on('load', function(){
	$(".se-pre-con").fadeOut("slow");
});
*/
$("#productId").ready(function (){
    $(".se-pre-con").fadeOut("slow");
});
</script>
<style>
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(/img/LoadingMountains.svg) center no-repeat #fff;
	background-size: 10% 10%;
}
@media(max-width:767px) {
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(/img/LoadingMountains.svg) center no-repeat #fff;
		background-size: 40% 40%;
	}
}
</style>
<div class="se-pre-con"></div>