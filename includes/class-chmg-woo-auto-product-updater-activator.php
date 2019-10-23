<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/includes
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Chmg_Woo_Auto_Product_Updater_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		update_option('chmg_wapu_enable_cron_jobs_el', '-1');
		update_option('chmg_wapu_choose_interval_el', 'daily');

		update_option('chmg_wapu_email_who_el', 'admin_only');
 		update_option('chmg_wapu_auto_sync_notification_el', '1');
		update_option('chmg_wapu_manual_sync_notification_el', '1');
	}

}
