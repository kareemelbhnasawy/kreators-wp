<?php
/**
 * Assets class
 *
 * @package AddonSlider
 */
namespace DynamicLayers\AddonSlider\Classes;

defined( 'ABSPATH' ) || die();

class Assets {

    /**
     * Init
     */
    function __construct() {

        add_action( "elementor/frontend/after_enqueue_styles", [$this, 'register_styles'] );
        add_action( "elementor/frontend/after_register_scripts", [$this, 'register_scripts'], 100 );

    }

    /**
     * Register styles
     *
     * @return void
     */
    public function register_styles() {

        $min = ( WP_DEBUG === true ) ? '' : '.min';
        wp_register_style( 'splitting', ADDON_SLIDER_ASSETS . '/css/lib/splitting.min.css', false, '1.0' );
        wp_register_style( 'slider-style', ADDON_SLIDER_ASSETS . '/css/widgets/slider' . $min . '.css', false, time() );

    }

    /**
     * Register Scripts
     *
     * @return void
     */
    public function register_scripts() {
        $min = ( WP_DEBUG === true ) ? '' : '.min';
        wp_register_script( 'splitting', ADDON_SLIDER_ASSETS . '/js/lib/splitting.min.js', [], '1.0', true );
        wp_register_script( 'slider-script', ADDON_SLIDER_ASSETS . '/js/slider'. $min .'.js', ['jquery', 'elementor-frontend'], time(), true );
    }

}