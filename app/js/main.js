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
    
    //Gestion du scroll de la navigation

    title = $('title').text();

    $('.home #primary-menu li > a, .home #masthead h1 > a').on('click', function(e) {

      var urlSection = $(this).attr('href'),
          hashSection = urlSection.substring(urlSection.indexOf('#')),
          offsetSection = $(hashSection).offset().top,
          dataTitle = $(this).attr('data-title');

      $('#primary-menu').find('.current').removeClass('current');
      $(this).addClass('current');

          $('html, body').animate({
            scrollTop: offsetSection
          }, 1000, function() {
            window.location.hash = hashSection;
            $('title').text(title + ' | ' + dataTitle);
          });

      e.preventDefault();

    });
    $(document).on("scroll", onScroll);


  }); /* End document ready */

  function onScroll(event){

    scrollPos = $(document).scrollTop(),
    windowHeight = $('#main').height();

    $('#primary-menu li:not(:nth-last-child(1)) a').each(function () {
        var currLink = $(this),
            idElement = $(this).attr('id'),
            idSubstr = idElement.substr(5),
            refElement = $('#' + idSubstr),
            refPos = refElement.position().top,
            refHeight = refElement.height();

        if (refPos <= scrollPos && refPos + refHeight > scrollPos) {
            $('#primary-menu li a').removeClass('current');
            currLink.addClass('current');
        }
        else{
            currLink.removeClass('current');
        }
    });

  }

}); /* jQuery end */
