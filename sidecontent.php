<!DOCTYPE html>
<meta charset="UTF-8">
<script>
		function centrar(lat, lon){
		
			
			map.setCenter(lat, lon);
		
		
	};
	
	function janelaRotas () {
	
	$.fancybox({
        type: 'iframe',
		
		afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
              parent.location.reload(true);
			  
            },
        href: 'placeroute.php',
    });
	
	
};

</script>


<?php

include 'config.php';


if(!isset($_SESSION['user_id'])){
	
	echo 'Por favor fa�a Login.';
	
}else{
	


$UserID=$_SESSION['user_id'];

$sql="SELECT * from marker where UserID='$UserID' ORDER BY MarkerID DESC";

$result = mysqli_query($link, $sql);
	
$num_rows= mysqli_num_rows($result);	

if ($num_rows>0){
	echo '<p>Os Seus Marcadores</p><br>';
	echo '<div id="marcadores">';
	
	
	echo '<ul>';
	
	while($row = mysqli_fetch_array($result)){
	
	
	
	echo '<li onClick="centrar('.$row['lat'].','.$row['lon'].')">';
	echo '<img src="'.$row['imagem'].'"/>';
	echo '<h3>'.$row['titulo'].'</h3>';
	
	echo '</li>';
	
	
	
	}
	
	echo '</ul>';
	echo '</div>';
	echo '<hr>';
}else{
	
	echo '<p>Ainda n�o tem Marcadores!</p>';
}


$sql="SELECT * from rota where UserID='$UserID' ORDER BY RotaID DESC";

$result = mysqli_query($link, $sql);

$num_rows= mysqli_num_rows($result);	

if ($num_rows>0){
	echo '<p>As Suas Rotas</p><br>';
	echo '<div id="rotas">';
	
	echo '<ul>';
	
	while($row = mysqli_fetch_array($result)){
		
		
		echo '<li>';
		echo '<img src="images/sign.jpg"/>';
		echo '<h3>'.$row['titulo_rota'].'</h3>';
		echo '</li>';
	}
	
	
	echo '</ul>';
	echo '</div>';
}else{
	echo '<p>Ainda n�o tem Rotas!</p>';
}
	echo '<div><a href="javascript:;" onClick="janelaRotas();">Deseja Criar uma Nova rota?</a></div>';
	
}
?>