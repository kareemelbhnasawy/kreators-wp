(function( $ ) {
	'use strict';

	jQuery(document).ready(function () {
	    jQuery('.mt-addons-tabs-nav-v2 a').on('click', function (event) {
	        event.preventDefault();
	        
	        jQuery('.tab-active').removeClass('tab-active');
	        jQuery(this).parent().addClass('tab-active');
	        jQuery('.mt-addons-tab-content-v2 section').hide();
	        jQuery(jQuery(this).attr('href')).show();
	    });

	    jQuery('.mt-addons-tabs-nav-v2 a:first').trigger('click');
	});
	
})( jQuery );