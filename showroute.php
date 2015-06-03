<script>

function drawIt{
map.drawRoute({
	
for (i=0;i<coordenadas.length-1;i++){
  origin: [coordenadas[i][0], coordenadas[i][1]],
  destination: [coordenadas[i+1][0], coordenadas[i+1][1]],
  travelMode: 'driving',
  strokeColor: '#131540',
  strokeOpacity: 0.6,
  strokeWeight: 6
};
});

};

<?php session_start();

include 'config.php';

$RouteID=$_GET['RouteID'];


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
	
}


echo 'var coordenadas = '.json_encode($coordenadas).';';

?>



</script>