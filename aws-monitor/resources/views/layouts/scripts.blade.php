        <script src="{{ asset('main.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/pace.min.js') }}"></script>
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/chat/moment-2.2.1.js') }}"></script>

        <!-- Counter-up -->
        <script src="{{ asset('js/waypoints.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.counterup.min.js') }}" type="text/javascript"></script>

        <!-- EASY PIE CHART JS -->
        <script src="{{ asset('assets/easypie-chart/easypiechart.min.js') }}"></script>
        <script src="{{ asset('assets/easypie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('assets/easypie-chart/example.js') }}"></script>


        <!--C3 Chart-->
        <script src="{{ asset('assets/c3-chart/d3.v3.min.js') }}"></script>
        <script src="{{ asset('assets/c3-chart/c3.js') }}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/morris/raphael.min.js') }}"></script>



        <!-- sparkline -->
        <script src="{{ asset('assets/sparkline-chart/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/sparkline-chart/chart-sparkline.js') }}" type="text/javascript"></script>

        <!-- sweet alerts -->
        <script src="{{ asset('assets/sweet-alert/sweet-alert.min.js') }}"></script>
        <script src="{{ asset('assets/sweet-alert/sweet-alert.init.js') }}"></script>

        <script src="{{ asset('js/jquery.app.js') }}"></script>
        <!-- Chat -->
        <script src="{{ asset('js/jquery.chat.js') }}"></script>
        <!-- Dashboard -->
        <script src="{{ asset('js/jquery.dashboard.js') }}"></script>

        <!-- Todo -->
        <script src="{{ asset('js/jquery.todo.js') }}"></script>

         @yield("page_specific_script_files")

        <!--Form Wizard-->
        <script src="{{ asset('assets/form-wizard/jquery.steps.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('assets/jquery.validate/jquery.validate.min.js') }}"></script>

        <!--wizard initialization-->
        <script src="{{ asset('assets/form-wizard/wizard-init.js') }}" type="text/javascript"></script>

         <script src="{{ asset('assets/timepicker/bootstrap-datepicker.js') }}"></script>

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>


        {{-- some scripts needed to for better UI with bootstrap --}}
        {{--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>  --}}

        <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/dataTables.bootstrap.js') }}"></script>

         <!-- Modal-Effect -->
         <script src="{{ asset('assets/modal-effect/js/classie.js') }}"></script>
        <script src="{{ asset('assets/modal-effect/js/modalEffects.js') }}"></script>
        <script src="{{ asset('assets/select2/select2.min.js') }}" type="text/javascript"></script>


        <script src="{{ asset('assets/toggles/toggles.min.js') }}"></script>




        <script src="{{ asset('assets/dygraph/dygraph.min.js') }}" ></script>

	<!-- Plotly Charts -->
	<script src="{{ asset('assets/plotly/plotly-latest.min.js') }}" ></script>
        <script src="{{ asset('https://cdn.plot.ly/plotly-latest.min.js') }}" ></script> 

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();

                jQuery(".select2").select2({
                    width: '100%'
                });
                jQuery('.toggle').toggles({on: true});
            } );


            $('#full-width-modal').on('show.bs.modal', function(e) {
                var station = e.relatedTarget.id;
                var obj = jQuery.parseJSON(station);
                //$('#wizard-validation-form').attr('action', "/updatestation");
                $('#station_number').val(obj["StationNumber"]);
                $('#station_name').val(obj["StationName"]);
                $('#snumber').val(obj["StationNumber"]);
                $('#slocation').val(obj["Location"]);
                $('#latitude').val(obj["Latitude"]);
                $('#longitude').val(obj["Longitude"]);
                //$('#city').val(obj["city"]);
                //$('#code').val(obj["code"]);
                $('#region').val(obj["StationRegion"]);
                //alert(obj["Opened"]);
                $('#date_opened').val(Date.parse(obj["Opened"]));
                $('#date_closed').val(Date.parse(obj["Closed"]));
                $('#station_type').val(obj["StationType"]);
                $('#country').val(obj["Country"]);

                if(obj["stationStatus"]=="on")
                    $('#station_status').prop('checked', true);
                else
                    $('#station_status').prop('checked', false);

            });

            //editing problem configurations
            $('#full-width-modal7').on('show.bs.modal', function(e) {
                var station_problems = e.relatedTarget.id;

                var insulatorsensors = new Array();
                var conigurations = new Array();
                var problems_stations_data = jQuery.parseJSON(station_problems);

                //continue from here tomorrow
                station=problems_stations_data[0];


                //looping to get the problems for the given selection
                for (var i = 0; i < problems_stations_data[1].length; i++) {
                            if (problems_stations_data[1][i]['station_id'] === station["station_id"]) {
                                conigurations.push(problems_stations_data[1][i]);

                            }
                }
                //'station_id','problem_id','max_track_counter','report_method',
                //'criticality','reporting_time_interval'

                $('#station_selected').val(station["StationName"]);
                $('#station_id').val(station["station_id"]);
                $('#problem_1').val(conigurations[0]['problem_id']);
                $('#problem_2').val(conigurations[1]['problem_id']);
                $('#problem_3').val(conigurations[2]['problem_id']);
                $('#problem_4').val(conigurations[3]['problem_id']);
                $('#problem_5').val(conigurations[4]['problem_id']);
                $('#problem_6').val(conigurations[5]['problem_id']);
                $('#problem_7').val(conigurations[6]['problem_id']);
                $('#problem_8').val(conigurations[7]['problem_id']);


                for (var i = 0; i <conigurations.length; i++) {

                    if(conigurations[i]['problem_id']==1){

                        $('#sorptmethod').val(conigurations[i]['report_method']);
                        $('#soprobRptTime').val(conigurations[i]['reporting_time_interval']);
                    }
                    else if(conigurations[i]['problem_id']==2){
                        $('#nooccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#norptmethod').val(conigurations[i]['report_method']);
                        $('#nocriticallity').val(conigurations[i]['criticality']);
                        $('#noprobRptTime').val(conigurations[i]['reporting_time_interval']);
                    }

                    else if(conigurations[i]['problem_id']==3){
                        $('#lpoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#lprptmethod').val(conigurations[i]['report_method']);
                        $('#lpcriticallity').val(conigurations[i]['criticality']);
                        $('#lpprobRptTime').val(conigurations[i]['reporting_time_interval']);
                    }
                    else if(conigurations[i]['problem_id']==4){
                        $('#msoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#msrptmethod').val(conigurations[i]['report_method']);
                        $('#mscriticallity').val(conigurations[i]['criticality']);
                        $('#msprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    else if(conigurations[i]['problem_id']==5){
                        $('#nmoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#nmrptmethod').val(conigurations[i]['report_method']);
                        $('#nmcriticallity').val(conigurations[i]['criticality']);
                        $('#nmprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    else if(conigurations[i]['problem_id']==6){
                        $('#idoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#idrptmethod').val(conigurations[i]['report_method']);
                        $('#idcriticallity').val(conigurations[i]['criticality']);
                        $('#idprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    else if(conigurations[i]['problem_id']==7){
                        $('#isoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#isrptmethod').val(conigurations[i]['report_method']);
                        $('#iscriticallity').val(conigurations[i]['criticality']);
                        $('#isprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    else if(conigurations[i]['problem_id']==8){
                        $('#ssoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#ssorptmethod').val(conigurations[i]['report_method']);
                        $('#ssocriticallity').val(conigurations[i]['criticality']);
                        $('#ssoprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    else if(conigurations[i]['problem_id']==9){
                        $('#pdoccurencesConsider').val(conigurations[i]['max_track_counter']);
                        $('#pdrptmethod').val(conigurations[i]['report_method']);
                        $('#pdcriticallity').val(conigurations[i]['criticality']);
                        $('#pdprobRptTime').val(conigurations[i]['reporting_time_interval']);

                    }
                    
                }



            });

            //configure ten meter nodes setting in the modal
            $('#full-width-modal2').on('show.bs.modal', function(e) {
                var tenMeterNode = e.relatedTarget.id;
                //alert(tenMeterNode);
                var tenMeterData = jQuery.parseJSON(tenMeterNode);

                obj=tenMeterData[0];
                var insulatorsensors = new Array();
                var windSpeedSensors = new Array();
                var windDirectionSensors = new Array();
                insulationSensors=tenMeterData[1];
                        for (var i = 0; i < tenMeterData[1].length; i++) {
                            if (tenMeterData[1][i]['node_id'] === obj["node_id"]) {
                                insulatorsensors.push(tenMeterData[1][i]);
                                break;
                            }
                        }
                        for (var i = 0; i < tenMeterData[2].length; i++) {
                            if (tenMeterData[2][i]['node_id'] === obj["node_id"]) {
                                windSpeedSensors.push(tenMeterData[2][i]);
                                break;
                            }
                        }
                        for (var i = 0; i < tenMeterData[3].length; i++) {
                            if (tenMeterData[3][i]['node_id'] === obj["node_id"]) {
                                windDirectionSensors.push(tenMeterData[3][i]);
                                break;
                            }
                        }

                //alert(insulatorsensors[0]);
                //alert(windSpeedSensors[0]["identifier_used"]);
                //alert(windDirectionSensors[0]["identifier_used"]);


                //windSpeedSensors=tenMeterData[2];
                //windDirectionSensors=tenMeterData[3];

                //$('#wizard-validation-form').attr('action', "/updatestation");
                $('#10node_id').val(obj["node_id"]);
                $('#10txt_key').val(obj["txt_10m"]);
                $('#10vin_label').val(obj["v_in_10m"]);
                $('#10mac_add').val(obj["e64_10m"]);
                $('#10v_in_min_value').val(obj["v_in_min_value"]);
                $('#10v_in_max_value').val(obj["v_in_max_value"]);
                $('#10v_mcu_label').val(obj["v_mcu_10m"]);
                $('#10gwlat').val(obj["gw_lat_10m"]);
                $('#10gwlong').val(obj["gw_long_10m"]);
                $('#10v_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#10v_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#10rssi').val(obj["rssi_10m"]);
                $('#10lqi').val(obj["lqi_10m"]);
                $('#10drp').val(obj["drp_10m"]);
                $('#10ps').val(obj["ps_10m"]);
                $('#10ut').val(obj["ut_10m"]);
                $('#10ttl').val(obj["ttl_10m"]);
                $('#10date').val(obj["date_10m"]);
                $('#10time').val(obj["time_10m"]);
                $('#10txt_value').val(obj["txt_10m_value"]);
                if(obj["node_status"]=="on")
                    $('#10mnode_status').prop('checked', true);
                else
                    $('#10mnode_status').prop('checked', false);
                $('#10parameter_read').val(insulatorsensors[0]["parameter_read"]);
                $('#10identifier_used').val(insulatorsensors[0]["identifier_used"]);
                $('#10max_value').val(insulatorsensors[0]["max_value"]);
                $('#10min_value').val(insulatorsensors[0]["min_value"]);
                if(insulatorsensors[0]["sensor_status"]=="on")
                    $('#10sensor_status').prop('checked', true);
                else
                    $('#10sensor_status').prop('checked', false);
                $('#10rptTime').val(insulatorsensors[0]["report_time_interval"]);
                $('#wsparameter_read').val(windSpeedSensors[0]["parameter_read"]);
                $('#wsidentifier_used').val(windSpeedSensors[0]["identifier_used"]);
                $('#wsmax_value').val(windSpeedSensors[0]["max_value"]);
                $('#wsmin_value').val(windSpeedSensors[0]["min_value"]);
                if(windSpeedSensors[0]["sensor_status"]=="on")
                    $('#wssensor_status').prop('checked', true);
                else
                    $('#wssensor_status').prop('checked', false);
                $('#wsrptTime').val(windSpeedSensors[0]["report_time_interval"]);
                $('#wssensor_status').val(windSpeedSensors[0]["sensor_status"]);
                $('#wdparameter_read').val(windDirectionSensors[0]["parameter_read"]);
                $('#wdidentifier_used').val(windDirectionSensors[0]["identifier_used"]);
                $('#wdmax_value').val(windDirectionSensors[0]["max_value"]);
                $('#wdmin_value').val(windDirectionSensors[0]["min_value"]);
                $('#wdrptTime').val(windDirectionSensors[0]["report_time_interval"]);
                if(windDirectionSensors[0]["sensor_status"]=="on")
                    $('#wdsensor_status').prop('checked', true);
                else
                    $('#wdsensor_status').prop('checked', false);

            });



            //configuring two meter nodes: setting parameters
            $('#full-width-modal3').on('show.bs.modal', function(e) {
                var twoMeterNode = e.relatedTarget.id;
                var twoMeterData = jQuery.parseJSON(twoMeterNode);
                var relativeHumiditysensors = new Array();
                var temperatureSensors = new Array();

                var obj = twoMeterData[0]
                //alert(obj["node_id"]);
                for (var i = 0; i < twoMeterData[1].length; i++) {
                            if (twoMeterData[1][i]['node_id'] === obj["node_id"]) {
                                relativeHumiditysensors.push(twoMeterData[1][i]);
                                break;
                            }
                        }
                for (var i = 0; i < twoMeterData[2].length; i++) {
                            if (twoMeterData[2][i]['node_id'] === obj["node_id"]) {
                                temperatureSensors.push(twoMeterData[2][i]);
                                break;
                            }
                  }
                //alert(temperatureSensors);
                $('#2mnode_id').val(obj["node_id"]);
                $('#2txt_key').val(obj["txt_2m"]);
                $('#2mvin_label').val(obj["v_in_2m"]);
                $('#2mac_add').val(obj["e64_2m"]);
                $('#2mv_in_min_value').val(obj["v_in_min_value"]);
                $('#2mv_in_max_value').val(obj["v_in_max_value"]);
                $('#2mv_mcu_label').val(obj["v_mcu_2m"]);
                $('#2gwlat').val(obj["gw_lat_2m"]);
                $('#2gwlong').val(obj["gw_long_2m"]);
                $('#2mv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#2mv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#2rssi').val(obj["rssi_2m"]);
                $('#2lqi').val(obj["lqi_2m"]);
                $('#2drp').val(obj["drp_2m"]);
                $('#2ps').val(obj["ps_2m"]);
                $('#2ut').val(obj["ut_2m"]);
                $('#2ttl').val(obj["ttl_2m"]);
                $('#2date').val(obj["date_2m"]);
                $('#2time').val(obj["time_2m"]);
                $('#2txt_value').val(obj["txt_2m_value"]);


                if(obj["node_status"]=="on")
                    $('#2mnode_status').prop('checked', true);
                else
                    $('#2mnode_status').prop('checked', false);

                if(relativeHumiditysensors[0]["sensor_status"]=="on")
                    $('#rhsensor_status').prop('checked', true);
                else
                    $('#rhsensor_status').prop('checked', false);
                $('#rhrptTime').val(relativeHumiditysensors[0]["report_time_interval"]);
                $('#rhparameter_read').val(relativeHumiditysensors[0]["parameter_read"]);
                $('#rhidentifier_used').val(relativeHumiditysensors[0]["identifier_used"]);
                $('#rhmax_value').val(relativeHumiditysensors[0]["max_value"]);
                $('#rhmin_value').val(relativeHumiditysensors[0]["min_value"]);
                if(temperatureSensors[0]["sensor_status"]=="on")
                    $('#tssensor_status').prop('checked', true);
                else
                    $('#tssensor_status').prop('checked', false);
                $('#tsrptTime').val(temperatureSensors[0]["report_time_interval"]);
                $('#tssensor_status').val(temperatureSensors[0]["sensor_status"]);
                $('#tsparameter_read').val(temperatureSensors[0]["parameter_read"]);
                $('#tsidentifier_used').val(temperatureSensors[0]["identifier_used"]);
                $('#tsmax_value').val(temperatureSensors[0]["max_value"]);
                $('#tsmin_value').val(temperatureSensors[0]["min_value"]);

            });



            //configuring ground nodes
            $('#full-width-modal4').on('show.bs.modal', function(e) {
                var groundNode = e.relatedTarget.id;
                var groundNodeData = jQuery.parseJSON(groundNode);

                obj=groundNodeData[0];
                var preciptationsensors = new Array();
                var soilTemperatureSensors = new Array();
                var soilMoistureSensors = new Array();

                //alert(groundNodeData[1])

                for (var i = 0; i < groundNodeData[1].length; i++) {
                            if (groundNodeData[1][i]['node_id'] === obj["node_id"]) {
                                preciptationsensors.push(groundNodeData[1][i]);
                                break;
                            }
                        }
                for (var i = 0; i < groundNodeData[2].length; i++) {
                            if (groundNodeData[2][i]['node_id'] === obj["node_id"]) {
                                soilTemperatureSensors.push(groundNodeData[2][i]);
                                break;
                            }
                  }
                for (var i = 0; i < groundNodeData[3].length; i++) {
                            if (groundNodeData[3][i]['node_id'] === obj["node_id"]) {
                                soilMoistureSensors.push(groundNodeData[3][i]);
                                break;
                            }
                  }
                $('#gndnode_id').val(obj["node_id"]);
                $('#gndtxt_key').val(obj["txt_gnd"]);
                $('#gndvin_label').val(obj["v_in_gnd"]);
                $('#gndmac_add').val(obj["e64_gnd"]);
                $('#gndv_in_min_value').val(obj["v_in_min_value"]);
                $('#gdv_in_max_value').val(obj["v_in_max_value"]);
                $('#gdv_mcu_label').val(obj["v_mcu_gnd"]);
                $('#gndgwlat').val(obj["gw_lat_gnd"]);
                $('#gndgwlong').val(obj["gw_long_gnd"]);
                $('#gdv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#gdv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#gndrssi').val(obj["rssi_gnd"]);
                $('#gndlqi').val(obj["lqi_gnd"]);
                $('#gnddrp').val(obj["drp_gnd"]);
                $('#gndps').val(obj["ps_gnd"]);
                $('#gndut').val(obj["ut_gnd"]);
                $('#gndttl').val(obj["ttl_gnd"]);
                $('#gnddate').val(obj["date_gnd"]);
                $('#grndtime').val(obj["time_gnd"]);
                $('#groundps').val(obj["ps_gnd"]);
                $('#groundpo').val(obj["p0_lst60_gnd"]);
                $('#gndup').val(obj["up_gnd"]);
                $('#gndt').val(obj["t_gnd"]);
                $('#v_a2').val(obj["v_a2_gnd"]);
                $('#groundrain_pulses').val(obj["ps_gnd"]);
                $('#gndtxt_value').val(obj["txt_gnd_value"]);


                if(obj["node_status"]=="on")
                    $('#gndnode_status').prop('checked', true);
                else
                    $('#gndnode_status').prop('checked', false);

                if(preciptationsensors[0]["sensor_status"]=="on")
                    $('#ppsensor_status').prop('checked', true);
                else
                    $('#ppsensor_status').prop('checked', false);
                $('#pprptTime').val(preciptationsensors[0]["report_time_interval"]);
                $('#ppparameter_read').val(preciptationsensors[0]["parameter_read"]);
                $('#ppidentifier_used').val(preciptationsensors[0]["identifier_used"]);
                $('#ppmax_value').val(preciptationsensors[0]["max_value"]);
                $('#ppmin_value').val(preciptationsensors[0]["min_value"]);

                if(soilTemperatureSensors[0]["sensor_status"]=="on")
                    $('#stsensor_status').prop('checked', true);
                else
                    $('#stsensor_status').prop('checked', false);
                $('#strptTime').val(soilTemperatureSensors[0]["report_time_interval"]);
                $('#stparameter_read').val(soilTemperatureSensors[0]["parameter_read"]);
                $('#stidentifier_used').val(soilTemperatureSensors[0]["identifier_used"]);
                $('#stmax_value').val(soilTemperatureSensors[0]["max_value"]);
                $('#stmin_value').val(soilTemperatureSensors[0]["min_value"]);

                if(soilMoistureSensors[0]["sensor_status"]=="on")
                    $('#smsensor_status').prop('checked', true);
                else
                    $('#smsensor_status').prop('checked', false);
                $('#smrptTime').val(soilMoistureSensors[0]["report_time_interval"]);
                $('#smparameter_read').val(soilMoistureSensors[0]["parameter_read"]);
                $('#smidentifier_used').val(soilMoistureSensors[0]["identifier_used"]);
                $('#smmax_value').val(soilMoistureSensors[0]["max_value"]);
                $('#smmin_value').val(soilMoistureSensors[0]["min_value"]);


            });

            $('#full-width-modal5').on('show.bs.modal', function(e) {
                var sinkNode = e.relatedTarget.id;
                var sinkData = jQuery.parseJSON(sinkNode);
                var Pressuresensors = new Array();
                var temperatureSensors = new Array();
                var obj = sinkData[0]
                for (var i = 0; i < sinkData[1].length; i++) {
                            if (sinkData[1][i]['node_id'] === obj["node_id"]) {
                                Pressuresensors.push(sinkData[1][i]);
                                break;
                            }
                }
                $('#sinknode_id').val(obj["node_id"]);
                $('#sinktxt_key').val(obj["txt_sink"]);
                $('#sinkvin_label').val(obj["v_in_sink"]);
                $('#sinkmac_add').val(obj["e64_sink"]);
                $('#sinkv_in_min_value').val(obj["v_in_min_value"]);
                $('#sinkv_in_max_value').val(obj["v_in_max_value"]);
                $('#sinkv_mcu_label').val(obj["v_mcu_sink"]);
                $('#sinkgwlat').val(obj["gw_lat_sink"]);
                $('#sinkgwlong').val(obj["gw_long_sink"]);
                $('#sinkv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#sinkv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#sinkrssi').val(obj["rssi_sink"]);
                $('#sinklqi').val(obj["lqi_sink"]);
                $('#sinkdrp').val(obj["drp_sink"]);
                $('#sinkps').val(obj["ps_sink"]);
                $('#sinkut').val(obj["ut_sink"]);
                $('#sinkttl').val(obj["ttl_sink"]);
                $('#sinkdate').val(obj["date_sink"]);
                $('#sinktime').val(obj["time_sink"]);
                $('#sinkps').val(obj["ps_sink"]);
                $('#sinkup').val(obj["up_sink"]);
                $('#sinktxt_value').val(obj["txt_sink_value"]);
                if(obj["node_status"]=="on")
                    $('#sinknode_status').prop('checked', true);
                else
                    $('#sinknode_status').prop('checked', false);

                if(Pressuresensors[0]["sensor_status"]=="on")
                    $('#pssensor_status').prop('checked', true);
                else
                    $('#pssensor_status').prop('checked', false);
                $('#psrptTime').val(Pressuresensors[0]["report_time_interval"]);
                $('#psparameter_read').val(Pressuresensors[0]["parameter_read"]);
                $('#psidentifier_used').val(Pressuresensors[0]["identifier_used"]);
                $('#psmax_value').val(Pressuresensors[0]["max_value"]);
                $('#psmin_value').val(Pressuresensors[0]["min_value"]);

            });


        </script>
