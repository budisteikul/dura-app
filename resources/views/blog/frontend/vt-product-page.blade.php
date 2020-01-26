@extends('layouts.frontend')
@section('content')
@section('title',$contents->title)

@push('scripts')
<script type="text/javascript" src="https://vertikaltrip.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
<style>
html, body {
    font-size: 14px;
    font-family: -apple-system, BlinkMacSystemFont, Roboto, "Helvetica Neue", sans-serif;
}
body {
    background-color: transparent;
    color: rgb(52, 64, 78);
    font-style: normal;
    font-variant-ligatures: normal;
    font-variant-caps: normal;
    font-variant-numeric: normal;
    font-variant-east-asian: normal;
    font-weight: normal;
    font-stretch: normal;
    line-height: normal;
    touch-action: manipulation;
    margin: 0px;
    overflow: auto !important;
}
h1 {
    display: block;
    font-size: 2em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    margin-bottom: 8px;
}

div {
    line-height: 1.5;
    color: rgba(0, 0, 0, 0.7);
}
</style>
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
  	
    <div class="col-sm-8 col-sm-auto">
    	<div style="height:66px;"></div>

@if($contents->keyPhoto!="")
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    @for($i=1;$i<count($contents->photos);$i++)
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
  <i class="far fa-clock"></i> {!!$contents->durationText!!} &nbsp;&nbsp;
  @if($contents->difficultyLevel!="")
  <i class="fas fa-signal"></i> {!!\App\Classes\Rev\BookClass::lang('dificulty',$contents->difficultyLevel)!!}
  @endif
</div>
<ul class="nav nav-tabs  nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
  </li>
  @if(($contents->meetingType=='MEET_ON_LOCATION' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP') && !empty($contents->startPoints))
  <li class="nav-item">
    <a class="nav-link" id="meeting-tab" data-toggle="tab" href="#meeting" role="tab" aria-controls="meeting" aria-selected="false">Meeting point</a>
  </li>
  @endif
  @if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
  <li class="nav-item">
    <a class="nav-link" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false">Pick-up</a>
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

  <!-- div>
        @if($contents->attention!="")
          <h3 class="mt-4">Please note</h3>
          {!!$contents->attention!!}
        @endif
  </div -->
  
  <div class="card mt-4 w-100 bg-light">
  <div class="card-body">
    <div class="col-md-12">
      <div class="row">
      <div class="col-md-6">
          <div>
            @if($contents->productCategory!="")
              <h3 class="mt-2">Experience type</h3>
              {!!\App\Classes\Rev\BookClass::lang('type',$contents->productCategory)!!}
            @endif
          </div>
          <div>
            @if($contents->bookingCutoffHours!="")
              <h3 class="mt-2">Booking in advance</h3>
              Cut off: {!!$contents->bookingCutoffHours!!} hours
            @endif
          </div>
          <div>
            @if($contents->durationText!="")
              <h3 class="mt-2">Duration</h3>
              {!!$contents->durationText!!}
            @endif
          </div>
          <div>
            @if($contents->difficultyLevel!="")
              <h3 class="mt-2">Difficulty</h3>
              {!!\App\Classes\Rev\BookClass::lang('dificulty',$contents->difficultyLevel)!!}
            @endif
          </div>
          <!-- div>
            @if(!empty($contents->supportedAccessibilityTypes))
              <h3 class="mt-2">Supported accessibility</h3>
              @for($i=0;$i<count($contents->supportedAccessibilityTypes);$i++)
             {!!\App\Classes\Rev\BookClass::lang('accessibility',$contents->supportedAccessibilityTypes[$i])!!}
              @endfor
            @endif
          </div -->
      </div>
      <div class="col-md-6">
          <div>
            @if($contents->activityCategories!="" || $contents->activityAttributes!="")
              <h3 class="mt-2">Categories</h3>
              @if($contents->activityCategories!="")
              @for($i=0;$i<count($contents->activityCategories);$i++)
                {!! \App\Classes\Rev\BookClass::lang('categories',$contents->activityCategories[$i]) !!}
              @endfor
              @endif
              @if($contents->activityAttributes!="")
              @for($i=0;$i<count($contents->activityAttributes);$i++)
                {!!\App\Classes\Rev\BookClass::lang('categories',$contents->activityAttributes[$i])!!}
              @endfor
              @endif
            @endif
          </div>
          <div>
            @if(!empty($contents->guidanceTypes))
            @if($contents->guidanceTypes[0]->guidanceType=="GUIDED")
              <h3 class="mt-2">Live tour guide</h3>
              @for($i=0;$i<count($contents->guidanceTypes[0]->languages);$i++)
                {!!\App\Classes\Rev\BookClass::lang('language',$contents->guidanceTypes[0]->languages[$i])!!}
              @endfor
            @endif
            @endif
          </div>
      </div>
    </div>
    </div>
    
  </div>
</div>
</div>
@if(($contents->meetingType=='MEET_ON_LOCATION' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP') && !empty($contents->startPoints))
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
@if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
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











<div style="height:35px;"></div><div style="height:35px;"></div>
    </div>
    <div class="col-sm-4">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
  			<div class="card-header text-white" style="background-color: #2c97de;"><h3>Book Now</h3></div>
 				 <div class="card-body" style="padding-left:0px;padding-right:0px;padding-top:5px;padding-bottom:15px;">
    				
     
    <div class="bokunWidget" data-src="https://vertikaltrip.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/{{ $calendar }}"></div><noscript>Please enable javascript in your browser to book</noscript>
   

  				</div>
			</div>
     		
        <div style="height:35px;"></div>
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