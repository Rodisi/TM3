<!DOCTYPE html>
<? session_start(); 

include 'config.php'; ?>

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
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox -->
	<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js"></script>
	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
	<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js"></script> 
	<script type="text/javascript" src="slider-master/js/jssor.js"></script>
    <script type="text/javascript" src="slider-master/js/jssor.slider.js"></script>
	<script type="text/javascript" src="toggles.js"></script>
	<script type="text/javascript" src="gmaps.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="js-marker-clusterer/src/markerclusterer.js"></script>

	
	
		
	<script>
	
var map;



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
	
	autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('#text_search')),
      {
        types: ['(country)'],
        
      });
  places = new google.maps.places.PlacesService(map);

 google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
 
 // When the user selects a city, get the place details for the city and
// zoom the map in on the city.
function onPlaceChanged() {
  var place = autocomplete.getPlace();
  if (place.geometry) {
    map.panTo(place.geometry.location);
    map.setZoom(15);
    search();
  } else {
    document.getElementById('autocomplete').placeholder = 'Enter a city';
  }

}

	
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
	
	$locais[]= array($row['titulo'],$row['lat'],$row['lon'],$row['MarkerID'],$row['texto'],$row['imagem']);
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
	var mytext = '<div id="contentorMarcador"><div id="textoMarcador"><p>'+beach[4]+'</p></div><div id="polaroid"><img src="'+beach[5]+'" width="200" height="215"/></div></div>';
	var myinfowindow = new google.maps.InfoWindow({content: mytext});
    map.addMarker({
        lat:beach[1],
        lng: beach[2],
		icon: "images/star.png",
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
				<input type="textbox" id="text_search"/>


				

				

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
		<div class="menu_icon"><img id="m_icon" src="images/menu-alt.png" alt="Open/Close Navigation Bar"/></div>
		
		<?php } ?>
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