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
var ultimoindex = (coordenadas.length)-1;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(coordenadas[0][0], coordenadas[0][0])
	};
	map = new google.maps.Map(document.getElementById('route_map'),
      mapOptions);
	  directionsDisplay.setMap(map);
        calcRoute();
}

	function calcRoute() {
		alert("tou no calcRoute");
	var start = new google.maps.LatLng(coordenadas[0][0],coordenadas[0][1]); // Route path starting piont (Address).
	var end = new google.maps.LatLng(coordenadas[ultimoindex][0],coordenadas[ultimoindex][1]); // Route path ending point.
	var waypts = new Array(); // Array to store waypoints.
		
		for (var i =0;i<coordenadas.length;i++){
			alert("tou no for");
			
		waypts.push({
			location:new google.maps.LatLng(coordenadas[i][0],coordenadas[i][1]),
			stopover:true
			
		});
		document.write(coordenadas[i][0],coordenadas[i][1]);
		
		document.write(waypts);
		}
		
		
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