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
				
           <div class="card mb-8 shadow p-2">
  			
 				 <div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 <div class="text-right">
		   		<img style="margin-bottom:30px;" height="20" src="/assets/logo/Powered-By-PayPal-Logo.webp">
				 </div>
                 
                 

	<div class="customer-invoice booking-invoice invoice-container" >
    	<table class="table customer-invoice">
        	<tbody class="headers">
            	<tr class="header">
                	<th></th>
                    <th class="amount">Quantity</th>
                    <th class="amount">Unit price</th>
                    <th class="amount">Discount</th>
                    <th class="amount">Tax</th>
                    <th class="amount">Amount</th>
                </tr>
            </tbody>
            <tbody class="product-invoice">
            	<tr class="product-header">
                	<td class="title" colspan="6">
                    	<span>Yogyakarta Merapi Lava Tour Admission Ticket - Thu 11.Jun 2020</span>
                    </td>
                </tr>
                <tr class="product-line-item ">
                	<td class="title">
                    	Passengers
                    </td>
                    <td class="quantity amount">
                    	1
                    </td>
                    <td class="unit-price amount">
                    	$32.59
                    </td>
                    <td class="discount amount">
                    	<div>
                        	<span>
                        		<span>10</span>
                                <span>%</span>
                            </span>
                       </div>
                    </td>
                    <td class="tax amount">
                    	<span>$0.00</span>
                    </td>
                    <td class="item-total amount">$29.33</td>
              </tr>
              <tr class="product-line-item ">
              	<td class="title">Pick-up and drop-off services</td>
                <td class="quantity amount">1</td>
                <td class="unit-price amount">$37.80</td>
                <td class="discount amount">
                	<div>
                    	<span>
                        	<span>0</span>
                            <span>%</span>
                        </span>
                   </div>
               </td>
               <td class="tax amount">
               		<span>$0.00</span>
               </td>
               <td class="item-total amount">$37.80</td>
        </tr>
        </tbody>
        <tbody></tbody>
        <tbody class="totals">
        	<tr class="first invoice-subtotal">
            	<td class="empty" colspan="4">&nbsp;</td>
                <td class="subtotal amount">
                	<span>Subtotal</span>
                    <span>:</span>
                </td>
                <td class="subtotal amount">$67.13</td>
            </tr>
            <tr class="invoice-total">
            	<td class="empty" colspan="4">&nbsp;</td>
                <td class="total amount">
                	<span>Amount due</span>
                    <span>:</span>
                </td>
                <td class="total amount">$67.13</td>
            </tr>
            </tbody>
            </table>
            <div class="customer-invoice mobile">
            	<div>
            		<div>
            			<div style="border:1px solid #DDD;padding:10px;margin:10px 0;">
            				<span>Yogyakarta Merapi Lava Tour Admission Ticket</span>
            				<span>&nbsp; - &nbsp;</span>
            				<span>Thu 11.Jun 2020</span>
            			</div>
            			<div class="zebraRow" style="border:1px solid #ddd;margin-bottom:10px;">
            				<div style="padding:10px;">
            					<span style="font-weight:600;">Title</span>
            					<span class="itemlabel">Passengers</span>
            				</div>
            				<div style="padding:10px;">
            					<span style="font-weight:600;">Quantity</span>
            					<span class="itemlabel">1</span>
            				</div>
            				<div style="padding:10px;">
            					<span style="font-weight:600;">Unit price</span>
            					<span class="itemlabel">$32.59</span>
            				</div>
            				<div style="padding:10px;">
            					<span style="font-weight:600;">Discount</span>
            					<span class="itemlabel">10%</span>
            				</div>
            				<div style="padding:10px;">
            					<span style="font-weight:600;flex:1;">Tax</span>
            					<span class="itemlabel">$0.00</span>
            				</div>
            				<div style="padding:10px;">
            					<span style="font-weight:600;">Amount</span>
            					<span class="itemlabel">$29.33</span>
            				</div>
            			</div>
            			<div class="zebraRow" style="border:1px solid #ddd;margin-bottom:10px;">
            				<div style="padding:10px;">
            				<span style="font-weight:600;">Title</span>
            				<span class="itemlabel">Pick-up and drop-off services</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Quantity</span>
            				<span class="itemlabel">1</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Unit price</span>
            				<span class="itemlabel">$37.80</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Discount</span>
            				<span class="itemlabel">0%</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;flex:1;">Tax</span>
            				<span class="itemlabel">$0.00</span>
            			</div>
            			<div style="padding:10px;">
            				<span style="font-weight:600;">Amount</span>
            				<span class="itemlabel">$37.80</span>
            			</div>
            		</div>
            	</div>
            <div class="zebraRow" style="border:1px solid #ddd;margin-bottom:10px;">
            	<div style="padding:10px;">
            		<span style="font-weight:600;">Subtotal</span>
            		<span class="itemlabel">$67.13</span>
            	</div>
            	<div style="padding:10px;">
            		<span style="font-weight:600;">Amount due</span>
            		<span class="itemlabel">$67.13</span>
            	</div>
            </div>
            
         </div>
       </div>
            
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