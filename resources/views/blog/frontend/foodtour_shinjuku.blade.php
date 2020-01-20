@extends('layouts.frontend')
@section('content')
@section('title',$title)
@section('description',$description)
@include('layouts.loading')
@push('scripts')
{!! $jscript !!}
@endpush
<header id="page-top" class="intro-header" style="background-image: url('/assets/shinjuku-food-tour/shinjuku-bg.jpg'); background-color: #000000">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:5px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img alt="Shinjuku Night Walking and Food Tours" class="rounded" src="/assets/shinjuku-food-tour/shinjuku.png">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<h1 id="title" style="text-shadow: 2px 2px #555555;">{{ $title }}</h1>
				<p class="text-faded">
                    {{$description}}
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
		</div>
    </div>
</header>

<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row">
    <div class="col-sm-8 col-sm-auto">
    	<div style="height:66px;"></div>
      		{!! $product !!}
    </div>
    <div class="col-sm-4">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
  			<div class="card-header text-white" style="background-color: #2c97de;"><h5>Book {{ $title }}</h5></div>
 			<div class="card-body" style="padding-left:0px;padding-right:0px;padding-top:5px;padding-bottom:15px;">
    				{!!$calendar!!}
			</div>
		</div>
  	</div>
   </div>
        <div style="height:35px;"></div>
    </div>
</section>

@if($categories!="")
<article id="explorer">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
        <div>
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:0px;">Explore Shinjuku Through our Ninja Food Tours</h3>
					<h4 class="section-subheading text-muted">And So Our Adventure Begins</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			{!! $categories !!}
        </div>
    </div>
</div>
</article>
@endif

<section id="guide" style="background-color:#f2f2f2">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row">
				<div class="col-lg-12 text-center">
				<h3 class="section-heading" style="margin-top:50px;">Ninja Food Tours Guide</h3>
				<h4 class="section-subheading text-muted">Wholeheartedly as a Local Friend</h4>
				<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			<br>
		</div>
        
     </div>
     <div class="row justify-content-center"> 
     <div class="row col-12">       
        
            
        	<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/food-tour-japan-yuma-wada-200x200.jpg" >
					<h4>Yuma</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
           
            
            
            <div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/Osaka_Tour_Guide_Foodie-200x200.jpg" >
					<h4>Rino</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>

			<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/Kyoto-Food-Tour-Guide-Osaka-200x200.jpg" >
					<h4>Moe</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
			
			<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/Ninja-Food-Tours-Giulia.jpg" >
					<h4>Giulia</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
			
			<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/Tokyo-Food-Tour-Guide-Info-200x200.jpg" >
					<h4>Amanda</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
			
			<div class="d-flex flex-wrap justify-content-center col-lg-4 col-md-4 mx-auto">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img alt="Tour Guide | Shinjuku Night Walking and Food Tours" class="mx-auto rounded-circle" width="200" src="/assets/shinjuku-food-tour/kyoto_food_tour_guide_yuta-200x200.jpg" >
					<h4>Yuta</h4>
					<p class="text-muted">Your Local Friend</p>
                    
					<br><br>
				</div>
			</div>
        	
            
            
        </div></div>
        
	</div>
</div>
</section>






</div>

@endsection