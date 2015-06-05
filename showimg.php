<html>
<head>
<style>
      .contentor {
        height: 800px;
        width: 600px;
        padding: 0px
      }
	  
	  img {
		  
		  max-width:100%;
		  max-height:100%;
	  }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php

include 'config.php';
if(isset($_GET['MarkerID'])){
	
	$MarkerID=$_GET['MarkerID'];
	
	$sql="Select imagem from marker where MarkerID='$MarkerID'";
	$result=mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result)){
		$imagem=$row['imagem'];
	}
	
	
	
}else{
	
	$imagem="polaroid.png";
	}


?>
<script>


	
	
<?php 
echo 'var fonte = '.json_encode($imagem).';';
?>
$( document ).ready(function() {
	alert(fonte);
var imgem =document.getElementById('imagem');
imgem.src = fonte;

});
</script>
</head>
<body>
<div id="contentor">
<img id="imagem" src="images/image_not_available.jpg"/>
</div>
</body>
</html>