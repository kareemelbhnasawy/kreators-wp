// Script for Category tabs only
(function( $ ) {
	'use strict';

	jQuery(document).ready(function () {
	    jQuery('.mt-addons-category-nav a').on('click', function (event) {
	        event.preventDefault();
	        
	        jQuery('.tab-active').removeClass('tab-active');
	        jQuery(this).parent().addClass('tab-active');
	        jQuery('.mt-addons-products-wrap section').hide();
	        jQuery(jQuery(this).attr('href')).show();
	    });

	    jQuery('.mt-addons-category-nav a:first').trigger('click');
	});
	
})( jQuery );