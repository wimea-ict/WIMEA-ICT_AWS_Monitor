<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                    <h3 class="panel-title">{{$heading}}</h3>
        </div>
        <div class="panel-body">
        <form action="{{$action}}" method="POST" id="report_form">
           {{csrf_field()}}
            <div class="form-group col-md-5 nopadding">

                <select class="form-control" name="id" id="station_id">
                    <option>--select station--</option>
                    @foreach ($stations as $station)
                        <option value="{{$station->station_id}}" {{(( (!empty($selected_station) && $selected_station==$station->station_id) || $loop->iteration==1 )?'selected':'')}} >{{$station->StationName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">

                <!-- <input type="submit" class="btn btn-primary" value="Choose" /> -->
            </div>

        </form>
        </div>
    </div><!--End panel-->
</div>
