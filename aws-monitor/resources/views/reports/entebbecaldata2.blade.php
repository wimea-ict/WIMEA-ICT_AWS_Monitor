<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Calibrated Humidity Data</h3>
            </div>
            <div class="panel-body">
                <table class="table table-sm table-hover" id="datatable">
                    <thead>
                        <th>Datetime</th>
                        <th>WIMEA humidity</th>
                        <th>WIMEA humidity (calibrated)</th>
                        <th>UNMA humidity</th>
                    </thead>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->datetime}}</td>
                            <td>{{$row->wimea_original_humidity}}</td>
                            <td>{{$row->wimea_calibrated_humidity}}</td>
                            <td>{{$row->unma_original_humidity}}</td>
                        </tr>                        
                    @endforeach
                </table>
            </div>            
        </div>                
    </div>

</div>

@endsection
