<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">


    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                Benchmarking Temperature <?php echo $heading; ?>                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            @include("reports.temperature")

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                Calibrating Temperature <?php echo $heading; ?>with a Confidence level of @foreach ($conf as $c) {{$c->confidence_level}} @endforeach%                           </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            @include("reports.calibrated_temperature")

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

            <!-- Accordions -->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                    Benchmarking Relative Humidity <?php echo $heading; ?>                            </a>
                            </h4>
                        </div>
                        <div id="collapseOne-2" class="panel-collapse collapse in">
                            <div class="panel-body">
                                @include("reports.relativehumidity")
    
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>

    </div> <!-- End row -->

            <!-- Accordions -->
    <div class="row">
            <div class="col-lg-12">
                <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                    Calibrating Relative Humidity <?php echo $heading; ?>with a Confidence level of @foreach ($conf1 as $c1) {{$c1->confidence_level}} @endforeach%                             </a>
                            </h4>
                        </div>
                        <div id="collapseOne-2" class="panel-collapse collapse in">
                            <div class="panel-body">
                                @include("reports.calibrated_relativehumidity")
    
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>

    </div> <!-- End row -->

</div>

@endsection

@section('page_specific_script_files')
<script>
//Temperature   
var ff = {!! json_encode($e_t->toArray())!!};
    var array1 = [];
    var array2 =[];
    var array3=[];

ff.map(function(x){
array1.push (parseFloat(x.temp_wimea))
array2.push((x.datetime))
array3.push(parseFloat(x.temp_unma))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: array2,
  y: array3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: array2,
  y: array1,
  line: {color: '#0000FF',
         width: 1
  }
}

var data = [trace1,trace2];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Temperature(Celcious)"
  }
                      
};

Plotly.newPlot('temperature_aws_adcon', data, layout, {response:true});
});


var ff2 = {!! json_encode($ec_t->toArray())!!};
    var arrays1 = [];
    var arrays2 =[];
    var arrays3=[];

ff2.map(function(x){
arrays1.push (parseFloat(x.wimea_calibrated_temp))
arrays2.push((x.datetime))
arrays3.push(parseFloat(x.unma_original_temp))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: arrays2,
  y: arrays3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: arrays2,
  y: arrays1,
  line: {color: '#0000FF',
         width: 1
  }
}

var data = [trace1,trace2];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Temperature(Celcious)"
  }
                      
};

Plotly.newPlot('cal_temperature_aws_adcon', data, layout, {response:true});
});

//Relative humidity
var rh = {!! json_encode($e_rh->toArray())!!};
    var rh_w = [];
    var rh_dt =[];
    var rh_u=[];

rh.map(function(x){
rh_w.push (parseFloat(x.rh_wimea))
rh_dt.push((x.datetime))
rh_u.push(parseFloat(x.rh_unma))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: rh_dt,
  y: rh_u,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: rh_dt,
  y: rh_w,
  line: {color: '#0000FF',
         width: 1
  }
}

var data = [trace1,trace2];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Relative humidity(%)"
  }
                      
};

Plotly.newPlot('relativehumidity_aws_adcon', data, layout, {response:true});
});


var rh1 = {!! json_encode($ec_rh->toArray())!!};
    var rh_w1 = [];
    var rh_dt1 =[];
    var rh_u1=[];

rh1.map(function(x){
rh_w1.push (parseFloat(x.wimea_calibrated_humidity))
rh_dt1.push((x.datetime))
rh_u1.push(parseFloat(x.unma_original_humidity))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: rh_dt1,
  y: rh_u1,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: rh_dt1,
  y: rh_w1,
  line: {color: '#0000FF',
         width: 1
  }
}

var data = [trace1,trace2];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Relative humidity(%)"
  }
                      
};

Plotly.newPlot('cal_relativehumidity_aws_adcon', data, layout, {response:true});
});
</script>

@endsection
