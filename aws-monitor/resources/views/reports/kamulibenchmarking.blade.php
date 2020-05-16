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

    </div> <!-- End row -->


        <!-- Accordions -->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel-group" id="accordion-test-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                        Benchmarking Pressure <?php echo $heading; ?>                            </a>
                                </h4>
                            </div>
                            <div id="collapseOne-2" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    @include("reports.pressure")
        
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
                                        Calibrating Pressure <?php echo $heading; ?>with a Confidence level of @foreach ($conf1 as $c1) {{$c1->confidence_level}} @endforeach%                            </a>
                                </h4>
                            </div>
                            <div id="collapseOne-2" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    @include("reports.calibrated_pressure")
        
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
var ff = {!! json_encode($k_t->toArray())!!};
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



//Pressure
var p = {!! json_encode($k_p->toArray())!!};
    var p_w = [];
    var p_dt =[];
    var p_u=[];

p.map(function(x){
p_w.push (parseFloat(x.press_wimea))
p_dt.push((x.datetime))
p_u.push(parseFloat(x.press_unma))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: p_dt,
  y: p_u,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: p_dt,
  y: p_w,
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
      title: "Pressure(Hecto Pascals)"
  }
                      
};

Plotly.newPlot('pressure_aws_adcon', data, layout, {response:true});
});


var p1 = {!! json_encode($kc_p->toArray())!!};
    var p_w1 = [];
    var p_dt1 =[];
    var p_u1=[];

p1.map(function(x){
p_w1.push (parseFloat(x.wimea_calibrated_pressure))
p_dt1.push((x.datetime))
p_u1.push(parseFloat(x.unma_original_pressure))

})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'ADCON',
  x: p_dt1,
  y: p_u1,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'WIMEA',
  x: p_dt1,
  y: p_w1,
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
      title: "Pressure(Hecto Pascals)"
  }
                      
};

Plotly.newPlot('cal_pressure_aws_adcon', data, layout, {response:true});
});
</script>

@endsection
