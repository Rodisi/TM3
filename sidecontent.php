<!DOCTYPE html>

<script>
		function centrar(lat, lon){
		
			
			map.setCenter(lat, lon);
		
		
	};

</script>


<?php

include 'config.php';


if(!isset($_SESSION['user_id'])){
	
	echo 'Por favor faça Login.';
	
}else{
	


$UserID=$_SESSION['user_id'];

$sql="SELECT * from marker where UserID='$UserID' ORDER BY MarkerID DESC";

$result = mysqli_query($link, $sql);
	
	echo '<div id="marcadores">';
	
	echo '<p>Os Seus Marcadores</p><br>';
	echo '<ul>';
	
	while($row = mysqli_fetch_array($result)){
	
	
	
	echo '<li onClick="centrar('.$row['lat'].','.$row['lon'].')">';
	echo '<img src="'.$row['imagem'].'"/>';
	echo '<h3>'.$row['titulo'].'</h3>';
	
	echo '</li>';
	
	
	
	}
	
	echo '</ul>';
	echo '</div>';
}


$sql="SELECT * from rota where UserID='$UserID' ORDER BY RotaID DESC";

$result = mysqli_query($link, $sql);


	echo '<div id="rotas">';
	echo '<p>As Suas Rotas</p><br>';
	echo '<ul>';
	
	while($row = mysqli_fetch_array($result)){
		
		
		echo '<li>';
		echo '<img src="images/sign.jpg"/>';
		echo '<h3>'.$row['titulo_rota'].'</h3>';
		echo '</li>';
	}
	
	
	echo '</ul>';
	echo '</div>';
	echo '<div><p onClick="janelaRotas()"><a href="">Deseja Criar uma Nova rota?</a></p></div>';

?>

