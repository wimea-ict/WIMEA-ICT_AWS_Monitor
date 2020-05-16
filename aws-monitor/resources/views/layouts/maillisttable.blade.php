@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mailing List - List of Mail Recipients. </h3> 
                </div>
                <div class="panel-body">
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                           
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
													<th>Options</th>
                                                                                                       
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
		                                  
                                            
                                             @foreach($user_email as $ue)
                                             @if($ue['status']==1)
                                                <tr>
                                                    <td>{{$ue['id']}}</td>
                                                    <td>{{$ue['Name']}}</td>
                                                    <td>{{$ue['email']}}</td>
                                                    <td>{{$ue['Location']}}</td>

                             <td><a href = "{{ URL::to('delete_mail/'.$ue['id']) }}" class= "btn btn-danger">Delete</a></td>
                            
                                                </tr>
                                                @endif
                                                @endforeach  
                
                                               
                                            
                                        

                                            </tbody>
                                        </table>
 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
