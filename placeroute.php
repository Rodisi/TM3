<?php
session_start();
include 'config.php';



$valor = $_POST;
$valores = array_keys($valor);


$tamanho=count($valores);
$titulo=$valores[0];
$user_id=$_SESSION['user_id'];
$sql="INSERT INTO rota (UserID, nLikes, titulo_rota) VALUES ('$user_id','0','$titulo')";
$result = mysqli_query($link, $sql);
echo $result;
if($result){
	
	$id_rota=msqli_insert_id();
	
	for($i=1;$i=$tamanho;$i++){
		
		$id_marker=$valores[$i];
		$sql="insert into marker_rota VALUES ('$id_marker','$id_rota')";
		$result = mysqli_query($link, $sql);
		
		if ($result){
			
			echo ("inserido.");
		}
		
	}
	
}else {
	
	echo "ocorreu um erro";
}







?>