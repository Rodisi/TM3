<?php session_start();

include 'config.php';
?>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="gmaps.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>
<script src="geocomplete/jquery.geocomplete.js"></script>
<script>

var map;

function initialize() {
	
	
function drawIt(){
map.drawRoute({
	
for (var i=0;i<coordenadas.length-1;i++){
  origin: [coordenadas[0][0], coordenadas[0][1]],
  destination: [coordenadas[1][0], coordenadas[1][1]],
  travelMode: 'driving',
  strokeColor: '#131540',
  strokeOpacity: 0.6,
  strokeWeight: 6
};
});

};

<?php

$RouteID=$_GET['RouteID'];
alert($RouteID);

$sql="Select MarkerID from marker_rota where RotaID='$RotaID'";
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
		
		alert($coordenadas);
	
}


echo 'var coordenadas = '.json_encode($coordenadas).';';

?>


    
        map = new GMaps({
	div: '#map-canvas',
	lat: 71.043333,
	lng: 77.028333,
        });
		
	};

</script>

</head>
<body>
<div id="route_map">



</div>
</body>
</html>