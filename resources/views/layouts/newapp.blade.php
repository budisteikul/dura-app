<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ str_ireplace("www.","",$_SERVER['HTTP_HOST']) }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet" type="text/css">
	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('scripts')
</head>
<body>
@guest

@else
<style>
#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
</style>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading mb-2 bg-white">
      	<div class="justify-content-center text-center">
        	
      			<img src="{{ asset(Auth::user()->picture_url) }}" width="100" class="rounded-circle mb-2 mt-2" alt="User Image">
                <br>
                <strong>{{ Auth::user()->name }}</strong>
                <br>
                {{ Auth::user()->email }}
                <br>
                <small>
                  	Member since {{ Carbon\Carbon::parse(Auth::user()->created_at)->formatLocalized('%b. %Y') }}
                  </small>
                <br>
                
        		<div class="btn-group mr-2 mb-2 mt-2" role="group">
                <button id="btn-edit" type="button" class="btn-sm btn-light"><i class="fa fa-edit"></i> Edit profile</button>
                <button id="btn-del" type="button" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn-sm btn-light"><i class="fa fa-sign-out-alt"></i> Log out</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                </div>
                
                <br>
                
        </div>
      </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light"><i class="far fa-arrow-alt-circle-right"></i> Tour</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><i class="far fa-arrow-alt-circle-right"></i> Financial Statements</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><i class="far fa-arrow-alt-circle-right"></i> Gallery</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"><i class="far fa-arrow-alt-circle-right"></i> Mail</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
 @endguest
<!-- ################################################################################ -->
    <div id="app">
    	
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
            	@guest
                @else
                <button style="outline:none;" class="navbar-toggler border-white shadow-none" type="button" id="menu-toggle" ><i id="tombol" class="far fa-arrow-alt-circle-right"></i></button>
                @endguest
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ str_ireplace("www.","",$_SERVER['HTTP_HOST']) }}
                </a>
                <button style="outline:none;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
			
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        	<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-list"></i> Tour <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/rev/book"><i class="far fa-circle"></i> {{ __('Booking') }}</a>
									<a class="dropdown-item" href="/rev/experiences"><i class="far fa-circle"></i> {{ __('Experiences') }}</a>
									<a class="dropdown-item" href="/rev/review"><i class="far fa-circle"></i> {{ __('Review') }}</a>
                                    <a class="dropdown-item" href="/rev/resellers"><i class="far fa-circle"></i> {{ __('Channel') }}</a>
                                </div>
                            </li>
							
							
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-list"></i> Financial Statements <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/fin/profitloss"><i class="far fa-circle"></i> {{ __('Profit & Loss') }}</a>
                                    
                                    <a class="dropdown-item" href="/fin/transactions"><i class="far fa-circle"></i> {{ __('Transactions') }}</a>
                                    
                                    <a class="dropdown-item" href="/fin/categories"><i class="far fa-circle"></i> {{ __('Categories') }}</a>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/mails"><i class="fa fa-envelope"></i> {{ __('Mails') }}</a>
                            </li>
                            
                        	<li class="nav-item">
                                <a class="nav-link" href="/blog/photo"><i class="fa fa-image"></i> {{ __('Galleries') }}</a>
                            </li>
                            
                            
                            
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
         <div class="container-fluid">
            @yield('content')
         </div>
        </main>
	</div>
<!-- ################################################################################ -->    
@guest

@else
  </div>
  <!-- /#wrapper -->

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
	  if($('#wrapper').hasClass('toggled'))
	  {
		  $('#tombol').attr('class', 'far fa-arrow-alt-circle-left');
	  }
	  else
	  {
		  $('#tombol').attr('class', 'far fa-arrow-alt-circle-right');
	  }
	  
    });
	
  </script>   
@endguest    
    
</body>
</html>
