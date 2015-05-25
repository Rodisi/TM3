<?php


include 'config.php';



/*** begin the session ***/
/***$row['Nome'].'<br><a href="">Criar Rota</a><input type="submit" value="LOGOUT" action="logout.php"**/
/**session_start();**/

if(!isset($_SESSION['user_id'])){
    echo 'Login:<form action="login.php" method="post"><input type="textbox" id="username" name="username"/>Password:<input type="password" id="password" name="login"/><input type="submit" value="Entrar"/></form>';
}else {
	
	$user_id=$_SESSION['user_id'];
	$sql="select Nome from user where UserID='$user_id'";
	$result = mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result)){
	
	echo 'Bem-Vindo';

	}
	
}

?>