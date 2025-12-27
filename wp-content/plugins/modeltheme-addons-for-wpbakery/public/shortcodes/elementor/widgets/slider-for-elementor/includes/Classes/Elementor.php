<?php
/**
 * Elementor class
 *
 * @package AddonSlider
 */
namespace DynamicLayers\AddonSlider\Classes;

defined( 'ABSPATH' ) || die();

class Elementor {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'elementor/init', [ $this, 'elementor_init' ] );
    }

    /**
     * Elementor Init
     */
    public function elementor_init(){
        // Register Category
        \Elementor\Plugin::instance()->elements_manager->add_category(
			'modeltheme-addons-for-wpbakery',
			[
				'title'  => esc_html__( 'MT: Slider', 'modeltheme-addons-for-wpbakery'),
				'icon' => 'eicon-slides'
			],
			1
        );

    }
}
