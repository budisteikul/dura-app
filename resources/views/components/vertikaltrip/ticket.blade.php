<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>E-TICKET</title>
<style type="text/css" media="all">
body {
  background: #ffffff;
  font-family: helvetica, arial;
  
  box-sizing: border-box;
  -webkit-print-color-adjust: exact; 
}

h1 {
  color: #ccc;
  font-weight: 200;
  font-size: 2.1em;
  margin: 0px;
}

h2 {
  color: #ffffff;
  opacity: .8;
  font-weight: 100;
  font-size: .9em;
  margin: 0px;
  text-transform: uppercase;
}

h3 {
  color: #ffffff;
  opacity: .8;
  font-weight: 100;
  font-size: .9em;
  margin: 0px;
}

.cards_wrapper {
  text-align: center;
}

.card {
  width: 320px;
  border-radius: 20px;
  background: #4d1532;
  display: inline-block;
  margin: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
}
.card img {
  width: 100%;
}
.card .inner {
  position: absolute;
  width: 320px;
  height: 100%;
  z-index: 1;
  opacity: 0.1;
  background-size: 130px;
  background-repeat: repeat-y;
  background-position: 0px 0px;
  background-repeat: repeat-x;
  animation: animatedBackground 40s linear infinite;
}
@keyframes animatedBackground {
  from {
    background-position: 100% -10px;
  }
  to {
    background-position: 0% -10px;
  }
}
.card_logo {
  background: #ffffff;
  border-radius: 20px 20px 0 0;
}


.card_heading h2 {
  padding-top: 10px;
  text-align: center;
}
.card_thumbnail {
  min-height: 150px;
  margin-top: 10px;
}
.card_thumbnail img {
  width: 100%;
  height: auto;
}
.card_trip {
  text-align: center;
  width: 85%;
  margin: 10px auto;
  display: flex;
  height: 80px;
}
.card_trip div {
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.card_trip div h1 {
  margin: 0px;
}
.card_trip div h2 {
  margin: 0px;
  letter-spacing: 2px;
}
.card_trip div.trip_from {
  text-align: left;
  width: 35%;
}
.card_trip div.trip_from h2 {
  padding-left: 2px;
}
.card_trip div.trip_icon {
  width: 50%;
}
.card_trip div.trip_icon img {
  padding-top: 20px;
  opacity: 1;
  width: 25px;
}
.card_trip div.trip_to {
  text-align: right;
  width: 35%;
}
.card_trip div.trip_to h2 {
  padding-right: 3px;
}
.card_departure {
  margin: -20px auto 32px;
}
.card_departure div {
  color: #ffffff;
}
.card_divider {
  position: relative;
  width: 100%;
}
.card_divider .divider_left {
  left: -15px;
}
.card_divider .divider_hole {
  position: absolute;
  top: -12px;
  padding: 0px;
  height: 25px;
  width: 25px;
  border-radius: 100%;
  background: #ffffff;
}
.card_divider .divider {
  width: 85%;
  margin: -4px auto;
  height: 2px;
  background: linear-gradient(to right, #ffffff 50%, transparent 50%);
  background-size: 10px 8px, 100% 2px;
  opacity: .2;
}
.card_divider .divider_right {
  right: -15px;
}
.card_flight_details h2 {
  font-size: .7em;
}
.card_flight_details .card_seating {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.card_flight_details .card_seating div {
  display: inline-block;
  width: 50%;
}
.card_flight_details .card_seating div.seating_passenger {
  text-align: left;
}
.card_flight_details .card_seating div.seating_passenger_dos {
  text-align: left;
  padding-left: 32px;
}
.card_flight_details .card_seating div.seating_seat {
  text-align: right;
}
.card_flight_details .card_details {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.card_flight_details .card_details div {
  display: inline-block;
  width: 33%;
}
.card_flight_details .card_details div.details_flight {
  text-align: left;
}
.card_flight_details .card_details div.details_date {
  text-align: center;
}
.card_flight_details .card_details div.details_time {
  text-align: right;
}
.card_flight_details .card_details_continued {
  width: 85%;
  margin: 30px auto;
  display: flex;
  padding-bottom: 30px;
}
.card_flight_details .card_details_continued div {
  display: inline-block;
  width: 100%;
}
.card_flight_details .card_details_continued div.details_flight {
  text-align: left;
}
.card_flight_details .card_details_continued div.details_date {
  text-align: center;
}
.card_flight_details .card_details_continued div.details_time {
  text-align: right;
}
.card .card_seating {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.card .card_seating div {
  display: inline-block;
  width: 50%;
}
.card .card_seating div.seating_passenger {
  text-align: left;
}
.card .card_seating div.seating_passenger_dos {
  text-align: left;
  padding-left: 32px;
}
.card .card_seating div.seating_seat {
  text-align: right;
}
.card .card_details {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.card .card_details div {
  display: inline-block;
  width: 100%;
}
.card .card_details div.details_flight {
  text-align: left;
}
.card .card_details div.details_date {
  text-align: center;
}
.card .card_details div.details_time {
  text-align: right;
}
.card .card_details_continued {
  width: 85%;
  margin: 30px auto;
  display: flex;
  padding-bottom: 30px;
}
.card .card_details_continued div {
  display: inline-block;
  width: 100%;
}
.card .card_details_continued div.details_flight {
  text-align: left;
}
.card .card_details_continued div.details_date {
  text-align: center;
}
.card .card_details_continued div.details_time {
  text-align: right;
}


.aa-theme {
  background: #0087C3;
}
.aa-theme .card_logo {
  border-top: 5px solid #0087C3;
}

@if($watermark)
.aa-theme:after {
	content: "";
	display: block;
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 50;
	background-image: url("/assets/logo/cancelled.png");
	background-position: 10px 50px;
	background-repeat: no-repeat;
	opacity: 0.9;
	}
@endif
</style>
</head>
  <body>

<div class="cards_wrapper">
		
	<div class="card aa-theme">
        <div class="card_heading">
					<div class="card_logo">
						<img src="{{ url('/assets/logo/logo-blue.png') }}" style="max-width:200px;" />
					</div>
                    <?php
					$image = str_ireplace("w=80","w=300",$rev_shoppingcart_products->image);
					$image = str_ireplace("h=80","h=200",$image);
					?>
					<img src="{{ $image }}">
					<div class="card_divider">
            <div class="divider_left divider_hole">
            </div>
            <div class="divider">
            </div>
            <div class="divider_right divider_hole">
            </div>
        </div>
					<h2 style="margin-left:15px; margin-right:15px;">{{ $rev_shoppingcart_products->title }}<br>{{ $rev_shoppingcart_products->rate }}</h2>
        </div>
        <div class="card_trip" style="padding-bottom:50px;">
            <div class="trip_from">
                
            </div>
            <div class="trip_icon">
                {!! QrCode::size(100)->generate('https://www.vertikaltrip.com/booking/ticket/'.$rev_shoppingcart_products->id ); !!}
            	<div style="color:#ffffff; margin-top:7px; opacity:0.6;">{{ $rev_shoppingcart_products->productConfirmationCode }}</div>
            </div>
            <div class="trip_to">
               
            </div>
        </div>
        <div class="card_divider">
            <div class="divider_left divider_hole">
            </div>
            <div class="divider">
            </div>
            <div class="divider_right divider_hole">
            </div>
        </div>
        
        <div class="card_details">
            <div class="details_flight">
                <h2>DATE</h2>
                <?php
				$tanggal = str_ireplace("@","<br>",$rev_shoppingcart_products->date);
				?>
                <h3>{!! $tanggal !!}</h3>
            </div>
            <div class="details_flight">
                <h2>NAME</h2>
                <h3><?php
	  	$rev_shoppingcarts = $rev_shoppingcart_products->shoppingcarts()->first();
	  ?>
      {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer }}
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer }}</h3>
            </div>
            
        </div>
    </div>
		
</div>

  </body></html>