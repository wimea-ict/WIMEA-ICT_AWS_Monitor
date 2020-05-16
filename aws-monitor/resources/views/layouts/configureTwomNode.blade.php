@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">2m Node configurations</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Station Name</th>
                                                    <th>Station Location</th>
                                                    <th>MAC Address</th>
                                                    <th>Txt key</th>
                                                    <th>Activation Status</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>

                                     {{--  StationName  Location  --}}
                                            <tbody>
                                            @foreach($twoMeterNodes as $twoMeterNode)
                                                @foreach($stations as $station)
                                                    @if($station['station_id']== $twoMeterNode['station_id'] )
                                                    <tr>
                                                        <td>{{$station['StationName']}}</td>
                                                        <td>{{$station['Location']}}</td>
                                                        <td>{{$twoMeterNode['txt_2m']}}</td>
                                                        <td>{{$twoMeterNode['e64_2m']}}</td>
                                                        <td>{{$twoMeterNode['node_status']}}</td>
                                                        <td><button class="btn btn-icon btn-success m-b-5"  data-toggle="modal" data-target="#full-width-modal3" id="{{htmlspecialchars(json_encode(array($twoMeterNode,$relativeHumiditysensors,$Temperaturesensors)))}}"> <i class="fa fa-edit"></i> Edit </button></td>
                                                    </tr>
                                                    <div id="full-width-modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header"> 
                                <h3 class="panel-title btn btn-primary">Edit 2m Node settings</h3> 
                            </div>
                           <div class="modal-body">
                           <div class="row">
                    <div class="col-md-12">
                    <form id="" method="post" action="{{url('updateTwoMNode')}}">
                                
                        <div class="panel panel-default">
                             
                            <div class="panel-body"> 
                                    <div>
                                    {{csrf_field()}}
                                    <input type="hidden" name="2mnode_id" id="2mnode_id"/>
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-5"> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapsesix-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsesix-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2txt_value">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2txt_value" name="2txt_value" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6 control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="2mnode_status" id="2mnode_status">
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mvin_label">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mvin_label" name="2mvin_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_in_min_value">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_min_value" name="2mv_in_min_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2gwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2gwlat" name="2gwlat" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2gwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2gwlong" name="2gwlong" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_max_value" name="2mv_in_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_label" name="2mv_mcu_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_max_value" name="2mv_mcu_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_min_value" name="2mv_mcu_min_value" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2rssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2rssi" name="2rssi" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2lqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2lqi" name="2lqi" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2drp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2drp" name="2drp" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2ttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2ttl" name="2ttl" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2date">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2date" name="2date" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2time">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2time" name="2time" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2ut">Time type label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2ut" name="2ut" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2txt_key" name="2txt_key" type="text" class="form-control" value="">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                
                                                                                <label class="col-lg-2 control-label " for="2mac_add">Mac address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mac_add" name="2mac_add" type="text" class="form-control" value="">
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            
                                                                                                                                                         
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapseseven-2" aria-expanded="false" class="collapsed">
                                                                Relative humidity sensor
                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseseven-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhrptTime" name="rhrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="rhsensor_status" id="rhsensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhparameter_read" name="rhparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="rhidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhidentifier_used" name="rhidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhmax_value" name="rhmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="rhmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhmin_value" name="rhmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapseeight-2" class="collapsed" aria-expanded="false">
                                                                Temperature Sensor

                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseeight-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsrptTime" name="tsrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="tssensor_status" id="tssensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsparameter_read" name="tsparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="tsidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsidentifier_used" name="tsidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                           
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsmax_value" name="tsmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="tsmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsmin_value" name="tsmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                 
                                            </div> 
                                        </div>
                                        

                                        
                                        
                                    </div>
                                
                                
                            </div>  <!-- End panel-body -->
                            
                        </div> <!-- End panel -->
                        <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>        
                    </div> <!-- end col -->

</div> <!-- End row -->
 

                                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                                                    @endif
                                                @endforeach    
                                            @endforeach   
                                                
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                

@endsection