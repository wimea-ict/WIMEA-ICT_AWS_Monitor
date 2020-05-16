<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Calibrated Pressure Data</h3>
            </div>
            <div class="panel-body">
                <table class="table table-sm table-hover" id="datatable">
                    <thead>
                        <th>Datetime</th>
                        <th>WIMEA pressure</th>
                        <th>WIMEA pressure (calibrated)</th>
                        <th>UNMA pressure</th>
                    </thead>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->datetime}}</td>
                            <td>{{$row->wimea_original_pressure}}</td>
                            <td>{{$row->wimea_calibrated_pressure}}</td>
                            <td>{{$row->unma_original_pressure}}</td>
                        </tr>                        
                    @endforeach
                </table>
            </div>            
        </div>                
    </div>

</div>

@endsection
