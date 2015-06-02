<!DOCTYPE html>
<?php session_start(); ?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="selesort.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

</head>

<body>
<script>


function initialize() {
$( "#listagem" )
    .sortable({ handle: ".handle" })
    .selectable({ filter: "li", cancel: ".handle" })
    .find( "li" )
        .addClass( "ui-corner-all" )
        .prepend( "<div class='handle'><span class='ui-icon ui-icon-carat-2-n-s'></span></div>" );
		
};

</script>
<?php


include 'config.php';

$user_id=$_SESSION['user_id'];

$sql="Select * from marker where UserID='$user_id'";
$result = mysqli_query($link, $sql);


echo '<div class ="selesort">';
echo '<ul id="listagem">';


while($row = mysqli_fetch_array($result)){
	
	echo '<li>'.$row['titulo'].'</li>';
}

echo '</div>';
echo '</ul>';

?>








</body>

</html>