		@if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="foodtours.xyz")
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/27270">Jogja Food Tours</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/26778">Tokyo Food Tours</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/27272">Paris Food Tours</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/27271">Trinidad Food Tours</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/27273">Cancun Food Tours</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/27274">India Food Tours</a>
				</li>
            </ul>
		</div>
        @elseif(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/25671">Jogja Car Rentals</a>
				</li>
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/20041">Jogja Experiences</a>
				</li>
            </ul>
		</div>
        @else
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
                @php
                	$contents = \App\Classes\Rev\BokunClass::get_product_list();
                @endphp
                @foreach($contents as $content)
                <li class="nav-item">
					<a class="nav-link menu-hover" href="https://foodtours.xyz/tours/{{ $content->id }}">{{ $content->title }}</a>
				</li>
               @endforeach
			</ul>
		</div>
        @endif