
(function($) { "use strict";
    
  //Page cursors

    document.getElementsByTagName("body")[0].addEventListener("mousemove", function(n) {
        t.style.left = n.clientX + "px", 
    t.style.top = n.clientY + "px", 
    e.style.left = n.clientX + "px", 
    e.style.top = n.clientY + "px", 
    i.style.left = n.clientX + "px", 
    i.style.top = n.clientY + "px"
    });
    var t = document.getElementById("mt-portfolio-grid-image-cursor"),
        e = document.getElementById("mt-portfolio-grid-image-cursor2"),
        i = document.getElementById("mt-portfolio-grid-image-cursor3");
    function n(t) {
        e.classList.add("hover"), i.classList.add("hover")
    }
    function s(t) {
        e.classList.remove("hover"), i.classList.remove("hover")
    }
    s();
    for (var r = document.querySelectorAll(".mt-portfolio-grid-images-hover-target"), a = r.length - 1; a >= 0; a--) {
        o(r[a])
    }
    function o(t) {
        t.addEventListener("mouseover", n), t.addEventListener("mouseout", s)
    }
  
    $(document).ready(function() {
      $(document).on('mouseenter', '.mt-portfolio-grid-images-name', function() {
        var index = $(this).index() + 1;

        // Remove show class from existing shown image
        $('.mt-portfolio-grid-images li.show').removeClass('show');

        // Add show class to the corresponding image based on the index
        $('.mt-portfolio-grid-images li:nth-child(' + index + ')').addClass('show');

        // Handle other actions specific to the hovered item
      });

      $('.mt-portfolio-grid-images-name:nth-child(1)').trigger('mouseenter');
    });

})(jQuery); 