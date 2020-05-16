

<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="index.html" class="logo-expanded">

            <span class="nav-label">AWS MONITOR</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="has-submenu"><a href="{{URL::to('viewStationStatus')}}"><i class="ion-home"></i> <span class="nav-label">DashBoard</span></a></li>
            <li class="has-submenu"><a href="#"><i class="ion-radio-waves"></i> <span class="nav-label">Real-time Status</span></a>
                <ul class="list-unstyled">
                    <li class=""><a href="{{URL::to('entebbe_station')}}">Entebbe Station</a></li>
		    <li><a href="{{URL::to('buyende2_station')}}">Buyende 2 Station</a></li>
                    <li><a href="{{URL::to('lwengo_station')}}">Lwengo Station</a></li>
		    <li><a href="{{URL::to('makerere_station')}}">Makerere Station</a></li>
                    <li><a href="{{URL::to('mubende_station')}}">Mubende Station</a></li>
		    <li><a href="{{URL::to('jinja_station')}}">Jinja Station</a></li>
		    <li><a href="{{URL::to('kamuli_station')}}">Kamuli Station</a></li>
		    <li><a href="{{URL::to('mayuge_station')}}">Mayuge Station</a></li>
                </ul>
            </li>

           <!-- <li class="has-submenu"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Configurations</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{URL::to('addnode')}}">Add Node</a></li>

                   <li class=""><a href="{{URL::to('addstation')}}">Add Station</a></li>
                   <li><a href="{{URL::to('configurestation ')}}">Configure Station</a></li>
                   <li><a href="{{URL::to('configure10mnode')}}">Configure 10m Node</a></li>
                   <li><a href="{{URL::to('configure2mnode')}}">Configure 2m Node</a></li>
                   <li><a href="{{URL::to('configuresinknode')}}">Configure sink Node</a></li>
                    <li><a href="{{URL::to('configuregroundnode')}}">Configure Ground Node</a></li>
                    <li><a href="{{URL::to('editProblemConfigurations')}}">Report Configurations</a></li>

                </ul>
            </li>-->

                {{--<ul class="list-unstyled">
                    <!--<li><a href="{{URL::to('addnode')}}">Add Node</a></li>-->
                        <li><a href="{{URL::to('configureproblem')}}">Configure problems</a></li>
                    <li><a href="{{URL::to('editProblemConfigurations')}}">Edit configurations</a></li>

                </ul> --}}
                {{-- {{URL::to('viewStationStatus')}} --}}


           {{-- <li class="has-submenu"><a href="{{ URL::to('probTbData') }}"><i class="ion-alert-circled"></i> <span class="nav-label">Problems Identified</span></a></li>--}}

            @if (Auth::user()->admin == 1)
                <li class="has-submenu"><a href="{{ URL::to('users') }}"><i class="fa fa-list"></i> <span class="nav-label">List of users</span></a></li>
            @endif

            <li class="has-submenu">
                <a href="{{URL::to('data_list')}}"><i class="ion-stats-bars"></i> <span class="nav-label">Import data</span></a>
            </li>

            <li class="has-submenu"><a href="#"><i class="ion-stats-bars"></i> <span class="nav-label">Benchmarking</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{URL::to('Entebbe')}}">Entebbe</a></li>
                    {{--<li><a href="{{URL::to('Jinja')}}">Jinja</a></li>--}}
                    <li><a href="{{URL::to('Kamuli')}}">Kamuli</a></li>
                </ul>
            </li>

           <li class="has-submenu"><a href="#"><i class="ion-document-text"></i> <span class="nav-label">Calibration Data</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{URL::to('caldata1')}}">Entebbe temperature</a></li>
                    <li><a href="{{URL::to('caldata2')}}">Entebbe humidity</a></li>
                    <li><a href="{{URL::to('caldata3')}}">Kamuli temperature</a></li>
                    <li><a href="{{URL::to('caldata4')}}">Kamuli pressure</a></li>
                </ul>

           </li>


               <li class="has-submenu">
                <a href="{{URL::to('googlemaps')}}"><i class="ion-stats-bars"></i> <span class="nav-label">Google Maps</span></a>
            </li>

	   <li class="has-submenu">
                <a href="{{URL::to('maillisttable')}}"><i class="ion-stats-bars"></i> <span class="nav-label">mail list</span></a>
            </li>

           <li class="has-submenu">
                <a href="{{URL::to('analyser')}}"><i class="ion-stats-bars"></i> <span class="nav-label">Problems Archive</span></a>
            </li>
            </li>

                 <li class="has-submenu">
                <a href="{{URL::to('analytic')}}"><i class="ion-stats-bars"></i> <span class="nav-label">Analytics</span></a>
            </li>



            {{-- ion-android-bicycle,  --}}

            <li class="has-submenu"><a href="#"><i class="ion-document-text"></i> <span class="nav-label">Node Data</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{URL::to('nodeData1')}}">Two Meter Data</a></li>
                    <li><a href="{{URL::to('nodeData2')}}">Ten Meter Data</a></li>
                    <li><a href="{{URL::to('nodeData3')}}">Ground Data</a></li>
                    <li><a href="{{URL::to('nodeData4')}}">Observationslip Data</a></li>                    
                </ul>
            </li>

            <li class="has-submenu">
                <a href="{{URL::to('logs')}}"><i class="ion-document-text"></i> <span class="nav-label">Logs</span></a>
            </li>
	    <li class="has-submenu"><a href="{{URL::to('downloads')}}"><i class="ion-android-download"></i> <span class="nav-label">Downloads</span></a></li>
        </ul>
    </nav>
</aside>
