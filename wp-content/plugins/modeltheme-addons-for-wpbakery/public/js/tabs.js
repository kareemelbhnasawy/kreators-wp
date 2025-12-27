(function( $ ) {
	'use strict';

	jQuery(document).ready(function () {
	    jQuery('.mt-addons-tabs-nav a').on('click', function (event) {
	        event.preventDefault();
	        
	        jQuery('.tab-active').removeClass('tab-active');
	        jQuery(this).parent().addClass('tab-active');
	        jQuery('.mt-addons-tab-content section').hide();
	        jQuery(jQuery(this).attr('href')).show();
	    });

	    jQuery('.mt-addons-tabs-nav a:first').trigger('click');
	});
	
})( jQuery );