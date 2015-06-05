<?php session_start();

include 'config.php';


if (isset($_SESSION['user_id'])&&isset($_GET['RotaID'])){
	
	$user_id=$_SESSION['user_id'];
	$RotaID=$_GET['RotaID'];
	
	$sql="Select UserID from rota where RotaID='$RotaID'";
	$result=mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
	/**Verifica se o user é o criador da rota**/
		if ($num_rows==1){
			
			//se é, apaga a rota com aquele ID
			$sql="DELETE FROM rota where RotaID='$RotaID'";
			$result=mysqli_query($link, $sql);
			header('Location: index.php');
			
		}else{
			
			header('Location: index.php');
		}
	
		
	
	
}else{
	
	header('Location: index.php');
}







?>