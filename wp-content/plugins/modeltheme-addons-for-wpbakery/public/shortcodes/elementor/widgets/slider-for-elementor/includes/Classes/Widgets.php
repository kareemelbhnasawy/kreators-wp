<?php
/**
 * Widgets class
 *
 * @package AddonSlider
 */
namespace DynamicLayers\AddonSlider\Classes;

use \Elementor\Plugin as Plugin;

defined( 'ABSPATH' ) || die();

class Widgets {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'elementor/widgets/register', [ $this, 'register'] );
    }

    public function get_widgets() {
        return [
            'Slider'
        ];
    }

    /**
     * Widgets Register
     *
     * @return void
     */
    public function register() {
        $widgets = $this->get_widgets();
        if ( $widgets ) {
            foreach ($widgets as $widget){
                $widget_init = '\DynamicLayers\AddonSlider\Widgets\\'. $widget .'\\Widget';
                Plugin::instance()->widgets_manager->register( new $widget_init );
            }
        }
    }
}
