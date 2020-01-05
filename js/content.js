$(document).ready(function() {

  var $window = $(window);
  var windowWidth = $window.width();

  
  function setWaypoints() {
    if( windowWidth > 1024 )
    {
      $('#clearbutton').waypoint(function(direction) {
        $('#menu').removeClass('sticky');
        $('.content').removeClass('sticky');
      }, { offset: '-130px' });


      $('#menu').waypoint(function(direction) {
        
        if( $window.scrollTop() != 0 )
        {
          $(this).addClass('sticky');
          $('.content').addClass('sticky');
        }

      }, { offset: '60px' });
    }
  }

  $window.resize(function (){
    windowWidth = $window.width();

    if( windowWidth < 1024 )
    {
      $('#menu').css('display', 'none');
      $('#menu').removeClass('sticky');
      $('.content').removeClass('sticky');
    }
    else
    {
      $('#menu').css('display', 'block');

      if ( $window.scrollTop() < $('#menu').offset().top-60 )
      {
        $('#menu').removeClass('sticky');
        $('.content').removeClass('sticky');
      }
      else
      {
        $('#menu').addClass('sticky');
        $('.content').addClass('sticky');
      }
    }
  });

  $('#header').parallax({speed: 2});

  $('#burgerbutton').bind('click', function() {
    $('#menu').slideToggle();
  });

  setWaypoints();
});