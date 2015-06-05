<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<style>
	
	#texto_editavel {
	width: 600px;
	height: 120px;
	border: 3px solid #cccccc;
	padding: 5px;
	display:block;
	
	}
	
	#titulo {
		
		width:300px;
	}
	
	</style>
  </head>
  <body>

<?php


if(!isset($_SESSION['user_id'])){

echo '<p>Para colocar Marcadores, por favor faça Log-in.</p>';

}else{

?>	
  
<form action="guardarmarcador.php" method="post" enctype="multipart/form-data">
Imagem: <br><input type="file" name="imagem">
<br>
Titulo: <br><input type="text" name="titulo" id="titulo"/>
<br><br>
História: <br><input type="textarea" name="historia" id ="texto_editavel"  onfocus="if(this.value == 'Conte-nos a sua historia!') { this.value = ''; }" value="Conte-nos a sua historia!"></textarea>

<br>
<input type="hidden" name="lat" id="latitude"/>
<br>
<input type="hidden" name="lon" id="longitude"/>
<br><br>
<input type="submit" value="Submit">



</form>


<?php } ?>
<script>
  var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = pair[1];
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]], pair[1] ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(pair[1]);
    }
  } 
    return query_string;
} ();
  
  lat=QueryString.lat;
  lon=QueryString.lon;
  document.getElementById('latitude').value=lat;
  document.getElementById('longitude').value=lon;
  </script>

  
  </body>
 </html>