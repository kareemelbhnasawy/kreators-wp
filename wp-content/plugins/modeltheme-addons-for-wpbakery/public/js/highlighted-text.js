// Script for Highlighted Text only
(function( $ ) {
	'use strict';

	setTimeout(function() {
	  var animating = document.querySelectorAll('.mt-addons-text-highlighted.animating');
	  for (var i = 0; i < animating.length; i++) {
	    animating[i].classList.remove('animating');
	  }
	}, 2000);

})( jQuery );