jQuery.noConflict();
jQuery(function($) {

  $(document).ready(function() {

  	//Gestion du header fixed
  	var windowHeight = $(window).height(),
  			logo1 = $('#masthead h1 a').attr('data-logo-1'),
  			logo2 = $('#masthead h1 a').attr('data-logo-2');

  	$(window).scroll( function() { 

      if( $(this).scrollTop() > 80 ) {
        $('#masthead').addClass('hideNav');   
      } else {
        $('#masthead').removeClass('hideNav');
      }

      if( $(this).scrollTop() > windowHeight ) {
        $('#masthead').removeClass('hideNav');
        $('#masthead').addClass('hasScrolled');        
        $('#masthead h1 img').attr('src', logo2);
      }

      if( $(this).scrollTop() < windowHeight/2 ) {
        $('#masthead').removeClass('hasScrolled');        
        $('#masthead h1 img').attr('src', logo1);
      }

  	});

    

  }); /* End document ready */

}); /* jQuery end */
