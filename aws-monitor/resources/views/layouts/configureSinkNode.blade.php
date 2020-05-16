@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sink Node configurations</h3>
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
                                            @foreach($sinkNodes as $sinkNode)
                                                @foreach($stations as $station)
                                                    @if($station['station_id']== $sinkNode['station_id'] )
                                                    
                                                    <tr>
                                                        <td>{{$station['StationName']}}</td>
                                                        <td>{{$station['Location']}}</td>
                                                        <td>{{$sinkNode['txt_sink']}}</td>
                                                        <td>{{$sinkNode['e64_sink']}}</td>
                                                        <td>{{$sinkNode['node_status']}}</td>
                                                        <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal5" id="{{htmlspecialchars(json_encode(array($sinkNode, $pressuresensors)))}}"> <i class="fa fa-edit"></i> Edit </button></td>
                                                    </tr>
                                                    <div id="full-width-modal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header"> 
                                <h3 class="panel-title btn btn-primary">Edit Sink Node settings</h3> 
                            </div>
                           <div class="modal-body">
                           <div class="row">
                           <div class="col-lg-12">
                            <form id="" method="post" action="{{url('updateSinkNode')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="sinknode_id" id="sinknode_id"/>
                                            <div class="panel-group panel-group-joined" id="accordion-test-3"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsethirteen-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsethirteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinktxt_value">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinktxt_value" name="sinktxt_value" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6 control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="sinknode_status" id="sinknode_status">
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkvin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkvin_label" name="sinkvin_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinktxt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinktxt_key" name="sinktxt_key" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_max_value" name="sinkv_mcu_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_min_value" name="sinkv_mcu_min_value" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_in_max_value" name="sinkv_in_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_label" name="sinkv_mcu_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkmac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkmac_add" name="sinkmac_add" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_in_min_value" name="sinkv_in_min_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkgwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkgwlat" name="sinkgwlat" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkgwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkgwlong" name="sinkgwlong" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                           
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkrssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkrssi" name="sinkrssi" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinklqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinklqi" name="sinklqi" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkdrp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkdrp" name="sinkdrp" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkttl" name="sinkttl" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkdate">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkdate" name="sinkdate" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinktime">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinktime" name="sinktime" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkps">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkps" name="sinkps" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkut">UT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkut" name="sinkut" type="text" class="form-control" value="">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                
                                                                                <label class="col-lg-2 control-label " for="sinkup">UP key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkup" name="sinkup" type="text" class="form-control" value="">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            

                                                                                                                                                           
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-2" aria-expanded="false" class="collapsed">
                                                                Pressure sensor
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="psrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psrptTime" name="psrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="pssensor_status" id="pssensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="psparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psparameter_read" name="psparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="psidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psidentifier_used" name="psidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="psmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psmax_value" name="psmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="psmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psmin_value" name="psmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                
                                            </div> 
                                        </div>
                                        <div class="modal-footer">
                                                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

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