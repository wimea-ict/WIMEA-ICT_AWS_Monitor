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
                            {{    " ".$stationTaken['Location']." Nodes performances"}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="tester" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>


 <?php

//=============================CALCULATING PACKET RECEPTION RATE============================================================
          //START
 //creating an array of the 4 Nodes
					 $Nodes=array('GroundNode','SinkNode','TwoMeterNode','TenMeterNode');
					 $array_of_min =array("1");

//--------------------------GETTING THE NUMBER OF EXPECTED PACKECTS FROM ALL NODES----------------------------------------
					 foreach($Reporting_intervals as $interval){
						 for($i=0; $i<4; $i++){
							 if($interval['Node']==$Nodes[$i]){
								 $result=json_encode($interval['cluster']);
								 $inter=(1440)/((int)$result[3]);
								  array_push($array_of_min,$inter);
							 }
						 }
					 }
						 $total_no_expected_in_24hrs= array_sum($array_of_min);
//=========================TOTAL PACKETS ACTUALLY REPORTED=================================================

					$total_packets_recieved = $packets_recieved_GND + $packets_recieved_SNK + $packets_recieved_TWN+$packets_recieved_TMN;
					$packet_reception_rate= ($total_packets_recieved*100)/$total_no_expected_in_24hrs;

				//	echo $packet_reception_rate;

          //END OF CALCULATION
 ?>

    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Statistics</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Measure</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
													<td>Packet reception rate</td>
													<td>{{round($packet_reception_rate,2)."%"}}</td>
													</tr>
													<tr>
													<td>Packet loss</td>
													<td>{{round(100-$packet_reception_rate,2)."%"}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Row -->


@endsection

@section('page_specific_script_files')

 <script src="assets/plotly/plotly-latest.min.js"></script> 
<script>
$(function() {
//====================================================================================================
TESTER = document.getElementById('tester');
var from_Db =<?php echo json_encode($axis); ?>;
var grd_occr = [];
var counts = [];
var arrGND =[];
var tnm_occr =[];
var tw_occr =[];
var snk_occr =[];
var arrKeys =[];
//var q;

//====================================================================================================

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
for(var t=0; t<from_Db.length; t++){
  if(from_Db[t].Problem =='GroundNode_off'){
		var time_r = new Date(from_Db[t].when_reported);
      	grd_occr.push(time_r.getHours());
   }

    if(from_Db[t].Problem =='TenMeterNode_off'){
    var time_tn = new Date(from_Db[t].when_reported);
        tnm_occr.push(time_tn.getHours());
   }

 if(from_Db[t].Problem =='TwoMeterNode_off'){
    var time_tw = new Date(from_Db[t].when_reported);
        tw_occr.push(time_tw.getHours());
   }


 if(from_Db[t].Problem =='SinkNode_off'){
    var time_sk = new Date(from_Db[t].when_reported);
        snk_occr.push(time_sk.getHours());
   }
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function contains(arr, element) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] === element) {
            return true;
        }
    }
    return false;
}
//____________________________________________________________________________________________________

function getFrequencies(array) {
   // const a = [5, 5, 5, 2, 2, 2, 2, 2, 9, 4];
    const result = {};
    for (let i = 0; i < array.length; ++i) { // loop over array
      if (!result[array[i]]){  // if no key for that number yet
        result[array[i]] = 0;  // then make one
      }
      ++result[array[i]];     // increment the property for that number
    }

    for(let key in result) {
              var value = array[key];
              //document.write("condition passed "+key + " = " + value + '<br>');
              arrKeys.push(parseInt(key));
         }
    for(let q = 0; q<24; q++){

          if(contains(arrKeys,q)){
              var val = array[q];
              //document.write("its in array "+val+" "+q+'<br>');
              arrGND.push(parseInt(val));
          }else{
              //document.write(q+'<br>');
              arrGND.push(parseInt(0));
          }
    }
    return arrGND;
}
//calling our function--------------------------------------------
var gnd_yaxis=getFrequencies(grd_occr);
arrGND =[];
var tnm_yaxis=getFrequencies(tnm_occr);
arrGND =[];
var tw_yaxis = getFrequencies(tw_occr);
arrGND=[];
var snk_yaxis =getFrequencies(snk_occr);

//____________________________________________________________________________________________________
	var trace1 = {
		type: 'scatter',
  x:  ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',  '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',  '18:00', '19:00', '20:00', '21:00', '22:00','23:00'],
  y: gnd_yaxis, //These are the y values
  mode: 'lines',
  name: 'GroundNode',
  marker: {color: 'rgb(139,69,19)'},
  line: {
  width: 2
  }
};

  var trace2 = {
    type: 'scatter',
  x:  ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',  '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',  '18:00', '19:00', '20:00', '21:00', '22:00','23:00'],
  y: tnm_yaxis, //These are the y values
  mode: 'lines',
  name: 'TenMeterNode',
  marker: {color: 'rgb(0,128,0)'},
  line: {
  width: 2
  }
};
  var trace3 = {
    type: 'scatter',
  x:  ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',  '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',  '18:00', '19:00', '20:00', '21:00', '22:00','23:00'],
  y: tw_yaxis, //These are the y values
  mode: 'lines',
  name: 'TwoMeterNode',
  marker: {color: 'rgb(255, 64, 0)'},
  line: {
  width: 2
  }
};

  var trace4 = {
    type: 'scatter',
  x:  ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00',  '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00',  '18:00', '19:00', '20:00', '21:00', '22:00','23:00'],
  y: snk_yaxis, //These are the y values
  mode: 'lines',
  name: 'SinkNode',
  marker: {color: 'rgb(0,0,255)'},
  line: {
  width: 2
  }
};

var layout = {
  xaxis: {
    title: 'Hours (24hrs)',
    gridwidth: 2
     },
  yaxis: {
    title: 'Frequency',
    showline: true
  }
};
	var data = [trace1,trace2,trace3,trace4]
	Plotly.plot( TESTER, data,layout );
});
</script>

@endsection

