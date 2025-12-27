(function ($, elementor) {

    'use strict';

    function sliderAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function () {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationDuration = $this.data('duration');
            var $animationType = 'dl-animation ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay,
                'animation-duration': $animationDuration
            });
            $this.addClass($animationType).one(animationEndEvents, function () {
                $this.removeClass($animationType);
            });
        });
    }

    var MT_Addons_Slider = function ($scope, $) {

        var $slider = $($scope).find(".mt-slider"),
            $wid = $scope.data("id"),
            $sliderSettings = $slider.data('settings');
        let swiper;
        if (!$slider.length) {
            return;
        }

        var $SliderOptions = {
            speed: $sliderSettings.speed,
            initialSlide: $sliderSettings.initialSlide,
            parallax: $sliderSettings.parallax,
            mousewheel: $sliderSettings.mousewheel,
            loop: $sliderSettings.loop,
            grabCursor: $sliderSettings.grabCursor
        };

        $SliderOptions.on = {
            init: function () {
                var swiper = this;
                // Hide preloader when swiper is initialized
                $slider.addClass('swiper-initialized');
                
                if ($SliderOptions.parallax === true) {
                    for (var i = 0; i < swiper.slides.length; i++) {
                        $(swiper.slides[i]).find('.slide-img-wrap').attr({ 'data-swiper-parallax': 0.75 * swiper.width });
                    }
                }
                // Initialize splitting for the active slide
                if (typeof Splitting !== 'undefined') {
                    Splitting();
                }
            },
            slideChangeTransitionStart: function () {
                var swiper = this;
                var animatingElements = $(swiper.slides[swiper.activeIndex]).find('[data-animation]');
                sliderAnimations(animatingElements);
                // Re-initialize splitting for the new active slide
                if (typeof Splitting !== 'undefined') {
                    Splitting();
                }
            },
            resize: function () {
                this.update();
            }
        };

        if (true === $sliderSettings.autoplay) {
            $SliderOptions.autoplay = {
                delay: $sliderSettings.autoplaySpeed
            }
            // if ($sliderSettings.pauseOnHover === true) {
            //     $($slider).hover(function () {
            //         (this).swiper.autoplay.stop();
            //     }, function () {
            //         (this).swiper.autoplay.start();
            //     });
            // }
        }

        if ($SliderOptions.parallax != true) {
            $SliderOptions.direction = $sliderSettings.direction;
            $SliderOptions.effect = $sliderSettings.effect;
            if ('coverflow' === $SliderOptions.effect) {
                $SliderOptions.coverflowEffect = {
                    rotate: 30,
                    slideShadows: false,
                }
            } else if ('fade' === $SliderOptions.effect) {
                $SliderOptions.fadeEffect = {
                    crossFade: true
                }
            } else if ('flip' === $SliderOptions.effect) {
                $SliderOptions.flipEffect = {
                    slideShadows: false
                }
            } else if ('cube' === $SliderOptions.effect) {
                $SliderOptions.cubeEffect = {
                    slideShadows: false
                }
            }
        }

        if ('yes' === $sliderSettings.navigation) {
            $SliderOptions.navigation = {
                nextEl: '.mt-slider-button-next',
                prevEl: '.mt-slider-button-prev'
            }
        }

        // Pagination
        if ('yes' === $sliderSettings.pagination) {
            if ('style-1' === $sliderSettings.pagiStyle) {
                $SliderOptions.pagination = {
                    el: '.mt-swiper-pagination',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + '<svg class="dl-circle-loader" width="20" height="20" viewBox="0 0 20 20">' +
                            '<circle class="path" cx="10" cy="10" r="5.5" fill="none" transform="rotate(-90 10 10)"' +
                            'stroke-opacity="1" stroke-width="2px"></circle>' +
                            '<circle class="solid-fill" cx="10" cy="10" r="3"></circle>' +
                            '</svg></span>';
                    }
                }
            } else if ('style-4' === $sliderSettings.pagiStyle) {
                $SliderOptions.pagination = {
                    el: '.mt-swiper-pagination',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '"><span class="number">0' + (index + 1) + '</span><span class="line"></span></span>';
                    }
                }
            } else if ('style-6' === $sliderSettings.pagiStyle) {
                $SliderOptions.pagination = {
                    el: '.mt-swiper-pagination',
                    clickable: true,
                    type: 'fraction',
                    formatFractionCurrent: function (number) {
                        if (number < 10) {
                            return '0' + number;
                        } else {
                            return number;
                        }
                    },
                    formatFractionTotal: function (number) {
                        if (number < 10) {
                            return '0' + number;
                        } else {
                            return number;
                        }
                    }
                }
            } else {
                $SliderOptions.pagination = {
                    el: '.mt-swiper-pagination',
                    clickable: true
                }
            }
        }

        // Initialize Swiper
        try {
            if (typeof Swiper !== 'undefined') {
                // Direct Swiper initialization
                swiper = new Swiper($slider[0], $SliderOptions);
                $slider.css("visibility", "visible");
            } else if (typeof elementorFrontend !== 'undefined' && elementorFrontend.utils && elementorFrontend.utils.swiper) {
                // Elementor async Swiper initialization
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($slider, $SliderOptions)
                    .then((newSwiperInstance) => {
                        swiper = newSwiperInstance;
                    })
                    .catch((error) => {
                        console.error('Swiper initialization failed:', error);
                        // Fallback: hide preloader even if swiper fails
                        $slider.addClass('swiper-initialized');
                    });
            } else {
                // Fallback: hide preloader if Swiper is not available
                console.warn('Swiper not available, hiding preloader');
                $slider.addClass('swiper-initialized');
            }
        } catch (error) {
            console.error('Swiper initialization error:', error);
            // Fallback: hide preloader on error
            $slider.addClass('swiper-initialized');
        }

        // Fallback timeout to hide preloader if initialization takes too long
        setTimeout(function() {
            if (!$slider.hasClass('swiper-initialized')) {
                console.warn('Swiper initialization timeout, hiding preloader');
                $slider.addClass('swiper-initialized');
            }
        }, 5000);

        if (true === $sliderSettings.autoplay) {
            if ($sliderSettings.pauseOnHover === true) {
                $slider.hover(
                    function () {
                        swiper.autoplay.stop();
                    },
                    function () {
                        swiper.autoplay.start();
                    }
                );
            }
        }

    };

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/mtfe-slider.default', MT_Addons_Slider);
    });

    // Fallback initialization for Splitting
    jQuery(document).ready(function() {
        if (typeof Splitting !== 'undefined') {
            Splitting();
        } else {
            // Wait for Splitting to load
            setTimeout(function() {
                if (typeof Splitting !== 'undefined') {
                    Splitting();
                }
            }, 1000);
        }
    });

}(jQuery, window.elementorFrontend));