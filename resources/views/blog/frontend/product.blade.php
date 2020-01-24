@extends('layouts.frontend')
@section('content')
@section('title',$title)
@include('layouts.loading')
@push('scripts')
{!! $jscript !!}
@endpush



<!-- ################################################################### -->

<!-- Navigation -->
<nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top shadow mb-5" id="mainNav-back">
	<div class="container">

		<a href="/"><img src="/logo.png" alt="VERTIKAL TRIP LLC" height="50"  style="margin-top:2px;margin-bottom:2px;"></a>
		
		
		@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="budi.my.id" || str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")


		<button class="navbar-toggler navbar-toggler-right  border-dark" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Indonesia <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/jogja-food-tour/">Yogyakarta</a>
                 </div>
                </li>
            	
            	<li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Japan <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/ninja-food-tours/">Shinjuku</a>
                 </div>
                </li>
            	
                <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  France <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/original-food-tours-paris/">Paris</a>
                                  <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/original-food-tours-paris/">Bordeaux</a>
                                   <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/original-food-tours-paris/">Lyon</a>
                                    <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/original-food-tours-paris/">Nice</a>
                 </div>
                </li>
               
                
				 <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Mexico <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/cancun-food-tours/">Cancun</a>
                 </div>
                </li>
				
			
				
				 <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  Trinidad and Tobago <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/trinidad-food-tours/">Trinidad</a>
                 </div>
                </li>

                 <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  India <span class="caret"></span>
                </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/india-food-tours/">Agra</a>
                        <a class="nav-link js-scroll-trigger text-dark ml-2" href="/product-list/india-food-tours/">Delhi</a>
                 </div>
                </li>

				

				
			</ul>
		</div>

		<!-- button class="navbar-toggler navbar-toggler-right border-dark" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-search text-white"></span>
		</button>
		
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<div class="form-group has-search text-uppercase ml-auto">
				<input type="text" style="margin-top:15px;" class="form-control" placeholder="Search">
			</div>
		</div -->
		
		
		@else

        <!-- button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            	<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/indonesia/"><i class="fa fa-map-marker-alt"></i>  Indonesia</a>
				</li>
                
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/japan/"><i class="fa fa-map-marker-alt"></i> Japan</a>
				</li>
                
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/france/"><i class="fa fa-map-marker-alt"></i> France</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/mexico/"><i class="fa fa-map-marker-alt"></i> Mexico</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/trinidad/"><i class="fa fa-map-marker-alt"></i> Trinidad</a>
				</li>


				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tour/india/"><i class="fa fa-map-marker-alt"></i> India</a>
				</li>

				
			</ul>
		</div -->
        
        @endif

	</div>
</nav>

<div style="height:25px;"></div>


@if($product_page)
<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row">
  	
    <div class="col-sm-8 col-sm-auto">
    	<div style="height:66px;"></div>
      		{!! $product !!}
    </div>
    <div class="col-sm-4">
    	<div style="height:64px;"></div>
    	<div class="card mb-4 shadow p-2">
  			<div class="card-header text-white" style="background-color: #2c97de;"><h5>Book Now</h5></div>
 				 <div class="card-body" style="padding-left:0px;padding-right:0px;padding-top:5px;padding-bottom:15px;">
    				{!! $calendar !!}
  				</div>
			</div>
     		
        <div style="height:35px;"></div>
    </div>
    
  </div>
</div>
</section>

@else
<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
				<div style="height:70px;"></div>	
           
				{!! $product !!}
				
					
				<div style="height:10px;"></div>		
				</div>
			</div>
        </div>
	</div>
</div>
</section>


@endif

@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="budi.my.id" || str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
<section id="booking" style="background-color:#ffffff">
<div class="container">
  <div class="row" style="padding-bottom:0px;">
				<div class="col-lg-8 text-center mx-auto">
					<!-- h3 class="section-heading" style="margin-top:50px;">TOUR OPERATOR</h3 -->
                    
       
					<!-- hr style="max-width:50px;border-color:#e2433b;border-width:3px;" -->
				</div>
  </div>

  <div class="row">
  	
    <div class="col-sm-4 col-sm-auto  mb-4">
    	<a href="/product-list/ninja-food-tours/">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/ninja-food.png" alt="Ninja Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto  mb-4">
    	<a href="/product-list/original-food-tours-paris">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/original-food-tours____.jpg" alt="Original Food Tours">
			</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto  mb-4">
    		<a href="/product-list/cancun-food-tours">
			<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/cancun-food-tours.png" alt="Cancun Food Tours">
			</div>
			</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/india-food-tours">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/india-food-tours.jpg" alt="India Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/trinidad-food-tours">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/trinidad.jpg" alt="Trinidad Food Tours">
		</div>
		</a>
    </div>

    <div class="col-sm-4 col-sm-auto mb-4">
    	<a href="/product-list/jogja-food-tour">
    	<div class="card mb-4 shadow p-4 card-block d-table-cell align-middle" style="height:200px;">
  				 <img class="card-img-top" src="/assets/foodtour/supplier/jogja.png" alt="Jogja Food Tour">
		</div>
		</a>
    </div>

   
    
  </div>
  
</div>

</section>
@endif

@endsection