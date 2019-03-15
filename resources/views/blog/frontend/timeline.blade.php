@inject('blog', 'App\Classes\Blog\BlogClass')
@extends('layouts.timeline')
@section('title', $setting->title)
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="/js/ratnawahyu.js"></script>
<link href="/css/ratnawahyu.css" rel="stylesheet">
@endpush
    
   <!-- ################################################################### -->
   <!-- Navigation -->
  <nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ $setting->title1 }}</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          
          {!! $setting->facebook!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->facebook .'"><i class="fa fa-facebook-square"></i> Facebook</a>
          </li>' : '' !!}
          
           {!! $setting->twitter!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->twitter .'"><i class="fa fa-twitter-square"></i> Twitter</a>
          </li>' : '' !!}
          
           {!! $setting->instagram!="" ? '
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="'. $setting->instagram .'"><i class="fa fa-instagram"></i> Instagram</a>
          </li>' : '' !!}
          
          {!! Auth::check() ? '
          <li class="nav-item">
          	<a class="nav-link" href="/blog/photo"><i class="fa fa-user"></i> Admin</a>
          </li>' : '' !!}
          
        </ul>
      </div>
    </div>
  </nav>
   
<!-- ################################################################### -->
	<header id="page-top" class="intro-header" style="background-image: url('{{ $setting->header }}'); background-color:#000000">
    	
        <div class="col-lg-8 col-md-10 mx-auto">
    	<div class="site-heading text-center">
        	<div class="transbox" style="min-height:285px; padding-top:35px; padding-bottom:35px; padding-left:10px; padding-right:10px;">
				<img class="img-circle" src="{{ $setting->gravatar }}">
				<hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<p class="text-faded">
					{!! nl2br($setting->description) !!}
				</p>
			</div>
             <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
       </div>
       </div>
    </header>
<!-- ################################################################### -->
 
 <section id="section"  style="background-color:#e9f0f5; max-width:1024px; margin:0 auto; height:100%;">
 	<ul class="timeline">
	<?php
	$i = 1;
	$date = "";
	?>
    @foreach($results as $result)
    	<?php
		
		$aaa = $result->date;
		$cek_date = DB::table('blog_posts')
					   ->where('date',function($query) use ($aaa){
						  		$query->select(DB::Raw(' min(date) '))->from('blog_posts')->where('date','>',$aaa);
						  })
					   ->where('user_id',$setting->user_id)
					   ->first();
		if(isset($cek_date->date)) $date = strtoupper(date("F",strtotime($cek_date->date)) ." ". date("Y",strtotime($cek_date->date)));
		
		$time=strtotime($result->date);
		$day=date("d",$time);
		$month=date("F",$time);
		$MONTH=date("M",$time);
		$year=date("Y",$time);
		
		$date2 = strtoupper($month ." ". $year);
		if(($date!=$date2))
		{
			$date = $date2;
			?>
			<li class="test"><div class="tldate"><?= $date ?></div></li>
			<?php	
		}
		
		$style = ' class="test"';
		if($i % 2 == 0) $style = ' class="timeline-inverted test"';
		?>
        <!-- ################################################################### -->
		<li<?= $style ?>>
        
			<div class="timeline-badge success">
				<span class="timeline-day">
                	<?= $day ?>
                </span>
				<span class="timeline-month">
                	<?= strtoupper($MONTH) ?>
                </span>
            </div>
            
			<div class="timeline-panel" style="background-color:#FFFFFF; margin-right:4px; margin-left:4px;">
				<div class="timeline-heading">
					<p class="text-muted text-left">
					<i class="fa fa-clock-o"></i> <?= $blog->timeAgo($result->date) ?>
					</p>
				</div>
                <?php
				if(count($result->attachments)){
				?>
                <!-- ################################################################### -->
				<div class="timeline-body">
                	<div id="loading" style="background: url(/img/output_DTGK2a.gif) no-repeat center;">
                    <div class="photoset-grid" style=" max-width:600px; visibility:hidden;" data-layout="{{$result->layout}}">
                    <?php
					$a = $result->layout;
					$b = str_split($a);
					$c = 0 ;
					$e = 0 ;
					$index = 0 ;
					?>
                    @foreach($result->attachments as $attachment)
                    	<?php
						$e++;
						$d = $b[$c];
						if($e==$d)
						{
							$c++;
							$e=0;
						}
						if($d>1)
						{
						?>
								<img id="{{ $attachment->id }}" onClick="openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}'); return false;" class="image-photo" src="{{ asset('/storage/'. $setting->user_id .'/images/250/'. $attachment->file_name) }}" alt=""  />
								
						<?php	
						}
						else
						{
						?>
                        		<img id="{{ $attachment->id }}" onClick="openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}'); return false;" class="image-photo" src="{{ asset('/storage/'.$setting->user_id.'/images/500/'. $attachment->file_name) }}" alt=""  />
								
                        <?php
						}
						$index++;
						?>
                    @endforeach
                    </div>
                    </div>
                    
                    @if(!empty($result->content))
                    <div class="timeline-footer">{{ $result->content }}</div>
                    @endif
                
                </div>
                <?php
				} else {
				?>
                <!-- ################################################################### -->
            
            	<div class="timeline-body">
                	<div id="loading" style="background: url(/img/output_DTGK2a.gif) no-repeat center;">
                    @if(!empty($result->content))
                    {!! $result->content !!}
                    @endif
                    </div>
                </div>	
            
            	<?php } ?>
            </div>
         </li>
         <?php
		 $i++;
		 ?>
	@endforeach
	</ul>
 </section>
<!-- footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; {{ $setting->title }} 2019</p>
    </div>
</footer --> 
<div class="pagination" style="background-color:#e9f0f5">
	<a href="{!! $results->nextPageUrl() !!}" style="visibility:hidden">Next</a>
</div> 
<a href="#page-top" class="cd-top js-scroll-trigger">Top</a>
<script>
function photogrid()
{
	$('.photoset-grid').photosetGrid({
		borderColor: '#FFFFFF',
		highresLinks: true,
		borderWidth: '2px',
		gutter: '2px',
		borderActive: true,
		onInit: function(){},
		onComplete: function(){
					
			$('.photoset-grid').css({
				'visibility': 'visible'
			});
		
		}
	});
}
		
function openFancyBox(id,index,animated_id)
{
		$('#'+ animated_id).addClass('infinite animated bounceIn');
		$.ajax({
            type: 'GET',
            url: '/',
			data: {
        		"post_id": id
        	},
            dataType: 'json',
            success: function (data) {
				$('#'+ animated_id).removeClass('infinite animated bounceIn');
                $.fancybox.open(data,
				{
					index: index,
					protect: true
				});
            }
        });
}


(function($) {
        
		photogrid();
		
      	var $container = $('.timeline');
      	$container.infinitescroll({
        	navSelector  : '.pagination',    		
      		nextSelector : '.pagination a:first',  
        	itemSelector : '.test',     		
			debug: false,
			path: function (pagenum) {
				var test = pagenum + ( {{ $results->currentPage() }} - 1 );
  				return '/?page=' + test;
			},		
        	loading: {
          		finishedMsg: "You've reached the end of time",
          		img: '/img/output_DTGK2a.gif',
		  		msgText: "Loading..."
         	 }
        	},
        function( newElements ) {
		  $('.timeline').infinitescroll('pause');
		  $('.image-photo').attr('height','50');
		  $('.image-photo').attr('width','50');
		  $('.photoset-grid').imagesLoaded()
  		  .done( function( instance, image ) {
				 photogrid();
     			 $('.image-photo').removeAttr('height');
				 $('.image-photo').removeAttr('width');
				 $('.timeline').infinitescroll('resume');
				 $("#loading").removeAttr("style")
			 })
         }
       );
	  
	
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