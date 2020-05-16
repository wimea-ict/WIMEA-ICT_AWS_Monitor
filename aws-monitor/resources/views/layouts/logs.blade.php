@extends('main')

@section('content')

<!-- Wizard with Validation -->
<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panel panel-default">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <a href="{{URL::to('viewProblemLogFile')}}" target="_blank"><b class="btn btn-info">View problem log file</b></a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{URL::to('downloadProblemLogFile')}}"><b class="btn btn-link">Download problem log file</b></a>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <a href="{{URL::to('viewUserLogFile')}}" target="_blank"><b class="btn btn-info">View user log file</b></a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{URL::to('downLoadUserLogFile')}}"><b class="btn btn-link">Download user log file</b></a>

        </div>

    </div>
    
    
        
</div><!-- End row -->


@endsection