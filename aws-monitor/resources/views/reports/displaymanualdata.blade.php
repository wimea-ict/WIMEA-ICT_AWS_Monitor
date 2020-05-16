<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Observationslip Data</h3>
            </div>
            <div class="panel-body">
                <table class="table table-sm table-hover" id="datatable">
                    <thead>
                        <th>Date</th>
                        <th>Time(Zulu)</th>
                        <th>Dry Bulb</th>
                        <th>Wet Bulb</th>
                    </thead>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{$row->Date}}</td>
                            <td>{{$row->TIME}}</td>
                            <td>{{$row->Dry_Bulb}}</td>
                            <td>{{$row->Wet_Bulb}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>        
    </div>

</div>

@endsection