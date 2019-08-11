@extends('layouts.index')
@section('content')

<style>
div_body {
  background: #d7e4ed;
  font-family: helvetica, arial;
  text-transform: uppercase;
  box-sizing: border-box;
}
h1 {
  color: #FFF;
  font-weight: 400;
  font-size: 2.1em;
  margin: 0px;
}
h2 {
  color: #FFF;
  opacity: 0.5;
  font-weight: 400;
  font-size: 0.8em;
  margin: 0px;
}
h3 {
  color: #FFF;
  opacity: 0.8;
  font-weight: 400;
  font-size: 0.8em;
  margin: 0px;
}
.tickets_wrapper {
  text-align: center;
  padding-top: 20px;
}
.ticket {
  width: 320px;
  border-radius: 20px;
  background: #4d1532;
  display: inline-block;
  margin: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, .4);
}
.ticket img {
  width: 100%;
}
.ticket .inner {
  position: absolute;
  width: 320px;
  height: 100%;
  z-index: 1;
  opacity: 0.1;
  background-image: url(https://puu.sh/rE78K/33424202f7.svg);
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
.ticket_logo {
  background: #fff;
  border-radius: 20px 20px 0 0;
}

.ticket_logo img.airasia {
  margin: -10px;
  text-align: center;
  width: 45%;
}
.ticket_heading h2 {
  padding-top: 20px;
  text-align: center;
}
.ticket_thumbnail {
  min-height: 150px;
  margin-top: 10px;
}
.ticket_thumbnail img {
  width: 100%;
  height: auto;
}
.ticket_trip {
  text-align: center;
  width: 85%;
  margin: 30px auto;
  display: flex;
  height: 90px;
}
.ticket_trip div {
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.ticket_trip div h1 {
  margin: 0px;
}
.ticket_trip div h2 {
  margin: 0px;
  letter-spacing: 2px;
}
.ticket_trip div.trip_from {
  text-align: left;
  width: 35%;
}
.ticket_trip div.trip_from h2 {
  padding-left: 2px;
}
.ticket_trip div.trip_icon {
  width: 30%;
}
.ticket_trip div.trip_icon img {
  padding-top: 20px;
  opacity: 1;
  width: 25px;
}
.ticket_trip div.trip_to {
  text-align: left;
  width: 60%;
  padding-left: 15px;
}
.ticket_trip div.trip_to h2 {
  padding-left: 0px;
}
.ticket_trip div.trip_to h3 {
  padding-left: 0px;
}
.ticket_departure {
  margin: -20px auto 32px;
}
.ticket_departure div {
  color: #ccc;
}
.ticket_divider {
  position: relative;
  width: 100%;
}
.ticket_divider .divider_left {
  left: -15px;
}
.ticket_divider .divider_hole {
  position: absolute;
  top: -12px;
  padding: 0px;
  height: 25px;
  width: 25px;
  border-radius: 100%;
  background: #ffffff;
}
.ticket_divider .divider {
  width: 85%;
  margin: auto;
  height: 2px;
  background: linear-gradient(to right, #d7e4ed 50%, transparent 50%);
  background-size: 10px 8px, 100% 2px;
  opacity: 0.2;
}
.ticket_divider .divider_right {
  right: -15px;
}
.ticket_flight_details h2 {
  font-size: 0.7em;
}
.ticket_flight_details .ticket_seating {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.ticket_flight_details .ticket_seating div {
  display: inline-block;
  width: 50%;
}
.ticket_flight_details .ticket_seating div.seating_passenger {
  text-align: left;
}
.ticket_flight_details .ticket_seating div.seating_passenger_dos {
  text-align: left;
  padding-left: 32px;
}
.ticket_flight_details .ticket_seating div.seating_seat {
  text-align: right;
}
.ticket_flight_details .ticket_details {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.ticket_flight_details .ticket_details div {
  display: inline-block;
  width: 33%;
}
.ticket_flight_details .ticket_details div.details_flight {
  text-align: left;
}
.ticket_flight_details .ticket_details div.details_date {
  text-align: center;
}
.ticket_flight_details .ticket_details div.details_time {
  text-align: right;
}
.ticket_flight_details .ticket_details_continued {
  width: 85%;
  margin: 30px auto;
  display: flex;
  padding-bottom: 30px;
}
.ticket_flight_details .ticket_details_continued div {
  display: inline-block;
  width: 33%;
}
.ticket_flight_details .ticket_details_continued div.details_flight {
  text-align: left;
}
.ticket_flight_details .ticket_details_continued div.details_date {
  text-align: center;
}
.ticket_flight_details .ticket_details_continued div.details_time {
  text-align: right;
}
.ticket .ticket_seating {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.ticket .ticket_seating div {
  display: inline-block;
  width: 50%;
}
.ticket .ticket_seating div.seating_passenger {
  text-align: left;
}
.ticket .ticket_seating div.seating_passenger_dos {
  text-align: left;
  padding-left: 32px;
}
.ticket .ticket_seating div.seating_seat {
  text-align: right;
}
.ticket .ticket_details {
  width: 85%;
  margin: 30px auto;
  display: flex;
}
.ticket .ticket_details div {
  display: inline-block;
  width: 33%;
}
.ticket .ticket_details div.details_flight {
  text-align: left;
}
.ticket .ticket_details div.details_date {
  text-align: center;
}
.ticket .ticket_details div.details_time {
  text-align: right;
}
.ticket .ticket_details_continued {
  width: 85%;
  margin: 30px auto;
  display: flex;
  padding-bottom: 30px;
}
.ticket .ticket_details_continued div {
  display: inline-block;
  width: 33%;
}
.ticket .ticket_details_continued div.details_flight {
  text-align: left;
}
.ticket .ticket_details_continued div.details_date {
  text-align: center;
}
.ticket .ticket_details_continued div.details_time {
  text-align: right;
}

.aa-theme {
  background: #961a14;
}
.aa-theme .ticket_logo {
  border-top: 5px solid #da251d;
}
</style>







<div class="container-fluid" style="background-color:#ffffff;font-family: helvetica, arial;
  text-transform: uppercase;
  box-sizing: border-box;">
  
  
  
<div class="tickets_wrapper">
		
    
	<div class="ticket aa-theme">
        <div class="ticket_heading">
					<div class="ticket_logo">
						<img style="margin-top:5px;margin-bottom:5px" src="https://static.budi.my.id/assets/foodtour/logo.jpg" class="airasia">
					</div>
					<!-- img src="https://static.budi.my.id/assets/foodtour/8c.jpg" / -->
                    <div style="height:50px;"></div>
					<div class="ticket_divider">
            			<div class="divider_left divider_hole">
            			</div>
            			<div class="divider">
            			</div>
            			<div class="divider_right divider_hole">
            			</div>
        			</div>
					<h2>VERTIKAL TRIP TICKET</h2>
        </div>
        <div class="ticket_trip">
            <div class="trip_from">
				<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->margin(0)->size(500)->generate('https://www.vertikaltrip.com/ticket/'. $rev_books->ticket)) !!} ">
            </div>
            
            <div class="trip_to">
                <h2>Booking Ref</h2>
                <h3>{{ $rev_books->ticket }}</h3>
                <h3>&nbsp;</h3>
                <h2>STATUS</h2>
                <h3>
                @if($rev_books->status==1)
                {{ 'PENDING' }}
                @else
                {{ 'CONFIRMED' }}
                @endif
                </h3>
            </div>
			
        </div>
        <div class="ticket_divider">
            <div class="divider_left divider_hole">
            </div>
            <div class="divider">
            </div>
            <div class="divider_right divider_hole">
            </div>
        </div>
        <div class="ticket_seating">
            <div class="seating_passenger">
                <h2>PRODUCT</h2>
                <h3>{{$blog_posts->title }}</h3>
            </div>
            
            <div class="seating_seat">
                <h2>LEAD TRAVELLER</h2>
                <h3>{!! str_ireplace(" / ","<br>",$rev_books->name) !!}</h3>
            </div>
        </div>
        <div class="ticket_details">
            <div class="details_flight">
                <h2>FOR</h2>
                <h3>{{ $rev_books->traveller }} ADULTS</h3>
            </div>
            <div class="details_date">
                <h2>DATE</h2>
                <h3>{{ Carbon\Carbon::parse($rev_books->date)->formatLocalized('%b %d, %y') }}</h3>
            </div>
            <div class="details_time">
                <h2>TIME</h2>
                <h3>{{ Carbon\Carbon::parse($rev_books->date)->formatLocalized('%I:%M %p') }}</h3>
            </div>
        </div>
    </div>
</div>

</div>

@endsection