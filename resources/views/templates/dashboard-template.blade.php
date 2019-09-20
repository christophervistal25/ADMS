@include('templates.header')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title text-center"><i class="fa fa-paw"></i> <span>ADMS</span></a>
            </div>

            <div class="clearfix"></div>
           @auth('patient')
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                      <div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                      </div>
                      <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                      <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                          <li><a><i class="fa fa-home"></i> Appointment <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="{{ route('appointment.create') }}">Set Appointment</a></li>
                              <li><a href="index.html">Upcoming Appointments</a></li>
                              <li><a href="index2.html">Appointment History</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <!-- /sidebar menu -->
                  </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                  <div class="nav_menu">
                    <nav>
                      <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                      </div>

                      <ul class="nav navbar-nav navbar-right">
                        <li class="">
                          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
                            <span class=" fa fa-angle-down"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li>
                              <a href="{{ route('account.settings') }}">
                                <span>Account setting</span>
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('patient.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out pull-right"></i>Logout</a>
                            </li>
                          <form id="logout-form" action="{{ route('patient.auth.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                          </form>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                <!-- /top navigation -->
            @endauth

            @auth('admin')
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                      <div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                      </div>
                      <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                      <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                          <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="index.html">Dashboard</a></li>
                              <li><a href="index2.html">Dashboard2</a></li>
                              <li><a href="index3.html">Dashboard3</a></li>
                            </ul>
                          </li>
                        </ul>
                         <ul class="nav side-menu">
                          <li><a><i class="fa fa-home"></i> Doctors <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="{{ route('doctor.index') }}">List of doctors</a></li>
                              <li><a href="{{ route('doctor.create') }}">Add new doctor</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div>

                    </div>
                    <!-- /sidebar menu -->
                  </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                  <div class="nav_menu">
                    <nav>
                      <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                      </div>

                      <ul class="nav navbar-nav navbar-right">
                        <li class="">
                          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
                            <span class=" fa fa-angle-down"></span>
                          </a>
                          <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="javascript:;"> Profile</a></li>
                            <li>
                              <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                              </a>
                            </li>
                            <li><a href="javascript:;">Help</a></li>
                            <li>
                              <a href="{{ route('admin.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out pull-right"></i>Logout</a>
                            </li>
                          <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                          </form>
                          </ul>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
                <!-- /top navigation -->
            @endauth
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title')</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            
             @yield('content')
          </div>
        </div>
        <!-- /page content -->
       

@include('templates.footer')
