<nav class="navbar navbar-default navbar-fixed-top mainnav">
  <div class="navbar-header pull-right">
    <div class="pull-right dropdown" style="padding-top: 10px;padding-right: 7px;margin-left: -10px;margin-right: 20px;" >
      @if(Auth::user())
        <a href="#" class="dropdown-toggle pull-right user_menu" data-toggle="dropdown" role="button" aria-expanded="false" title="User">
            <img src="{{ asset('images/login.png') }}" id="currentUserImage" class="img-circle user-profile" alt="user name" aria-haspopup="true"   aria-expanded="true"/>&nbsp;
        </a>
        <ul class="dropdown-menu user-dropdown ">
          <div class="navbar-content">
              <li><a href="{{ url('dashboard') }}" data-toggle="tooltip" title="Dashboard" target="_blank"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
              <li><a href="{{ url('logout') }}" data-toggle="tooltip" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
          </div>
        </ul>
      @else
        <a href="#" class="dropdown-toggle pull-right user_menu" data-toggle="dropdown" role="button" aria-expanded="false" title="User"><img src="{{ asset('images/user.png') }}" class="img-circle user-profile" alt="user name" aria-haspopup="true" aria-expanded="true"/>
        </a>
        <ul class="dropdown-menu" role="menu">
          <div class="navbar-content">
              <li>
                <a href="{{ url('login')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> Login</a>
              </li>
          </div>
        </ul>
      @endif
    </div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

</nav>