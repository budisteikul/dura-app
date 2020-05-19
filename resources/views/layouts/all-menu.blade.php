		
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <span style="font-size:13px; color:#FFFFFF">TOURS</span>
        </button>
       
        
        <div class="collapse navbar-collapse stroke" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
            @php
            	$contents = \App\Classes\Rev\BokunClass::get_product_list_byid(env('BOKUN_NAVBAR'));
            @endphp
                
            @if(count($contents->children))
                @foreach($contents->children as $line1)
                    @if(!empty($line1->children))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ $line1->title }} <span class="caret"></span>
                             </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach($line1->children as $line2)
                                 <a class="dropdown-item" href="/tours/{{ Str::slug($line2->title) }}/{{ $line2->id }}">{{ $line2->title }}</a>
                            @endforeach
                             </div>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link menu-hover" href="/tours/{{ Str::slug($line1->title) }}/{{ $line1->id }}">{{ $line1->title }}</a>
                        </li>
                    @endif
               @endforeach
			@else
               
               <li class="nav-item">
               	<a class="nav-link menu-hover" href="/tours/{{ Str::slug($contents->title) }}/{{ $contents->id }}">{{ $contents->title }}</a>
               </li>
               
           @endif

                            
			</ul>
		</div>
      