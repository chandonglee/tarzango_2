var $ = jQuery.noConflict();

jQuery(document).ready(function ($) {
	$('ul').each(function() {
		$(this).find('li').first().addClass('first');
		$(this).find('li').last().addClass('last');
	});
    
   
    $("#owl-demo").owlCarousel({
 
      /*autoPlay: 3000, //Set AutoPlay to 3 seconds*/
 
      items : 3,
      itemsCustom : [
        [0, 1],
        [640, 1],
          [768, 2],
        [1200, 3]
      ],
      navigation : true,
    pagination:false
 
  });
    
	
	
});

$(window).scroll(function(){
  var sticky = $('.nav-cont'),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});
