<?php


include 'config.php';



/*** begin the session ***/
/*session_start();*/

if(!isset($_SESSION['user_id']))
{
    echo 'Login:<input type="textbox"/>Password:<input type="password"/><input type="submit" value="Entrar" action="login.php"/>';
}else {
	
	
	$sql="select * from user where ";
}

?>