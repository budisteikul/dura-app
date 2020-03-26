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
                @endphp
                @for($i=0;$i<count($activity);$i++)
							<?php
								$lineitems = $product_invoice[$i]->lineItems;
							?>
                <!-- Product booking -->
                <div class="card-body">
                
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $activity[$i]->activity->title }}</b>
                    			</div>
								
								<?php
							
							$group1 = array();
							foreach ( $activity[$i]->pricingCategoryBookings as $value ) {
    							$group1[$value->pricingCategoryId][] = $value;
							}
							
							$subtotal_harga = 0;
							for($j=0;$j<count($group1);$j++)
								{
									
									try
									{
										$jumlah = count(array_values($group1)[$j]);
										$harga = $jumlah * array_values($group1)[$j][0]->bookedPrice;
										
									}
									catch(Exception $e)
									{
										$harga = $lineitems[$i]->quantity * $lineitems[$i]->total;
									}
									$subtotal_harga += $harga;
								}
							?>
								
                    			<div class="col-4 text-right">
                    				<b>${{ $subtotal_harga }}</b>
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
										$harga = $lineitems[$i]->total;
										print('1 X Price per booking ($'.$harga.')<br>');
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
                    	<b style="font-size:18px">${{ $subtotal_harga+$subtotal_extra }}</b>
                    	</div>
                	</div>
                </div>
                <!-- ################################################################### --> 
                
                
                
                
			</div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            <div class="col-lg-6 col-lg-auto mb-6 mt-4">
           
		   
		   
		   
			<div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		<img style="margin-bottom:30px;" height="20" src="/assets/logo/Powered-By-PayPal-Logo.webp">
				 </div>
             
                <div id="bokun-w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2">Loading...</div><script type="text/javascript">
var w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2;
(function(d, t) {
  var host = 'widgets.bokun.io';
  var frameUrl = 'https://' + host + '/widgets/111929?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2';
  var s = d.createElement(t), options = {'host': host, 'frameUrl': frameUrl, 'widgetHash':'w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2', 'autoResize':true,'height':'','width':'100%', 'minHeight': 0,'async':true, 'ssl':true, 'affiliateTrackingCode': '', 'transientSession': true, 'cookieLifetime': 43200 };
  s.src = 'https://' + host + '/assets/javascripts/widgets/embedder.js';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
    try {
      w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2 = new BokunWidgetEmbedder(); w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2.initialize(options); w111929_2cb5f0f5_dc73_4c7a_ac95_85cca45165a2.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');
</script>
                
                
			</div></div>
		   
		   
		   
		   
		   
		   
              
        	</div>
            
            	
           

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection