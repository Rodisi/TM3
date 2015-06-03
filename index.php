<!DOCTYPE html>
<?php session_start(); 

include 'config.php'; 
?>



<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="jQuery-TE/jquery-te-1.4.0.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple">
	<meta charset="UTF-8">

	
	
    <title>Mark It! - Tell your stories</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	

	
	
	
	<script type="text/javascript" src="slider-master/js/jssor.js"></script>
    <script type="text/javascript" src="slider-master/js/jssor.slider.js"></script>
	<script type="text/javascript" src="toggles.js"></script>
	<script type="text/javascript" src="gmaps.js"></script>
	
	<link rel="stylesheet" type="text/css" href="selesort.css">

	
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<!-- Add fancyBox -->
	<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js"></script>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js"></script> 
	
	<script src="geocomplete/jquery.geocomplete.js"></script>
	
	<script type="text/javascript" src="js-marker-clusterer/src/markerclusterer.js"></script>

	
	
		
	<script>
	
	<?php
	if(isset($_SESSION['user_id'])){
	
	$user_id=$_SESSION['user_id'];
	
	$marcadoresTitulo=array();
	$marcadoresID=array();
	$sql="Select * from marker where UserID='$user_id'";
	$result=$result=mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result)){
		
		$marcadoresTitulo[]=$row['titulo'];
		$marcadoresID[]=$row['MarkerID'];
		
	}
	echo 'var marcadoresTitulo = '.json_encode($marcadoresTitulo).';';
	echo 'var marcadoresID = '.json_encode($marcadoresID).';';
	}
	?>
	
var map;
var selectboxes=0;

function populaSelects(idSelect){
	
	
var select = document.getElementById(idSelect);
	for(var i = 0; i < marcadoresTitulo.length; i++) {
		var opt = marcadoresTitulo[i];
		var val = marcadoresID[i];
		var el = document.createElement("option");
		el.textContent = opt;
		el.value = val;
		select.appendChild(el);
		
	};
};

function criaSelects(){
	
	if (selectboxes<marcadoresTitulo.length){
selectboxes++;
var myElement = document.getElementById('caixas');
var txt = document.createTextNode(selectboxes+".");
myElement.appendChild(txt);
var selectList = document.createElement("select");
selectList.id = "marker"+selectboxes;
selectList.name="marker"+selectboxes;
selectList.onchange=function(){disableValues(this.id, this.value);};
myElement.appendChild(selectList);
var br = document.createElement("br");
myElement.appendChild(br);

populaSelects(selectList.id);

if (selectboxes==1){
	
	criaSelects();
};
}else{
	alert("Já nâo tem mais marcadores disponiveis!");
};
};

/**function disableValues(selectID, selectedValue){
	
	alert(selectID+" e "+ selectedValue);
	
	for(var i = 1;i=selectboxes;i++){
		var aMudar = "marker"+i;
		var protegido = selectID;
		if (protegido==(aMudar)){
			alert("aqui - "+protegido+" não fiz nada");
		}else{
			$(aMudar).("option[value='"+ selectedValue + "']").attr('disabled', true ); 
			
		};
		
	};
	
};**/

function initialize() {
	
	/**$( "#text_search" ).autocomplete({
    source: "search.php",
	minLength: 2,
	select: function(event, ui)
	{
	$("input#text_search").val(ui.item.value);
    $("#geocoding_form").submit();
	},		
    });**/
	
$("#text_search").geocomplete();  // Option 1: Call on element.


<?php
if(isset($_SESSION['user_id'])){
	echo 'var isLogged =true;';
}else{
	echo 'var isLogged =false;';
}
?>

if (isLogged){
criaSelects();
};
/**function janelaRotas () {
	
	$.fancybox({
        type: 'iframe',
		
		afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
              parent.location.reload(true);
			  
            },
        href: 'placeroute.php',
    });
	
	
};**/


/**$( "#listagem" )
    .sortable({ handle: ".handle" })
    .selectable({ filter: "li", cancel: ".handle" })
    .find( "li" )
    .addClass( "ui-corner-all" )
    .prepend( "<div class='handle'><span class='ui-icon ui-icon-carat-2-n-s'></span></div>" );**/
	

	
	GMaps.geolocate({
  success: function(position) {
    map.setCenter(position.coords.latitude, position.coords.longitude);
  },
  error: function(error) {
    alert('Geolocation failed: '+error.message);
  },
  not_supported: function() {
    alert("Your browser does not support geolocation");
  },
  always: function() {
    //alert("Done!");
  }
});

	
  var markers = [];
    map = new GMaps({
  div: '#map-canvas',
  lat: 71.043333,
  lng: 77.028333,
  click: function(event){
	  var marker;
	  var latitude = event.latLng.lat();
	  var longitude = event.latLng.lng();
	  $.fancybox({
        type: 'iframe',
		
		afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
              parent.location.reload(true);
			  
            },
        href: 'placemarker.php?lat='+ latitude + '&lon=' + longitude,
    });
	},
	});

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
  
  
  setMarkers(map, locais);
  
}

/**function ProcuraMarcador(titulo){
	
window.location.href = "index.php?titulo=" + titulo; 

};**/


<?php

/**if(isset($_GET['titulo'])){
	
	$titulo=$_GET['titulo'];
	
	$sql="Select * from marker where titulo='$titulo'";
	
	$result = mysqli_query($link, $sql);
	
	
}**/

$locais =array();
$sql="SELECT * from marker";
$result=mysqli_query($link, $sql);



while($row = mysqli_fetch_array($result)){
	
	//verifica se o marcador é do utilizador logged-in e muda icone (vermelhor é marcadores do utilizador, amarelo de todos os outros)
	if (isset($_SESSION['user_id'])){
		
		
	
		if ($row['UserID']==$_SESSION['user_id']){
			
			$icon = 'images/star_red.png';
		}else {
			
			$icon = 'images/star.png';
		}
	}else{
		
		$icon = 'images/star.png';
	}
	
	$locais[]= array($row['titulo'],$row['lat'],$row['lon'],$row['MarkerID'],$row['texto'],$row['imagem'],$icon);
}
echo 'var locais = '.json_encode($locais).';';
?>

//para testar sem DB
/*var locais = [
  ['Bondi Beach', -33.890542, 151.274856, 4, "Coiso Loiso"],
  ['Coogee Beach', -33.923036, 151.259052, 5, "Ena Pa"],
  ['Cronulla Beach', -34.028249, 151.157507, 3, "Porque Posso"],
  ['Manly Beach', -33.80010128657071, 151.28747820854187, 2, "GETTUPA"],
  ['Maroubra Beach', -33.950198, 151.259302, 1, "Odeio esta net"]
];*/





				
				
function setMarkers(map, locations) {
  // Add markers to the map
  for (var i = 0; i < locations.length; i++) {
    var beach = locations[i];
	var mytext = '<div id="contentorMarcador"><div id="textoMarcador"><h1>'+beach[0]+'</h1><br><p>'+beach[4]+'</p></div><div id="polaroid"><img src="'+beach[5]+'" width="200" height="215"/></div></div>';
	var myinfowindow = new google.maps.InfoWindow({content: mytext});
    map.addMarker({
        lat:beach[1],
        lng: beach[2],
		icon: beach[6],
        title: beach[0],
		infoWindow: {
		content: mytext
},
    click: function(e) {
		
  }
});
  }
  
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>

	
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
  <div class="container">
  
	<div id="header">
		<div id=titulo> </div>
		<div class="social_icons">
								<img src="images/social-icons.png" border="0" usemap="#social-icons">
								<map name="social-icons">
								  <area shape="rect" coords="0,0,32,32" href="http://www.facebook.com" target="_blank" alt="Facebook">
								  <area shape="rect" coords="48,0,80,32" href="http://www.twitter.com" target="_blank" alt="Twitter">
								  <area shape="rect" coords="96,0,128,32" href="https://plus.google.com" target="_blank" alt="Google+">
								</map>
		</div>
		
		<div class="global_search">
			<form method="post" id="geocoding_form"> <!--onSubmit="ProcuraMarcador(input#text_search)"-->
				<input type="textbox" id="text_search" onFocus="this.value='';"/>


				

				

				<input type="submit" id="search" value="Procurar" method="Post"/>

				</form>

		</div>
			<script>
	
$('#geocoding_form').submit(function(e){
		//alert("Your browser does not support geolocation");
        e.preventDefault();
        GMaps.geocode({
  address: $('#text_search').val(),
  callback: function(results, status) {
    if (status == 'OK') {
      var latlng = results[0].geometry.location;
      map.setCenter(latlng.lat(), latlng.lng());
      map.addMarker({
        lat: latlng.lat(),
        lng: latlng.lng()
      });
    }
  }
});
      });
	  
</script>
		
		<div class="session_fields">
		<?php include "session_nav.php"; ?>
		</div>
		
		<?php if (isset($_SESSION['user_id'])){
			
			
		?>
		
		
		
		<div class="other">
		<img class="clickToggle" src="images/build-sign.png" width="75px" height="75px"/>
		</div>
		<div class="menu_icon"><img id="m_icon" src="images/menu-alt.png" alt="Open/Close Navigation Bar"/></div>
		
		<?php } ?>
	</div>
		<div class="bottombar">
		

			<div class ="selesort">
			<p>Construidor de Rotas</p>
			
			<form id="form_rotas" action="placeroute.php" method="post">
				<div id="caixas">
				<input type="textbox" value="Titulo da Rota" name="titulo_rota" onFocus="this.value='';"/><br><br>
				</div>
				<div id="botoes">
				<br>
					<input type="button" value="add marker" onClick="criaSelects()"/><br><br>
					<input type="submit" value="Criar Rota!"/>
				</div>
			</form>
			</div>
		
		</div>
		<div class='sidebar'>
		
			<div class="nav_content">
		
			<?php include 'sidecontent.php'; ?>
		
		
			</div>
		
		</div>
		
		
			
			<div id="map-canvas"></div>

	</div>
  </body>
</html>