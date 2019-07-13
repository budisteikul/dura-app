@extends('layouts.index')
@section('title', $act_name .' | '. $app_name)
@section('google_analytics', $google_analytics)
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="https://static.budi.my.id/js/ratnawahyu.js"></script>
<link href="https://static.budi.my.id/css/ratnawahyu.css" rel="stylesheet">

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d1810cb22d70e36c2a3697f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script language="javascript">

function BOOKING()
{
	//$('#submit').prop('disabled', true);
	//$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	
	if($('#name').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The name field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#name').focus();
				
			});
		return false;	
	}
	
	if($('#email').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The email field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#email').focus();
				
			});
		return false;
	}
	
	if($('#phone').val()=="")
	{
		swal({
  			title: "Warning",
  			text: "The phone field is required",
  			icon: "warning",
  			dangerMode: true,
			}).then((value) => {
  				$('#phone').focus();
				
			});
		return false;	
	}
	
	$.ajax({
			data: {
        		"_token": '{{ csrf_token() }}',
				'name': $('#name').val(),
				'country': $('#country').val(),
				'os0': $('#os0').val(),
				'phone': $('#phone').val(),
				'email': $('#email').val(),
				'date': $('#date').val(),
				'post_id': $('#post_id').val(),
        	},
			type: 'POST',
			url: '/book'
			}).done(function( data ) {
			if(data.id=="1")
			{
				
			}
			else
			{
				return false;	
			}
		});
}
</script>

@endpush
    
<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">Yogyakarta Food Tour</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span> <span style="font-size:16px">Menu</span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive" >
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#about">About The Tour</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#guide">Our Tour Guide</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#booking">Book Now</a>
				</li>
			</ul>
		</div>
    </div>
  </nav>

<header id="page-top" class="intro-header" style="background-image: url('https://static.budi.my.id/assets/foodtour/tugu-dark.jpg'); background-color: #B0B0B0">
	<div class="col-lg-8 col-md-10 mx-auto">
		<div class="site-heading text-center">
			<div class="transbox" style=" min-height:100px; padding-top:20px; padding-bottom:5px; padding-left:10px; padding-right:10px;">
            	<img src="https://static.budi.my.id/assets/foodtour/logo-jogja-istimewa-png-4.png" width="250">
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
                
				<h1 id="title" style="text-shadow: 2px 2px #555555;">{{ $act_name }}</h1>
				<p class="text-faded">
					
                    Book for tonight? It's Ok!
         			<br>
         			Because we can start the tour every day at 6.30 pm.
         			
		 			And our meeting point is Tugu Yogyakarta Monument.
                    
				</p>
			</div>
            <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
		</div>
    </div>
</header>

 <!-- Post Content -->
<article id="about">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:0px;">About The Tour</h3>
					<h4 class="section-subheading text-muted">{{ $act_name }}</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			
			<p>
				<br>
				<div>
					<strong>Name :</strong> {{ $act_name }}<br />
					<strong>Duration :</strong> 3 hours start at 6.30 pm<br />
					<strong>Type :</strong> Open Trip<br />
					<strong>Language :</strong> Offered in English<br />
					<strong>Meeting point :</strong> Tugu Yogyakarta Monument<br />	
					Gowongan, Jetis, Yogyakarta 55233<br />	
					<strong>Price :</strong><br />
					{!! $price !!}
				</div>
			
				<h2 class="section-heading">Highlights</h2>
				- If you like food and want to experience Jogja culture <br />
				- The walking tour part was a good introduction to the city <br />
				- Travel on a becak (Traditional Public Transportation) <br />
				- Learn interesting fun facts about Yogyakarta <br />
				- Enjoying the nighttime atmosphere of Yogyakarta <br />
			
				<h2 class="section-heading">Overview</h2>
				Yogyakarta’s Imaginary Line is an imaginary straight line drawn from the southern beach Parang Kusumo with Mount Merapi. Journey through a part of the city's imaginary line, from Tugu Yogyakarta Monument to Southern City Square. Join us on this experience to try authentic Javanese dishes, play traditional games, travel on a becak, learn interesting fun facts about city, interact with locals and many more.
			</p>

			<p>
				<h2 class="section-heading">Inclusions</h2>
				- Local Guide (English Speaking) <span class="fa fa-user"></span><br>
				- Mineral water 600 ml <span class="fa fa-coffee"></span><br />
				- Fee of all activities at Alun - Alun Kidul (masangin, paddle car, etc) <span class="fa fa-ticket"></span><br />
				- Becak (Yogyakarta traditional rickshaw) <span class="fa fa-car"></span><br />
				- Raincoat, if it's rain <span class="fa fa-briefcase"></span><br />
				- Many types of Javanese authentic snack, food and drink <span class="fa fa-cutlery"></span><br />
			</p>
          
			<p>
				<h2 class="section-heading">What to bring</h2>
				- Please be hungry, because a lot of food is to be tried out during this tour.<br />
				- Wear comfortable and relax clothing.<br />
				- And don't forget to bring your camera to take some nice pictures.<br />
			</p>
          
			<center>
				<br>
				<img class="img-fluid" src="https://static.budi.my.id/assets/foodtour/garis-imajiner.jpg">
				<span class="caption text-muted">Yogyakarta’s Imaginary Line</span>
				<br>
			</center>
          
			<p>
				<b>Tugu Yogyakarta Monument - Southern City Square</b><br />
				From our meeting point Tugu Yogyakarta Monument, we go to the south through a part of the Yogyakarta's imaginary line ( Malioboro Road, Nirboyo Gate, Yogyakarta Palace, East Fortess Corner etc). Along the journey, we will enjoying the nighttime atmosphere of Yogyakarta and discover a variety of activities and food until we reach the Southern City Square ( Alun - Alun Kidul ).
			</p>
			
		</div>
    </div>
</div>
</article> 

<section id="guide" style="background-color:#f7f8f9">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row">
				<div class="col-lg-12 text-center">
				<h3 class="section-heading" style="margin-top:50px;">Tour Guide On Duty</h3>
				<h4 class="section-subheading text-muted">{{ $act_name }}</h4>
				<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
			<br>
			<div class="d-flex flex-wrap justify-content-center">
				<div class="team-member" style="margin-bottom:5px; margin-left:30px; margin-right:30px;">
					<img class="mx-auto rounded-circle" width="200" src="https://static.budi.my.id/assets/foodtour/tour-guide.jpg" >
					<h4>Kalika</h4>
					<p class="text-muted">Hi! My name is Kalika, I was born and still live in Jogja. I am a very adventurous person, I like music, movies, travelling and starting adventures with new friend</p>
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<section id="gallery" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">Gallery</h3>
					<h4 class="section-subheading text-muted">{{ $act_name }}</h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row text-center" style="padding-bottom:0px;">
					
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Becak | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/becak.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Alun - alun kidul | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/paddle-car.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/masangin.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/customer2.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Customer | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/customer3.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
				<div class="col-lg-4 col-sm-6">
					<img class="img-fluid rounded" alt="Small Groups | {{ $act_name }}" src="https://static.budi.my.id/assets/foodtour/small-groups.jpg">
					<br />
					<span class="caption text-muted"></span>
					<div class="mb-4"></div>
				</div>
        
			</div>
		</div>
	</div>
</div>
</section>

<section id="booking" style="background-color:#f7f8f9">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
					<h3 class="section-heading" style="margin-top:50px;">Instant Booking</h3>
					<h4 class="section-subheading text-muted">Secure payment by <img src="https://static.budi.my.id/assets/foodtour/logo-paypal.jpg"></h4>
					<hr style="max-width:50px;border-color:#e2433b;border-width:3px;">
				</div>
			</div>
        
			<!-- ############################################################################### -->
			<div class="form-group">
				<h2 class="section-heading">Lead Traveller Contact</h2>
			</div>
			<div class="form-group">
				<label for="name"><strong>Full name :</strong></label>
				<input type="text" id="name" name="name" class="form-control" placeholder="Full name">
			</div>
			<div class="form-group">
				<label for="name"><strong>Email :</strong></label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="name"><strong>Phone :</strong></label>
				<div class="form-row">
					<div class="col-4">
						<select class="form-control" id="country" name="country">
							<option data-countryCode="DZ" value="213">Algeria (+213)</option>
							<option data-countryCode="AD" value="376">Andorra (+376)</option>
							<option data-countryCode="AO" value="244">Angola (+244)</option>
							<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
							<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
							<option data-countryCode="AR" value="54">Argentina (+54)</option>
							<option data-countryCode="AM" value="374">Armenia (+374)</option>
							<option data-countryCode="AW" value="297">Aruba (+297)</option>
							<option data-countryCode="AU" value="61">Australia (+61)</option>
							<option data-countryCode="AT" value="43">Austria (+43)</option>
							<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
							<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
							<option data-countryCode="BH" value="973">Bahrain (+973)</option>
							<option data-countryCode="BD" value="880">Bangladesh (+880)</option>
							<option data-countryCode="BB" value="1246">Barbados (+1246)</option>
							<option data-countryCode="BY" value="375">Belarus (+375)</option>
							<option data-countryCode="BE" value="32">Belgium (+32)</option>
							<option data-countryCode="BZ" value="501">Belize (+501)</option>
							<option data-countryCode="BJ" value="229">Benin (+229)</option>
							<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
							<option data-countryCode="BT" value="975">Bhutan (+975)</option>
							<option data-countryCode="BO" value="591">Bolivia (+591)</option>
							<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
							<option data-countryCode="BW" value="267">Botswana (+267)</option>
							<option data-countryCode="BR" value="55">Brazil (+55)</option>
							<option data-countryCode="BN" value="673">Brunei (+673)</option>
							<option data-countryCode="BG" value="359">Bulgaria (+359)</option>
							<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
							<option data-countryCode="BI" value="257">Burundi (+257)</option>
							<option data-countryCode="KH" value="855">Cambodia (+855)</option>
							<option data-countryCode="CM" value="237">Cameroon (+237)</option>
							<option data-countryCode="CA" value="1">Canada (+1)</option>
							<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
							<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
							<option data-countryCode="CF" value="236">Central African Republic (+236)</option>
							<option data-countryCode="CL" value="56">Chile (+56)</option>
							<option data-countryCode="CN" value="86">China (+86)</option>
							<option data-countryCode="CO" value="57">Colombia (+57)</option>
							<option data-countryCode="KM" value="269">Comoros (+269)</option>
							<option data-countryCode="CG" value="242">Congo (+242)</option>
							<option data-countryCode="CK" value="682">Cook Islands (+682)</option>
							<option data-countryCode="CR" value="506">Costa Rica (+506)</option>
							<option data-countryCode="HR" value="385">Croatia (+385)</option>
							<option data-countryCode="CU" value="53">Cuba (+53)</option>
							<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
							<option data-countryCode="CY" value="357">Cyprus South (+357)</option>
							<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
							<option data-countryCode="DK" value="45">Denmark (+45)</option>
							<option data-countryCode="DJ" value="253">Djibouti (+253)</option>
							<option data-countryCode="DM" value="1809">Dominica (+1809)</option>
							<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
							<option data-countryCode="EC" value="593">Ecuador (+593)</option>
							<option data-countryCode="EG" value="20">Egypt (+20)</option>
							<option data-countryCode="SV" value="503">El Salvador (+503)</option>
							<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
							<option data-countryCode="ER" value="291">Eritrea (+291)</option>
							<option data-countryCode="EE" value="372">Estonia (+372)</option>
							<option data-countryCode="ET" value="251">Ethiopia (+251)</option>
							<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
							<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
							<option data-countryCode="FJ" value="679">Fiji (+679)</option>
							<option data-countryCode="FI" value="358">Finland (+358)</option>
							<option data-countryCode="FR" value="33">France (+33)</option>
							<option data-countryCode="GF" value="594">French Guiana (+594)</option>
							<option data-countryCode="PF" value="689">French Polynesia (+689)</option>
							<option data-countryCode="GA" value="241">Gabon (+241)</option>
							<option data-countryCode="GM" value="220">Gambia (+220)</option>
							<option data-countryCode="GE" value="7880">Georgia (+7880)</option>
							<option data-countryCode="DE" value="49">Germany (+49)</option>
							<option data-countryCode="GH" value="233">Ghana (+233)</option>
							<option data-countryCode="GI" value="350">Gibraltar (+350)</option>
							<option data-countryCode="GR" value="30">Greece (+30)</option>
							<option data-countryCode="GL" value="299">Greenland (+299)</option>
							<option data-countryCode="GD" value="1473">Grenada (+1473)</option>
							<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
							<option data-countryCode="GU" value="671">Guam (+671)</option>
							<option data-countryCode="GT" value="502">Guatemala (+502)</option>
							<option data-countryCode="GN" value="224">Guinea (+224)</option>
							<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
							<option data-countryCode="GY" value="592">Guyana (+592)</option>
							<option data-countryCode="HT" value="509">Haiti (+509)</option>
							<option data-countryCode="HN" value="504">Honduras (+504)</option>
							<option data-countryCode="HK" value="852">Hong Kong (+852)</option>
							<option data-countryCode="HU" value="36">Hungary (+36)</option>
							<option data-countryCode="IS" value="354">Iceland (+354)</option>
							<option data-countryCode="IN" value="91">India (+91)</option>
							<option data-countryCode="ID" value="62">Indonesia (+62)</option>
							<option data-countryCode="IR" value="98">Iran (+98)</option>
							<option data-countryCode="IQ" value="964">Iraq (+964)</option>
							<option data-countryCode="IE" value="353">Ireland (+353)</option>
							<option data-countryCode="IL" value="972">Israel (+972)</option>
							<option data-countryCode="IT" value="39">Italy (+39)</option>
							<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
							<option data-countryCode="JP" value="81">Japan (+81)</option>
							<option data-countryCode="JO" value="962">Jordan (+962)</option>
							<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
							<option data-countryCode="KE" value="254">Kenya (+254)</option>
							<option data-countryCode="KI" value="686">Kiribati (+686)</option>
							<option data-countryCode="KP" value="850">Korea North (+850)</option>
							<option data-countryCode="KR" value="82">Korea South (+82)</option>
							<option data-countryCode="KW" value="965">Kuwait (+965)</option>
							<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
							<option data-countryCode="LA" value="856">Laos (+856)</option>
							<option data-countryCode="LV" value="371">Latvia (+371)</option>
							<option data-countryCode="LB" value="961">Lebanon (+961)</option>
							<option data-countryCode="LS" value="266">Lesotho (+266)</option>
							<option data-countryCode="LR" value="231">Liberia (+231)</option>
							<option data-countryCode="LY" value="218">Libya (+218)</option>
							<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
							<option data-countryCode="LT" value="370">Lithuania (+370)</option>
							<option data-countryCode="LU" value="352">Luxembourg (+352)</option>
							<option data-countryCode="MO" value="853">Macao (+853)</option>
							<option data-countryCode="MK" value="389">Macedonia (+389)</option>
							<option data-countryCode="MG" value="261">Madagascar (+261)</option>
							<option data-countryCode="MW" value="265">Malawi (+265)</option>
							<option data-countryCode="MY" value="60">Malaysia (+60)</option>
							<option data-countryCode="MV" value="960">Maldives (+960)</option>
							<option data-countryCode="ML" value="223">Mali (+223)</option>
							<option data-countryCode="MT" value="356">Malta (+356)</option>
							<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
							<option data-countryCode="MQ" value="596">Martinique (+596)</option>
							<option data-countryCode="MR" value="222">Mauritania (+222)</option>
							<option data-countryCode="YT" value="269">Mayotte (+269)</option>
							<option data-countryCode="MX" value="52">Mexico (+52)</option>
							<option data-countryCode="FM" value="691">Micronesia (+691)</option>
							<option data-countryCode="MD" value="373">Moldova (+373)</option>
							<option data-countryCode="MC" value="377">Monaco (+377)</option>
							<option data-countryCode="MN" value="976">Mongolia (+976)</option>
							<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
							<option data-countryCode="MA" value="212">Morocco (+212)</option>
							<option data-countryCode="MZ" value="258">Mozambique (+258)</option>
							<option data-countryCode="MN" value="95">Myanmar (+95)</option>
							<option data-countryCode="NA" value="264">Namibia (+264)</option>
							<option data-countryCode="NR" value="674">Nauru (+674)</option>
							<option data-countryCode="NP" value="977">Nepal (+977)</option>
							<option data-countryCode="NL" value="31">Netherlands (+31)</option>
							<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
							<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
							<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
							<option data-countryCode="NE" value="227">Niger (+227)</option>
							<option data-countryCode="NG" value="234">Nigeria (+234)</option>
							<option data-countryCode="NU" value="683">Niue (+683)</option>
							<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
							<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
							<option data-countryCode="NO" value="47">Norway (+47)</option>
							<option data-countryCode="OM" value="968">Oman (+968)</option>
							<option data-countryCode="PW" value="680">Palau (+680)</option>
							<option data-countryCode="PA" value="507">Panama (+507)</option>
							<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
							<option data-countryCode="PY" value="595">Paraguay (+595)</option>
							<option data-countryCode="PE" value="51">Peru (+51)</option>
							<option data-countryCode="PH" value="63">Philippines (+63)</option>
							<option data-countryCode="PL" value="48">Poland (+48)</option>
							<option data-countryCode="PT" value="351">Portugal (+351)</option>
							<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
							<option data-countryCode="QA" value="974">Qatar (+974)</option>
							<option data-countryCode="RE" value="262">Reunion (+262)</option>
							<option data-countryCode="RO" value="40">Romania (+40)</option>
							<option data-countryCode="RU" value="7">Russia (+7)</option>
							<option data-countryCode="RW" value="250">Rwanda (+250)</option>
							<option data-countryCode="SM" value="378">San Marino (+378)</option>
							<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
							<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
							<option data-countryCode="SN" value="221">Senegal (+221)</option>
							<option data-countryCode="CS" value="381">Serbia (+381)</option>
							<option data-countryCode="SC" value="248">Seychelles (+248)</option>
							<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
							<option data-countryCode="SG" value="65">Singapore (+65)</option>
							<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
							<option data-countryCode="SI" value="386">Slovenia (+386)</option>
							<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
							<option data-countryCode="SO" value="252">Somalia (+252)</option>
							<option data-countryCode="ZA" value="27">South Africa (+27)</option>
							<option data-countryCode="ES" value="34">Spain (+34)</option>
							<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
							<option data-countryCode="SH" value="290">St. Helena (+290)</option>
							<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
							<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
							<option data-countryCode="SD" value="249">Sudan (+249)</option>
							<option data-countryCode="SR" value="597">Suriname (+597)</option>
							<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
							<option data-countryCode="SE" value="46">Sweden (+46)</option>
							<option data-countryCode="CH" value="41">Switzerland (+41)</option>
							<option data-countryCode="SI" value="963">Syria (+963)</option>
							<option data-countryCode="TW" value="886">Taiwan (+886)</option>
							<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
							<option data-countryCode="TH" value="66">Thailand (+66)</option>
							<option data-countryCode="TG" value="228">Togo (+228)</option>
							<option data-countryCode="TO" value="676">Tonga (+676)</option>
							<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
							<option data-countryCode="TN" value="216">Tunisia (+216)</option>
							<option data-countryCode="TR" value="90">Turkey (+90)</option>
							<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
							<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
							<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
							<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
							<option data-countryCode="UG" value="256">Uganda (+256)</option>
							<option data-countryCode="GB" value="44">UK (+44)</option>
							<option data-countryCode="UA" value="380">Ukraine (+380)</option>
							<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
							<option data-countryCode="UY" value="598">Uruguay (+598)</option>
							<option data-countryCode="US" value="1" selected>USA (+1)</option>
							<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
							<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
							<option data-countryCode="VA" value="379">Vatican City (+379)</option>
							<option data-countryCode="VE" value="58">Venezuela (+58)</option>
							<option data-countryCode="VN" value="84">Vietnam (+84)</option>
							<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
							<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
							<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
							<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
							<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
							<option data-countryCode="ZM" value="260">Zambia (+260)</option>
						</select>
					</div>
					<div class="col">
						<input type="text" class="form-control" placeholder="Phone" id="phone">
					</div>
				</div>
			</div>
			<div class="form-group">
				<h2 class="section-heading">Select Date and Travelers</h2>
			</div>
			<div class="form-group">   
				<label for="datetimepicker1"><strong>Date :</strong></label>           
                <div class='input-group' id='datetimepicker1'>
					<input type="text" id="date" name="date" value="" class="form-control bg-white" readonly>
                    <div class="input-group-append input-group-addon text-muted">
						<div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <small class="form-text text-muted">Date format YYYY-MM-DD</small>
				<script type="text/javascript">
				<?php
				$defaultTimes = '18:30:00';
				$defaultDates = date('Y-m-d') .' 00:00:00';
			
			
				while(in_array($defaultDates, $disabledDates))
				{
					$defaultDates = date('Y-m-d 00:00:00',strtotime($defaultDates . "+1 days"));
				}
			
			
				?>
			$(function () {
                $('#date').datetimepicker({
					minDate:'<?= $defaultDates ?>',
					disabledDates: [<?= "'" . implode("','", $disabledDates) . "'" ?>],
					format: 'YYYY-MM-DD <?= $defaultTimes ?>',
					showTodayButton: true,
					showClose: true,
					ignoreReadonly: true,
					defaultDate: '<?= $defaultDates ?>'
				});
            });
				</script>    
			</div>
			
			<input id="post_id" type="hidden" name="post_id" value="{{ $post_id }}">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onSubmit="return BOOKING();">
			<input type="hidden" name="cmd" value="_s-xclick">
			<table>
				<tr><td>
				{!! $price !!}
				<br>
				<input type="hidden" name="on0" value="Number of travelers"><strong>Number of travelers :</strong>
				</td></tr>
				<tr><td>
				<select name="os0" class="form-control" id="os0">
				{!! $option_button !!}
				</select>
				</td></tr>
			</table>

			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="hosted_button_id" value="{!! $hosted_button_id !!}">
			<br />
			<button id="submit" type="submit" class="btn btn-danger"><i class="fa fa-ticket"></i> Book Now</button>	
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			<br />
			<small class="form-text text-muted">After payment received, we will contact you immediately</small>
			</form>
			<div style="height:50px;"></div>
		</div>
    </div>
</div>
</section>



<section style="background-color:#ffffff">
<div class="container">
	<div style="height:50px;"></div>
    <div class="row">
		<div class="col-md-12 mx-auto">
			<div class="d-flex flex-wrap justify-content-center" style="padding-bottom:0px;">
				<div class="d-flex flex-wrap justify-content-left">
					<a href="/airbnb" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/airbnb-button.jpg" height="45" alt="Book {{ $act_name }} via AirBNB" style="margin-bottom:5px; margin-left:5px; margin-right:5px;"></a>
					<a href="/expedia" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/expedia-button.jpg" height="45" alt="Book {{ $act_name }} via Expedia" style="margin-bottom:5px; margin-left:5px; margin-right:5px;"></a>
					<a href="/tripadvisor" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/tripadvisor-button.jpg" height="45" alt="Book {{ $act_name }} via TripAdvisor" style="margin-bottom:5px; margin-left:5px; margin-right:5px;"></a>
					<a href="/viator" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/viator-button.jpg" height="45" alt="Book {{ $act_name }} via Viator" style="margin-bottom:5px; margin-left:5px; margin-right:5px;"></a>
					<a href="/tourhq" target="_blank"><img src="https://static.budi.my.id/assets/foodtour/tourhq-button.jpg" height="45" alt="Book {{ $act_name }} via Tour HQ" style="margin-bottom:5px; margin-left:5px; margin-right:5px;"></a>
				</div>
			</div>
			<div style="height:50px;"></div>
		</div>
	</div>
</div>
</section>

<footer class="py-5 bg-dark">
<div class="container">
    <div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<p class="m-0 text-center text-white">
				Vertikal Trip
				<br>
				<span class="fa fa-location-arrow"></span> Tugu Yogyakarta Monument<br />Gowongan, Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55233<br>
				Whatsapp : <a class="text-danger" href="https://wa.me/+6285743112112">+62 857-4311-2112</a> <br> <span class="fa fa-instagram"></span> <a class="text-danger" href="https://www.instagram.com/vertikaltrip" target="_blank">@vertikaltrip</a> | <span class="fa fa-facebook"></span> <a class="text-danger" href="https://www.facebook.com/vertikaltrip" target="_blank">Vertikal Trip</a><br />
				<span class="fa fa-envelope"></span> <a href="mailto:guide@vertikaltrip.com" class="text-danger" target="_blank">guide@vertikatrip.com</a><br />
				<br>
				<img src="https://static.budi.my.id/assets/foodtour/payment.png">
				<br><br>
			</p>
        </div>
    </div>
</div>
</footer>

<script>


(function($) {
        
  "use strict"; // Start of use strict
  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

 
  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 75
  });
 
  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  
  // Collapse now if page is not at top
  navbarCollapse();
  
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);
  
  
})(jQuery);
</script>
@endsection