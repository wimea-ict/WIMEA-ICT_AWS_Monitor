@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Add Sensor</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" action="#" style="margin-bottom: 30px;">
                                    <div>
                                        <h3>Sensor Credentials</h3>
                                        <section>
                                           
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-2"> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                                Sensor Details
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseOne-2" class="panel-collapse collapse in"> 
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
                                        
                                    </div>
                                </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

                </div> <!-- End row -->
 @endsection
