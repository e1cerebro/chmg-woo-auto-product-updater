<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Chmg_Woo_Auto_Product_Updater
 *
 * @wordpress-plugin
 * Plugin Name:       CHMG Woo Auto Product Updater 
 * Plugin URI:        https://github.com/e1cerebro/chmg-woo-auto-product-updater
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Canadian Home Medical Group
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       chmg-woo-auto-product-updater
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CHMG_WOO_AUTO_PRODUCT_UPDATER_VERSION', '1.0.0' );
define( 'TEXT_DOMAIN', 'chmg-woo-auto-product-updater');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-chmg-woo-auto-product-updater-activator.php
 */
function activate_chmg_woo_auto_product_updater() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-chmg-woo-auto-product-updater-activator.php';
	Chmg_Woo_Auto_Product_Updater_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-chmg-woo-auto-product-updater-deactivator.php
 */
function deactivate_chmg_woo_auto_product_updater() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-chmg-woo-auto-product-updater-deactivator.php';
	Chmg_Woo_Auto_Product_Updater_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_chmg_woo_auto_product_updater' );
register_deactivation_hook( __FILE__, 'deactivate_chmg_woo_auto_product_updater' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-chmg-woo-auto-product-updater.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_chmg_woo_auto_product_updater() {

	$plugin = new Chmg_Woo_Auto_Product_Updater();
	$plugin->run();

}
run_chmg_woo_auto_product_updater();
