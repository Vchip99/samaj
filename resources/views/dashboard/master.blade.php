<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="{{ asset('css/bootstrap.min.css?ver=1.0')}}" rel="stylesheet">
  <link href="{{ asset('css/font-awesome/css/font-awesome.min.css?ver=1.0')}}" rel="stylesheet"/>
  <link href="{{ asset('css/sidemenu/sidemenu_layout.css?ver=1.0')}}" rel="stylesheet"/>
  <link href="{{ asset('css/sidemenu/_all-skins.css?ver=1.0')}}" rel="stylesheet"/>
  <link href="{{ asset('css/jquery-confirm.min.css?ver=1.0')}}" rel="stylesheet"/>

  <script src="{{ asset('js/jquery.min.js?ver=1.0')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js?ver=1.0')}}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery-confirm.min.js?ver=1.0')}}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>
  <style type="text/css">
  .admin_table{
    padding-top: 10px;
    background-color: #01bafd;
  }
  .admin_div{
    padding: 10px;
    background-color: #01bafd;
  }
  </style>
  @yield('dashboard_header')
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <header class="main-header">
    <a href="" class="logo">
      <span class="logo-mini"><b> V</b>EDU</span>
      <span class="logo-lg"><b>Vchip</b>Technology</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
        <a href="">
          <img src="{{ asset('images/user1.png')}}" class="img-circle" alt="User Image">
        </a>
        </div>
        <div class="pull-left info">
          @php
            $adminUser = Auth::guard('admin')->user();
          @endphp
          <p>{{ucfirst($adminUser->name)}}</p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">Admin</li>
          <li class="treeview ">
            <a href="#" title="Student Admission">
              <i class="fa fa-dashboard"></i> <span>Student Admission</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li title="Admission Form"><a href="{{ url('admin/create-student-admission')}}"><i class="fa fa-circle-o"></i>Admission Form</a></li>
              <li title="Admission Receipt"><a href="{{ url('admin/create-admission-receipt')}}"><i class="fa fa-circle-o"></i>Admission Receipt</a></li>
              <li title="Sub Course Details"><a href="{{ url('admin/manage-course-receipt')}}"><i class="fa fa-circle-o"></i>Sub Course Details</a></li>
              <li title="Course Payment"><a href="{{ url('admin/manage-course-payment')}}"><i class="fa fa-circle-o"></i>Course Payment</a></li>
              <li title="Enquiries"><a href="{{ url('admin/enquiries')}}"><i class="fa fa-circle-o"></i>Enquiries</a></li>
            </ul>
          </li>
        <li class="header">LABELS</li>
        <li>
          <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
            <i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout {{ucfirst($adminUser->name)}}</span>
            <span class="pull-right-container"></span>
          </a>
          <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    @yield('module_title')
    <div class="content">
      <div class="row">
        @yield('admin_content')
      </div>
    </div>
  </div>
<script type="text/javascript">
  $(document).ready(function(){
        setTimeout(function() {
          $('.alert-success').fadeOut('fast');
        }, 10000); // <-- time in milliseconds
    });
</script>
</body>
</html>
