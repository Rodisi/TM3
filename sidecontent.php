<!DOCTYPE html>
<meta charset="UTF-8">
<script>
function centrar(lat, lon){
		
			
map.setCenter(lat, lon);

		
};

function showRoute(RouteID){
	//abre fancybox
	//passa RouteID por post
	//faz query
	//abre mapa estatico
	//desenha rota
	
	
	$.fancybox({
        type: 'iframe',
        href: 'showroute.php?RouteID='+RouteID,
    });
	
	/**location.href = "showroute.php?RouteID="+RouteID;**/
};

function apagaM(id_elemento){
	
	if (confirm('De certeza que deseja apagar este Marcador?')) {
		location.href ="apagamarcador.php?MarkerID="+id_elemento;
	}
	
	
}

function apagaR(id_elemento){
	if (confirm('De certeza que deseja apagar esta Rota?')) {
	location.href ="apagarota.php?RotaID="+id_elemento;
	}
}
	

	
	/**function janelaRotas () {
	
	$.fancybox({
        type: 'iframe',
		
		afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
              parent.location.reload(true);
			  
            },
        href: 'placeroute.php',
    });
	
	
};**/


</script>


<?php

include 'config.php';


if(!isset($_SESSION['user_id'])){
	
	echo 'Por favor faça Login.';
	
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
	/**echo '<a href="apagamarcador.php?MarkerID='.$row['MarkerID'].'">Apagar este marcador</a>';**/
	echo '<input type="button" value="APAGAR" onClick="apagaM('.$row['MarkerID'].')"/>';
	
	echo '</li>';
	
	
	
	}
	
	echo '</ul>';
	echo '</div>';
	echo '<hr>';
}else{
	
	echo '<p>Ainda não tem Marcadores!</p>';
}


$sql="SELECT * from rota where UserID='$UserID' ORDER BY RotaID DESC";

$result = mysqli_query($link, $sql);

$num_rows= mysqli_num_rows($result);	

if ($num_rows>0){
	echo '<p>As Suas Rotas</p><br>';
	echo '<div id="rotas">';
	
	echo '<ul>';
	
	while($row = mysqli_fetch_array($result)){
		
		
		echo '<li onClick="showRoute('.$row['RotaID'].')">';
		echo '<img src="images/sign.png"/>';
		echo '<h3>'.$row['titulo_rota'].'</h3>';
		echo '<input type="button" value="APAGAR" onClick="apagaR('.$row['RotaID'].')"/>';
		echo '</li>';
	}
	
	
	echo '</ul>';
	echo '</div>';
}else{
	echo '<p>Ainda não tem Rotas!</p>';
}
	
	
}
?>

