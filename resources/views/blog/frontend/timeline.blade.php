@extends('layouts.frontend')
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
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="/">{{ $setting->title1 }}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					{!! $setting->facebook!="" ? '<li><a target="_blank" href="'. $setting->facebook .'"><i class="fa fa-facebook-square"></i> Facebook</a></li>' : '' !!}
                    {!! $setting->twitter!="" ? '<li><a target="_blank" href="'. $setting->twitter .'"><i class="fa fa-twitter-square"></i> Twitter</a></li>' : '' !!}
                    {!! $setting->instagram!="" ? '<li><a target="_blank" href="'. $setting->instagram .'"><i class="fa fa-instagram"></i> Instagram</a></li>' : '' !!}
                    {!! Auth::check() ? '<li><a href="/blog/post"><i class="fa fa-user"></i> Admin</a></li>' : '<li><a href="/auth/login"><i class="fa fa-user"></i> Login</a></li>' !!}
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
   
<!-- ################################################################### -->
	<header class="intro-header" style="background-image: url('{{ $setting->header }}'); background-color:#000000">
    	<div class="site-heading">
        	<div class="transbox">
				<img class="img-circle" src="{{ $setting->gravatar }}" style="margin-top:15px">
				<hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
				<p class="text-faded mb-5" style="margin-left:10px; margin-right:10px; margin-bottom:20px; padding:5px; ">
					{!! nl2br($setting->description) !!}
				</p>
			</div>
             <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
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
					<i class="fa fa-clock-o"></i> <?= App\Classes\Blog\BlogClass::timeAgo($result->date) ?>
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
								<img id="{{ $attachment->id }}" onClick="return openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}')" class="image-photo" src="{{ asset('/storage/images/'. $setting->user_id .'/250/'. $attachment->file_name) }}" alt=""  />
								
						<?php	
						}
						else
						{
						?>
                        		<img id="{{ $attachment->id }}" onClick="return openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}')" class="image-photo" src="{{ asset('/storage/images/'.$setting->user_id.'/500/'. $attachment->file_name) }}" alt=""  />
								
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
<div class="halaman" style="background-color:#e9f0f5">
	<a href="{!! $results->nextPageUrl() !!}" style="visibility:hidden">Next</a>
</div> 
<a href="#0" class="cd-top">Top</a>
    <!-- ################################################################### -->
  	
    <script type="text/javascript">
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
		
	</script>
    
    
		
<script>
function openFancyBox(id,index,animated_id)
{
		$('#'+ animated_id).addClass('infinite animated pulse');
		$.ajax({
            type: 'GET',
            url: '/',
			data: {
        		"post_id": id,
				"user_id": '{{ $setting->user_id }}',
				"request": 'fancybox'
        	},
            dataType: 'json',
            success: function (data) {
				$('#'+ animated_id).removeClass('infinite animated pulse');
                $.fancybox.open(data,
				{
					index: index,
					protect: true
				});
            }
        });
	return false;
}

(function($) {
	 photogrid();
      	var $container = $('.timeline');
      	$container.infinitescroll({
        navSelector  : '.halaman',    		// selector for the paged navigation
      	nextSelector : '.halaman a:first',  // selector for the NEXT link (to page 2)
        itemSelector : '.test',     		// selector for all items you'll retrieve
		debug: true,
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
	  
	$('#mainNav').affix({
	offset: {
		top: 100
	}
	})
	 
	
		
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

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 56
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

  

})(jQuery); // End of use strict
</script>
@endsection