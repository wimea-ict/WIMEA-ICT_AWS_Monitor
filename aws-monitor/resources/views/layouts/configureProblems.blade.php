@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Configure Station Problems</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <form id="" method="post" action="{{url('configureproblem')}}">
                            
                                    <div class="form-group clearfix">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Select Station</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="station_selected">
                                                @foreach($stations as $station)
                                                    <option value="{{$station['StationName']}}">{{$station['StationName']}}</option>
                                                @endforeach
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>   
                                <div class="row">
                           <div class="col-lg-12">
                            {{csrf_field()}}
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
                                                                                        <option selected>Critical</option>
                                                                                        
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="sorptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="probRptTime" name="soprobRptTime" value="8" type="number" class="form-control" value="">
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
                                                                                    <select class="form-control" name="lpcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="lprptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="occurencesConsider" >Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="occurencesConsider" name="lpoccurencesConsider" value="4" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="probRptTime" name="lpprobRptTime" type="number" value="8" class="form-control" value="">
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
                                                                                    <select class="form-control" name="nocriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="norptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="nooccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="occurencesConsider" name="nooccurencesConsider" value="4" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="noprobRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="moprobRptTime" name="noprobRptTime" value="8" type="number" class="form-control" value="">
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
                                                                                    <select class="form-control" name="ssocriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="ssorptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ssoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="occurencesConsider" name="ssoccurencesConsider" value="4" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ssoprobRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="probRptTime" name="ssoprobRptTime" type="number" value="8" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-8" aria-expanded="false" class="collapsed">
                                                                Missing sensor values
                                                               
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-8" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="mscriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select report method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="msrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="msoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="occurencesConsider" value="4" name="msoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="probRptTime">Reporting time interval(hours)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="probRptTime" value="8" name="msprobRptTime" type="number" class="form-control" value="">
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
                                                                                    <select class="form-control" name="iscriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="isrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="isoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="isoccurencesConsider" value="4" name="isoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="isprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="isprobRptTime" name="isprobRptTime" value="8" type="number" class="form-control" value="">
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
                                                                                    <select class="form-control" name="idcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="idrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="idoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="idoccurencesConsider" value="4" name="idoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="idprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="idprobRptTime" value="8" name="idprobRptTime" type="number" class="form-control" value="">
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
                                                        `                   <div class="form-group clearfix">
                                                                                <label class="col-sm-2 control-label">Select criticality state</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="nmcriticallity">
                                                                                        <option>Critical</option>
                                                                                        <option selected>Non Critical</option>
                                                                                    </select>
                                                                                </div>
                                                                                <label class="col-sm-2 control-label">Select repotrt method</label>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-control" name="nmrptmethod">
                                                                                        <option>sms</option>
                                                                                        <option selected>email</option>
                                                                                        <option>Both</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="nmoccurencesConsider">Occurences to Consider</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="nmoccurencesConsider" value="4" name="nmoccurencesConsider" type="number" class="form-control" value="">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="nmprobRptTime">Reporting time interval(hrs)</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="nmprobRptTime" value="8" name="nmprobRptTime" type="number" class="form-control" value="">
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
                                                <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

                    </div>    
                                
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                


@endsection