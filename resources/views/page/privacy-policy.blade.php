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
				<div style="height:70px;"></div>
				
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		
				 </div>
                 
				 
				 <!-- ##### -->
					<div class="row" style="padding-bottom:0px;">
						<div class="col-lg-12 text-center">
							<h3 class="section-heading">PRIVACY POLICY</h3>
							<hr style="max-width:50px;border-color:#1D57C7;border-width:3px;">
							<h4 class="section-subheading text-muted">
								Personal data rights and data security
							</h4>
						</div>
					</div>
					
                 <!-- ##### -->
                 <div class="row col-md-8  mx-auto text-left">
					<div class="textwidget" style=" min-height:250px;">
					 <!-- ##### content -->
					
					  <p>&nbsp;</p>

<p><strong>Introduction</strong></p>
<p>We’ve provided this Privacy Policy to inform you of our practices and how the information we collect is used. It also explains where and how we collect your personal information, as well as your rights over any personal information we hold concerning you. This policy applies to you if you use our products or services online, by phone or through our mobile applications, or interact with us on social media. This policy upholds our commitment to protect your personal information.</p>
<p>&nbsp;</p>


<p><strong>What type of information we collect and hold</strong></p>
<ul>
  <li>Information that you provide to us such as your name,  telephone number, email address, feedback you give to us by phone, email or post, and your communications with us via social media    </li>
  <li>We do not store your credit card details, including of the last 4 digits and expiration dates which the payment gateways provide us    </li>
  <li>Information about the services that we provide to you (including, for example, the tours we have supplied to you, when and where they were supplied, how much they were purchased for, as well as the manner in which you use our products and services, and so on)    </li>
  <li>Information about any device you have used to access our services (such as your device’s make and model, browser or IP address) and how you use our services, including our website    </li>
  <li>Your contact details and details of the emails and other electronic communications you receive from us, including whether that communication has been opened and whether you have clicked on any links within that communication. We do this to inform our choices when creating communications that are relevant to you    </li>
</ul>
<p>&nbsp;</p>

<p><strong>How your information is used by us</strong></p>
<p>The information we collect may be used to:</p>
<ul>
  <li>Make our services available to you    </li>
  <li>Process your orders    </li>
  <li>Process payments and refunds    </li>
  <li>Personalise your booking experience    </li>
  <li>Help us to ensure that our customers are genuine and to prevent fraud    </li>
  <li>Conduct market research, either ourselves or via reputable agencies    </li>
  <li>For statistical analysis    </li>
  <li>Help us understand more about you as a customer, the products and services you consume and how you consume them, so we can improve our service to you    </li>
  <li>Find ways to improve our services and websites    </li>
  <li>Contact you about products and services, as well as provide you with offers, promotions    </li>
  <li>Help answer your questions and solve any issues you may have    </li>
  </ul>
<p>Your personal data will be held for 2 years unless a request is expressly made to remove delete this information. Without prejudice to any other administrative or judicial remedy, you shall have the right to lodge a complaint with a supervisory authority in the Republic of Indonesia if the you consider that the processing of your personal data infringes this Regulation.</p>
<p>&nbsp;</p>

<p><strong>Who we share your information with</strong></p>
<p>We do not sell, rent or lease your personal information to third parties. We work with GDPR-compliant data processors with whom we share and receive your information.</p>
<p>For example:  </p>
<ul>
  <li>Payment Gateways    </li>
  <li>Advertising Networks    </li>
  <li>Analytics Providers    </li>
  <li>Email Providers    </li>
  <li>Review Agencies    </li>
  <li>Search Information Providers    </li>
  <li>Fraud Prevention Service Providers    </li>
  <li>Tour operators    </li>
  </ul>
<p>Vertikaltrip.com will not share personal information with any third parties without your permission, unless to:  </p>
<ul>
  <li>Respond to duly authorised information requests of governmental authorities    </li>
  <li>Comply with any law, regulation, subpoena, or court order    </li>
  <li>Help prevent fraud, or enforce or protect the rights and properties of Vertikaltrip.com    </li>
  <li>Protect the personal safety of Vertikal Trip’s employees and third parties on Vertikal Trip’s property    </li>
  <li>Transfer personal data if Vertikal Trip’s website or Vertikaltrip.com is acquired (or the majority of the company is acquired) by a third party    </li>
  <li>Transfer personal data if we sell or acquire any business or assets to a third-party buyer or seller</li>
</ul>
<p>&nbsp;</p>

<p><strong>How we inform you of our products and services</strong></p>
<p>We would like to tell you about the great offers, promotions, competitions, products and services of Vertikal Trip from time to time that we think will be of interest to you.
 
Where you have given us consent to do so, we may contact you by post, email, text message, online, using social media and push notifications via apps, or by any other electronic means.
 
We will need to send you occasional service-related messages, but we won’t send you marketing messages unless you opt into this feature. Marketing messages include updates, offers, promotions and basket reminders. You are not required to receive all these types of messages, and you can amend your preferences or unsubscribe at any time, or by sending us an e-mail to guide@vertikaltrip.com</p>
<p>&nbsp;</p>

<p><strong>Access to your information and how you can update it</strong></p>
<p>Under data protection legislation, you have the right to access information held about you (also known as Subject Access Request). If you opt to exercise this right and we agree that we are obliged to provide personal information to you (or someone else on your behalf), we will provide it to you or them free of charge (within 28 working days). Before providing personal information to you or another person on your behalf, we may ask for proof of identity and sufficient information about your interactions with us in order to verify identity.
 
If any of the personal information we hold about you is inaccurate or out of date, you may ask us to correct it. You can also correct or update your personal information. If you wish to exercise these rights, please contact us at guide@vertikaltrip.com</p>
<p>&nbsp;</p>

<p><strong>Security</strong></p>
<p>Vertikal Trip is committed to protecting the information with which you provide us.</p>
<ul>
  <li>We use a trusted payment processing service to process your payment and we do not store your credit/debit card information, including of the expiry dates and last 4 digits of your card number.     </li>
  <li>We use secure socket layer software (SSL) to encrypt personal information that you provide. This technology prevents you from inadvertently revealing personal information using an unsecure connection. Our website is certified with an SSL certificate, which verifies that our website is secure.    </li>
  <li>We keep your information confidential and store user personal data on a secure server, which is password protected and firewall protected. Unfortunately, the transmission of information via the internet is not completely secure. We will do our best to protect your personal data, although we cannot guarantee the security of your data once transmitted to our website. We will strive to prevent unauthorised access to your data using strict procedures and security features.</li>
</ul>
<p>&nbsp;</p>

<p><strong>Security</strong></p>
<p>Vertikaltrip.com may occasionally update its Privacy Policy. When this is done we will also revise the ‘last updated’ date of its privacy policy statement.</p>
<p>&nbsp;</p>

<p class="text-right"><strong>Last updated 22th March 2020</strong></p>
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