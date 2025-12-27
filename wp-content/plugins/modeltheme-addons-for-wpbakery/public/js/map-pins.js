// Script used only for Map Pins
(function( $ ) {
	'use strict';

	jQuery(document).ready(function(jQuery){

	    //open interest point description
	    jQuery('.mt-addons-map-single-point').children('a').on('click', function(){
	        var selectedPoint = jQuery(this).parent('li');
	        if( selectedPoint.hasClass('is-open') ) {
	            selectedPoint.removeClass('is-open').addClass('visited');
	        } else {
	            selectedPoint.addClass('is-open').siblings('.mt-addons-map-single-point').removeClass('is-open');
	        }
	    });
	    //close interest point description
	    jQuery('.mt-addons-pin-close').on('click', function(event){
	        event.preventDefault();        
	        jQuery(this).parents('.mt-addons-map-single-point').eq(0).removeClass('is-open').addClass('visited');
	    });
	});
	
})( jQuery );