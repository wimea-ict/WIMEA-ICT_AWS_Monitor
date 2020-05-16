<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   
    @include('layouts.links')

       
</head>
<body>
			
<header class="top-head container-fluid" style="background-color:#1a2942; color:white;">
<h1 class="navbar-toggle pull-left">AWS MONITOR</h1>





  <ul class="list-inline navbar-right top-menu top-right-menu" >
   <li class="dropdown text-center"> 
   <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="line-height:70px;  color:white;  
 cursor: default;" >
   Login
      </a>
  <ul class="dropdown-menu extended pro-menu " tabindex="5003" style="overflow: hidden; outline: none; width:600px; color:#03111C; ">
                         
                            <li>  
							
<div class="container" style="width:600px;" >
    <div class="row">
            <div class="panel panel-default" style="width:600px;">
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>



							</li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- End right navbar -->



   </header>






















        <!--Main Content Start -->
        <section class="welcome_content">
            
            

            <!-- Page Content Start -->
            <!-- ================== -->
     
            <div class="wraper container-fluid">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('flash_message') }}
                    </div>
                @endif

                @yield('content')


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <script>
             $('div.alert').not('.alert-important').delay(4000).slideUp(300);
            </script>

			<footer class="footerr" style="width:9000px;">
                &copy; 2018 - <?php echo date('Y'); ?> Wimea AWS Monitor ICT production. All Rights reserved.
</footer>

            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
        @include('layouts.scripts')


        
    

    </body>
</html>
