<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class AddonSlider {


    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

        add_action( 'elementor/init', [ $this, 'elementor_init' ] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \AddonSlider
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'ADDON_SLIDER_FILE', __FILE__ );
        define( 'ADDON_SLIDER_PATH', __DIR__ );
        define( 'ADDON_SLIDER_URL', plugins_url( '', ADDON_SLIDER_FILE ) );
        define( 'ADDON_SLIDER_ASSETS', ADDON_SLIDER_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {
            new \DynamicLayers\AddonSlider\Classes\Elementor();

        } else {
            new \DynamicLayers\AddonSlider\Classes\Assets();
        }

    }

    /**
     * Elementor Initialize
     *
     * @return void
     */
    public function elementor_init(){
        
        new \DynamicLayers\AddonSlider\Classes\Widgets();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new \DynamicLayers\AddonSlider\Classes\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \AddonSlider
 */
function slider_init() {
    return AddonSlider::init();
}

// kick-off the plugin
slider_init();
