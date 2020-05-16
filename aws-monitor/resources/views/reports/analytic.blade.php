<!--page_specific_css_files  page_specific_script_files-->

@extends('main')
@section('page_specific_css_files')
<style>
#map {
 height:500px;
margin:0;
padding:0;
}
</style>
@endsection

@section('content')
<div class="row">
<!--<table align="left" border="1" cellpadding=" " cellspacing="2" class="table">-->


<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select AWS Statistics
  <span class="caret"></span></button>

<ul class="dropdown-menu">



<?php
  foreach($stations as $station) {

  ?>


  <div>
      <li class="active"><a class=".btn-primary " href="{{URL::to('selected_aws/'.$station['station_id']) }}"> 
          <?php
              echo $station['Location'];
          ?>
      </a></li>
  </div>
<?php 

}
?>

</ul>  
</div>


<!--</table>-->
</div>

<!--<div class="row">-->

    <!-- Accordions -->
    <!--<div class="row">-->
<div class="row">
<div class="col-lg-12">
    <div class="panel-group" id="accordion-test-2">
          <div class="panel panel-default">
                <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                Stations Performances
                            </a>
                        </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">

                    <div id="vin_vmcu_2m" style="height: 500px;"  class="text-center"></div>
                        </div>
                </div>
          </div>
    </div> <!-- End row -->
</div> <!-- End row -->
</div>



<div class="row">
<div class="col-lg-12">
    <div class="panel-group" id="accordion-test-2">
          <div class="panel panel-default">
                <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                              AWS Problems in the past week
                            </a>
                        </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">

                    <div id="vin_vmcu_10m" style="height: 500px;"  class="text-center"></div>
                        </div>
                </div>
          </div>
    </div> <!-- End row -->
</div> <!-- End row -->
</div>


@endsection
@section('page_specific_script_files')

<!-- {{--  <script src="assets/plotly/plotly-latest.min.js"></script>  --}} -->

<script>

$(function() {


//2 meter node
Plotly.d3.csv("files/test.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}

/*
var trace1 = {
  type: "scatter",
  mode: "lines",
  name: 'V_MCU',
  x: unpack(rows, 'Date'),
  y: unpack(rows, 'V_MCU'),
  line: {color: '#008000',
	 width: 1
  }
}*/

var trace2 = {
  type: "bar",
  //mode: "bar",
  name: 'V_IN',
       marker: {color: 'rgb(55, 83, 109)'},
  x: unpack(rows, 'stations'),
  y: unpack(rows, 'often_off'),
  line: {color: '#0000FF',
	 width: 1
  }
}

var data = [trace2];

var layout = {
  title: '',
  height:500,
  xaxis: {
      //rangeslider:{},
      title: "Stations"

  },
  yaxis: {
      title: "Frequency (up_time)"
  }
};

Plotly.newPlot('vin_vmcu_2m', data, layout, {response:true});
})



//10 meter node
Plotly.d3.csv("files/awsproblems.csv", function(err, rows){

  function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}

/*
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
*/

var trace2 = {
  type: "pie",
  //mode: "lines",
  name: 'V_IN',
    marker: {color: 'rgb(55, 83, 109)'},
  labels: unpack(rows, 'Problems'),
  values: unpack(rows, 'Frequency'),
  line: {color: '#0000FF',
  hole: .4
	// width: 1
	 
	 }
}

var data = [trace2];

var layout = {
  title: '',
  height:500,
  xaxis: {
      //rangeslider:{},
      title: "Problems"

  },
  yaxis: {
      title: "Frequency"
  }
};

Plotly.newPlot('vin_vmcu_10m', data, layout, {response:true});
})

});


</script>


        
@endsection                
