/**
 * jQuery easing
 * @here https://github.com/gdsmith/jquery.easing/
 */
(function(factory){if(typeof define==="function"&&define.amd){define(["jquery"],function($){return factory($)})}else if(typeof module==="object"&&typeof module.exports==="object"){exports=factory(require("jquery"))}else{factory(jQuery)}})(function($){$.easing.jswing=$.easing.swing;var pow=Math.pow,sqrt=Math.sqrt,sin=Math.sin,cos=Math.cos,PI=Math.PI,c1=1.70158,c2=c1*1.525,c3=c1+1,c4=2*PI/3,c5=2*PI/4.5;function bounceOut(x){var n1=7.5625,d1=2.75;if(x<1/d1){return n1*x*x}else if(x<2/d1){return n1*(x-=1.5/d1)*x+.75}else if(x<2.5/d1){return n1*(x-=2.25/d1)*x+.9375}else{return n1*(x-=2.625/d1)*x+.984375}}$.extend($.easing,{def:"easeOutQuad",swing:function(x){return $.easing[$.easing.def](x)},easeInQuad:function(x){return x*x},easeOutQuad:function(x){return 1-(1-x)*(1-x)},easeInOutQuad:function(x){return x<.5?2*x*x:1-pow(-2*x+2,2)/2},easeInCubic:function(x){return x*x*x},easeOutCubic:function(x){return 1-pow(1-x,3)},easeInOutCubic:function(x){return x<.5?4*x*x*x:1-pow(-2*x+2,3)/2},easeInQuart:function(x){return x*x*x*x},easeOutQuart:function(x){return 1-pow(1-x,4)},easeInOutQuart:function(x){return x<.5?8*x*x*x*x:1-pow(-2*x+2,4)/2},easeInQuint:function(x){return x*x*x*x*x},easeOutQuint:function(x){return 1-pow(1-x,5)},easeInOutQuint:function(x){return x<.5?16*x*x*x*x*x:1-pow(-2*x+2,5)/2},easeInSine:function(x){return 1-cos(x*PI/2)},easeOutSine:function(x){return sin(x*PI/2)},easeInOutSine:function(x){return-(cos(PI*x)-1)/2},easeInExpo:function(x){return x===0?0:pow(2,10*x-10)},easeOutExpo:function(x){return x===1?1:1-pow(2,-10*x)},easeInOutExpo:function(x){return x===0?0:x===1?1:x<.5?pow(2,20*x-10)/2:(2-pow(2,-20*x+10))/2},easeInCirc:function(x){return 1-sqrt(1-pow(x,2))},easeOutCirc:function(x){return sqrt(1-pow(x-1,2))},easeInOutCirc:function(x){return x<.5?(1-sqrt(1-pow(2*x,2)))/2:(sqrt(1-pow(-2*x+2,2))+1)/2},easeInElastic:function(x){return x===0?0:x===1?1:-pow(2,10*x-10)*sin((x*10-10.75)*c4)},easeOutElastic:function(x){return x===0?0:x===1?1:pow(2,-10*x)*sin((x*10-.75)*c4)+1},easeInOutElastic:function(x){return x===0?0:x===1?1:x<.5?-(pow(2,20*x-10)*sin((20*x-11.125)*c5))/2:pow(2,-20*x+10)*sin((20*x-11.125)*c5)/2+1},easeInBack:function(x){return c3*x*x*x-c1*x*x},easeOutBack:function(x){return 1+c3*pow(x-1,3)+c1*pow(x-1,2)},easeInOutBack:function(x){return x<.5?pow(2*x,2)*((c2+1)*2*x-c2)/2:(pow(2*x-2,2)*((c2+1)*(x*2-2)+c2)+2)/2},easeInBounce:function(x){return 1-bounceOut(1-x)},easeOutBounce:bounceOut,easeInOutBounce:function(x){return x<.5?(1-bounceOut(1-2*x))/2:(1+bounceOut(2*x-1))/2}})});

/**
 * Animate to auto height
 * @here https://css-tricks.com/snippets/jquery/animate-heightwidth-to-auto/
 */
jQuery.fn.animateAuto = function(prop, speed, easing, callback){

    var elem, height, width;
    
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto","width":"auto"}).appendTo("body");
        height = elem.css("height"),
        width = elem.css("width"),
        elem.remove();
        
        if(prop === "height")
        	el.animate(
        		{
					height: height
  				}, 
  				{
    				duration: 1000,
    				specialEasing: {
      					height: easing
    				},
    				complete: callback
  				}
  			);
        else if(prop === "width")
        	el.animate(
        		{
					width: width
  				}, 
  				{
    				duration: 1000,
    				specialEasing: {
      					width: easing
    				},
    				complete: callback
  				}
  			); 
        else if(prop === "both")
        	el.animate(
        		{
					height: height,
					width: width
  				}, 
  				{
    				duration: 1000,
    				specialEasing: {
      					height: easing,
      					width: easing
    				},
    				complete: callback
  				}
  			);
    });  
}

let grid = document.querySelector('muuri-grid');

jQuery(document).ready(function($){

	/**
	 * Header navigation
	 * ============================================================================================
	 */

	$('.site-navigation .sub-menu > li > a').each( function() {

		$(this)
        	.contents()
        	.filter(function() {
            	return this.nodeType === 3 && $.trim(this.nodeValue) !== '';
        	})
        	.wrap('<span/>');
	
	})

	$('.site-navigation .menu-item-has-children > a').on('click', function(e) {

		e.preventDefault();

		$('.site-navigation .menu-item-has-children > a').not( $(this) ).siblings('.sub-menu').removeClass('show');

		$(this).siblings('.sub-menu').toggleClass('show');

		if ( $(this).siblings('.sub-menu').hasClass('show') ) {
			$(this).attr('aria-expanded', true);
		} else {
			$(this).removeAttr('aria-expanded');			
		}		

	}) 

	$('.navbar-toggler').on('click', function(e) {

		e.preventDefault();

		$(this).toggleClass('collapsed');
		//$('#masthead:not(.nav-expanding)').addClass('nav-expanding');

		menuCollapsing 	= $(this).is('.collapsed');
		menuExpanding 	= !$(this).is('.collapsed');

		$(this).next('.navbar-collapse').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {

			/*if ( menuExpanding )
				$(this).addClass('show');

			if ( menuCollapsing )
				$(this).removeClass('show');*/

			// This class is solely for the purpose of being a helper in the 
			// `detect click outside of the navbar` function 
			$(this).toggleClass('show');			

		});

	})		

	// `detect click outside of the navbar` function
	document.addEventListener('click', (evt) => {

	    const navbar 		= document.getElementById('primary-menu'),
	    	  toggler 		= document.querySelector('.navbar-toggler');
	    let targetElement 	= evt.target; // clicked element

	    do {
	        if ( targetElement == navbar || targetElement == toggler ) {
	            // This is a click inside. Do nothing, just return.
	            // document.getElementById("flyout-debug").textContent = "Clicked inside!";
	            return;
	        }
	        // Go up the DOM
	        targetElement = targetElement.parentNode;
	    } while (targetElement);

	    // This is a click outside.

	    // Close open submenus
	    $('.sub-menu.show').removeClass('show');

	    // Close mobile menu by triggering a toggler click, ONLY IF the menu is expanded 
	    // (that's why we need the 'show' class - to know when the mobile menu is 
	    // collapsed/expanded)!!
	    if ( $('.wrap--site-navigation.show').length > 0 ) 
	    	$('.navbar-toggler').trigger('click');

	});   	

	/**
	 * IMPORTANT!!!!!!!!! =========================================================================
	 * 
	 * Back button misery!!!
	 *
	 * With the above menu design solution (CSS and JS), if a user clicks a link in an opened 
	 * mobile menu or in a desktop submenu, and then after the redirection she steps back by 
	 * using the Back button, the menu will still be open!!!
	 *
	 * The below function fixes this BROWSER BUG.@async
	 *
	 * BUG description - after using the browser Back button, CSS and JS don't work as
	 * 					 expected, they actually DON'T WORK AS THEY SHOULD AFTER A PAGE 
	 * 					 LOAD.
	 * 					 It seems that, by using the Back button, there's actually NO WAY
	 * 					 TO RESET THE PREVIOUS PAGE'S (the one the user's going back to, 
	 * 					 and the one she clicked the link on previously) ON-LOAD STATUS!!! 
	 *
	 * FYKI - things happening on resize are not reviewed/updated here.
	 * ============================================================================================
	 */
	$('.site-navigation a').on('click', function(e) {

		// Get the link value
		const url 			= $(this).attr('href'),
			  window_width 	= window.innerWidth;

		// Disable automatic redirect
		e.preventDefault();

		console.log($(this));

		if ( '#' !== url ) {

	        if ( window_width <= 992 )
				$('.navbar-toggler').addClass('collapsed');

	        if ( window_width > 991 )
				$('.sub-menu').removeClass('show');			        

			setTimeout( function() {

				window.location.href = url;

			}, 100 );

		}

	})

	/**
	 * Page titles
	 * ============================================================================================
	 */

	$('.styled-titles').children().addClass('sal-animate');

	/**
	 * Resources page - Muuri
	 * ============================================================================================
	 */

	 if ( $('body.kohnen-page--resources').length > 0 ) {

		// Initiate Muuri
		grid = new Muuri('.muuri-grid', {
			// Disable animation
			layoutDuration: 0,
			showDuration: 0,
			hideDuration: 0,
		  	//layoutEasing: 'ease',
		  	//showEasing: 'ease',
		  	//hideEasing: 'ease',				
		  	// Layout
		  	layout: {
		    	fillGaps: false,
		    	horizontal: false,
		    	alignRight: false,
		    	alignBottom: false,
		    	rounding: false
		  	},
		  	layoutOnResize: 150,
		  	layoutOnInit: true,
		});

		$('.muuri-grid').addClass('loaded-images');	

		setTimeout( function() {

			$('.muuri-post-filter').animateAuto('height', 300, 'easeOutCubic', function() {
			
				setTimeout( function() {

					$('.muuri-post-filter').addClass('auto-height');
					$('.muuri-post-filter').removeAttr('style');

				}, 2000);

			});

		}, 300);

	}

	/**
	 * Stuff to be processed upon other stuff getting loaded
	 * ============================================================================================
	 */

	$(window).on('load', function() {

		$('body:not(.loaded)').addClass('loaded');	
  	
  	});  	
  
})

/**
 * $(window).on('load', function() {}) DOESN'T WORK IN INCOGNITO!!!
 *
 * Everything that should be processed upon the onload event MUST be handled here!!!
 */
jQuery(window).ready(function($) {

	console.log('load');

	grid.refreshItems().layout();
	
	// We don't need this here, we add the class above, on document ready
	//document.getElementById('muuri-grid').classList.add('loaded-images');

	// Link Listener to Filter by Category
	const links = document.querySelectorAll('#categories button');

	links.forEach( (element) => {

		// Identify the clicked category
		const category = $('#categories').find('.active').attr('data-slug');

		category === 'all' 
			? grid.filter('[data-category]') 
			: grid.filter(`[data-category="${category}"]`);

		element.addEventListener('click', (e) => {
		
			e.preventDefault();

			links.forEach( (link) => link.classList.remove('active') );
			event.target.classList.add('active');

			// Identify the clicked category
			const category = e.target.innerHTML.toLowerCase();

			category === 'all' 
				? grid.filter('[data-category]') 
				: grid.filter(`[data-category="${category}"]`);
		});
	} );

	// Search bar listener - not used here, but might come in handy later
	/*document.querySelector('#search-bar').addEventListener('input', (e) => {

		const search = e.target.value;
		grid.filter( (item) => item.getElement().dataset.tags.includes(search) );
	
	});*/

	/**
	 * Image listener, very basic but very SYMPA, minimalistic lightbox
	 * functionality - not used here, but might come in handy later
	 */
	/*const overlay = document.getElementById('overlay');

	document.querySelectorAll('.muuri-grid .item img').forEach((element) => {
		
		element.addEventListener('click', () => {

			const route = element.getAttribute('src');
			const description = element.parentNode.parentNode.dataset.description;
			overlay.classList.add('active');
			document.querySelector('#overlay img').src = route;
			document.querySelector('#overlay .description').innerHTML = description;

		});

	});

	// Close Button EventListener
	document.querySelector('#btn-close-popup').addEventListener('click',  () => {
		overlay.classList.remove('active');
	});

	// Overlay EventListener
	overlay.addEventListener('click', (e) => {
		e
		e.target.id === 'overlay' ? overlay.classList.remove('active') : '';
	});*/	

})

window.onload = function() {

	// jQuery hasClass alternative in vanilla JS
	//console.log( document.body.classList.contains('page-template') );
	//console.log( document.body.classList.contains('loaded') );	

	if ( !document.body.classList.contains('loaded') ) {

		//console.log('Doesn\'t');

		//document.body.classList.remove("no-js");
		document.body.classList.add('loaded');

	}

};
