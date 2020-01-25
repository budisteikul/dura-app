@extends('layouts.frontend')
@section('title',$contents->title)
@section('content')
@include('layouts.loading')
@push('scripts')
<script type="text/javascript" src="https://vertikaltrip.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
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
  								<div class="card-footer bg-primary p-0">
    								<a href="/tour?activityId={{ $content->activity->id }}" class="btn btn-primary btn-lg btn-block text-white" style=" cursor: pointer;">More info</a>
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






<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row" style="padding-bottom:0px;">
				<div class="col-lg-8 text-center mx-auto">
					<!-- h3 class="section-heading" style="margin-top:50px;">TOUR OPERATOR</h3 -->
                    
       
					<!-- hr style="max-width:50px;border-color:#e2433b;border-width:3px;" -->
				</div>
  </div>

  <div class="row">
  	
    <div class="col-sm-4 col-sm-auto  mb-4">
    	<a href="/product-list/ninja-food-tours/">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/ninja-food.png" alt="Ninja Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto  mb-4">
    	<a href="/product-list/original-food-tours-paris">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/original-food-tours____.jpg" alt="Original Food Tours">
			</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto  mb-4">
    		<a href="/product-list/cancun-food-tours">
			<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/cancun-food-tours.png" alt="Cancun Food Tours">
			</div>
			</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/india-food-tours">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/india-food-tours.jpg" alt="India Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/trinidad-food-tours">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/trinidad.jpg" alt="Trinidad Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/jogja-food-tour">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/jogja.png" alt="Jogja Food Tour">
		</div>
		</a>
    </div>

   
    
  </div>
  
</div>

</section>
@endsection