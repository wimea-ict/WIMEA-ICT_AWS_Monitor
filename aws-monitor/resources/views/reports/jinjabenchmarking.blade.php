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

</div>

@endsection

@section('page_specific_script_files')
<script>
//Temperture
var ff = {!! json_encode($j_t->toArray())!!};
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
var p = {!! json_encode($j_p->toArray())!!};
    var array1 = [];
    var array2 =[];
    var array3=[];

p.map(function(x){
array1.push (parseFloat(x.press_wimea))
array2.push((x.datetime))
array3.push(parseFloat(x.press_unma))

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
      title: "Pressure(Hecto Pascals)"
  }
                      
};

Plotly.newPlot('pressure_aws_adcon', data, layout, {response:true});
});

//Relative humidity
var rh = {!! json_encode($j_rh->toArray())!!};
    var array1 = [];
    var array2 =[];
    var array3=[];

rh.map(function(x){
array1.push (parseFloat(x.rh_wimea))
array2.push((x.datetime))
array3.push(parseFloat(x.rh_unma))

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
      title: "Relative humidity(%)"
  }
                      
};

Plotly.newPlot('relativehumidity_aws_adcon', data, layout, {response:true});
});
</script>

@endsection
