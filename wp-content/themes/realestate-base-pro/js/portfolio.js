( function( $ ) {

	$(document).ready(function($){

		var jQuerycontainer = $('.portfolio-container');
		jQuerycontainer.imagesLoaded(function(){
			jQuerycontainer.isotope({
				filter: '*',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		});

		$('.portfolio-filter a').on('click',function(){
			$('.portfolio-filter .current').removeClass('current');
			$(this).addClass('current');

			var selector = $(this).attr('data-filter');
			jQuerycontainer.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			return false;
		});

	});

} )( jQuery );
