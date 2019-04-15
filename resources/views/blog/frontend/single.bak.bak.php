@inject('blog', 'App\Classes\Blog\BlogClass')
@extends('layouts.timeline')
@section('title', 'Ratna Wahyu')
@section('content')
@push('scripts')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<script src="/js/ratnawahyu.js"></script>
<link href="/css/ratnawahyu.css" rel="stylesheet">
<style>
blockquote {
  font-style: italic;
  color: #868e96;
}

.section-heading {
  font-size: 30px;
  font-weight: 700;
  margin-top: 60px;
}

.caption {
  font-size: 14px;
  font-style: italic;
  display: block;
  margin: 0;
  padding: 10px;
  text-align: center;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
}

article{
	background-color:#FFFFFF;
	padding-top:50px;
	padding-bottom:50px;
	font-size:16px;
}

#title
{
	font-size:1.4em;
}

@media(min-width:768px) {
	#title
	{
		font-size:1.8em;
	}
}
</style>
@endpush
    
   <!-- ################################################################### -->
   <!-- Navigation -->
  <nav class="navbar navbar-default navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Ratna Wahyuningtyas</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="https://www.facebook.com/ratna.wahyu.54"><i class="fa fa-facebook-square"></i> Facebook</a>
          </li>
          
          <li class="nav-item">
          	<a class="nav-link" target="_blank" href="https://instagram.com/ratna_diknana"><i class="fa fa-instagram"></i> Instagram</a>
          </li>
          
          {!! Auth::check() ? '
          <li class="nav-item">
          	<a class="nav-link" href="/blog/photo"><i class="fa fa-user"></i> Admin</a>
          </li>' : '' !!}
          
        </ul>
      </div>
    </div>
  </nav>

<!-- ################################################################### -->
    <header id="page-top" class="intro-header" style="background-image: url('/storage/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/images/header/Yjep3WbsqDzzs41muHQHE3OgRZ7xs1JE9509psLk.jpeg'); background-color:#000000">
    	
        <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading text-center">
        	<div class="transbox" style=" min-height:285px; padding-top:35px; padding-bottom:35px; padding-left:10px; padding-right:10px;">
            	<img class="img-circle" src="storage/eca1ca75-9e80-493f-bfef-cbeb44f8aac3/images/gravatar/pp1.jpg">
				
                <hr style="max-width:50px;border-color: #c03b44;border-width: 3px;">
                <!-- h1 style="font-size:30px;">Terms and Cancellation Policy</h1 -->
				<h1 id="title">Terms and Cancellation Policy</h1>
				<p class="text-faded">
					Posted on August 24, 2019
				</p>
			</div>
             <i class="fa fa-angle-down infinite animated fadeInDown" style="font-size: 50px; color:#FFFFFF; margin-top:30px"></i>
       
       </div>
       </div>
    </header>
   
<!-- ################################################################### -->
 <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>

          <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.</p>

          <p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p>

          <p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p>

          <p>For those who have seen the Earth from space, and for the hundreds and perhaps thousands more who will, the experience most certainly changes your perspective. The things that we share in our world are far more valuable than those which divide us.</p>

          <h2 class="section-heading">The Final Frontier</h2>

          <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

          <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

          <blockquote class="blockquote">The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>

          <p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.</p>

          <h2 class="section-heading">Reaching for the Stars</h2>

          <p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man.</p>

          <a href="#">
            <img class="img-fluid" src="devel/post-sample-image.jpg" alt="">
          </a>
          <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>

          <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>

          <p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p>

          <p>Placeholder text by
            <a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by
            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>
        </div>
      </div>
    </div>
  </article>

<footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>
<a href="#page-top" class="cd-top js-scroll-trigger">Top</a>
<script>


(function($) {
        
		
	
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