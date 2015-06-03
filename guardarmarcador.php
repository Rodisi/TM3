<?php
// Begin the session
session_start();

include 'config.php';



$user_id=$_SESSION['user_id'];

$lat=$_POST['lat'];
$lon=$_POST['lon'];
$hist=$_POST['historia'];
$titulo=$_POST['titulo'];



if(!isset($_FILES['imagem'])){
	
	$file = "images/polaroid.png";
	
}else {
	
move_uploaded_file($_FILES["imagem"]["tmp_name"],"images/" . $_FILES["imagem"]["name"]);
$file="images/".$_FILES["imagem"]["name"];
$image = new Imagick($file); 
	
}


$sql="INSERT INTO marker (UserID, lat, lon, imagem, texto, markerLikes, titulo) VALUES ('$user_id','$lat','$lon','$file','$hist',0,'$titulo')";
$result = mysqli_query($link, $sql);

if($result){
	
	echo 'Marcador criado.';
	
}else{
	
	echo 'Ocorreu um problema.';
}

?>