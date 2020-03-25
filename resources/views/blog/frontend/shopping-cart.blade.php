@extends('layouts.frontend')
@section('content')
@include('layouts.loading')
@push('scripts')
<style>
.promocode-form .well {
  text-align: right;
}
.gift-card-form .well {
  text-align: right;
}
@media only screen and (max-width: 600px) {
  .customer-invoice .mobile {
    display: block;
  }
}
@media only screen and (min-width: 601px) {
  .customer-invoice .mobile {
    display: none;
  }
}
@media only screen and (max-width: 600px) {
  .customer-invoice.table {
    display: none;
  }
}
.zebraRow div:nth-child(odd) {
  background: #eee;
}
.zebraRow .itemlabel {
  float: right;
}
html.rtl .zebraRow .itemlabel {
  float: left;
}
.invoice-list {
  margin-top: 15px;
}
.invoice-list a.invoice-link.selected {
  font-weight: bold;
  background-color: #F7F749;
}
.invoice-list a.inactive-invoices-link {
  display: inline-block;
  color: #333;
  margin-top: 5px;
}
.invoice-list a.inactive-invoices-link i {
  display: inline-block;
  width: 10px;
}
.invoice-list a.inactive-invoices-link:hover {
  text-decoration: none;
}
.invoice-list h5 {
  border-bottom: 1px solid #DFDFDF;
}
.invoice-list .seller-invoice-list h5 {
  margin-bottom: 0px;
}
.invoice-list .seller-invoice-list .seller-invoices {
  margin-top: 6px;
}
.booking-invoice {
  border: 1px solid #DDD;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 15px;
}
.booking-invoice .invoice-header h3 {
  margin-top: 0px;
  padding-top: 0px;
}
.booking-invoice table tr td.amount,
.booking-invoice table tr th.amount {
  text-align: right;
}
.booking-invoice tr.custom-header td {
  font-weight: bold;
  background-color: #f9f9f9;
}
.booking-invoice .product-invoice tr.product-header td {
  font-weight: bold;
  background-color: #f9f9f9;
}
.booking-invoice .product-invoice tr.product-line-item td {
  vertical-align: middle;
}
.booking-invoice .product-invoice tr.product-line-item td input,
.booking-invoice .product-invoice tr.product-line-item td select,
.booking-invoice .product-invoice tr.product-line-item td .input-prepend,
.booking-invoice .product-invoice tr.product-line-item td .input-append {
  margin-bottom: 0px;
}
.booking-invoice .product-invoice tr.product-line-item td.title {
  padding-left: 20px;
}
.booking-invoice tbody.headers {
  border-style: none;
}
.booking-invoice tbody.headers th {
  border-top-style: none;
}
.booking-invoice tbody.totals {
  border-top: 4px double #333;
}
.booking-invoice tbody.totals tr td.empty {
  border-top-style: none;
}
.booking-invoice tbody.totals tr.invoice-total td,
.booking-invoice tbody.totals tr.invoice-paid td,
.booking-invoice tbody.totals tr.invoice-remaining td {
  font-weight: bold;
  font-size: 1.2em;
}
.booking-invoice tbody.dcc-payments {
  border-top-style: none;
}
.booking-invoice tbody.dcc-payments tr.header td.title {
  border-top: 4px double #333;
  font-weight: bold;
  font-size: 1.2em;
  text-align: left;
}
.booking-invoice tbody.dcc-payments tr td.empty {
  border-top-style: none;
}
.booking-invoice tbody.dcc-payments tr.subhead td.amount {
  border-top: 4px double #333;
}
.booking-invoice tbody.dcc-payments tr td.converted {
  font-weight: bold;
  font-size: 1.2em;
}
.booking-invoice tr.custom-line-item td,
.booking-invoice tr.custom-new-header td {
  vertical-align: middle;
}
.booking-invoice tr.custom-line-item td input,
.booking-invoice tr.custom-new-header td input,
.booking-invoice tr.custom-line-item td select,
.booking-invoice tr.custom-new-header td select,
.booking-invoice tr.custom-line-item td .input-prepend,
.booking-invoice tr.custom-new-header td .input-prepend,
.booking-invoice tr.custom-line-item td .input-append,
.booking-invoice tr.custom-new-header td .input-append {
  margin-bottom: 0px;
}
.booking-invoice tr.custom-line-item td.title {
  padding-left: 20px;
}
.booking-invoice .clear {
  clear: both;
}
.input-prepend.input-block-level {
  display: table;
  width: 100%;
}
</style>
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
			
            	{!! $cart !!}
            
            	
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		<img style="margin-bottom:30px;" height="20" src="/assets/logo/Powered-By-PayPal-Logo.webp">
				 </div>
             
             
                 
        
         
            
  

				
                
                
                
                
                
                
			</div></div>

			
				<div style="height:40px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endsection