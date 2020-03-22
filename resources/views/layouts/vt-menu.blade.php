		<div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/">Home</a>
				</li>
                @php
                	$contents = \App\Classes\Rev\BokunClass::get_product_list();
                @endphp
                @foreach($contents as $content)
                <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="/tours/{{ $content->id }}">{{ $content->title }}</a>
				</li>
               @endforeach
			</ul>
		</div>