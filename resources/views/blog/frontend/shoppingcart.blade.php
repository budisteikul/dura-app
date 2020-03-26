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
		<a href="/"><img src="/assets/logo/jogjafoodtour.webp" alt="JOGJA FOOD TOUR" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
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

		<a href="/"><img src="/assets/logo/logo.webp" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:9px;margin-bottom:9px;"></a>
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
				<div style="height:70px;"></div>
			
            <div class="row mb-2">  
			<div class="col-lg-6 col-lg-auto mb-6 mt-4">
            	
                
                
                
                
                
                
                
                <div class="card shadow">
  				<div class="card-header bg-dark text-white pt-0 pb-1">
    				<h3><i class="fas fa-shopping-cart"></i> Order Summary</h3>
  				</div>
                
                @php
                	$activity = $contents->activityBookings;
                    $invoice = $contents->customerInvoice;
                    $product_invoice = $contents->customerInvoice->productInvoices;
                @endphp
                @for($i=0;$i<count($activity);$i++)
                <!-- Product booking -->
                <div class="card-body">
                
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $activity[$i]->activity->title }}</b>
                    			</div>
                    			<div class="col-4 text-right">
                    				<b>{{ $product_invoice[$i]->totalAsText }}</b>
                    			</div>
                			 </div>
                    
                    		 <div class="row mb-4">
                				<div class="ml-4">
                    				<img class="img-fluid" src="{!! $product_invoice[$i]->product->keyPhoto->derived[2]->url !!}">
                    			</div>
                    			<div class="col-8">
                                	{{ $product_invoice[$i]->dates }}
                                	<br>
                                    {{ $activity[$i]->rate->title }}
                                    <br>
                            <?php
							
							$group = array();
							foreach ( $activity[$i]->pricingCategoryBookings as $value ) {
    							$group['id_'. $value->pricingCategoryId][] = $value;
							}
							
							for($j=0;$j<count($group);$j++)
								{
									$jumlah = count(array_values($group)[$j]);
									$judul = array_values($group)[$j][0]->bookedTitle;
									try
									{
										$harga = array_values($group)[$j][0]->bookedPrice;
										print($jumlah.' X '. $judul .' ($'. $harga .') <br>');
									}
									catch(Exception $e)
									{
										print('1 X Price per booking ('.$product_invoice[$i]->totalAsText.')<br>');
									}
								}
							?>
                                    
                                </div>
                			</div>
                            <!-- Product detail booking -->
                            <?php
								if($activity[$i]->extrasPrice>0)
								{
							?>
                            <!-- Extra booking $activity -->
							<div class="card">
                        		<div class="card-body">
                                <?php
								for($k=0;$k<count($activity[$i]->extraBookings);$k++)
								?>
									<div class="row mb-4">
                						<div class="col-8">
                    						Child<br>per booking
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>$0.02</b>
                    					</div>
                					</div>
                                   
								</div>
                   			</div>
							<!-- Extra booking -->
                            <?php
								}  
							?>  
                            
                            
				</div>
                <!-- Product booking -->
                @endfor
                
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
                    	<b style="font-size:18px">$0.08</b>
                    	</div>
                	</div>
                </div>
                
                
                
                
                
			</div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
           
              
        	</div>
            
            	
           

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection