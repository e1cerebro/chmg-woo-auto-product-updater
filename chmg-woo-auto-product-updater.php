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
define( 'CHMG_WAPU_ADMIN_EMAIL', get_option('admin_email') );
define( 'TEXT_DOMAIN', 'chmg-woo-auto-product-updater');
define( 'CRON_INTERVALS', [	'1min' => 'Once every minute',
							'3min' => 'Once every 3 minutes',
							'30min' => 'Once every 30 minutes',
							'hourly' => 'Once every hour',
							'twicedaily' => 'Twice daily',
							'daily' => 'Once daily',]);
define( 'ALPHABETS_MAPPING', [	'-1' => 'Skip This Option',
								'0' => 'A', 
								'1' => 'B', 
								'2' => 'C', 
								'3' => 'D', 
								'4' => 'E', 
								'5' => 'F', 
								'6' => 'G', 
								'7' => 'H', 
								'8' => 'I', 
								'9' => 'J', 
								'10'=>'K', 
								'11'=>'L', 
								'12'=>'M', 
								'13'=>'N', 
								'14'=>'O', 
								'15'=>'P', 
								'16'=>'Q', 
								'17'=>'R', 
								'18'=>'S', 
								'19'=>'T', 
								'20'=>'U', 
								'21'=>'V', 
								'22'=>'W', 
								'23'=>'X', 
								'24'=>'Y', 
								'25'=>'Z',
								'26' => 'AA', 
								'27' => 'AB', 
								'28' => 'AC', 
								'29' => 'AD', 
								'30' => 'AE', 
								'31' => 'AF', 
								'32' => 'AG', 
								'33' => 'AH', 
								'34' => 'AI', 
								'35' => 'AJ', 
								'36'=>'AK', 
								'37'=>'AL', 
								'38'=>'AM', 
								'39'=>'AN', 
								'40'=>'AO', 
								'41'=>'AP', 
								'42'=>'AQ', 
								'43'=>'AR', 
								'44'=>'AS', 
								'45'=>'AT', 
								'46'=>'AU', 
								'47'=>'AV', 
								'48'=>'AW', 
								'49'=>'AX', 
								'50'=>'AY', 
								'51'=>'AZ',
								]);


define('CHMG_ADMIN_IMAGE_PATH', plugin_dir_url( __FILE__ ).'admin/img/');

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
