<header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>



                <!-- Left navbar -->


                <!-- Right navbar -->
                <ul class="list-inline navbar-right top-menu top-right-menu">


                    <!-- user login dropdown start-->
                    <li class="dropdown text-center">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                            <span class="username">{{ Auth::user()->name }}</span> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">

                           <li><a href="{{ route('register') }}"><i class="ion-calendar"></i> <span class="nav-label">Register Users</span></a></li>
		 <li><a href="{{ route('maillist') }}"><i class="ion-calendar"></i> <span class="nav-label">Add to mail list</span></a></li>
  
                            <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-sign-out"></i> Log Out
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- End right navbar -->

            </header>
