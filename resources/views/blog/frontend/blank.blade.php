@extends('layouts.frontend')
@section('content')
@push('scripts')


@endpush
 <!-- ################################################################### -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	
	
	
	<div class="container">
		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>

		
        
     
        
        
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
        		<div class="row">

        			@foreach($contents->items as $content)
        			<div class="col-sm-4 col-sm-auto  mb-4">
    						<div class="card  h-100 shadow card-block">
  				 				<img class="card-img-top" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}">
  				 				
  								<div class="card-header bg-white border-0 d-flex text-left h-100 pb-0">
        								<h5>{{ $content->activity->title }}</h5>
      							</div>
  								<div class="card-body pt-0">
    								<p class="card-text text-right">Price from<br /><b>${{$content->activity->nextDefaultPrice}}</b></p>
  								</div>
  								<div class="card-footer bg-danger p-0">
    								<a class="btn btn-danger btn-lg btn-block text-white" style=" cursor: pointer;">More info</a>
  								</div>
							</div>
    				</div>
					@endforeach

				</div>
				<div style="height:45px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>



@endsection