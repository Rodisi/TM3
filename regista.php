<?php session_start();

include 'config.php';


if (isset($_POST['nome'])&&isset($_POST['email'])&&isset($_POST['passw'])){
	
	
	
	$nome=filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
	$email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password=filter_var($_POST['passw'], FILTER_SANITIZE_STRING);
	
	
	$sql="Select * from user where email='$email'";
	$result=mysqli_query($link,$sql);
	
	$num_rows=mysqli_num_rows($result);
	
	if($num_rows==0){
	
	$sql="INSERT INTO user (Nome, email, Password) VALUES ('$nome','$email','$password')";
	$result =mysqli_query($link, $sql);
	header("Location: index.php");
	}else{
		
		header("Location: register.php?err=2");
	}
	
	
	
}


?>