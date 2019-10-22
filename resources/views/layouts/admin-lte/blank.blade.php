@inject('User', 'App\User')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
  	@if(View::hasSection('title'))
        {{ config('app.name', 'Laravel') }} &raquo; @yield('title')
    @else
		{{ config('app.name', 'Laravel') }}
    @endif
    </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{asset('js/mail.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/mail.css')}}">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script>
  function adjustCollapseView(){
    var desktopView = $(document).width();
    if(desktopView >= "768"){
        $("#sidebar-toggle").attr("data-toggle","");
		$("#sidebar-toggle").attr("style","visibility:hidden;");
        //$("#sidebar-toggle .collapse").addClass("in").css("height","auto")
    }else{
        $("#sidebar-toggle").attr("data-toggle","push-menu");
		$("#sidebar-toggle").attr("style","visibility:visible;");
        //$("#sidebar-toggle .collapse").removeClass("in").css("height","0")
        //$("#sidebar-toggle .collapse:first").addClass("in").css("height","auto")
    }
}

$(function(){
    adjustCollapseView();
    $(window).on("resize", function(){
        adjustCollapseView();
    });
});
  </script>
  @stack('scripts')
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="/" class="logo">
      <!-- span class="logo-mini"><b>{{ config('app.name', 'Laravel') }}</b></span -->
      <span class="logo-lg"><b>{{ config('app.name', 'Laravel') }}</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" id="sidebar-toggle" class="sidebar-toggle" data-toggle="push-menu" role="button" style="visibility:hidden;">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <li class="dropdown messages-menu">
            <a href="{{ route('rev_book.index') }}" class="dropdown-toggle">
              <i class="fa fa-ticket"></i>
			</a>
          </li>
          <li class="dropdown messages-menu">
            <a href="{{ route('mails.index') }}" class="dropdown-toggle">
              <i class="fa fa-envelope-o"></i>
             
              {!! \App\Classes\Mail\MailClass::get_unread('inbox') > 0 ? '<span class="label label-success">'. \App\Classes\Mail\MailClass::get_unread("inbox") .'</span>' : '' !!}
              
            </a>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset(Auth::user()->picture_url) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset(Auth::user()->picture_url) }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  <small>
                  	Member since {{ Carbon\Carbon::parse(Auth::user()->created_at)->formatLocalized('%b. %Y') }}
                  </small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <button type="button" onClick="window.location='{{ url('profiles/'.  Auth::user()->id) }}'" class="btn btn-default btn-flat">Edit Profile</button>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset(Auth::user()->picture_url) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <i class="fa fa-envelope-o"></i><span style="font-size:12px;"> {{ Auth::user()->email }}</span>
        </div>
      </div>
      <hr style="border-color: #f2f2f2; margin-top:0px;">
      @if(request()->is('mails*'))
		  @include('layouts.admin-lte.mail-menu')
	  @else
		
		<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="{{ request()->is('*hris/departments*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Departemen</a></li>
        <li class="treeview 
        {{ request()->is('*hris/employees*') ? 'active menu-open' : '' }}
		{{ request()->is('*hris/positions*') ? 'active menu-open' : '' }}
        {{ request()->is('*hris/contracts*') ? 'active menu-open' : '' }}
        {{ request()->is('*hris/families*') ? 'active menu-open' : '' }}
        {{ request()->is('*hris/departments*') ? 'active menu-open' : '' }}
        ">
          <a href="#">
            <i class="fa fa-user"></i> <span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->is('*hris/departments*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Departemen</a></li>
			<li class="{{ request()->is('*hris/positions*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Jabatan</a></li>
            <li class="{{ request()->is('*hris/employees*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Karyawan</a></li>
            <li class="{{ request()->is('*hris/families*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Keluarga karyawan</a></li>
            <li class="{{ request()->is('*hris/contracts*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Kontrak</a></li>
          </ul>
        </li>
        
        
      </ul>
	  @endif
    </section>
  </aside>
		@yield('content')
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <strong>Copyright &copy; 2019 <a href="/">{{ config('app.name', 'Laravel') }}</a>.</strong> All rights reserved.
  </footer>
</div>
</body>
</html>