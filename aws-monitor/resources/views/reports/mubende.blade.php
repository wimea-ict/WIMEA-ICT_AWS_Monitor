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

    {{--  <script src="assets/plotly/plotly-latest.min.js"></script>  --}}

<script>

$(function() {
//10 meter node
Plotly.d3.csv("files/mubende_10m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_MCU'),
  line: {color: '#008000',
	 width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_IN'),
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

Plotly.newPlot('vin_vmcu_10m', data, layout, {response:true});
})


Plotly.d3.csv("files/mubende_10m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Wind speed',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'P0_LST60'),
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
      title: "Wind speed"
  }
};

Plotly.newPlot('windspeed_sensor', data, layout, {response:true});
})


Plotly.d3.csv("files/mubende_10m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Wind Direction',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'Degree_WD'),
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
      title: "Wind Direction in degrees"
  }
};

Plotly.newPlot('wind_direction_sensor', data, layout, {response:true});
})


Plotly.d3.csv("files/mubende_10m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Insolation',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_A1'),
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
//end of 10 meter node


//2 meter node
Plotly.d3.csv("files/mubende_2m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_MCU'),
  line: {color: '#008000',
	 width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_IN'),
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
      range:[0,6],
      dtick: 0.6,
      title: "Voltages"
  }
};

Plotly.newPlot('vin_vmcu_2m', data, layout, {response:true});
})


Plotly.d3.csv("files/mubende_2m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Temperature',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'Temperature'),
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
      title: "Temperature"
  }
};

Plotly.newPlot('templature', data, layout, {response:true});
})


Plotly.d3.csv("files/mubende_2m.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'R_Humidity'),
  line: {color: '#0000FF',
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
//end of 2 meter node

//ground node
Plotly.d3.csv("files/mubende_gnd.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_MCU'),
  line: {color: '#008000',
	 width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_IN'),
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


Plotly.d3.csv("files/mubende_gnd.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'Temperature'),
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


Plotly.d3.csv("files/mubende_gnd.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Soil moisture',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_A1'),
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


Plotly.d3.csv("files/mubende_gnd.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Precipitation',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'PO_LST60'),
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
// end of ground node

//sink node
Plotly.d3.csv("files/mubende_sink.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_MCU'),
  line: {color: '#008000',
	 width: 1
  }
}

var trace2 = {
  type: "scatter",
  mode: "lines",
  name: 'V_IN',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_IN'),
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
})
//end of sink node

//gateway
Plotly.d3.csv("files/mubende_elec.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'SOC',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'SOC'),
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
})


Plotly.d3.csv("files/mubende_elec.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}


var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'Battery',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_BAT'),
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


});

</script>

@endsection
