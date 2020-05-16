<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')
<style>
#map {
 height:500px;
margin:0;
padding:0;
}
</style>
@endsection

@section('content')
<div class="row">

    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                    <div class="panel-heading">
                             <div>

		<table class="table table-bordered" id="datatable">
		<thead>  
			<tr>
				<th>station</th>
				<th>Problem </th>
				<th> when reported</th>
				<th> status </th>
				<th> Location  </th>
			</tr>
		 </thead>	
                @foreach($data as $row)
				@if(!empty($row->stationID))

					<tr>
				<td>{{$row->StationName}}</td>
				<td>{{$row->Problem}}</td>
				<td>{{$row->when_reported}}</td>
				<td>{{$row->status}}</td>
				<td>{{$row->Location}}</td>
			  </tr>
				@endif

                @endforeach
		</table>
        </div>            
            </div>    
              </div>                   
        </div>

    </div> <!-- End row -->
</div>


@endsection
@section('page_specific_script_files')


        
@endsection                
