 
                <div class="card shadow">
  				<div class="card-header bg-dark text-white pb-1">
    				<h4><i class="fas fa-shopping-cart"></i> Order Summary</h4>
  				</div>
                <?php
				$grand_subtotal = 0;
				$grand_discount = 0;
				$grand_total = 0;
				?>
                @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_product)
                <!-- Product booking -->
                <div class="card-body">
                            <!-- Product detail booking -->
							<div class="row mb-4">
                				<div class="col-8">
                    				<b>{{ $shoppingcart_product->title }}</b>
                    			</div>
                    			<div class="col-4 text-right">
                                	<?php
									$product_subtotal = 0;
									$product_discount = 0;
									$product_total = 0;
									foreach($shoppingcart_product->shoppingcart_rates()->where('type','product')->get() as $shoppingcart_rates)
									{
										$product_subtotal += $shoppingcart_rates->subtotal;
										$product_discount += $shoppingcart_rates->discount;
										$product_total += $shoppingcart_rates->total;
									}
									?>
                                    @if($product_discount>0)
                                    	<strike class="text-muted">${{ $product_subtotal }}</strike><br><b>${{ $product_total }}</b>
                                    @else
                    					<b>${{ $product_total }}</b>
                    				@endif
                                </div>
                			 </div>
                    
                    		 <div class="row mb-4">
                             <!-- div class="col-10 row" -->
                				<div class="ml-4 mb-2">
                               		@if(isset($shoppingcart_product->image))
                    				<img class="img-fluid" width="55" src="{{ $shoppingcart_product->image }}">
                                	@endif
                    			</div>
                    			<div class="col-8 ml-0" style="font-size:12px; margin-left:-8px">
                                	{{ \App\Classes\Rev\BookClass::datetotext($shoppingcart_product->date) }}
                                	<br>
                                    {{ $shoppingcart_product->rate }}
                                    <br>
                                    @foreach($shoppingcart_product->shoppingcart_rates()->where('type','product')->get() as $shoppingcart_rates)
                                    	
                                        	{{ $shoppingcart_rates->qty }} x {{ $shoppingcart_rates->unitPrice }} (${{ $shoppingcart_rates->price }})
                                    	
                                        <br>
                                    @endforeach
                                </div>
                			<!-- /div>
                            <div class="col text-right">
                            	<button id="remove-{{ $shoppingcart_product->bookingId }}" onClick="REMOVE({{ $shoppingcart_product->bookingId }});" class="btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </div -->
                            </div>
                            <!-- Product detail booking -->
                            <!-- Pickup booking $activity -->
                            @php
							$pickups = $shoppingcart_product->shoppingcart_rates()->where('type','pickup')->get();
                            @endphp
                            @if(count($pickups))
                            <div class="card mb-2">
                        		<div class="card-body">
                               		@foreach($pickups as $shopppingcart_rates)
									<div class="row mb-2">
                						<div class="col-8">
                                        <strong style="font-size:12px;">Pick-up and drop-off services</strong>
                                        <br>
                                        <span style="font-size:12px;">{{ $shopppingcart_rates->unitPrice }}</span>
                    					</div>
                    					<div class="col-4 text-right">
                    						@if($shopppingcart_rates->discount > 0)
                                            	<strike class="text-muted">${{ $shopppingcart_rates->subtotal }}</strike><br><b>${{ $shopppingcart_rates->total }}</b>
                                            @else
                                            	<b>${{ $shopppingcart_rates->subtotal }}</b>
                    						@endif
                                        </div>
                					</div>
                               		@endforeach
								</div>
                   			</div>
							@endif
                            <!-- Pickup booking $activity -->
							
                            <!-- Extra booking $activity -->
                            @php
                            $extra = $shoppingcart_product->shoppingcart_rates()->where('type','extra')->get();
                            @endphp
                            @if(count($extra))
							<div class="card mb-2">
                            
                        		<div class="card-body">
                                <div class="row col-12 mb-2">
                            		<strong>Extras</strong>
                            	</div>
                                @foreach($extra as $shoppingcart_rates)
									<div class="row mb-2">
                						<div class="col-8">
										{{ $shoppingcart_rates->title }}
                    					</div>
                    					<div class="col-4 text-right">
                                        	@if($shopppingcart_rates->discount > 0)
                                            	<strike class="text-muted">${{ $shopppingcart_rates->subtotal }}</strike><br><b>${{ $shopppingcart_rates->total }}</b>
                                            @else
                    							<b>${{ $shoppingcart_rates->subtotal }}</b>
                                            @endif
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
				$grand_subtotal += $shoppingcart_product->subtotal;
				$grand_discount += $shoppingcart_product->discount;
				$grand_total += $shoppingcart_product->total;
				?>
                
                @endforeach
                <div class="card-body pt-0 mt-0">
                	<hr>
                	<div class="row mb-2">
                		<div class="col-8">
                    		<span style="font-size:18px">Items</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">${{ $grand_subtotal }}</span>
                    	</div>
                	</div>
                    @if($grand_discount>0)
                    <div class="row mb-2">
                		<div class="col-8">
                    		<span style="font-size:18px">Discount</span>
                    	</div>
                    	<div class="col-4 text-right">
                    		<span style="font-size:18px">${{ $grand_discount }}</span>
                    	</div>
                	</div>
                    @endif
				</div>
                
                <div class="card-body pt-0">
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