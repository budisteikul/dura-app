<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
    	<div class="col-lg-7 col-sm-auto">
    		<div style="height:66px;"></div>
            
			@if($contents->keyPhoto!="")
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  				<ol class="carousel-indicators">
   				 <!-- li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li -->
    				@for($i=0;$i<count($contents->photos);$i++)
    				<li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
   					 @endfor
  				</ol>
  				<div class="carousel-inner">
    				<div class="carousel-item active">
      					<img class="d-block w-100" src="https://bokunprod.imgix.net{{ $contents->keyPhoto->fileName }}?w=600&h=400&fit=crop&crop=faces">
    				</div>
    				@for($i=1;$i<count($contents->photos);$i++)
    				<div class="carousel-item">
      					<img class="d-block w-100" src="https://bokunprod.imgix.net{{ $contents->photos[$i]->fileName }}?w=600&h=400&fit=crop&crop=faces" alt="Second slide">
    				</div>
    				@endfor
  				</div>
  				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    					<span class="sr-only">Previous</span>
  				</a>
  				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    				<span class="carousel-control-next-icon" aria-hidden="true"></span>
    				<span class="sr-only">Next</span>
  				</a>
			</div>
			@endif
	
			<h1 class="mt-4">{{ $contents->title }}</h1>
			<div class="text-muted mt-4 mb-4">
  				<i class="far fa-clock text-danger"></i> <b>{!!$contents->durationText!!}</b> &nbsp;&nbsp;
  				@if($contents->difficultyLevel!="")
  				<i class="fas fa-signal text-danger"></i> <b>{!!\App\Classes\Rev\BookClass::lang('dificulty',$contents->difficultyLevel)!!}</b> &nbsp;&nbsp;
  				@endif
  				@if($contents->privateActivity)
    			<span class="badge badge-danger">PRIVATE TOUR</span>
  				@endif
			</div>
			<div class="text-muted mt-4 mb-4">
  				@if($contents->excerpt!="")
  				{!!$contents->excerpt!!}
  				@endif
			</div>
			<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  				<li class="nav-item">
    				<a class="nav-link active text-theme" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><b>Description</b></a>
  				</li>
  				@if(!empty($contents->startPoints))
  				<li class="nav-item">
    				<a class="nav-link text-theme" id="meeting-tab" data-toggle="tab" href="#meeting" role="tab" aria-controls="meeting" aria-selected="false"><b>Meeting point</b></a>
  				</li>
  				@endif
  				@if(!empty($pickup->pickupPlaces))
  				<li class="nav-item">
    				<a class="nav-link text-theme" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false"><b>Pick-up</b></a>
  				</li>
  				@endif
			</ul>
			<div class="tab-content">
  				<div class="tab-pane fade show active mt-4" id="description" role="tabpanel" aria-labelledby="description-tab">
  					<div>
    					{!!$contents->description!!}
  					</div>
  					<div>
        				@if($contents->included!="")
          				<h3 class="mt-4">What's included?</h3>
          				{!!$contents->included!!}
        				@endif
  					</div>
  					<div>
        				@if($contents->excluded!="")
          				<h3 class="mt-4">Exclusions</h3>
          				{!!$contents->excluded!!}
        				@endif
  					</div>
  					<div>
        				@if($contents->requirements!="")
          				<h3 class="mt-4">What do I need to bring?</h3>
          				<?php
          				$requirements = $contents->requirements;
            			$requirements = str_ireplace("Wandernesia","Vertikal Trip",$requirements);
          				?>
          				{!!$requirements!!}
        				@endif
  					</div>
  					<div>
        				@if($contents->attention!="")
          				<h3 class="mt-4">Please note</h3>
          				<?php
          				$attention = $contents->attention;
            			$attention = str_ireplace("Wandernesia","Vertikal Trip",$attention);
          				?>
          				{!!$attention!!}
        				@endif
  					</div>
  
  					
				</div>
				@if(!empty($contents->startPoints))
  					<div class="tab-pane fade mt-4" id="meeting" role="tabpanel" aria-labelledby="meeting-tab">
  						You can start this experience at the following places:
  						<div>
    						<h3 class="mt-4 mb-0">{{ $contents->startPoints[0]->title }}</h3>
    						{{  $contents->startPoints[0]->address->addressLine1 }} {{  $contents->startPoints[0]->address->addressLine2 }} {{  $contents->startPoints[0]->address->addressLine3 }} {{  $contents->startPoints[0]->address->city }} {{  $contents->startPoints[0]->address->state }} {{  $contents->startPoints[0]->address->postalCode }} {{  $contents->startPoints[0]->address->countryCode }}
  						</div>
  						<div class="map-responsive mt-2">
    						<iframe src = "https://maps.google.com/maps?q={{  $contents->startPoints[0]->address->geoPoint->latitude }},{{  $contents->startPoints[0]->address->geoPoint->longitude }}&hl=en;z=13&amp;output=embed" width="600" height="450" frameborder="0" style="border:0;"></iframe>
  						</div>
					</div>
				@endif 
				@if(!empty($pickup->pickupPlaces))
  				<div class="tab-pane fade mt-4" id="pickup" role="tabpanel" aria-labelledby="pickup-tab">
  					We offer pick-up to the following places for this experience:
  					<br><br>
  					<div>
              			<ul>
              				@for($i=0;$i<count($pickup->pickupPlaces);$i++)
                			<li>{!!$pickup->pickupPlaces[$i]->title!!}</li>
              				@endfor
            			</ul>
  					</div>
				</div>
				@endif  
			</div>
    	</div>
        
    	<div class="col-lg-5">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
        									
  				<div class="card-body">
				<h3>{!!\App\Classes\Rev\BookClass::lang('type',$contents->productCategory)!!} Details</h3>							
				<br>
											@if($contents->bookingCutoffHours!="")
											<i class="far fa-calendar-alt text-secondary mb-4" style="width:20px;"></i> Booking Cut off: {!!$contents->bookingCutoffHours!!} hours
                                            <br>
            								@endif
				
											@if($contents->durationText!="")
              								<i class="far fa-clock text-secondary mb-4" style="width:20px;"></i> Duration: 
              								{!!$contents->durationText!!}
                                            <br>
            								@endif
				
											@if($contents->difficultyLevel!="")
											<i class="fas fa-signal text-secondary mb-4" style="width:20px;"></i> Difficulty {!!\App\Classes\Rev\BookClass::lang('dificulty',$contents->difficultyLevel)!!}
                                            <br>
											@endif
                                            
                                            @if(!empty($contents->guidanceTypes))
            								@if($contents->guidanceTypes[0]->guidanceType=="GUIDED")
              								<i class="fas fa-info-circle text-secondary mb-4" style="width:20px;"></i> Live Tour Guide in 
              								@for($i=0;$i<count($contents->guidanceTypes[0]->languages);$i++)
                							{!!\App\Classes\Rev\BookClass::lang('language',$contents->guidanceTypes[0]->languages[$i])!!}
              								@endfor
            								@endif
                                            <br>
            								@endif
            	</div>
		</div>
        <div id="bookingCard" class="card mb-4 shadow p-2">
  			<div class="card-header">
            			<h3><i class="fa fa-ticket-alt"></i> Book {{ $contents->title }}</h3>
                		Secure booking — only takes 2 minutes!
						<br><br>
                    	<i class="fa fa-ticket-alt text-secondary mb-4" style="width:20px;"></i> Instant Booking
						<br>
						<i class="fa fa-phone-alt text-secondary mb-4" style="width:20px;"></i> 24/7 Support
						<br>
                    	<i class="fa fa-history text-secondary mb-4" style="width:20px;"></i> Free Cancellation
						<br>
						<i class="fab fa-paypal text-secondary mb-4" style="width:20px;"></i> Secure Payments
                        <br>
            </div>
 			<div id="bookingframe" class="card-body" style="padding-left:1px;padding-right:1px;padding-top:20px;padding-bottom:15px;">
    			{!! $calendar !!}
			</div>
		</div>
    </div>
	<div class="clearfix"></div>
    
  </div>
  <div style="height:25px;background-color:#ffffff"></div>
</div>
</section>




