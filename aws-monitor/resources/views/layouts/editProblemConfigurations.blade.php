@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Edit problem configurations</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Number</th>
                                                    <th>location</th>
                                                    <th>longitude</th>
                                                    <th>Latitude</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
{{--  'station_id', 'StationName', 'StationNumber', 'StationRegNumber', 'Location', 'Indicator', 'StationRegion', 'Country', 'Latitude', 'Longitude', 'Altitude', 'StationStatus', 'StationType', 'Opened', 'Closed', 'SubmittedBy', 'CreationDate','UpdateDate'  --}}
                                     
                                            <tbody>
                                            @foreach($stations as $station)
                                                <tr>
                                                    <td>{{$station['StationName']}}</td>
                                                    <td>{{$station['StationNumber']}}</td>
                                                    <td>{{$station['Location']}}</td>
                                                    <td>{{$station['Longitude']}}</td>
                                                    <td>{{$station['Latitude']}}</td>
                                                    <td><button class="btn btn-icon btn-success m-b-5 edit-station-button" data-toggle="modal" id="{{htmlspecialchars(json_encode(array($station, $problemConfigurationvalues)))}}" data-target="#full-width-modal7"  data-delete-link="" > <i class="fa fa-edit"></i> Edit </button></td>
                                                </tr>
                                                @endforeach    
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                <div id="full-width-modal7" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                           <div class="modal-body">
                           <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title btn btn-primary">Edit Station Problem configurations</h3> 
                            </div> 
                            <div class="panel-body">
                                <div class="row">
                                <form  method="post" action="{{url('updateProblemConfigurations')}}">
                                {{csrf_field()}}
                                    <input type="hidden" id="station_id" name="station_id"/>
                                    
                                    <div class="form-group clearfix">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Station</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="station_selected" name="station_selected" type="text" readonly>  
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                           <div class="col-lg-12">
                           
                                            <div class="panel-group panel-group-joined" id="accordion-test-3"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsethirteen-2" aria-expanded="false" class="collapsed" >
                                                                Station off

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsethirteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="socriticallity">
                                                                                        <option>Critical</option>
                                                                                        
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select report method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="sorptmethod" id="sorptmethod">
                                                                                        <option value="sms">sms</option>
                                                                                        <option value="email">email</option>
                                                                                        <option value="email">Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input  name="soprobRptTime" id="soprobRptTime" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                                                                                                           
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-6" aria-expanded="false" class="collapsed">
                                                                low node power values
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-6" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="lpcriticallity" id="lpcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select report method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="lprptmethod" id="lprptmethod">
                                                                                        <option>sms</option>
                                                                                        <option>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="occurencesConsider" >Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="lpoccurencesConsider" name="lpoccurencesConsider"  type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="lpprobRptTime" name="lpprobRptTime" type="number"  class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-5" aria-expanded="false" class="collapsed">
                                                                Node off
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-5" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="nocriticallity" id="nocriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="norptmethod" id="norptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="nooccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="nooccurencesConsider" name="nooccurencesConsider"  type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="noprobRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="noprobRptTime" name="noprobRptTime"  type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-7" aria-expanded="false" class="collapsed">
                                                                Sensor off
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-7" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="ssocriticallity" id="ssocriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="ssorptmethod" id="ssorptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ssoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ssoccurencesConsider" name="ssoccurencesConsider"  type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ssoprobRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ssoprobRptTime" name="ssoprobRptTime" type="number"  class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-8" aria-expanded="false" class="collapsed">
                                                            Sensor values are below range
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-8" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="mscriticallity" id="mscriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select report method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="msrptmethod" id="msrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="msoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input   id="msoccurencesConsider" name="msoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="msprobRptTime"  name="msprobRptTime" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-9" aria-expanded="false" class="collapsed">
                                                                Incorrect sensor values
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-9" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="iscriticallity" id="iscriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="isrptmethod" id="isrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="isoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input  id="isoccurencesConsider"  name="isoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="isprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="isprobRptTime" name="isprobRptTime"  type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-10" aria-expanded="false" class="collapsed">
                                                                Incorrect Date values
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-10" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="idcriticallity" id="idcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="idrptmethod" id="idrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="idoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="idoccurencesConsider"  name="idoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="idprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="idprobRptTime"  name="idprobRptTime" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>

                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-11" aria-expanded="false" class="collapsed">
                                                                Node Missing values
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-11" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="nmcriticallity" id="nmcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option  >Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="nmrptmethod" id="nmrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option  >email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="nmoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="nmoccurencesConsider"  name="nmoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="nmprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="nmprobRptTime"  name="nmprobRptTime" type="number" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>

                                                 <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-12" aria-expanded="false" class="collapsed">
                                                                Packet Dropping Problem
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-12" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        `                   <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="pdcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select report method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="pdrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option selected>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="pdoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="pdoccurencesConsider" value="4" name="pdoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="pdprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="pdprobRptTime" value="8" name="pdprobRptTime" type="number" class="form-control" value="">
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
                                   

                    </div>    
                                
                            </div>
                                </form>
                            </div>  <!-- End panel-body -->
                            
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

</div> <!-- End row -->
 

                                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

@endsection