<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>INVOICE</title>
<style type="text/css" media="all">
body {
  position: relative;
  width: 21cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px; 
}


.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}


header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
  max-width:300px;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #0087C3;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #0087C3;
  -webkit-print-color-adjust: exact; 
}

table .desc {
  text-align: left;
  -webkit-print-color-adjust: exact; 
}

table .unit {
  background: #DDDDDD;
  -webkit-print-color-adjust: exact; 
}

table .qty {
	-webkit-print-color-adjust: exact; 
}

table .total {
  background: #0087C3;
  color: #FFFFFF;
  -webkit-print-color-adjust: exact; 
}

table .discount {
  -webkit-print-color-adjust: exact; 
}

table .subtotal {
  background: #DDDDDD;
  -webkit-print-color-adjust: exact; 
}

table td.unit,
table td.qty,
table td.total,
table td.discount {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: none; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #0087C3;
  font-size: 1.4em;
  border-top: 1px solid #0087C3; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 1.2em;
  margin-bottom: 20px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  margin-top:50px;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


	</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        {!! QrCode::size(111)->margin(0)->generate('https://www.vertikaltrip.com/booking/invoice/'.$rev_shoppingcarts->id ); !!}
      </div>
      <div id="company">
        				<br><br>
                            <img src="/assets/logo/logo-blue.png" data-holder-rendered="true" height="40" />
                        
                        <div>Jl. Abiyoso VII No.190 Bantul ID</div>
                        <div>+62 857 43 112 112</div>
                        <div>guide@vertikaltrip.com</div>
      </div>
      
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer }}
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer }} </h2>
          <div class="address">{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer }}</div>
          <div class="email"><a href="mailto:{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer }} ">{{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer }} </a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE {{ $rev_shoppingcarts->confirmationCode }}</h1>
          <div class="date">Date of Invoice: {{ Carbon\Carbon::parse($rev_shoppingcarts->created_at)->formatLocalized('%d %b %Y') }}</div>
          <div class="date">Due Date: {{ Carbon\Carbon::parse($rev_shoppingcarts->created_at)->formatLocalized('%d %b %Y') }}</div>
          <div class="date">Status: {{ \App\Classes\Rev\BookClass::check_status_invoice($rev_shoppingcarts->confirmationCode) }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc"><strong>DESCRIPTION</strong></th>
            <th class="unit"><strong>UNIT PRICE</strong></th>
            <th class="qty"><strong>QUANTITY</strong></th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php
						$grantTotal = 0;
						?>
                        @foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
                        <?php
						$subtotal = 0;
						$total = 0;
						$discount = 0;
						$number = 1;
						?>
                        @foreach($shoppingcart_products->shoppingcart_rates()->get() as $shoppingcart_rates)
                        <tr>
            				<td class="no">{{ sprintf("%02d", $number) }}</td>
            				<td class="desc"><h3>{{ $shoppingcart_rates->title }}</h3>{{ $shoppingcart_rates->unitPrice }}</td>
            				<td class="unit">${{ $shoppingcart_rates->price }}</td>
            				<td class="qty">{{ $shoppingcart_rates->qty }}</td>
           				  <td class="total">${{ $shoppingcart_rates->subtotal }}</td>
          				</tr>
                        
                        <?php
						$number += 1;
						$subtotal += $shoppingcart_rates->subtotal;
						$total += $shoppingcart_rates->total;
						$discount += $shoppingcart_rates->discount;
						?>
                        @endforeach
                        <?php
						$grantTotal += $total;
						?>
                        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>${{ $subtotal }}</td>
          </tr>
          @if($discount>0)
          <tr>
            <td colspan="2"></td>
            <td colspan="2">DISCOUNT</td>
            <td>${{ $discount }}</td>
          </tr>
          @endif
          @if(\App\Classes\Rev\BookClass::check_status_invoice($rev_shoppingcarts->confirmationCode)=="Refunded")
          <tr>
            <td colspan="2"></td>
            <td colspan="2">REFUNDED</td>
            <td>-${{ $grantTotal }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">AMOUNT DUE (USD)</td>
            <td>$0</td>
          </tr>
          @else
          <tr>
            <td colspan="2"></td>
            <td colspan="2">AMOUNT DUE (USD)</td>
            <td>${{ $grantTotal }}</td>
          </tr>
          @endif
        </tfoot>
      </table>
      <div id="thanks"><strong>Thank you for your booking with VERTIKAL TRIP</strong></div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">&nbsp;</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  
</body>
</html>