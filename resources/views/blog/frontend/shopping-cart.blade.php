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
            	<!-- ################################################################### -->   
                <div class="card shadow">
  				<div class="card-header bg-dark text-white pt-0 pb-1">
    				<h3><i class="fas fa-shopping-cart"></i> Order Summary</h3>
  				</div>
                
                @php
                	$activity = $contents->activityBookings;
                    $invoice = $contents->customerInvoice;
                    $product_invoice = $contents->customerInvoice->productInvoices;
					$grand_total = 0;
                @endphp
                @for($i=0;$i<count($activity);$i++)
							<?php
								$lineitems = $product_invoice[$i]->lineItems;
								//print_r($lineitems);
								//exit();
							?>
                <!-- Product booking -->
                <div class="card-body">
                
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $activity[$i]->activity->title }}</b>
                    			</div>
								
<?php
$subtotal_harga = 0;
for($z=0;$z<count($lineitems);$z++)
	{
		
		$itemBookingId = $lineitems[$z]->itemBookingId;
		$itemBookingId = explode("_",$itemBookingId);
		if($activity[$i]->extrasPrice>0)
		{
			$check_extra = false;
			for($k=0;$k<count($activity[$i]->extraBookings);$k++)
			{
				if($itemBookingId[1]==$activity[$i]->extraBookings[$k]->id) $check_extra = true;
			}
			if(!$check_extra)
			{
				$jumlah = $lineitems[$z]->quantity;
				$harga = $lineitems[$z]->unitPrice * $jumlah;
				$subtotal_harga += $harga;
			}
		}
		else
		{
			$jumlah = $lineitems[$z]->quantity;
			$harga = $lineitems[$z]->unitPrice * $jumlah;
			$subtotal_harga += $harga;
		}
	}
							
							?>
								
                    			<div class="col-4 text-right">
                    				<b>${{ $subtotal_harga }}</b>
                    			</div>
                			 </div>
                    
                    		 <div class="row mb-4">
                				<div class="ml-4">
									@if(isset($product_invoice[$i]->product->keyPhoto->derived[2]->url))
                    				<img class="img-fluid" src="{!! $product_invoice[$i]->product->keyPhoto->derived[2]->url !!}">
									@endif
                    			</div>
                    			<div class="col-8">
                                	{{ $product_invoice[$i]->dates }}
                                	<br>
                                    {{ $activity[$i]->rate->title }}
                                    <br>
                            
<?php
	for($z=0;$z<count($lineitems);$z++)
	{
		
		$itemBookingId = $lineitems[$z]->itemBookingId;
		$itemBookingId = explode("_",$itemBookingId);
		if($activity[$i]->extrasPrice>0)
		{
			$check_extra = false;
			for($k=0;$k<count($activity[$i]->extraBookings);$k++)
			{
				if($itemBookingId[1]==$activity[$i]->extraBookings[$k]->id) $check_extra = true;
			}
			if(!$check_extra)
			{
				if($lineitems[$z]->quantity==$lineitems[$z]->people && $lineitems[$z]->title!="Passengers")
				{
					print($lineitems[$z]->quantity ." x ".$lineitems[$z]->title." ($".$lineitems[$z]->unitPrice.")<br>");
				}
				else
				{
					print($lineitems[$z]->quantity ." x Price per booking ($". $lineitems[$z]->unitPrice .")<br>");
				}
				
			}
		}
		else
		{
			if($lineitems[$z]->quantity==$lineitems[$z]->people && $lineitems[$z]->title!="Passengers")
				{
					print($lineitems[$z]->quantity ." x ".$lineitems[$z]->title." ($".$lineitems[$z]->unitPrice.")<br>");
				}
				else
				{
					print($lineitems[$z]->quantity ." x Price per booking ($". $lineitems[$z]->unitPrice .")<br>");
				}
		}
	}
							?>
							
							
                                    
                                </div>
                			</div>
                            <!-- Product detail booking -->
                            <?php
								$subtotal_extra = 0;
								if($activity[$i]->extrasPrice>0)
								{
							?>
                            <!-- Extra booking $activity -->
							<div class="card">
                        		<div class="card-body">
                                <?php
								
								for($k=0;$k<count($activity[$i]->extraBookings);$k++)
								{
								?>
									<div class="row mb-4">
                						<div class="col-8">
										{{ $activity[$i]->extraBookings[$k]->extra->title }}
                    					</div>
                    					<div class="col-4 text-right">
                    						<b>${{ $activity[$i]->extraBookings[$k]->extra->price }}</b>
                    					</div>
                					</div>
                                <?php
									$subtotal_extra += $activity[$i]->extraBookings[$k]->extra->price;
								}
								?>
								</div>
                   			</div>
							<!-- Extra booking -->
                            <?php
								}  
							?>  
                            
                            
				</div>
                <!-- Product booking -->
				
				
				@php
					$total = $subtotal_harga + $subtotal_extra;
					$grand_total += $total;
				@endphp
				<div class="card-body pt-0 mt-0">
                	<hr>
                	<div class="row mb-2">
                		<div class="col-8">
                    		<span style="font-size:18px">Subtotal</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">${{ $total }}</span>
                    	</div>
                	</div>
				</div>
				
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
		   		<img style="margin-bottom:30px;" height="20" src="/assets/logo/Powered-By-PayPal-Logo.webp">
				 </div>
             
                {!! $widget !!}
                
                
			</div></div>
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