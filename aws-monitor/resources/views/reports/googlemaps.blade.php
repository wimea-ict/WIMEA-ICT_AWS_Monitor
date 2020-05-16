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
                            <div id="map">

             


        </div>            
            </div>    
              </div>                   
        </div>

    </div> <!-- End row -->
</div>


@endsection
@section('page_specific_script_files')
<script>
var locations_from_db = {!! json_encode($data->toArray())!!};
var labels = [];
var locations=[];
 
    for(var i=0; i<locations_from_db.length; i++){

    	//alert(locations_from_db.length)


    labels.push(locations_from_db[i].Location);
    locations.push({ lat: locations_from_db[i].Latitude, lng: locations_from_db[i].Longitude  });
     
    }
	console.log('1');

function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
	  center: {lat: 0.3499986, lng: 32.567164398}
        });

        // Create an array of alphabetical characters used to label the markers.
        //var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	// var labels = ['Juba', 'Mayuge'];
	console.log('2');

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
          });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      

</script>

     <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>

  
    <script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbZBuo64GuoE3Pf5RehrX_pnRS75l3K-Q&callback=initMap">
    </script> 
@endsection                
