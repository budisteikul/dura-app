@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')

@endpush



<!-- ################################################################### -->

<!-- Navigation -->
@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="jogjafoodtour.com")
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">
		<a href="/"><img src="/assets/logo/jogjafoodtour.png" alt="JOGJA FOOD TOUR" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#services">Why Jogja Food Tour?</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#about">The Tour</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#gallery">Snapshot</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#guide">Tour Guide</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/#review">Reviews</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div style="height:25px;"></div>	
@else
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/assets/logo/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		@include('layouts.vt-menu')
        
	</div>
</nav>
<div style="height:25px;"></div>
@endif

<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-left">
				<div style="height:56px;"></div>
			
            <div class="row mb-2">  
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	<!-- ################################################################### -->   
                <div class="card shadow">
  				<div class="card-header bg-dark text-white pb-1">
    				<h4><i class="fas fa-shopping-cart"></i> Order Summary</h4>
  				</div>
                
                <?php
				$grand_total = 0;
				?>
                @foreach($rev_carts as $rev_cart)
                <!-- Product booking -->
                <div class="card-body">
                
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $rev_cart->title }}</b>
                    			</div>
                    			<div class="col-4 text-right">
                                	<?php
									$product_price = 0;
									foreach($rev_cart->carts_detail()->where('type','product')->get() as $carts_detail)
									{
										$product_price += $carts_detail->subtotal;
									}
									?>
                    				<b>${{ $product_price }}</b>
                    			</div>
                			 </div>
                    
                    		 <div class="row mb-4">
                				<div class="ml-4">
                               		@if(isset($rev_cart->image))
                    				<img class="img-fluid" src="{{ $rev_cart->image }}">
                                	@endif
                    			</div>
                    			<div class="col-8">
                                	{{ $rev_cart->date }}
                                	<br>
                                    {{ $rev_cart->rate }}
                                    <br>
                                    @foreach($rev_cart->carts_detail()->where('type','product')->get() as $carts_detail)
                                    {{ $carts_detail->qty }} x {{ $carts_detail->unitPrice }} (${{ $carts_detail->price }})
                                    <br>
                                    @endforeach
                                </div>
                			</div>
                            <!-- Product detail booking -->
                            <!-- Pickup booking $activity -->
                            @php
							$pickups = $rev_cart->carts_detail()->where('type','pickup')->get();
                            @endphp
                            @if(count($pickups))
                            <div class="card mb-2">
                        		<div class="card-body">
                               		@foreach($pickups as $carts_detail)
									<div class="row mb-2">
                						<div class="col-8">
                                        <strong>Pick-up and drop-off services</strong>
                                        <br>
                                        {{ $carts_detail->unitPrice }}
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>${{ $carts_detail->total }}</b>
                    					</div>
                					</div>
                               		@endforeach
								</div>
                   			</div>
							@endif
                            <!-- Pickup booking $activity -->
							
                            <!-- Extra booking $activity -->
                            @php
                            $extra = $rev_cart->carts_detail()->where('type','extra')->get();
                            @endphp
                            @if(count($extra))
							<div class="card mb-2">
                            
                        		<div class="card-body">
                                <div class="row col-12 mb-2">
                            		<strong>Extras</strong>
                            	</div>
                                @foreach($extra as $carts_detail)
									<div class="row mb-2">
                						<div class="col-8">
										{{ $carts_detail->title }}
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>${{ $carts_detail->total }}</b>
                    					</div>
                					</div>
                               @endforeach
								</div>
                   			</div>
							<!-- Extra booking -->
                            @endif
                            
				</div>
                <!-- Product booking -->
                <?php
				$grand_total += $rev_cart->total;
				?>
                @endforeach
                
                <div class="card-body pt-0 mt-0">
                	<hr>
                	<div class="row mb-2">
                		<div class="col-8">
                    		<span style="font-size:18px">Subtotal</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">${{ $grand_total }}</span>
                    	</div>
                	</div>
				</div>
                
				
				
				
				
				
                
                
                <div class="card-body pt-0">
                	<!-- hr>
                	<div class="row mb-4">
                		<div class="col-8">
                    		<span style="font-size:18px">Items</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">$0.08</span>
                    	</div>
                	</div -->
                	<hr class="mt-0">    
                    <div class="row mb-4 mt-0">
                		<div class="col-8">
                    		<b style="font-size:18px">Total (USD)</b>
                    	</div>
                    	<div class="col-4 text-right">
                    	<b style="font-size:18px">${{ $grand_total }}</b>
                    	</div>
                	</div>
                </div>
				</div>
                <!-- ################################################################### --> 
            </div>
            
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
            <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		<img style="margin-bottom:30px;" height="20" src="/assets/logo/Powered-By-PayPal-Logo.png">
				 </div>
             
                {!! $widget !!}
                
                
                
                
                
                
			</div>
            </div>
            </div>
            
        	</div>
            
            	
           

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection