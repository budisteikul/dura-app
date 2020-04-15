@extends('layouts.frontend')
@section('title','TERMS AND CONDITIONS')
@section('content')

<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')

<section id="booking" style="background-color:#ffffff">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 mx-auto">
			<div class="row" style="padding-bottom:0px;">
				<div class="col-lg-12 text-left">
					<div style="height:70px;"></div>
           			<div class="card mb-8 shadow p-2">
                     	<div class="card-body" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:15px;">
                 			<div class="text-right">
		   		
				 			</div>
				 			<!-- ##### -->
							<div class="row" style="padding-bottom:0px;">
								<div class="col-lg-12 text-center">
									<h3 class="section-heading">{{ $blog_posts->title }}</h3>
									<hr style="max-width:50px;border-color:#1D57C7;border-width:3px;">
									<h4 class="section-subheading text-muted">
									{{ $blog_posts->description }}
									</h4>
								</div>
							</div>
					
                 			<!-- ##### -->
                 			<div class="row col-md-8  mx-auto text-left">
								<div class="textwidget" style=" min-height:250px;">
                                <div style="height:50px;"></div>
					 			<!-- ##### content ############################################################## -->
					  			{!! $blog_posts->content !!}
					 			<!-- ##### content ############################################################## -->
                                <div style="height:50px;"></div>
								</div>
							</div>
                 			<!-- ##### --> 
						</div>
					</div>
					<div style="height:40px;"></div>		
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection