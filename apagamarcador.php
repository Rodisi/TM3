<?php session_start();

include 'config.php';


if (isset($_SESSION['user_id'])&&isset($_GET['MarkerID'])){
	
	$user_id=$_SESSION['user_id'];
	$MarkerID=$_GET['MarkerID'];
	
	$sql="Select UserID from marker where MarkerID='$MarkerID'";
	$result=mysqli_query($link, $sql);
	$num_rows = mysqli_num_rows($result);
	/**Verifica se o user é o criador do marcador**/
		if ($num_rows==1){
			
			//se é, apaga o marcador com aquele ID
			$sql="DELETE FROM marker where MarkerID='$MarkerID'";
			$result=mysqli_query($link, $sql);
			header('Location: index.php');
			
		}else{
			
			header('Location: index.php');
		}
	
		
	
	
}else{
	
	header('Location: index.php');
}







?>