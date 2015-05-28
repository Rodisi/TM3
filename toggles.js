//Toggles de divs
	
	$(document).ready(function(){ 

	var toggleSide=0;
	var toggleBottom=0;
	$(".fancybox").fancybox();
	 
	$("#m_icon").click(function(){ 
	

	if (toggleSide==0) {
	var div = $(".sidebar");
	div.animate({width: '350px'}, "slow");
	toggleSide=1;
	}
	else {
	var div = $(".sidebar");
	div.animate({width: '0'}, "slow");
	toggleSide=0;
	}
	});
	
	
	
	});