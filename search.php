<?php

include 'config.php';

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$sql = "SELECT titulo, lat, lon FROM marker WHERE titulo LIKE '%".$term."%'";
$result = mysqli_query($link, $sql);//query the database for entries containing the term

while($row = mysqli_fetch_array($result)){
	
	$row_set[] =$row['titulo'];
}
echo json_encode($row_set);//format the array into json data


?>