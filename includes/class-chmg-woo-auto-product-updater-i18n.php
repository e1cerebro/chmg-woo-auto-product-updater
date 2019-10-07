<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/includes
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Chmg_Woo_Auto_Product_Updater_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'chmg-woo-auto-product-updater',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
