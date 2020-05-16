<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div class="row">

    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Import Excel FIle in Laravel</h3>
                    </div>
                </br>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                
                @if($message = Session::get("success"))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{$message}}</strong>
                </div>
                @endif
                <div class="panel-body">
                    <form method="post" action="{{url('upload')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td width="" align="right"><label>Select File for Upload</label></td>
                                    <td width=""></td>
                                    <td width="30%" align="left"><input type="file" name="select_file">
                                    </td>
                                    <td width="30%" align="left">
                                    <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    
                    </form>

                </div>
            </div>
            </br>
 <!--           <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Weather Data</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <tr>
                                <th>Datetime</th>
                                <th>Relative Humidity(WIMEA)</th>
                                <th>Relative Humidity(UNMA)</th>
                                <th>Solar Intensity(WIMEA)</th>
                                <th>Solar Intensity(UNMA)</th>
                                <th>Temperature(WIMEA)</th>
                                <th>Temperature(UNMA)</th>
                                <th>Pressure(WIMEA)</th>
                                <th>Pressure(UNMA)</th>
                                <th>Station</th>                                
                            </tr>
                            {{--@foreach ($data as $row)
                            <tr>
                                <td>{{$row->datetime}}</td>
                                <td>{{$row->rh_wimea}}</td>
                                <td>{{$row->rh_unma}}</td>
                                <td>{{$row->sol_wimea}}</td>
                                <td>{{$row->sol_unma}}</td>
                                <td>{{$row->temp_wimea}}</td>
                                <td>{{$row->temp_unma}}</td>
                                <td>{{$row->press_wimea}}</td>
                                <td>{{$row->press_unma}}</td>
                                <td>{{$row->station}}</td>
                            </tr>
                            @endforeach--}}
                        </table> 
                    </div>    
                </div>
            </div>    

                </div>    
                            
        </div>

    </div> 
</div>
-->
@endsection                
