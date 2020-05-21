
@if(env('BOKUN_NAVBAR')=='')
	@php
	$product_lists = \App\Classes\Rev\BokunClass::get_product_list();
	@endphp
    @foreach($product_lists as $product_list)
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
				<div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $product_list->title }}</h3>
                    <h4 class="section-subheading text-muted">{{ $product_list->description }}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
        		<div class="row">
                	@php
					$contents = \App\Classes\Rev\BokunClass::get_product_list_byid($product_list->id);
        			@endphp
                    @foreach($contents->items as $content)
        			<div class="col-lg-4 col-md-6 mb-4">
                    	@php
                        if(isset($content->activity->slug))
                        {
                        	$link = '/tour/'. $content->activity->slug;
                        }
                        else
                        {
                        	$link = '/tour?activityId='. $content->activity->id;
                        }
                        @endphp
						<div class="card h-100 shadow card-block rounded">
						@if(isset($content->activity->keyPhoto->fileName))
                        	<div class="container-book">
							<a href="{!! $link !!}" class="text-decoration-none"><img class="card-img-top image-book" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}"></a>
                            <div class="middle-book">
    							<a href="{!! $link !!}" class="btn btn-theme btn-md p-3" style="border-radius:0;">BOOK NOW</a>
  							</div>
                            </div>
						@endif	
							<div class="card-header bg-white border-0 text-left pb-0">
								<h3 class="mb-4"><a href="{!! $link !!}" class="text-dark text-decoration-none">{{ $content->activity->title }}</a></h3>
							</div>
							@if($content->activity->excerpt!="")
							<div class="card-body pt-0">
								<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
							</div>
							@endif
							<div class="card-body pt-0">
								<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
							</div>
							<div class="card-footer bg-white pt-0" style="border:none">
								<div class="d-flex align-items-end mb-2">
									<div class="p-0 ml-0">
										<div class="text-left">
                                    		<span class="text-muted">Price from</span>
                                    	</div>
                                    	<div>
                                    		<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    	</div>
                                    </div>
  									<div class="ml-auto p-0">
                                    	<a href="{!! $link !!}" class="btn btn-theme btn-md"><i class="fas fa-info-circle"></i> More info</a>
                                    </div>
								</div>
							</div>
  								
						</div>
    				</div>
					@endforeach
				</div>
				<div style="height:45px;"></div>		
				</div>
			</div>
		</div>
	</div>
</div>
</section>
    @endforeach
@else
<!-- ===================================================================================== -->
@php
	$product_lists = \App\Classes\Rev\BokunClass::get_product_list_byid(env('BOKUN_NAVBAR'));
@endphp
@if(count($product_lists->children))
@foreach($product_lists->children as $product_list)
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
				<div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $product_list->title }}</h3>
                    <h4 class="section-subheading text-muted">{{ $product_list->description }}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
        		<div class="row">
                	@php
					$contents = \App\Classes\Rev\BokunClass::get_product_list_byid($product_list->id);
        			@endphp
                    @foreach($contents->items as $content)
        			<div class="col-lg-4 col-md-6 mb-4">
                    	@php
                        if(isset($content->activity->slug))
                        {
                        	$link = '/tour/'. $content->activity->slug;
                        }
                        else
                        {
                        	$link = '/tour?activityId='. $content->activity->id;
                        }
                        @endphp
						<div class="card h-100 shadow card-block rounded">
						@if(isset($content->activity->keyPhoto->fileName))
                            <div class="container-book">
							<a href="{!! $link !!}" class="text-decoration-none"><img class="card-img-top image-book" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}"></a>
                            <div class="middle-book">
    							<a href="{!! $link !!}" class="btn btn-theme btn-md p-3" style="border-radius:0;">BOOK NOW</a>
  							</div>
                            </div>
						@endif	
							<div class="card-header bg-white border-0 text-left pb-0">
								<h3 class="mb-4"><a href="{!! $link !!}" class="text-dark text-decoration-none">{{ $content->activity->title }}</a></h3>
							</div>
							@if($content->activity->excerpt!="")
							<div class="card-body pt-0">
								<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
							</div>
							@endif
							<div class="card-body pt-0">
								<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
							</div>
							<div class="card-footer bg-white pt-0" style="border:none">
								<div class="d-flex align-items-end mb-2">
									<div class="p-0 ml-0">
										<div class="text-left">
                                    		<span class="text-muted">Price from</span>
                                    	</div>
                                    	<div>
                                    		<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    	</div>
                                    </div>
  									<div class="ml-auto p-0">
                                    	<a href="{!! $link !!}" class="btn btn-theme btn-md"><i class="fas fa-info-circle"></i> More info</a>
                                    </div>
								</div>
							</div>
  								
						</div>
    				</div>
					@endforeach
				</div>
				<div style="height:45px;"></div>		
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endforeach
@else
<section id="tour" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
            <div class="row" style="padding-bottom:0px;">
                <div class="col-lg-12 text-center">
				<div style="height:70px;"></div>
                    <h3 class="section-heading" style="margin-top:0px;">{{ $product_lists->title }}</h3>
                    <h4 class="section-subheading text-muted">{{ $product_lists->description }}</h4>
                    <hr class="hr-theme">
                    <div style="height:30px;"></div>
                </div>
            </div>
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-center">
        		<div class="row">
                    @foreach($product_lists->items as $content)
        			<div class="col-lg-4 col-md-6 mb-4">
                    	@php
                        if(isset($content->activity->slug))
                        {
                        	$link = '/tour/'. $content->activity->slug;
                        }
                        else
                        {
                        	$link = '/tour?activityId='. $content->activity->id;
                        }
                        @endphp
						<div class="card h-100 shadow card-block rounded container-book">
						@if(isset($content->activity->keyPhoto->fileName))
							<div class="container-book">
							<a href="{!! $link !!}" class="text-decoration-none"><img class="card-img-top image-book" src="https://bokunprod.imgix.net/{{ $content->activity->keyPhoto->fileName }}?w=300&h=150&fit=crop&crop=faces" alt="{{ $content->activity->title }}"></a>
                            <div class="middle-book">
    							<a href="{!! $link !!}" class="btn btn-theme btn-md p-3" style="border-radius:0;">BOOK NOW</a>
  							</div>
                            </div>
						@endif	
							<div class="card-header bg-white border-0 text-left pb-0">
								<h3 class="mb-4"><a href="{!! $link !!}" class="text-dark text-decoration-none">{{ $content->activity->title }}</a></h3>
							</div>
							@if($content->activity->excerpt!="")
							<div class="card-body pt-0">
								<p class="card-text text-left">{!!$content->activity->excerpt!!}</p>
							</div>
							@endif
							<div class="card-body pt-0">
								<p class="card-text text-left text-muted"><i class="far fa-clock"></i> Duration : {{ $content->activity->durationText }}</p>
							</div>
							<div class="card-footer bg-white pt-0" style="border:none">
								<div class="d-flex align-items-end mb-2">
									<div class="p-0 ml-0">
										<div class="text-left">
                                    		<span class="text-muted">Price from</span>
                                    	</div>
                                    	<div>
                                    		<b style="font-size: 24px;">${{$content->activity->nextDefaultPrice}}</b>
                                    	</div>
                                    </div>
  									<div class="ml-auto p-0">
                                    	<a href="{!! $link !!}" class="btn btn-theme btn-md"><i class="fas fa-info-circle"></i> More info</a>
                                    </div>
								</div>
							</div>
  								
						</div>
    				</div>
					@endforeach
				</div>
				<div style="height:45px;"></div>		
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endif
<!-- ===================================================================================== -->
@endif