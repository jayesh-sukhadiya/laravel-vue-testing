<!DOCTYPE html>
<html lang="en">
<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Just Call Services | Home</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/bundles/izitoast/css/iziToast.min.css') }}">
  <!-- Datepicker -->
  <link href="{{ asset('public/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.min.css') }}" rel='stylesheet' type='text/css'>
  @yield('css')
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/assets/img/favicon.png') }}" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
      <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
          <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link nav-link-lg fullscreen-btn"> <i data-feather="maximize"></i> 
            </a>
          </li>
          <li>
          </li>
        </ul>
      </div>
      <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i> </a>
          <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
            <div class="dropdown-header">Notifications
              <div class="float-right"> <a href="#">Mark All As Read</a></div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
              <a href="#" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-primary text-white"> <i class="fas fa-code"></i> </span>  <span class="dropdown-item-desc"> Template update is available now! <span class="time">2 Min Ago</span> </span>
              </a>
            </div>
            <div class="dropdown-footer text-center"> <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </li>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('public/assets/img/user.png') }}" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right pullDown">
            <div class="dropdown-title">Hello, {{ Auth::user()->use_full_name }}</div>
            <a href="{{ url('admin/user-profile') }}" class="dropdown-item has-icon"> <i class="fas fa-user"></i> Profile</a>
            <!-- <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings</a> -->
            <div class="dropdown-divider"></div> <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </div>
        </li>
      </ul>
    </nav>