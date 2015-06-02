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
	
	$(".clickToggle").click(function(){ 
	

	if (toggleBottom==0) {
	var div2 = $(".bottombar");
	div2.animate({height: '450px'}, "slow");
	toggleBottom=1;
	}
	else {
	var div2 = $(".bottombar");
	div2.animate({height: '0'}, "slow");
	toggleBottom=0;
	}
	});
	
	
	
	});