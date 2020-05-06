		
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
                @if(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="vertikaltrip.com")
                @php
                    $contents = \App\Classes\Rev\BokunClass::get_product_list_byid(27645);
                @endphp
                @elseif(str_ireplace("www.","",$_SERVER['HTTP_HOST'])=="foodtours.xyz")
                @php
                    $contents = \App\Classes\Rev\BokunClass::get_product_list_byid(27673);
                @endphp
                @else
                @php
                    $contents = \App\Classes\Rev\BokunClass::get_product_list_byid(27770);
                @endphp
                @endif
                @foreach($contents->children as $line1)
                    @if(!empty($line1->children))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ $line1->title }} <span class="caret"></span>
                             </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach($line1->children as $line2)
                                 <a class="dropdown-item" href="/tours/{{ $line2->id }}">{{ $line2->title }}</a>
                            @endforeach
                             </div>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link menu-hover" href="/tours/{{ $line1->id }}">{{ $line1->title }}</a>
                        </li>
                    @endif
               @endforeach


                            
			</ul>
		</div>
      