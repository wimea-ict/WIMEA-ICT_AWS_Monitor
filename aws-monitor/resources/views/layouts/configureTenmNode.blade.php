@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">10m Node configurations</h3>
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
                                     
                                            <tbody>
                                            @foreach($tenMeterNodes as $tenMeterNode)
                                                @foreach($stations as $station)
                                                    @if($station['station_id']== $tenMeterNode['station_id'] )
                                                    <tr>
                                                        <td>{{$station['StationName']}}</td>
                                                        <td>{{$station['Location']}}</td>
                                                        <td>{{$tenMeterNode['txt_10m']}}</td>
                                                        <td>{{$tenMeterNode['e64_10m']}}</td>
                                                        <td>{{$tenMeterNode['node_status']}}</td>
                                                        <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal2" id="{{htmlspecialchars(json_encode(array($tenMeterNode, $insulationsensors,$windspeedsensors, $winddirectionsensors))) }}" > <i class="fa fa-edit" ></i> Edit </button></td>
                                                    </tr>
                                                    <div id="full-width-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header"> 
                                <h3 class="panel-title btn btn-primary">Edit 10m Node settings</h3> 
                            </div>
                           <div class="modal-body">
                           <div class="row">
                    <div class="col-md-12">
                    <form id="" method="post" action="{{url('updateTenMNode')}}">
                            
                        <div class="panel panel-default">
                             
                            <div class="panel-body"> 
                                    <div>
                                    {{csrf_field()}}
                                    <input type="hidden" name="10node_id" id="10node_id"/>
                                    <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-2"> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapsefour-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefour-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10txt_value">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10txt_value" name="10txt_value" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6 control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="10mnode_status" id="10mnode_status">
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10vin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10vin_label" name="10vin_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10txt_key" name="10txt_key" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10mac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10mac_add" name="10mac_add" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_min_value" name="10v_in_min_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_in_max_value">v_in max value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_max_value" name="10v_in_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_label" name="10v_mcu_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10gwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10gwlat" name="10gwlat" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10gwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10gwlong" name="10gwlong" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_max_value">v_mcu max value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_max_value" name="10v_mcu_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_min_value">v_mcu min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_min_value" name="10v_mcu_min_value" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10rssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10rssi" name="10rssi" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10lqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10lqi" name="10lqi" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10drp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10drp" name="10drp" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10ttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10ttl" name="10ttl" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10date">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10date" name="10date" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10time">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10time" name="10time" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10ps">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10ps" name="10ps" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10ut">UT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10ut" name="10ut" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                                Insolation sensor
                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseOne-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10rptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10rptTime" name="10rptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="10sensor_status" id="10sensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10parameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10parameter_read" name="10parameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10identifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10identifier_used" name="10identifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10max_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10max_value" name="10max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10min_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10min_value" name="10min_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                                wind speed Sensor

                                                               
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseTwo-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsrptTime" name="wsrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="wssensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsparameter_read" name="wsparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wsidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsidentifier_used" name="wsidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsmax_value" name="wsmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wsmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsmin_value" name="wsmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div> 
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                                                wind Direction sensor
                                                                
                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseThree-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wdrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdrptTime" name="wdrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="wdsensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wdparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdparameter_read" name="wdparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wdidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdidentifier_used" name="wdidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdmax_value" name="wdmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wdmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdmin_value" name="wdmin_value" type="number" class="form-control" value="">
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