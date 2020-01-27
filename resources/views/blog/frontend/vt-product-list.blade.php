@extends('layouts.frontend')
@section('title',$contents->title)
@section('content')

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
    margin-bottom: 8px;
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
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>	
        		<div class="row">

        			@foreach($contents->items as $content)
        			<div class="col-sm-4 col-sm-auto  mb-4">
    						<div class="card  h-100 shadow card-block rounded">
  				 				<img class="card-img-top" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}">
  				 				
  							<div class="card-header bg-white border-0 text-left h-100 pb-0">
        								<h2 class="mb-0">{{ $content->activity->title }}</h2>
							<div class="pt-2">
								 @if($content->activity->excerpt!="")
									<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
								 @endif
							</div>
      						</div>
							
  								<div class="card-body pt-0">
									<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
    								<p class="card-text text-right"><b>Price from</b><br /><b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b></p>
  								</div>
  								<div class="card-footer bg-primary p-0">
    								<a href="/tour?activityId={{ $content->activity->id }}" class="btn btn-primary btn-lg btn-block text-white" style=" cursor: pointer; background-color: #2C97DE; border-color: #2C97DE;"><i class="fas fa-info-circle"></i> More info</a>
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