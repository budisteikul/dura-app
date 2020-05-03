		
        @if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <span style="font-size:13px; color:#FFFFFF">TOURS</span>
        </button>
        @else
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <span style="font-size:13px; color:#FFFFFF">DESTINATION</span>
        </button>
        @endif
        
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
                @php
                	$contents = \App\Classes\Rev\BokunClass::get_product_list();
                @endphp
                @foreach($contents as $content)
                <li class="nav-item">
					<a class="nav-link menu-hover" href="/tours/{{ $content->id }}">{{ $content->title }}</a>
				</li>
               @endforeach
			</ul>
		</div>
      