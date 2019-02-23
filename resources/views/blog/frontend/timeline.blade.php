@inject('blog', 'App\Classes\Blog\BlogClass')
@extends('layouts.frontend')
@section('title', $setting->title)
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="/js/ratnawahyu.js"></script>
<link href="/css/ratnawahyu.css" rel="stylesheet">
<style>
#mainNav {
  	border-color: rgba(34,34,34,.05);
    font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif;
    background-color:#000000;
    -webkit-transition: all .35s;
    -moz-transition: all .35s;
    transition: all .35s;
}

.navbar-toggler {
  padding: 0.25rem 0.75rem;
  font-size: 1.25rem;
  line-height: 1;
  background-color: transparent;
  border: 2px solid transparent;
  border-radius: 0.25rem;
}

.navbar-toggler:hover, .navbar-toggler:focus {
  text-decoration: none !important;
  outline: none;
  box-shadow: none;
}


.navbar-toggler-icon {
  display: inline-block;
  width: 1.5em;
  height: 1.5em;
  vertical-align: middle;
  content: "";
  background: no-repeat center center;
  background-size: 100% 100%;
}

#mainNav .navbar-brand {
  font-family: 'Kaushan Script', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
  font-weight: 700;
  color: #ccd0d5;
  text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
  filter: alpha(opacity=60);
}

#mainNav .navbar-brand.active, #mainNav .navbar-brand:active, #mainNav .navbar-brand:focus, #mainNav .navbar-brand:hover {
  color: #FFFFFF;
}

#mainNav .navbar-nav .nav-item .nav-link {
  	text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    color: #dce5ec;
}

#mainNav .navbar-nav .nav-item .nav-link.active, #mainNav .navbar-nav .nav-item .nav-link:hover {
  color: #FFFFFF;
}

@media(min-width:768px) {
  #mainNav {
    padding-top: 25px;
    padding-bottom: 25px;
    -webkit-transition: padding-top 0.3s, padding-bottom 0.3s;
    transition: padding-top 0.3s, padding-bottom 0.3s;
    border: none;
    background-color: transparent;
  }
  #mainNav .navbar-brand {
    font-size: 1.75em;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
  }
  #mainNav .navbar-nav .nav-item .nav-link {
    padding: 1.1em 1em !important;
  }
  #mainNav.navbar-shrink {
    padding-top: 0;
    padding-bottom: 0;
    background-color: #212529;
  }
  #mainNav.navbar-shrink .navbar-brand {
    font-size: 1.25em;
    padding: 12px 0;
  }
  
}
  .timeline-heading .timeline-footer {
	font-size:14px;
	}
.timeline-footer {
	font-size:14px;
	}
	
	.tldate {
 	 display: block;
 	 width: 150px;
 	 background: #e9f0f5;
 	 color: #becad2;
 	 margin: 0 auto;
 	 padding: 3px 0;
 	 text-align: center;
 	 font-size: 1.1em;
}

.timeline > li > .timeline-badge > span.timeline-day {
    font-size: 1.3em;
	color:#FFFFFF;
}

.timeline > li > .timeline-badge > span.timeline-month {
    font-size: .6em;
    position: relative;
    top: -17px;
	color:#FFFFFF;
}
</style>
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
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Food Tours</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Itinerary</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">The Tour Guide</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Booking</a>
          </li>
          {!! Auth::check() ? '
          <li class="nav-item">
          	<a class="nav-link js-scroll-trigger" href="#" onClick="window.location=\'/blog/post\'"><i class="fa fa-user"></i> Admin</a>
          </li>' : '' !!}
          
        </ul>
      </div>
    </div>
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
								<img id="{{ $attachment->id }}" onClick="return openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}','{{ $setting->user_id }}')" class="image-photo" src="{{ asset('/storage/'. $setting->user_id .'/images/250/'. $attachment->file_name) }}" alt=""  />
								
						<?php	
						}
						else
						{
						?>
                        		<img id="{{ $attachment->id }}" onClick="return openFancyBox('{{ $result->id }}','{{ $index }}','{{ $attachment->id }}','{{ $setting->user_id }}')" class="image-photo" src="{{ asset('/storage/'.$setting->user_id.'/images/500/'. $attachment->file_name) }}" alt=""  />
								
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
		
function openFancyBox(id,index,animated_id,user_id)
{
		$('#'+ animated_id).addClass('infinite animated bounceIn');
		$.ajax({
            type: 'GET',
            url: '/',
			data: {
        		"post_id": id,
				"user_id": user_id,
				"request": 'fancybox'
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
	return false;
}

(function($) {
				
	 	photogrid();
      	var $container = $('.timeline');
      	$container.infinitescroll({
        navSelector  : '.halaman',    		
      	nextSelector : '.halaman a:first',  
        itemSelector : '.test',     		
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
})(jQuery);

</script>
@endsection