// Script for Accordion only

	// TIMELINE VERTICAL
	jQuery(document).ready(function(jQuery){
	  var timelineBlocks = jQuery('.mt-addons-timeline-item'),
	    offset = 0.8;

	  //hide timeline blocks which are outside the viewport
	  hideBlocks(timelineBlocks, offset);

	  //on scolling, show/animate timeline blocks when enter the viewport
	  jQuery(window).on('scroll', function(){
	    (!window.requestAnimationFrame) 
	      ? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
	      : window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
	  });

	  function hideBlocks(blocks, offset) {
	    blocks.each(function(){
	      ( jQuery(this).offset().top > jQuery(window).scrollTop()+jQuery(window).height()*offset ) && jQuery(this).find('.mt-addons-timeline-img, .mt-addons-timeline-content, .mt-addons-timeline-date, .mt-addons-timeline-title, .mt-addons-timeline-desc').addClass('is-hidden');
	    });
	  }

	  function showBlocks(blocks, offset) {
	    blocks.each(function(){
	      ( jQuery(this).offset().top <= jQuery(window).scrollTop()+jQuery(window).height()*offset && jQuery(this).find('.mt-addons-timeline-img').hasClass('is-hidden') ) && jQuery(this).find('.mt-addons-timeline-img, .mt-addons-timeline-content, .mt-addons-timeline-date, .mt-addons-timeline-title, .mt-addons-timeline-desc').removeClass('is-hidden').addClass('bounce-in');
	    });
	  }
	});
