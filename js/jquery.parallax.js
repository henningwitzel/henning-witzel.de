(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();
	var windowWidth = $window.width();

	$.fn.parallax = function(params) {

		var defaults = {
				bgParallax : true,
        xpos			 : '50%',
        speedFactor: 0.2,
        outerHeight: true,
        paddingTop : 0
    };

    var options = $.extend({}, defaults, params);

		var $this = $(this);
		var getHeight;
		var firstTop;
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});

		function insertCSS() 
		{
			 var css = document.createElement('link');
			 css.rel = 'stylesheet';
		   css.href = $('body').attr('basepath') + 'css/parallax.css';

		   var l = document.getElementsByTagName('link')[0];
		   l.parentNode.insertBefore(css, l);
		}

		// function to be called whenever the window is scrolled or resized
		function update()
		{
			var pos = $window.scrollTop();

			if( options.bgParallax == true && windowWidth > 1024 )
			{				
				$this.each(function(){
					var $element = $(this);
					var top = $element.offset().top;

					var height = $element.outerHeight();

					// Check if totally above or totally below viewport
					if (top + height < pos || top > pos + windowHeight) {
						return;
					}

					var position = Math.round((firstTop - pos) * (options.speedFactor));
					$this.css('background-position', options.xpos + " " + position + "px");
				});
			}
			else 
			{
				var marginposition = (640 + Math.round((firstTop - pos) * (options.speedFactor*8)));
				

				$this.find('img').each(function() {
					$(this).css('margin-top', "-" + marginposition + "px");
				});				
			}

		}		


		function changeBackgroundImages()
		{
			var image;
			if( options.bgParallax == true )
			{
				if ( windowWidth <= 800 ) // image for tablet resolution
				{
					image = $this.attr('data_image_800');
				}

				else if ( windowWidth <= 1280 ) // image for notebook resolution
				{
					image = $this.attr('data_image_1280');
				}
				
				else if ( windowWidth <= 1440 ) // image for notebook resolution
				{
					image = $this.attr('data_image_1440');
				}

				else // image for desktop resolution
				{
					image = $this.attr('data_image_1920');
				}

				$this.css('background', 'url(' + image + ')');
			}
			else
			{
				console.log('no bg image');
			}
		}			


		$window.resize(function () {
			windowHeight = $window.height();
			windowWidth = $window.width();

			changeBackgroundImages();
			update();
		});

		$window.bind('scroll', update);
		
		
		insertCSS();
		changeBackgroundImages();
		update();

	};	

})(jQuery);
