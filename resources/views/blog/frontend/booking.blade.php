@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')

@endpush



<!-- ################################################################### -->

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
	
		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		

	</div>
</nav>

<div style="height:25px;"></div>



<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>
				
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		<img class="img-fluid" style="margin-bottom:30px;" src="/assets/vertikaltrip/Powered-By-PayPal-Logo.png">
				 </div>
                {!! $product !!}
				
			</div></div>

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection