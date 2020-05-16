<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">

    @include("reports.select_station_section")

    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                2m Node
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            @include("reports.node2m")

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                10m Node
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                                @include("reports.node10m")

                            </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                Ground Node
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            @include("reports.nodegnd")
                            </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseFour-2" class="collapsed" aria-expanded="false">
                                Sink Node
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                        @include("reports.nodesink")
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- End row -->
</div>

@endsection

@section('page_specific_script_files')
    {{--  <script src="assets/morris/node2mcharts.js"></script>  --}}
    <script>


    $( "#station_id" ).change(function() {
          $("#report_form").submit()
    });

    $(function() {

        //10m node
        var vin_vmcu_10m="<?=$vin_vmcu_10m?>";

            if(vin_vmcu_10m==""){
            $("#vin_vmcu_10m").html("<h4>No V_IV or V_MCU data Found</h4>");

            }else{
                new Dygraph(document.getElementById("vin_vmcu_10m"),
                    vin_vmcu_10m,
                    {
                        labels: [ "x", "V_MCU", "V_IN" ],
                    xlabel: 'Time',
                    ylabel: 'Voltage (V)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }

            var insulation_sensor="<?=$insulation_sensor?>";

            if(insulation_sensor==""){
            $("#insulation_sensor").html("<h4>No Insulation Sensor data Found</h4>");

            }else{
                new Dygraph(document.getElementById("insulation_sensor"),
                    insulation_sensor,
                    {
                        labels: [ "x", "insulation"],
                        legend:'always',
                        hideOverlayonMouseOut:true,
                        animatedZooms:true,
                        showRangeSelector:true,
                        showInRangeSelector:true,
                        rangeSelectorPlotLineWidth:0.5,
                        rangeSelectorHeight:20,
                        rangeSelectorForegroundLineWidth:0.5,
                        rangeSelectorForegroundStrokeColor:'grey'
                });
            }


            var windspeed_sens="<?=$windspeed_sensor?>";
            if(windspeed_sens==""){
            $("#windspeed_sensor").html("<h4>No Windspeed Sensor data Found</h4>");

            }else{
                new Dygraph(document.getElementById("windspeed_sensor"),
                windspeed_sens,
                {
                    labels: [ "x", "windspeed"],
                    xlabel: 'Time',
                    ylabel: 'Wind speed (mph)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }

            var wind_direction="<?=$wind_direction_sensor?>";

            if(wind_direction==""){
            $("#wind_direction_sensor").html("<h4>No Wind Direction Sensor data Found</h4>");

            }else{
                new Dygraph(document.getElementById("wind_direction_sensor"),
                wind_direction,
                {
                    labels: [ "x", "wind_direction"],
                    xlabel: 'Time',
                    ylabel: 'Wind direction',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }


        //end 10m node

        //2m node
        var vin_vmcu_2m="<?=$vin_vmcu_2m?>";
        if(vin_vmcu_2m==""){
            $("#vin_vmcu_2m").html("<h4>No V_IN VMCU data Found</h4>");
        }else{
            new Dygraph(document.getElementById("vin_vmcu_2m"),
            vin_vmcu_2m,
            {
                labels: [ "x", "V_MCU", "V_IN" ],
                xlabel: 'Time',
                ylabel: 'Voltage (V)',
                legend:'always',
                hideOverlayonMouseOut:true,
                animatedZooms:true,
                showRangeSelector:true,
                showInRangeSelector:true,
                rangeSelectorPlotLineWidth:0.5,
                rangeSelectorHeight:20,
                rangeSelectorForegroundLineWidth:0.5,
                rangeSelectorForegroundStrokeColor:'grey'

            });
        }

        var humidity="<?=$humidity?>";
        humidity = "date,humidity\n"+humidity;
        //document.write(humidity);
            if(humidity==""){
                $("#humidity").html("<h4>No Humidity data Found</h4>");
            }else{
               
                /* prepare the graph */
                g = new Dygraph(document.getElementById("humidity"),
                    humidity,
                    {
                        labels: [ "x", "humidity"],
                        legend:'always',
                        hideOverlayonMouseOut:true,
                        animatedZooms:true,
                        showRangeSelector:true,
                        showInRangeSelector:true,
                        rangeSelectorPlotLineWidth:0.5,
                        rangeSelectorHeight:20,
                        rangeSelectorForegroundLineWidth:0.5,
                        rangeSelectorForegroundStrokeColor:'grey',
                        xlabel: 'Time',
                        ylabel: 'Relative humidity (%)'

                        

                    });
                    
            }

            var templature="<?=$templature?>";
            if(templature==""){
                $("#templature").html("<h4>No Temperature data Found</h4>");
            } else{
                new Dygraph(document.getElementById("templature"),
                templature,
                {
                    labels: [ "x", "temperature"],
                    xlabel: 'Time',
                    ylabel: 'Temperature (&deg;C)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }
            //end 2m node

        //ground node
        var vin_vmcu="<?=$vin_vmcu?>";
            if(vin_vmcu==""){
                $("#vin_vmcu_gnd").html("<h4>No V_IN or V_MCU data Found</h4>");

            }else{
                new Dygraph(document.getElementById("vin_vmcu_gnd"),
                    vin_vmcu,
                    {
                        labels: [ "x", "V_MCU", "V_IN" ],
                        xlabel: 'Time',
                        ylabel: 'Voltage (V)',
                        legend:'always',
                        hideOverlayonMouseOut:true,
                        animatedZooms:true,
                        showRangeSelector:true,
                        showInRangeSelector:true,
                        rangeSelectorPlotLineWidth:0.5,
                        rangeSelectorHeight:20,
                        rangeSelectorForegroundLineWidth:0.5,
                        rangeSelectorForegroundStrokeColor:'grey'
                    }
                );
            }

            var precipitation="<?=$precipitation?>";
            if(precipitation==""){
            $("#precipitation").html("<h4>No Precipitation data Found</h4>");

            }else{
                new Dygraph(document.getElementById("precipitation"),
                precipitation,
                {
                    labels: [ "x", "Precipitation"],
                    xlabel: 'Time',
                    ylabel: 'Precipitation (mm)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }

            var soil_templature="<?=$soil_templature?>";

            if(soil_templature == ""){
                $("#soil_templature").html("<h4>No Soil Templature data Found</h4>");

            }else{
                new Dygraph(document.getElementById("soil_templature"),
                soil_templature,
                {
                labels: [ "x", "soil_templature"],
                xlabel: 'Time',
                ylabel: 'Soil temperature (&deg;C)',
                legend:'always',
                hideOverlayonMouseOut:true,
                animatedZooms:true,
                showRangeSelector:true,
                showInRangeSelector:true,
                rangeSelectorPlotLineWidth:0.5,
                rangeSelectorHeight:20,
                rangeSelectorForegroundLineWidth:0.5,
                rangeSelectorForegroundStrokeColor:'grey'
                });
            }

            var soil_moisture="<?=$soil_moisture?>";
            if(soil_moisture==""){

                $("#soil_moisture").html("<h4>No Soil Moisture data Found</h4>");

            }else{
                
                new Dygraph(document.getElementById("soil_moisture"),
                soil_moisture,
                {
                    labels: [ "x", "soil_moisture"],
                    xlabel: 'Time',
                    ylabel: 'Soil moisture (%VWC)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }

        //end ground node

        //sink node
        var vin_vmcu_data="<?=$vin_vmcu_sink?>";

            if(vin_vmcu_data==""){
                $("#vin_vmcu_sink").html("<h4>No V_IN or V_MCU data Found</h4>");
            }else{

                new Dygraph(document.getElementById("vin_vmcu_sink"),
                    vin_vmcu_data,
                    {
                        labels: [ "x", "V_MCU", "V_IN" ],
                        xlabel: 'Time',
                        ylabel: 'Voltage (V)',
                        legend:'always',
                        hideOverlayonMouseOut:true,
                        animatedZooms:true,
                        showRangeSelector:true,
                        showInRangeSelector:true,
                        rangeSelectorPlotLineWidth:0.5,
                        rangeSelectorHeight:20,
                        rangeSelectorForegroundLineWidth:0.5,
                        rangeSelectorForegroundStrokeColor:'grey'
                    });

            }

            var pressure="<?=$pressure?>";
            if(pressure==""){
                $("#pressure").html("<h4>No Pressure data Available</h4>");
            }else{

                new Dygraph(document.getElementById("pressure"),
                pressure,
                {
                    labels: [ "x", "pressure" ],
                    xlabel: 'Time',
                    ylabel: 'Pressure (mbar)',
                    legend:'always',
                    hideOverlayonMouseOut:true,
                    animatedZooms:true,
                    showRangeSelector:true,
                    showInRangeSelector:true,
                    rangeSelectorPlotLineWidth:0.5,
                    rangeSelectorHeight:20,
                    rangeSelectorForegroundLineWidth:0.5,
                    rangeSelectorForegroundStrokeColor:'grey'
                });
            }


        //end sinknode

            $('#station_id').find('option[selected="selected"]').each(function(){
            $(this).prop('selected', true);
        });

    });//end out function

    $(window).on('load', function() {
        var first_station_submit="<?=$submit_form?>"

        if(first_station_submit!=""){
            $("#report_form").submit()
        }
    });

    </script>
@endsection
