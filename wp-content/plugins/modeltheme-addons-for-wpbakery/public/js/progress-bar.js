(function ($) {
    
    $(document).ready(function () {
        MTProgressBar.init();
    });
     
    var MTProgressBar = {
        init: function () {
            var bars = $('.mt-addons-progress-bar');

            if (bars.length) {
                bars.each(function (i) {

                    // Getting progress bar attrs

                    var thisItem = $(this), 
                        thisItem_id = thisItem.attr('id'),
                        thisItem_id_attr = thisItem.attr('data-progressbar-id'),
                        color = thisItem.attr('data-progressbar-color'),
                        trail_color = thisItem.attr('data-progressbar-trail-color'),
                        duration = thisItem.attr('data-progressbar-duration'),
                        number = thisItem.attr('data-progressbar-data-number'),
                        stroke_width = thisItem.attr('data-progressbar-data-bar-stroke'),
                        bar_height = thisItem.attr('data-progressbar-data-bar-height'),
                        trail_width = thisItem.attr('data-progressbar-data-trail-width'),
                        percentageType = thisItem.attr('data-progressbar-percentage-type');
         				
					if (color == '') {
                        color = '#FFEA82';
                    }
                    
                    if (trail_color == '') {
                        trail_color = '#eee';
                    }else{
                        trail_color = trail_color;
                    }
                    if (duration == '') {
                        duration = 1400;
                    }else{
                        duration = parseInt(duration);
                    }
 					if (number == '') {
                      number = 0.5;
                    }else{
                      number = number;
                    }
                    if (stroke_width == '') {
                        stroke_width = 4;
                    }else{
                        stroke_width = stroke_width;
                    }
                    if (bar_height == '') {
                        bar_height = 100;
                    }else{
                        bar_height = bar_height;
                    }
                    if (trail_width == '') {
                        trail_width = 100;
                    }else{
                        trail_width = trail_width;
                    }
                     // alert(trail_color);
                    var bar = new ProgressBar.Line("#"+thisItem_id,
                    {
					  strokeWidth: stroke_width,
                      easing: 'bounce',
					  duration: duration,
					  color: color,
					  trailColor: trail_color,
					  trailWidth: trail_width,
					  svgStyle: {
					  	width: '100%', 
					  	height: bar_height,
					  },
					  text: {
						className: percentageType,

					    style: {
					      // Text color.
					      // Default: same as stroke color (options.color)
					      color: '#999',
					      position: 'absolute',
					      right: '0',
					      top: '30px',
					      padding: 0,
					      margin: 0,
					      transform: null
					    },
					    autoStyleContainer: false
					  },
					  from: {color: '#FFEA82'},
					  to: {color: '#ED6A5A'},
					  step: (state, bar) => {
					    bar.setText(Math.round(bar.value() * 100) + ' %');
					  }

                   
					});
					bar.animate( number );  // Number from 0.0 to 1.0
                });

            }
        }

    };
    
})(jQuery);
