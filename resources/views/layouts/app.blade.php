<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Maheshwari Samaj') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="{{ asset('js/jquery.min.js?ver=1.0')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js?ver=1.0')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
    <style>
        .home{
            margin-top: 60px;
        }
        a{
            color:black;
            text-decoration: none;
        }
        .dashboard{
            background-color: white;
            border-bottom: 1px solid black;
            color:black;
            padding-left: 20px;
        }
        .profpic{
            margin-top: 10px;
            border-bottom: 1px solid black;
        }
        /*img{
          width: 230px;
          height:160px;
        }*/
        .image{
            height:180px;
            width:180px;
        }
        .family_top{
            background-color: white;
            border-bottom: 1px solid black;
            color:black;
            padding-left: 20px;
        }
        .member1{

            width: 78%;
            display:block;
            margin:auto;
            margin-top: 10px;
        }
        @media only screen and (max-width: 610px){
            .col-1{width: 100%;}
            .member1{width:230px;}
        }
        @media only screen and (max-width: 580px){
            .col-2{width: 100%;}
        }

        @media (max-width: 1190px) {
          .navbar-header {
              float: none;
          }
          .navbar-left,.navbar-right {
              float: none !important;
          }
          .navbar-toggle {
              display: block;
          }
          .navbar-collapse {
              border-top: 1px solid transparent;
              box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
          }
          .navbar-fixed-top {
              top: 0;
              border-width: 0 0 1px;
          }
          .navbar-collapse.collapse {
              display: none!important;
          }
          .navbar-nav {
              float: none!important;
              margin-top: 7.5px;
          }
          .navbar-nav>li {
              float: none;
          }
          .navbar-nav>li>a {
              padding-top: 10px;
              padding-bottom: 10px;
          }
          .collapse.in{
              display:block !important;
          }
        }
        .top-margin{
          margin-top: 60px;
        }
    </style>
    @yield('header-css')
    @yield('header-js')
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('home') }}">{{ config('app.name', 'Maheshwari Samaj') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            @php
                $loginUser = Auth::user();
            @endphp
            <ul class="nav navbar-nav navbar-right">
              @if(is_object($loginUser))
                <li class="active"><a href="{{ url('home') }}"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon"></span> Maheshwari<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('panchayat') }}">Maheshwari Panchayat</a>
                            <a href="{{ url('navyuvak-mandal') }}">Navyuvak Mandal</a>
                            <a href="{{ url('mahila-mandal') }}">Mahila Mandal</a>
                            <a href="{{ url('varishth-nagrik') }}">Varishth Nagrik</a>
                            <a href="{{ url('jilha-sangathan') }}">Maheshwari Jilha Sangathan</a>
                            <a href="{{ url('seva-manch') }}">Maheshwari Seva Manch</a>
                        </li>
                    </ul>
                </li>
                @if(1 == $loginUser->is_member)
                  <li><a href="{{ url('members') }}"><span class="glyphicon glyphicon-user"></span>Members</a></li>
                @endif
                <li><a href="{{ url('marriage') }}"><span class="glyphicon"></span>Parinay</a></li>
                @if(1 == $loginUser->is_member)
                  <li><a href="{{ url('blood-group') }}">Blood Group</a></li>
                  <li><a href="{{ url('add-member') }}"><span class="glyphicon glyphicon-plus"></span>Add Member</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Business/Profession <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ url('search-business') }}">Search Business</a>
                              <a href="{{ url('add-business') }}">Add Business</a>
                          </li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          Jobs <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ url('jobs') }}">All Job</a>
                              <a href="{{ url('show-job') }}">Add Job</a>
                          </li>
                      </ul>
                  </li>
                @endif
                @if(1 == $loginUser->is_super_admin)
                  <li><a href="{{ url('group-member') }}">Group Member</a></li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        {{ Auth::user()->f_name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('notifications') }}">Notification</a>
                            <a href="{{ url('contacts') }}">Contact</a>
                            @if(1 == $loginUser->is_super_admin)
                            <a href="{{ url('show-notification') }}">Create Notification</a>
                            <a href="{{ url('show-contact') }}">Create Contact</a>
                            @endif
                            <a href="{{ url('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
              @endif
          </ul>
        </div>
      </div>
    </nav>
    @yield('content')
</body>
</html>
