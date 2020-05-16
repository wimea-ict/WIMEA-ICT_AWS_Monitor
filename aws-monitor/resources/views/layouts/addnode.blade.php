@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Add Node</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" action="#" style="margin-bottom: 30px;">
                                    <div>
                                        
                                        <h3>Nodes Credentials</h3>
                                        <section>
                                        <div class="col-lg-12"> 
                                                    <div class="panel-group panel-group-joined" id="accordion-test"> 
                                                        <div class="panel panel-default"> 
                                                            <div class="panel-heading"> 
                                                                <h4 class="panel-title"> 
                                                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                                        Node Details
                                                                    </a> 
                                                                </h4> 
                                                            </div> 
                                                            <div id="collapseOne" class="panel-collapse collapse in"> 
                                                                <div class="panel-body">
                                                                <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Makerere Station</option>
                                                                                        <option>Mbarara Station</option>
                                                                                        <option>Lyantonde Station</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="userName2">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nname" name="nname" type="text">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="userName2">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nnumber" name="nnumber" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="mcaddress" name="mcaddress" type="text" class="form-control">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>

                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-12 control-label">Node Status configurations</label>
                                                                                
                                                                            </div>

                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_label" name="v_in_label" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_title" name="v_in_key_title" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_value" name="v_in_key_value" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="region" name="v_in_min_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_max_value" name="v_in_max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_label" name="v_mcu_label" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_title" name="v_mcu_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_value" name="v_mcu_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_max_value" name="v_mcu_max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_min_value" name="v_mcu_min_value" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                </div> 
                                                            </div> 
                                                        </div> 
                                                         
                                                    </div> 
                                                </div> 

                                        </section>
                                        <h3>Sensor Credentials</h3>
                                        <section>
                                        <div class="form-group clearfix">
                                                <label class="col-lg-4 col-lg-offset-3 control-label" for="">Number of Sensors on the Station</label>
                                                <div class="col-lg-4">
                                                    <input class="form-control" id="sensors" name="sensors" type="number">
                                                </div>
                                                
                                        </div>    
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-2"> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                                Sensor 1
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseOne-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                                Sensor 2
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseTwo-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                            <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>    
                                                        </div> 
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                                                Sensor 3
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseThree-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 col-lg-offset-4">
                                                                                    <select class="form-control">
                                                                                        <option>Node 1</option>
                                                                                        <option>Node 2</option>
                                                                                        <option>Node 3</option>
                                                                                        
                                                                                    </select>
                                                                                    </div>
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control">
                                                                                </div>
                                                                    </div>    
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>   
                                        </section>
                                        <h3>Step Final</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                    <label for="acceptTerms-2">Submit the Station the details.</label>
                                                </div>
                                            </div>

                                        </section>
                                    </div>
                                </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->
 @endsection
