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
                <h3 class="panel-title">Problems</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-sm table-hover table-bordered" style="margin-bottom: 30px;">
                        <thead class="thead-light">
                            <th scope="col">STATION NAME</th>
                            <th scope="col">SOURCE</th>
                            <th scope="col">CRITICALITY</th>
                            <th scope="col">PROBLEM </th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DATE (1ST OCCURRENCE)</th>
                            <th scope="col">Lasted For</th>
                        </thead>
                        @foreach($data as $dt)
                            @foreach($problems as $problem)
                                @if($problem->id === $dt->classification_id)
                                    <tr>
                                        <td>{{$dt->stn_name}}</td>
                                        @if(!empty($dt->parameter_read))
                                            <td>{{$dt->parameter_read ." - ". $dt->source}}</td>
                                        @else
                                            <td>{{$dt->source}}</td>
                                        @endif
                                        <td>{{ $dt->criticality }}</td>
                                        <td>{{ $problem->problem_description }}</td>
                                        <td>{{ $dt->status }}</td>
                                        <td>{{ $dt->created_at }}</td>
                                        <td>{{ $dt->lasted_for }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div> <!-- End panel-body -->
        </div><!-- End panel -->
</div><!-- End row -->


@endsection