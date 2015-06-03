<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="gmaps.js"></script>
</head>
<body>


<?php

include 'config.php';
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

$(document).ready(function(){
	
url = GMaps.staticMapURL({
  size: [800, 800],
  lat: coordenadas[0][0],
  lng: coordenadas[0][1],
  zoom:3,
  polyline: {
	  path: coordenadas,
	  strokeColor: "#000000",
	  strokeWeight: 10,
	  strokeOpacity:1,
	  
  }
});

$('<img/>').attr('src', url)
  .appendTo('#map2');




});

</script>


<div id="map2"></div>
</body>
</html>