<?php session_start();

include 'config.php';
?>
<html>
<head>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>
<script src="geocomplete/jquery.geocomplete.js"></script>
<style>
      html, body, #route_map {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>



<?php

$RouteID=$_GET['RouteID'];


$sql="Select MarkerID from marker_rota where RotaID='$RouteID'";
$result=mysqli_query($link,$sql);

$marcadores=array();

while($row = mysqli_fetch_array($result)){
	
	$marcadores[]=$row['MarkerID'];
	
}

$tamanho=count($marcadores);
$coordenadas=array();

for ($i=0;$i<$tamanho;$i++){
	
	$MarkerID=$marcadores[$i];
	$sql="Select lat, lon from marker where MarkerID='$MarkerID'";
	$result=mysqli_query($link,$sql);
	
		while($row = mysqli_fetch_array($result)){
			$coordenadas[]=array($row['lat'],$row['lon']);
			
		}
		
	
	
}
?>



<script>
    
<?php
	
	
echo 'var coordenadas = '.json_encode($coordenadas).';';

?>

var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
function initialize() {
	
	directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });
	var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(coordenadas[0][0], coordenadas[0][0])
	};
	map = new google.maps.Map(document.getElementById('route_map'),
      mapOptions);
	  directionsDisplay.setMap(map);
	  var flightPlanCoordinates = [];
	  
	  for (i = 0; i < coordenadas.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(coordenadas[i][0], coordenadas[i][1]),
        map: map
      });
      flightPlanCoordinates.push(marker.getPosition());
	  }
	  
	  // directions service configuration
    var start = flightPlanCoordinates[0];
    var end = flightPlanCoordinates[flightPlanCoordinates.length - 1];
    var waypts = [];
    for (var i = 1; i < flightPlanCoordinates.length - 1; i++) {
      waypts.push({
        location: flightPlanCoordinates[i],
        stopover: true
      });
    }
    calcRoute(start, end, waypts);
}
function calcRoute(start, end, waypts) {
  var request = {
    origin: start,
    destination: end,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING
  };
  
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions_panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    }
  });
	
}	
google.maps.event.addDomListener(window, 'load', initialize);  


</script>

</head>
<body>
<div id="route_map">



</div>
</body>
</html>