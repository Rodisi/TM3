<?php
session_start();
include 'config.php';



$valor = $_POST;
$valores = array_keys($valor);



$tamanho=count($_POST);
$titulo=$_POST['titulo_rota'];
$user_id=$_SESSION['user_id'];
$sql="INSERT INTO rota (UserID, nLikes, titulo_rota) VALUES ('$user_id','0','$titulo')";
$result = mysqli_query($link, $sql);


	
	$sql="SELECT RotaID from rota where UserID='$user_id' ORDER BY RotaID DESC LIMIT 1";
	$result = mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result)){
	$id_rota=$row['RotaID'];
	
	}
	for($i=1;$i<$tamanho;$i++){
		
		$id_marker=$_POST['marker'.$i];
		
		$sql="insert into marker_rota (MarkerID, RotaID) VALUES ('$id_marker','$id_rota')";
		$result = mysqli_query($link, $sql);
		
		
		
	}
	


header('Location: index.php');





?>