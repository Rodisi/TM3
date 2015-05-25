//Toggles de divs
	
	$(document).ready(function(){ 

	var toggleSide=0;
	var toggleBottom=0;
	$(".fancybox").fancybox();
	 
	$(".sidebar").click(function(){ 
	

	if (toggleSide==0) {
	var div = $(".sidebar");
	div.animate({width: '15%'}, "slow");
	toggleSide=1;
	}
	else {
	var div = $(".sidebar");
	div.animate({width: '2%'}, "slow");
	toggleSide=0;
	}
	});
	
	
	
	});