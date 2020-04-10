
<style>
.cardWrap {
  width: 27em;
  margin: 0px auto;
  color: #fff;
  font-family: sans-serif;
}

.card {
  background: linear-gradient(to bottom, #3989c6 0%, #3989c6 26%, #ecedef 26%, #ecedef 100%);
  height: 11em;
  float: left;
  position: relative;
  padding: 1em;
  margin-top: 100px;
}

.cardLeft {
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
  width: 16em;
}

.cardRight {
  width: 6.5em;
  border-left: 0.18em dashed #fff;
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
}
.cardRight:before, .cardRight:after {
  content: "";
  position: absolute;
  display: block;
  width: 0.9em;
  height: 0.9em;
  background: #fff;
  border-radius: 50%;
  left: -0.5em;
}
.cardRight:before {
  top: -0.4em;
}
.cardRight:after {
  bottom: -0.4em;
}

h1 {
  font-size: 1.1em;
  margin-top: 0;
}
h1 span {
  font-weight: normal;
}

.title,
.name,
.seat,
.time {
  text-transform: uppercase;
  font-weight: normal;
}
.title h2,
.name h2,
.seat h2,
.time h2 {
  font-size: 0.9em;
  color: #525252;
  margin: 0;
}
.title span,
.name span,
.seat span,
.time span {
  font-size: 0.7em;
  color: #a2aeae;
}

.title {
  margin: 1.4em 0 0 0;
}

.name,
.seat {
  margin: 0.8em 0 0 0;
}

.time {
  margin: 0.7em 0 0 1em;
}

.seat,
.time {
  float: left;
}

.eye {
  position: relative;
  width: 2em;
  height: 1.5em;
  background: #fff;
  margin: 0 auto;
  border-radius: 1em/0.6em;
  z-index: 1;
}
.eye:before, .eye:after {
  content: "";
  display: block;
  position: absolute;
  border-radius: 50%;
}
.eye:before {
  width: 1em;
  height: 1em;
  background: #e84c3d;
  z-index: 2;
  left: 8px;
  top: 4px;
}
.eye:after {
  width: 0.5em;
  height: 0.5em;
  background: #fff;
  z-index: 3;
  left: 12px;
  top: 8px;
}

.number {
  text-align: center;
  text-transform: uppercase;
}
.number h3 {
  color: #e84c3d;
  margin: 0.6em 0 0 0;
  font-size: 2.5em;
}
.number span {
  display: block;
  color: #a2aeae;
}

</style>


<div class="cardWrap">

  <div class="card cardLeft">
    <div style="min-height:30px;">
    	<h1><span style="font-size:12px">{{ $rev_shoppingcart_products->title }}</span></h1>
    </div>
    <div class="title">
      <img src="{{ $rev_shoppingcart_products->image }}" height="50">
    </div>
    <div class="name">
      <h2 style="font-size:12px">{{ $rev_shoppingcart_products->date }}</h2>
      <span style="font-size:10px">date</span>
    </div>
    <div class="name">
      <h2 style="font-size:12px">
      <?php
	  	$rev_shoppingcarts = $rev_shoppingcart_products->shoppingcarts()->first();
	  ?>
      {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer }}
                        {{ $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer }} 
      </h2>
      <span style="font-size:10px">name</span>
    </div>
    <!-- div class="seat">
      <h2>156</h2>
      <span>seat</span>
    </div>
    <div class="time">
      <h2>12:00</h2>
      <span>time</span>
    </div -->
    
  </div>
  <div class="card cardRight">
    <div><center><img src="/assets/logo/logo.png" height="30"></center></div>
    <div class="number">
      <h3>{!! QrCode::size(100)->generate('https://www.vertikaltrip.com/booking/ticket/'.$rev_shoppingcart_products->id ); !!}</h3>
    </div>
    <div style="color:#000000; margin-top:7px; font-size:12px;"><center>{{ $rev_shoppingcart_products->productConfirmationCode }}</center></div>
  </div>
  
  

</div>
