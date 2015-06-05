<?php


include 'config.php';



/*** begin the session ***/
/*****/


if(!isset($_SESSION['user_id'])){
	
		
    echo '<form action="login.php" method="post">Login:<input type="textbox" name="username"/>Password:<input type="password" name="password"/><input type="submit" value="Entrar"/></form>';
	
}else {
	
	$user_id=$_SESSION['user_id'];
	$sql="select * from user where UserID='$user_id'";
	$result = mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result)){
	
	$nome=$row['Nome'];
	echo 'Bem-Vindo/a '.$nome;
	
	
	echo '<br><a href="logout.php">Logout</a>';

	}
	
}

if(!isset($_SESSION['user_id'])){
	
		if(isset($_GET['err'])){
			
			$mensagem =$_GET['err'];
			if ($mensagem==1){
				
				echo '<p style="color:red;">Password ou Username Inválidos.<p><br>';
			}
		}
}

?>