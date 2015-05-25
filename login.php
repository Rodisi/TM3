<?php


/*** begin our session ***/
session_start();

/*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	
	include 'config.php';
	
	$sql="Select UserID, email, password FROM user where email='$username' AND password='$password'";
	
	$result=mysqli_query($link, $sql);
	
	/* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
	
	if ($row_cnt>0){
		
		while($row = mysqli_fetch_array($result)) {
		$user_id=$row['UserID'];
		$_SESSION['user_id'] = $user_id;
		}
		
		
	}else {
		
		echo 'Login Failed. Incorrect Username or Password.';
	}

	
	/* close connection */
	mysqli_close($link);
	
	header("Location: index.php");
?>