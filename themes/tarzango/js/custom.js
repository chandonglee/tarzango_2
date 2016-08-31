$( document ).ready(function() {
	$( function() {
		$( "#datepicker1" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker2" ).datepicker();
	} );

	$(".sign.1").click(function(){
		$(".map-address.1").slideToggle(1000);
		$(this).toggleClass("minus");
	});
	$(".sign.2").click(function(){
		$(".map-address.2").slideToggle(1000);
		$(this).toggleClass("minus");
	});
	$(".sign.3").click(function(){
		$(".map-address.3").slideToggle(1000);
		$(this).toggleClass("minus");
	});
	
	$(".header-navigation-section img.open").click(function(){
		$(".menu-dropdown").toggle();
		$(".header-navigation-section .close-button").toggle();
	});
	
	$(".header-navigation-section .close-button").click(function(){
		$(".header-navigation-section .close-button").toggle();
		$(".menu-dropdown").toggle();
	});
	
});