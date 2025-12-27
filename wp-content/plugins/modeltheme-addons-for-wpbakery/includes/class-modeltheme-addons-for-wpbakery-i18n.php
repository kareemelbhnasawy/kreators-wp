<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://modeltheme.com/
 * @since      1.0.0
 *
 * @package    Modeltheme_Addons_For_Wpbakery
 * @subpackage Modeltheme_Addons_For_Wpbakery/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Modeltheme_Addons_For_Wpbakery
 * @subpackage Modeltheme_Addons_For_Wpbakery/includes
 * @author     ModelTheme <support@modeltheme.com>
 */
class Modeltheme_Addons_For_Wpbakery_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'modeltheme-addons-for-wpbakery',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
