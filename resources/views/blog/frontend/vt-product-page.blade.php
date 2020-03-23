@extends('layouts.frontend')
@section('content')
@section('title',$contents->title)
@push('scripts')

@endpush



<!-- ################################################################### -->

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/assets/logo/logo.webp" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		@include('layouts.vt-menu')
        
	</div>
</nav>

<div style="height:25px;"></div>



<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row">
  	
    <div class="col-sm-7 col-sm-auto">
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
    <span class="badge badge-info">PRIVATE TOUR</span>
  @endif
</div>
<div class="text-muted mt-4 mb-4">
  @if($contents->excerpt!="")
  {!!$contents->excerpt!!}
  @endif
</div>
<ul class="nav nav-tabs  nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><b>Description</b></a>
  </li>
  @if(!empty($contents->startPoints))
  <li class="nav-item">
    <a class="nav-link" id="meeting-tab" data-toggle="tab" href="#meeting" role="tab" aria-controls="meeting" aria-selected="false"><b>Meeting point</b></a>
  </li>
  @endif
  @if(!empty($contents->pickupPlaces))
  <li class="nav-item">
    <a class="nav-link" id="pickup-tab" data-toggle="tab" href="#pickup" role="tab" aria-controls="pickup" aria-selected="false"><b>Pick-up</b></a>
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
            $requirements = str_ireplace("from Wandernesia","",$requirements);
			$requirements = str_ireplace("Wandernesia","",$requirements);
          ?>
          {!!$requirements!!}
        @endif
  </div>

  <div>
        @if($contents->attention!="")
          <h3 class="mt-4">Please note</h3>
          {!!$contents->attention!!}
        @endif
  </div>
  
  <div class="card mt-4 w-100 bg-light">
  <div class="card-body">
    <div class="col-md-12">
      <div class="row">
      <div class="col-md-6">
          <div>
            @if($contents->productCategory!="")
              <h3 class="mt-4"><i class="far fa-clipboard"></i> Experience type</h3>
              {!!\App\Classes\Rev\BookClass::lang('type',$contents->productCategory)!!} &nbsp;&nbsp;
            @endif
            @if($contents->privateActivity)
                <span class="badge badge-info">PRIVATE TOUR</span>
            @endif
          </div>
          <div>
            @if($contents->bookingCutoffHours!="")
              <h3 class="mt-4"><i class="far fa-calendar-alt"></i> Booking in advance</h3>
              Cut off: {!!$contents->bookingCutoffHours!!} hours
            @endif
          </div>
          <div>
            @if($contents->durationText!="")
              <h3 class="mt-4"><i class="far fa-clock"></i> Duration</h3>
              {!!$contents->durationText!!}
            @endif
          </div>
          <div>
            @if($contents->difficultyLevel!="")
              <h3 class="mt-4"><i class="fas fa-signal"></i> Difficulty</h3>
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
            @if($contents->activityCategories!="")
              <h3 class="mt-4"><i class="fa fa-list"></i> Categories</h3>
              @if($contents->activityCategories!="")
              @for($i=0;$i<count($contents->activityCategories);$i++)
                <span class="badge badge-light border text-muted">{!! \App\Classes\Rev\BookClass::lang('categories',$contents->activityCategories[$i]) !!}</span>
              @endfor
              @endif
            @endif
          </div>
		  <div>
            @if($contents->activityAttributes!="")
              <h3 class="mt-4"><i class="fas fa-cogs"></i> Attributes</h3>
              @for($i=0;$i<count($contents->activityAttributes);$i++)
                <span class="badge badge-light border text-muted">{!!\App\Classes\Rev\BookClass::lang('categories',$contents->activityAttributes[$i])!!}</span>
              @endfor
            @endif
          </div>
          <div>
            @if(!empty($contents->guidanceTypes))
            @if($contents->guidanceTypes[0]->guidanceType=="GUIDED")
              <h3 class="mt-4"><i class="fas fa-info-circle"></i> Live tour guide</h3>
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
@if(!empty($contents->pickupPlaces))
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
	
    <div class="col-sm-5">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
  			<div class="card-header">
            	<h3><i class="fa fa-ticket-alt"></i> Book {{ $contents->title }}</h3>
                Secure booking — only takes 2 minutes!
            </div>
 				 <div id="bookingframe" class="card-body" style="padding-left:1px;padding-right:1px;padding-top:20px;padding-bottom:15px;">
    				
     
					{!! $calendar !!}

  				</div>
			</div>
     		
    </div>
	
	<div class="clearfix"></div>
    
  </div>
</div>
</section>

<div style="height:25px;background-color:#ffffff"></div>



@endsection