<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/* Unschedule All the cron events */
$timestamp = wp_next_scheduled( 'chmg_wapu_update_products_hook' );
wp_unschedule_event( $timestamp, 'chmg_wapu_update_products_hook' );			
		


/* Deleting all the options */
delete_option('chmg_wapu_enable_cron_jobs_el');
delete_option('chmg_wapu_choose_interval_el');
delete_option('chmg_wapu_product_sku_el');
delete_option('chmg_wapu_map_price_el');
delete_option('chmg_wapu_regular_price_el');
delete_option('chmg_wapu_sales_price_el');
delete_option('chmg_wapu_short_description_el');
delete_option('chmg_wapu_main_description_el');
delete_option('chmg_wapu_on_sale_el');
delete_option('chmg_wapu_skip_product_el');
delete_option('chmg_wapu_sheet_id_el');
delete_option('chmg_wapu_default_sheet_names_el');
delete_option('chmg_wapu_set_map_price_el');
delete_option('sheet_access_token');
delete_option('chmg_wapu_api_token_el');
  