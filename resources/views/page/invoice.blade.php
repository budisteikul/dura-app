@extends('layouts.frontend')
@section('title','INVOICE '. $rev_shoppingcarts->confirmationCode)
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
<!-- ################################################################### -->

<style>
#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>

<div id="invoice">

    <!-- div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div -->
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        
                            {!! QrCode::size(120)->margin(0)->generate('https://www.vertikaltrip.com/booking/invoice/'.$rev_shoppingcarts->id ); !!}
                       
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <img src="{{ url('/assets/logo/logo-dark.png') }}" data-holder-rendered="true" height="50" />
                           
                        </h2>
                        <div>Jl. Abiyoso VII No.190 Bantul ID</div>
                        <div>+62 857 43 112 112</div>
                        <div>guide@vertikaltrip.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer }}
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer }} 
                      </h2>
                        <div class="address">{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer }} </div>
                        <div class="email"><a href="mailto:{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer }} ">{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer }} </a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE {{ $rev_shoppingcarts->confirmationCode }}</h1>
                        <div class="date">Date of Invoice: {{ Carbon\Carbon::parse($rev_shoppingcarts->created_at)->formatLocalized('%d %b %Y') }}</div>
                        <div class="date">Due Date: {{ Carbon\Carbon::parse($rev_shoppingcarts->created_at)->formatLocalized('%d %b %Y') }}</div>
                        <div>Status: <span class="badge badge-success">Paid in Full</span></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">PRICE</th>
                            <th class="text-right">QTY</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$grantTotal = 0;
						?>
                        @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
                        <?php
						$subtotal = 0;
						$number = 1;
						?>
                        @foreach($shoppingcart_products->shoppingcart_rates()->get() as $shoppingcart_rates)
                        <tr>
                            <td class="no">{{ sprintf("%02d", $number) }}</td>
                            <td class="text-left">
                            <h3>{{ $shoppingcart_rates->title }}</h3>
                            {{ $shoppingcart_rates->unitPrice }}
                            </td>
                            <td class="unit">${{ $shoppingcart_rates->price }}</td>
                            <td class="qty">{{ $shoppingcart_rates->qty }}</td>
                            <td class="total">${{ $shoppingcart_rates->total }}</td>
                        </tr>
                        <?php
						$number += 1;
						$subtotal += $shoppingcart_rates->total;
						?>
                        @endforeach
                        <?php
						$grantTotal += $subtotal;
						?>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>${{ $subtotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>${{ $grantTotal }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">&nbsp;</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
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
</div>
			


@endsection