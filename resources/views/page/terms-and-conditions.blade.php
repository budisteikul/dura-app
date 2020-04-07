@extends('layouts.frontend')
@section('title','Terms and Conditions')
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
				<div style="height:70px;"></div>
				
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		
				 </div>
                 
				 
				 <!-- ##### -->
					<div class="row" style="padding-bottom:0px;">
						<div class="col-lg-12 text-center">
							<h3 class="section-heading">TERMS AND CONDITIONS</h3>
							<hr style="max-width:50px;border-color:#1D57C7;border-width:3px;">
							<h4 class="section-subheading text-muted">
								
							</h4>
						</div>
					</div>
					
                 <!-- ##### -->
                 <div class="row col-md-8  mx-auto text-left">
					<div class="textwidget" style=" min-height:250px;">
					 <!-- ##### content -->
					 @php
						$thedomain = "VERTIKAL TRIP";
					 @endphp
						<p>&nbsp;</p>
<p>These terms and conditions contain legal obligations and we encourage you to read through them carefully. Unless otherwise stated, any purchases made through {{ $thedomain }} are subject to these terms and conditions.</p>
<p>&nbsp;</p>
<p><strong>1. OUR CONTRACT</strong></p>
<p>All bookings are made with {{ $thedomain }} (us/we). By making a booking, the traveller/guest (you) is deemed to have agreed to these terms and conditions on behalf of all individuals included in the booking. The services to be provided are those in your booking confirmation invoice. No alterations or variations to these terms and conditions are in effect unless made in writing by and under the authority of {{ $thedomain }}</p>
<p>&nbsp;</p>
<p><strong>2. PRICING AND PAYMENTS</strong></p>
<p><strong>2.1 Pricing</strong></p>
<p>i. Prices and exchange rates &mdash; Prices are correct at the time of quoting, converted at the prevailing foreign exchange rate as set by {{ $thedomain }}.</p>
<p>ii. Price changes &mdash; The prices appearing on the website are the current rates and can change without notice. Once a traveller has booked through {{ $thedomain }}, the traveller will not be required to pay any difference in the event of a price increase. {{ $thedomain }} will not refund the balance of any price reduction.</p>
<p>iii. Child rate &mdash; Our child rates apply at the time of the tour, not the time of booking. Proof of age must be available for inspection on the day of travel. If a traveller is identified as not qualifying for a child price (if a child price is available for the tour), the traveller will be required to provide the balance of difference between the adult rate and child rate for the tour before being permitted to start the trip.</p>
<p>iv. Per person &mdash; All prices listed are on a per traveller basis unless otherwise stated.</p>
<p>v. Inclusions &mdash; Prices include all inclusions as indicated on the tour description on {{ $thedomain }}</p>
<p>vi. Exclusions &mdash; Prices do not include:</p>
<p>a) Tips and gratuities &mdash; If you are happy with the services provided by your local guides and drivers, a tip &mdash; though not compulsory &mdash; is appropriate. While it may not be customary to you, it is of great significance to the people who will take care of you during your travels, inspires excellent service, and is an entrenched feature of the tourism industry across many destinations. Please consider this when budgeting for your extra expenses on your tour.</p>
<p>b) Items of a personal nature &mdash; These may include snacks, meals, and drinks not outlined as an inclusion in the inclusions section of the tour description.</p>
<p>c) Baggage and personal insurance &mdash; It is highly recommended that each traveller obtains adequate insurance for their travels</p>
<p>d) Local taxes and fees &mdash; Unless otherwise stated, the price does not include any local taxes or fees, including foreign departure, security, port charges, park fees, customs, immigration, agricultural, passenger-facility charges, or international transportation tax.</p>
<p><strong>2.2 Payment</strong></p>
<p> {{ $thedomain }} use PayPal as payment gateway to securely transact payments using their respective payment systems.</p>
<p>&nbsp;</p>
<p><strong>3. CANCELLATIONS AND NO-SHOWS</strong></p>
<p><strong>3.1 Cancellations by the traveller</strong></p>
<p>For a 100% refund, cancellations or changes must be made at least 24 hours in advance of the tour by texting reservations at +62 85743112112. There will be a 100% charge for no-shows. In other words, if you do not show up for the scheduled tour, no refund will be issued.</p>
<p><strong>3.2 Cancellations by {{ $thedomain }}</strong></p>
<p>We  may cancel a tour at any time prior to departure if, due to terrorism, natural disasters, political instability, or other external events it is not viable for us to operate the planned itinerary. If we cancel your tour, you can transfer amounts paid to an alternate departure date or, alternatively, receive a full refund. In circumstances where the cancellation is due to external events outside our reasonable control, refunds will be less any unrecoverable costs. We are not responsible for any incidental expenses you may have incurred as a result of your booking, including but not limited to visas, vaccinations, travel insurance, or non-refundable flights.</p>
<p>&nbsp;</p>
<p><strong>4. AGE AND HEALTH REQUIRMENTS</strong></p>
<p>a) Age requirements &mdash; All travellers under the age of 18 must be accompanied by a legal guardian, or in lieu of a legal guardian, by an escort over the age of 18, appointed by their legal guardian. The legal guardian or their designee will be responsible for the traveller under the age of 18. While many of our tours permit all ages, the minimum age requirements may vary with tours. Please see the tour description to check whether a tour is child friendly. For tours featuring alcohol, travellers may be required to show proof of age of majority.</p>
<p>b) Health requirements &mdash; Some trips can be physically demanding, and travellers must ensure that they are suitably fit to allow participation. It is your responsibility to ensure that you are physically fit to participate.</p>
<p>&nbsp;</p>
<p><strong>5. TRAVEL INSURANCE</strong></p>
<p>It is a requirement that all travellers booking a  tour or activity have valid and comprehensive travel insurance. Neither {{ $thedomain }} can be held responsible for any liability, expenses, or losses you incur as a result of being inadequately insured. We strongly recommend that at the time of booking a comprehensive travel insurance policy is purchased.</p>
<p>&nbsp;</p>
<p><strong>6. PASSPORT AND VISAS</strong></p>
<p>Unless travelling domestically, travellers must carry a valid passport and have obtained the appropriate visas when travelling with {{ $thedomain }}. Please ensure your passport is valid for 6 months beyond the duration of the trip. It is the traveller&rsquo;s responsibility to ensure that you are in possession of the correct visas for your holiday. {{ $thedomain }} cannot accept responsibility if you are refused entry to a country because you lack the correct visa documentation.</p>
<p>&nbsp;</p>
<p><strong>7. DISCAIMERS AND LIMITATIONS OF LIABILITY</strong></p>
<p>a) {{ $thedomain }} shall not be liable for injury, damage, loss, accident, delay, or irregularity, liability, or expense to person or property.</p>
<p>b) {{ $thedomain }} accept no responsibility for any sickness, acts of crime, labour disputes, government actions, acts of war and/or terrorism, weather conditions, defect in any vehicle of transportation, or for any misadventure or casualty or any other causes beyond their control.</p>
<p>c) {{ $thedomain }} maintains information that is accurate to the best of our knowledge; however, does not warrant that content and information provided on {{ $thedomain }} website will be without error and that functionality of the websites uninterrupted or without error.</p>
<p>d) {{ $thedomain }} will not accept responsibility or liability for any traveller who contravenes any law or regulation of any country visited.</p>
<p>&nbsp;</p>
<p><strong>8. INTERNATIONAL / OVERSEAS ORDERS</strong></p>
<p>All prices shown on {{ $thedomain }}&rsquo;s website are in USD&rsquo;s and all transactions are conducted in USD&rsquo;s. If your credit/debit card account is in a currency other than USD, you may also be subject to a foreign currency transaction fee. Please consult your bank or credit card provider if you are unsure. We are not responsible for the exchange rate or any charges your bank or issuing credit card company may charge you.</p>
<p>&nbsp;</p>
<p><strong>Changes to these terms and conditions</strong></p>
<p>{{ $thedomain }} may occasionally update its terms and conditions. When this is done, we will also revise the &lsquo;last updated&rsquo; date of its terms and conditions.</p>
<p>&nbsp;</p>
<p class="text-right"><strong>Last updated 22th March 2020<br>
{{ $thedomain }}</strong></p>
					 <!-- ##### -->
					</div>
				</div>
                 <!-- ##### --> 
                 
              
				
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