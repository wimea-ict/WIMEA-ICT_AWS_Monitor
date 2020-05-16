@extends('main')

@section('content')
{{-- some js to enable data table --}}
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script> --}}
{{-- source, source_id, criticality, classification_id, track_counter, status --}}
<!-- Wizard with Validation -->
<div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel panel-default">
            <div class="panel-heading"> 
                <h3 class="panel-title">Table showing the users of the system</h3> 
            </div> 
            <div class="panel-body">
                @if (isset($success))
                    <div class="alert alert-success"><?= $success ?></div>
                @elseif (isset($successEdit))
                    <div class="alert alert-success"><?= $successEdit ?></div>
                @elseif (isset($registerUser))
                    <div class="alert alert-success"><?= $registerUser ?></div>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-sm table-hover table-bordered" style="margin-bottom: 30px;">
                        <thead class="thead-light">
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Options</th>
                        </thead>    
                        @foreach($users as $user)
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td><a href = "{{ URL::to('edit_users/'.$user->id) }}" class= "btn btn-warning">Edit</a>
                            <a href = "{{ URL::to('delete_users/'.$user->id) }}" class= "btn btn-danger">Delete</a></td>
                            <!--<td><button type = "submit" name = "remove">Remove</button></td>-->
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div> <!-- End panel-body -->
        </div><!-- End panel -->
</div><!-- End row -->
@endsection