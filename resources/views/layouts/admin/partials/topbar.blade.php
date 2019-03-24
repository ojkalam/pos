<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">POS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Point of Sale</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
     <!--  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        <!--   <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li> -->
                <!-- inner menu: contains the actual data -->
          <!--  <ul class="menu"> 
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> 
       -->

       <!-- Notifications: style can be found in dropdown.less -->
       @if(auth()->user()->role == 'admin')
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-info">{{ auth()->user()->unreadNotifications ->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ auth()->user()->unreadNotifications ->count() }} unread notifications
               <a href="{{ route('markasread') }}" style="display:inline-block" class="btn btn-sm btn-default">Mark all as read</a>
              </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach( auth()->user()->notifications as $notification)
                  @if($notification->unread())
                    <li style="background:#E4E9F1">
                      <a href="{{ route('mark_single_asread', [ 'id' => $notification->id ]) }}">
                      <i class="fa fa-warning text-yellow"></i> {{ $notification->data['product_info'] }} <br> 
                        @php
                            $dt = new Carbon\Carbon($notification->created_at);
                        @endphp
                      <span style="margin-left:22px"><i class="fa fa-clock-o"></i> {{ $dt->diffForHumans() }}</span>
                      </a>
                    </li>
                  @else
                    <li style="background:#fff">
                      <a href="#">
                      <i class="fa fa-warning text-yellow"></i> {{ $notification->data['product_info'] }} <br> 
                        @php
                            $dt = new Carbon\Carbon($notification->created_at);
                        @endphp
                      <span style="margin-left:22px"><i class="fa fa-clock-o"></i> {{ $dt->diffForHumans() }}</span>
                      </a>
                    </li>
                  @endif
                   @endforeach

                </ul>
              </li>
              <!-- <li class="footer"><a href="{{ route('markasread') }}" class="btn btn-sm btn-default">Mark all as read</a></li> -->
              <li class="footer"><a  href="{{ route('delnotification') }}">View all</a></li>
            </ul>
          </li>
          @endif
          <!-- User Account: style can be found in dropdown.less -->
          <li class="user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('backend/dist/img/user.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ \Auth::user()->name }}</span>
            </a>
          </li>
          <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none" >
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div>

    </nav>
  </header>