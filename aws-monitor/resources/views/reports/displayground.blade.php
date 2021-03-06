<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Ground Node Data</h3>
            </div>
            <div class="panel-body">
                <table class="table table-sm table-hover" id="datatable">
                    <thead>
                        <th>Datetime</th>
                        <th>Name</th>
                        <th>Rainfall(In Tips)</th>
                        <th>Temperature</th>
                    </thead>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->RTC_T}}</td>
                            <td>{{$row->NAME}}</td>
                            <td>{{$row->P0_LST60}}</td>
                            <td>{{$row->T1}}</td>
                        </tr>                        
                    @endforeach
                </table>
            </div>            
        </div>                
    </div>

</div>

@endsection