<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Ten Meter Node Data</h3>
            </div>
            <div class="panel-body">
                <table class="table table-sm table-hover" id="datatable">
                    <thead>
                        <th>Datetime</th>
                        <th>Name</th>
                        <th>V_A1</th>
                        <th>V_A2</th>
                        <th>Wind direction</th>
                        <th>Solar Insolation</th>
                    </thead>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->RTC_T}}</td>
                            <td>{{$row->NAME}}</td>
                            <td>{{$row->V_A1}}</td>
                            <td>{{$row->V_A2}}</td>
                            <td>{{$row->P0_LST60}}</td>
                            <td>{{$row->V_AD1}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>            
        </div>        
    </div>   
</div>

@endsection