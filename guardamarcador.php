<?php
// Begin the session
session_start();

include 'config.php';

$user_id=$_SESSION['user_id'];

$lat=$_POST['lat'];
$lon=$_POST['lon'];
$hist=$_POST['historia'];

?>