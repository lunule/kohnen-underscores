jQuery(document).ready(function($){

	/* Prefix `/resources` type navigation links with the correct site url
	---------------------------------------------------------------------- */

	 $('#masthead a[href^="/"], #colophon a[href^="/"]').each( function(i) {

	 	const oVal 		= $(this).attr('href'),
	 		  newVal 	= kohnen.siteurl + oVal;

	 	$(this).attr('href', newVal);

	 })

	/** 
	 * Animate HTML elems with [data-sal] attribute
	 * ============================================================================================
	 */
	$('[data-sal]').each( function(i) {

		if ( $(this).closest('.styled-titles').length == 0 ) {

			$(this).closest('section').addClass('has-data-sal');

		}

	})

	$('.has-data-sal:in-viewport [data-sal]').addClass('sal-animate');
	$(window).scroll(function() {

		$('.has-data-sal:in-viewport( -250 ) [data-sal]:not(.sal-animate)').addClass('sal-animate');	 

	})


	/* Home page
	============================================================================================ */

	if ( $('.page-template-page-home').length > 0 ) {

		/* Tabbed service cards
		----------------------- */

		$('.wrap--styled-tabs').tabslet({
			container: '#tabs_container',
		});

		/* Case study card slider
		------------------------- */

		const carousel = $(".styled-carousel .carousel-inner").lightSlider({
			item: 1,
			pager: false,
			controls: false,
			slideMargin: 0,
			auto: true,
			pauseOnHover: true,
			loop: true,
            useCSS: true,
            cssEasing: 'cubic-bezier(0.215, 0.61, 0.355, 1)',
            speed: 500, 	// animation speed
            pause: 5000, 	// pause between auto-sliding when auto is set to true
			/*responsive : [
			    {
			        breakpoint: 800,
			        settings: { // settings for width 480px to 800px
			            item: 3,
			            slideMove: 1,
			            slideMargin: 6
			          }
			    },
			    {
			        breakpoint: 480,
			        settings: {  // settings for width 0px to 480px
			            item: 2,
			            slideMove: 1
			          }
			    }
			]*/		
			onSliderLoad: function (el) {
				console.log( carousel.getCurrentSlideCount() );
			},	
            onBeforeSlide: function (el) {
				
				//console.log( carousel.getCurrentSlideCount() );
				
				// block link access for the time of the slide animation!!
				$('.styled-carousel-controls .block-link-access').css('z-index', 2);

				// Update the frontend counter value
				$('.styled-carousel-counter span:first-child').text( carousel.getCurrentSlideCount() );
            },
            onAfterSlide: function (el) {

				// remove link access block
            	$('.styled-carousel-controls .block-link-access').css('z-index', 0);
            
            }
		});

		$('.carousel-control-prev').click(function() { 
			carousel.goToPrevSlide(); 
		});

		$('.carousel-control-next').click(function() {
			carousel.goToNextSlide(); 
		});

	}

	/* Contact us banner
	-------------------- */

	if ( $('.contact-us-banner').length > 0 ) {

		let x = 0,
			y = 0,
			now,
			then = 0,
			delta;

		const banner = document.querySelector('.contact-us-banner__styled-magnetic-wrap'),
			  interval = 1000/30; 	//maximum 60 eps, you can change

		banner.addEventListener('mousemove', e => {

			x = e.clientX;
			y = e.offsetY;

			now = Date.now();
			delta = now - then;			

			if ( delta > interval ) {

				then = now - delta % interval; //subtract extra waited time

				// console.log(x);
				// console.log(y);

				const mouseX = x,
					  mouseY = y;

				const sqrs = document.querySelectorAll(".cub-item");

				$.each( sqrs, function( i, sqr ) { 

					const sqrX = sqr.offsetLeft + 40;
					const sqrY = sqr.offsetTop + 20;

					const diffX = mouseX - sqrX;
					const diffY = mouseY - sqrY;

					const radians = Math.atan2(diffY, diffX);

					const angle = (radians * 180) / Math.PI;

					sqr.style.transform = `rotate(${angle}deg)`;

				})
			
			};		
		
		});

	}	

	/* Footer
	============================================================================================ */

	/**
	 * Disable links with a # href value
	 */

	$('.footer-menu a[href="#"]').attr('aria-disabled', 'true');

	document.body.addEventListener('click', function (event) {
  
  		// filter out clicks on any other elements
  		if ( event.target.nodeName == 'A' && event.target.getAttribute('aria-disabled') == 'true' )
    		event.preventDefault();
  
	});
  
})