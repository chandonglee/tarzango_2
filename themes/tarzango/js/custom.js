$( document ).ready(function() {
	$( function() {
		$( "#datepicker1" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker2" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker3" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker4" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker5" ).datepicker();
	} );
	
	$( function() {
		$( "#datepicker6" ).datepicker();
	} );

	$(".sign.1").click(function(){
    $(".map-address.1").slideToggle(300);
    $(this).toggleClass('minus', 0);
  });
  $(".sign.2").click(function(){
    $(".map-address.2").slideToggle(300);
    $(this).toggleClass('minus', 0);
  });
  $(".sign.3").click(function(){
    $(".map-address.3").slideToggle(300);
    $(this).toggleClass('minus', 0);
  });

  /* $(".close-button").click(function(){
    $(".menu-dropdown").slideToggle(300);
    $(this).toggleClass('minus', 0);
  });*/
	
	$(".close-button").click(function(){
		$(".menu-dropdown").toggle();
		
	});
	
	
	
	$(".sorting .title").click(function(){
		$(".sorting .dropdown").toggle();
	});
	
	$(".total button.book").click(function(){
		$(".sidebar-modal").toggle();
	});
	
	// search section
	
	$(".search-section .persons").click(function(){
		$(".search-section .dropdown").toggle();
	});
	
	$(function () {
		$('.plus1').on('click',function(){
			var $qty = $('#search_form').find('.adult');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				var aaa = currentVal + 1;
				console.log(aaa);
				$(".adults_final").val(currentVal + 1);
				$qty.val(aaa);
			}
		});
		$('.minus1').on('click',function(){
			var $qty=$('#search_form').find('.adult');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$(".adults_final").val(currentVal - 1);
				$qty.val(currentVal - 1);
			}
		});
	});
	
	$(function () {
		$('.plus2').on('click',function(){
			var $qty=$('#search_form').find('.children');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				$(".children_final").val(currentVal + 1);
				$qty.val(currentVal + 1);
			}
		});
		$('.minus2').on('click',function(){
			var $qty=$('#search_form').find('.children');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$(".children_final").val(currentVal - 1);
				$qty.val(currentVal - 1);
			}
		});
	});
	
	$(function () {
		$('.increase').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.adult');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.decrease').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.adult');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$qty.val(currentVal - 1);
			}
		});
	});
	
	$(function () {
		$('.increase').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.child');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.decrease').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.child');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$qty.val(currentVal - 1);
			}
		});
	});
	
	$('.attraction-details-body .inner .right-section').css('height', $('.attraction-details-body .inner .left-section').height()+'px');
	
	$('.attraction-details-body .inner .right-section .sidebar-modal').css('height', $('.attraction-details-body .inner .right-section').height()+'px');
	
});

$(function () {
		$('.increment-right').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.room');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.decrement-left').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.room');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$qty.val(currentVal - 1);
			}
		});
	});

	/*
	$(function () {
		$('.increase').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.child');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal)) {
				$qty.val(currentVal + 1);
			}
		});
		$('.decrease').on('click',function(){
			var $qty=$(this).closest('.col-sm-6').find('.child');
			var currentVal = parseInt($qty.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				$qty.val(currentVal - 1);
			}
		});
	});*/
function myFunction() {
  
  $("#myDropdown1").toggle();
    //document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

