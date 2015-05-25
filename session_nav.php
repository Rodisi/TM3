<?php


include 'config.php';



/*** begin the session ***/
session_start();

if(!isset($_SESSION['user_id']))
{
    echo '<div class="login_form"><input type="textbox"/><input type="password"/></div>';
}else {
	
	
	$sql="select * from user where ";
}

?>