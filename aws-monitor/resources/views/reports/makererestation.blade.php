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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                Gateway
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree-2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            @include("reports.gateway")
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- End row -->
</div>

@endsection

@section('page_specific_script_files')


{{-- <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>  --}}

<script>
var ff = {!! json_encode($f->toArray())!!};
    var array1 = [];
    var array2 =[];
    var array3=[];
    var array4=[];
  var array5 =[];
ff.map(function(x){
array1.push (parseFloat(x.V_IN))
array2.push((x.RTC_T))
array3.push(parseFloat(x.V_MCU))
array4.push(parseFloat(x.T))
array5.push(parseFloat(x.RH_SHT2X))
})
$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'V_MCU',
  x: array2,
  y: array3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'V_IN',
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
      range:[0,4],
      dtick: 0.4,
      title: "Voltages"
  }
                      
};

Plotly.newPlot('vin_vmcu_2m', data, layout, {response:true});
});
$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Relative Humidity',
  x: array2,
  y: array5,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
          
      title: "Relative Humidity"
  }
};

Plotly.newPlot('humidity', data, layout, {response:true});
})
 $(function () {
  
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Temperature',
  x: array2,
  y: array4,
  line: {color: '#FF0000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Time"

  },
  yaxis: {
      title: "Temperature"
  }
};

Plotly.newPlot('templature', data, layout, {response:true});
})
var pp = {!! json_encode($p->toArray())!!};
var arr1 = [];
    var arr2 =[];
    var arr3=[];
    var arr4=[];
  var arr5 =[];
pp.map(function(x){
if(x.V_IN){
arr1.push (parseFloat(x.V_IN))//if checks if there are nulls in the data
    }
if(x.RTC_T){
arr2.push((x.RTC_T))
}
if(x.V_MCU){
arr3.push(parseFloat(x.V_MCU))
}if (x.V_A1){
arr4.push(parseFloat(x.V_A1))
}if(x.V_A2){
arr5.push(parseFloat(x.V_A2))
}
})

$(function() {

var trace1 = {
  type: 'scatter',
  mode: 'lines',
  name: 'V_MCU',
  x: arr2,
  y: arr3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: 'scatter',
  mode: 'lines',
  name: 'V_IN',
  x: arr2,
  y: arr1,
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
      range:[0,8],
      dtick: 0.4,
     title: "Voltages"
  }
                      
};

Plotly.newPlot('vin_vmcu_10m', data, layout, {response:true});
});

$(function() {
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Insolation',
  x: arr2,
  y: arr4,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Insolation"
  }
};

Plotly.newPlot('insulation_sensor', data, layout, {response:true});
})

$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Wind Direction',
  x: arr2,
  y: arr5,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
          range:[0,5],
          dtick: 0.3,
      title: "Wind Direction (V_A2)"
  }
};

Plotly.newPlot('wind_direction_sensor', data, layout, {response:true});
})
$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Wind speed',
  x: arr2,
  y: arr4,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
          range:[0,5],
          dtick: 0.3,
      title: "Wind speed (V_A1)"
  }
};

Plotly.newPlot('windspeed_sensor', data, layout, {response:true});
})

var yy = {!! json_encode($y->toArray())!!};
    var r1 = [];
    var r2 =[];
    var r3=[];
    var r4=[];
  var   r5 =[];
yy.map(function(x){ 
if(x.V_IN){
r1.push (parseFloat(x.V_IN))
}
if(x.V_IN){

r2.push((x.RTC_T))}
if(x.V_MCU){

r3.push(parseFloat(x.V_MCU))}
if(x.V_A1){
r4.push(parseFloat(x.V_A1))}
if(x.P0_LST60){
r5.push(parseFloat(x.P0_LST60))
}
})
$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: r2,
  y: r3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: r2,
  y: r1,
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
      range:[0,5],
      dtick: 0.5,
      title: "Voltages"
  }
};

Plotly.newPlot('vin_vmcu_gnd', data, layout, {response:true});
})

$(function() {
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: r2,
  y: r3,
  line: {color: '#FF0000',
        width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Soil Temperature"
  }
};

Plotly.newPlot('soil_templature', data, layout, {response:true});
})

$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Soil moisture',
  x: r2,
  y: r4,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Soil moisture"
  }
};

Plotly.newPlot('soil_moisture', data, layout, {response:true});
})

$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Precipitation',
  x: r2,
  y: r5,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Precipitation"
  }
};

Plotly.newPlot('precipitation', data, layout, {response:true});
})



var zz = {!! json_encode($z->toArray())!!};
    var t1 = [];
    var t2 =[];
    var t3=[];
    var t4=[];
  var   t5 =[];
zz.map(function(x){ 
if(x.V_IN){
t1.push (parseFloat(x.V_IN))
}
if(x.RTC_T){

t2.push((x.RTC_T))}
if(x.V_MCU){

t3.push(parseFloat(x.V_MCU))}
if(x.P_MS5611){
t4.push(parseFloat(x.P_MS5611))}

})

$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: t2,
  y: t3,
  line: {color: '#008000',
         width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: t2,
  y: t1,
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
      range:[0,5],
      dtick: 0.5,
      title: "Voltages"
  }
};

Plotly.newPlot('vin_vmcu_sink', data, layout, {response:true});


});

$(function() {
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Pressure',
  x: t2,
  y: t4,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Pressure"
  }
};

Plotly.newPlot('pressure', data, layout, {response:true});

});
//start of the gateway
var mm = {!! json_encode($m->toArray())!!};
    var m1 = [];
    var m2 =[];
    var m3=[];
   
mm.map(function(x){ 
if(x.SOC){
m1.push (parseFloat(x.SOC))
}
if(x.RTC_T){

m2.push((x.RTC_T))}
if(x.V_BAT){

m3.push(parseFloat(x.V_BAT))}

})
$(function() {

var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'SOC',
  x:m2,
  y:m1,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "SOC"
  }
};

Plotly.newPlot('soc1', data, layout, {response:true});
});
$(function() {
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Battery',
  x: m2,
  y: m3,
  line: {color: '#008000',
         width: 1
  }
}


var data = [trace1];

var layout = {
  title: '',
  height:380,
  xaxis: {
      rangeslider:{},
      title: "Datetime"

  },
  yaxis: {
      title: "Battery voltage"
  }
};

Plotly.newPlot('battery', data, layout, {response:true});
})
//end of gateway

</script>
@endsection
       
