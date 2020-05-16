@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ground Node configurations</h3>
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
                                            @foreach($groundNodes as $groundNode)
                                                @foreach($stations as $station)
                                                    @if($station['station_id']== $groundNode['station_id'] )
                                                    <tr>
                                                        <td>{{$station['StationName']}}</td>
                                                        <td>{{$station['Location']}}</td>
                                                        <td>{{$groundNode['txt_gnd']}}</td>
                                                        <td>{{$groundNode['e64_gnd']}}</td>
                                                        <td>{{$groundNode['node_status']}}</td>
                                                        <td><button class="btn btn-icon btn-success m-b-5" data-toggle="modal" data-target="#full-width-modal4" id="{{htmlspecialchars(json_encode(array($groundNode,$precipitationsensors,$soilTempsensors,$soilMoisturesensors)))}}"> <i class="fa fa-edit"></i> Edit </button></td>
                                                    </tr>
                                                    <div id="full-width-modal4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header"> 
                                <h3 class="panel-title btn btn-primary">Edit Ground Node settings</h3> 
                            </div>
                           <div class="modal-body">
                           <div class="row">
                           <div class="col-lg-12">
                           <form novalidate method="post" action="{{url('updateGroundNode')}}">
                           {{csrf_field()}}
                           <input type="hidden" name="gndnode_id" id="gndnode_id"/>
                                            <div class="panel-group panel-group-joined" id="accordion-test-4"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapsenight-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsenight-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndtxt_value">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndtxt_value" name="gndtxt_value" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6 control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="gndnode_status" id="gndnode_status">
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndvin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndvin_label" name="gndvin_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndtxt_key" name="gndtxt_key" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_max_value" name="gdv_mcu_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_min_value" name="gdv_mcu_min_value" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_in_max_value" name="gdv_in_max_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_label" name="gdv_mcu_label" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndmac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndmac_add" name="gndmac_add" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndv_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndv_in_min_value" name="gndv_in_min_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndgwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndgwlat" name="gndgwlat" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndgwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndgwlong" name="gndgwlong" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                           
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndrssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndrssi" name="gndrssi" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndlqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndlqi" name="gndlqi" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gnddrp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gnddrp" name="gnddrp" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndttl" name="gndttl" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gnddate">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gnddate" name="gnddate" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="grndtime">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="grndtime" name="grndtime" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="groundps">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundps" name="groundps" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="groundpo">PO key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundpo" name="groundpo" type="text" class="form-control" value="">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            

                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndps">UP key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndup" name="gndup" type="text" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndut">UT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndut" name="gndut" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndps">Box Temperature key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndt" name="gndt" type="text" class="form-control" >
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndps">V A2 key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_a2" name="v_a2" type="text" class="form-control" >
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapseten-2" aria-expanded="false" class="collapsed">
                                                                Rainfall sensor
                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseten-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="pprptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="pprptTime" name="pprptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="ppsensor_status" id="ppsensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ppparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppparameter_read" name="ppparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ppidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppidentifier_used" name="ppidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ppmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppmax_value" name="ppmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ppmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppmin_value" name="ppmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapseeleven-2" class="collapsed" aria-expanded="false">
                                                                Soil temperature sensor

                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseeleven-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="strptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="strptTime" name="strptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="stsensor_status" id="stsensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="stparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stparameter_read" name="stparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="stidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stidentifier_used" name="stidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="stmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stmax_value" name="stmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="stmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stmin_value" name="stmin_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapsetweleve-2" class="collapsed" aria-expanded="false">
                                                                Soil moisture sensor
                                                                
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsetweleve-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                    
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="smrptTime">Report time interval</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smrptTime" name="smrptTime" type="text" class="form-control" required>
                                                                                </div>
                                                                                <div class="col-sm-6  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="smsensor_status" id="smsensor_status" >
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="smparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smparameter_read" name="smparameter_read" type="text" class="form-control" value="" readonly>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="smidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smidentifier_used" name="smidentifier_used" type="text" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="smmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smmax_value" name="smmax_value" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="smmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smmin_value" name="smmin_value" type="number" class="form-control" value="">
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
                                        </div>
                                    

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