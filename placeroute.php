<!DOCTYPE html>
<?php session_start(); ?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="selesort.css">

</head>

<body>

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





</body>

</html>