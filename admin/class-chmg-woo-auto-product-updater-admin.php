<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/admin
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Chmg_Woo_Auto_Product_Updater_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Chmg_Woo_Auto_Product_Updater_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chmg_Woo_Auto_Product_Updater_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/chmg-woo-auto-product-updater-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name."-chosen-css", "https://harvesthq.github.io/chosen/chosen.css", array(), '', 'all' );


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Chmg_Woo_Auto_Product_Updater_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chmg_Woo_Auto_Product_Updater_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/chmg-woo-auto-product-updater-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name."-chosen-js","//harvesthq.github.io/chosen/chosen.jquery.js", '', true );


	}

	/* Creating the admin menus */
	public function chmg_wapu_admin_menu(){

						add_menu_page(
											$page_title = "Woo Sync", 
											$menu_title = "Woo Sync", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name, 
											$function 	= [$this, 'chmg_wapu_menu_cb'], 
											$icon_url   = 'dashicons-rest-api', 
											$position = 58);

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Sync Sheet", 
											$menu_title = "Sync Sheet", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name, 
											$function 	= [$this, 'chmg_wapu_menu_cb']
										 );
 

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Sheet Mapping", 
											$menu_title = "Sheet Mapping", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name.'_settings', 
											$function 	= [$this, 'chmg_wapu_settings_menu_cb']
										 );

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Product Settings", 
											$menu_title = "Product Settings", 
											$capability = "manage_options", 
											$menu_slug  = 'chmg-woo-auto-product-updater_settings&tab=chmg-woo-product-settings', 
											$function 	= [$this, 'chmg_wapu_automation_menu_cb']
										 );

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Notification Settings", 
											$menu_title = "Notification Settings", 
											$capability = "manage_options", 
											$menu_slug  = 'chmg-woo-auto-product-updater_settings&tab=chmg-woo-notification-settings', 
											$function 	= [$this, 'chmg_wapu_automation_menu_cb']
										 );
						
						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Authorize Sheet", 
											$menu_title = "Authorization Settings", 
											$capability = "manage_options", 
											$menu_slug  = 'chmg-woo-auto-product-updater_settings&tab=chmg-woo-authorization-settings', 
											$function 	= [$this, 'chmg_wapu_authorize_menu_cb']
										 );

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Auto Sync", 
											$menu_title = "Auto Sync Settings", 
											$capability = "manage_options", 
											$menu_slug  = 'chmg-woo-auto-product-updater_settings&tab=chmg-woo-cron-job-settings', 
											$function 	= [$this, 'chmg_wapu_automation_menu_cb']
										 );

 	}
	
	 /**
	  * Main menu callback function
	  * Links to an external sheet in the partials folder
	  * @return void
	  */  
	 
	public function chmg_wapu_menu_cb(){

		include_once( 'partials/chmg-woo-auto-product-updater-admin-display.php' );
 	}	

	 /**
	  * Authorize menu callback function
	  * Links to an external sheet in the partials folder
	  * @return void
	  */  
	public function chmg_wapu_authorize_menu_cb(){

		include_once( 'partials/chmg-woo-auto-product-updater-integration.php' );
	 }	
	 
	 /**
	  * Call back function for the auto Sync menu
	  * @return void
	  */ 

	  public function chmg_wapu_automation_menu_cb(){
		include_once( 'partials/chmg-woo-auto-sync-display.php' );
	  } 
	
	 /**
	  * Settings menu callback function
	  * Links to an external sheet in the partials folder
	  * @return void
	  */  
	public function chmg_wapu_settings_menu_cb(){

		include_once( 'partials/chmg-woo-auto-product-updater-settings.php' );
 	}	

	/**
	 * Handles the form creation for the authorize menu
	 *
	 * @return void
	 */
	public function chmg_wapu_authorize_settings_options(){

		

		/******** SECTION SETTINGS ********/
		add_settings_section(
			'chmg_wapu_general_section',
			__( 'Authorization Settings', TEXT_DOMAIN ),
			[$this, 'chmg_wapu_general_settings_section_cb' ],
			$this->plugin_name.'_integration'
		);

		/*====== Google Api ======*/
		add_settings_field(
			'chmg_wapu_api_token_el',
			__( 'Google Authorization Key', TEXT_DOMAIN),
			[ $this,'chmg_wapu_api_token_cb'],
			$this->plugin_name.'_integration',
			'chmg_wapu_general_section'
 		);
		register_setting( $this->plugin_name.'_integration', 'chmg_wapu_api_token_el');

		/*====== Default sheet ID ======*/
		add_settings_field(
			'chmg_wapu_sheet_id_el',
			__( 'Default Sheet ID', TEXT_DOMAIN),
			[$this,'chmg_wapu_sheet_id_cb'],
			$this->plugin_name.'_integration',
			'chmg_wapu_general_section'
			);
		register_setting( $this->plugin_name.'_integration', 'chmg_wapu_sheet_id_el');
		
		/*====== Default Sheet Names - Used during the cron jobs ======*/
		add_settings_field(
			'chmg_wapu_default_sheet_names_el',
			__( 'Default Sheet Names', TEXT_DOMAIN),
			[$this,'chmg_wapu_default_sheet_names_cb'],
			$this->plugin_name.'_integration',
			'chmg_wapu_general_section'
			);
		register_setting( $this->plugin_name.'_integration', 'chmg_wapu_default_sheet_names_el');
		
	
	}

	/* General settings callback */
	public function chmg_wapu_general_settings_section_cb(){

	}

	/**
	 * Creates the HTML field for accepting the API token
	 *
	 * @return void
	 */
	public function chmg_wapu_api_token_cb(){
		$chmg_wapu_api_token_el =  get_option('chmg_wapu_api_token_el');
		?>

		<div class="chmg-wapu-input">
		 	<input class="regular-text" type="text" name="<?php echo esc_attr('chmg_wapu_api_token_el'); ?>" value="<?php echo esc_attr($chmg_wapu_api_token_el); ?>" >
		</div>
		<p class="description"><?php _e("Paste the API access token from google here.", TEXT_DOMAIN); ?></p>

		<?php
	}

	/**
	 * General settings for handling the settings API 
	 *
	 * @return void
	 */
	public function chmg_wapu_sheet_settings_options(){


		include_once( 'partials/chmg-woo-settings-api/chmg-woo-product-settings.php' );
		include_once( 'partials/chmg-woo-settings-api/chmg-woo-sheet-mapping-settings.php' );
		include_once( 'partials/chmg-woo-settings-api/chmg-woo-notification-settings.php' );
		include_once( 'partials/chmg-woo-settings-api/chmg-woo-cron-settings.php' );

		$product_settings = new CHMG_WOO_PRODUCT_SETTINGS($this->plugin_name);
		$sheet_settings = new CHMG_WOO_SHEET_MAPPING_SETTINGS($this->plugin_name);
		$notification_settings = new CHMG_WOO_NOTIFICATION_SETTINGS($this->plugin_name);
		$cron_job_settings = new CHMG_WOO_CRON_SETTINGS($this->plugin_name);

		$chmg_woo_object_settings = [$product_settings, $sheet_settings, $notification_settings, $cron_job_settings];

		foreach($chmg_woo_object_settings as $settings_object){
			$settings_object->register_section();
			$settings_object->register_fields();
		}

	}

	
  
    /***** CALL BACK FUNCTIONS *******/
    function chmg_wapu_settings_section_cb(){

	}
	

	function chmg_wapu_product_variation_description_cb(){
		$chmg_wapu_product_variation_description_el =  get_option('chmg_wapu_product_variation_description_el');
		?>

		<div class="chmg-wapu-input">
			<label for="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>">
				<input <?php echo ("1" ==$chmg_wapu_product_variation_description_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>" value="1">
					Update product variations description</label>
		</div>

		<?php
	}






	/*====== START GENERAL SETTINGS HTML FIELDS FUNCTIONS======*/
		function chmg_wapu_sheet_id_cb(){
			$chmg_wapu_sheet_id_el =  get_option('chmg_wapu_sheet_id_el');
			?>

			<div class="chmg-wapu-input">
				<input class="regular-text" type="text" name="<?php echo esc_attr('chmg_wapu_sheet_id_el'); ?>" value="<?php echo esc_attr($chmg_wapu_sheet_id_el); ?>" >
			</div>

			<?php
		}


		function chmg_wapu_default_sheet_names_cb(){
			$chmg_wapu_default_sheet_names_el =  get_option('chmg_wapu_default_sheet_names_el');
			?>

			<div class="chmg-wapu-input">
				<textarea name="<?php echo esc_attr('chmg_wapu_default_sheet_names_el'); ?>" id="<?php echo esc_attr('chmg_wapu_default_sheet_names_el'); ?>" class="large-text code" rows="5" ><?php echo esc_attr($chmg_wapu_default_sheet_names_el); ?></textarea>
			</div>

			<?php
		}
	

	/*======END GENERAL SETTINGS FIELDS FUNCTIONS======*/



		
		function chmg_wapu_choose_interval_sanitize($chmg_wapu_new_interval){

				$chmg_wapu_choose_interval_el =  get_option('chmg_wapu_choose_interval_el');

				if($chmg_wapu_new_interval != $chmg_wapu_choose_interval_el){

					$timestamp = wp_next_scheduled( 'chmg_wapu_update_products_hook' );
					wp_unschedule_event( $timestamp, 'chmg_wapu_update_products_hook' );

					if ( !wp_next_scheduled( 'chmg_wapu_update_products_hook' ) ) {
						wp_schedule_event( time(), $chmg_wapu_new_interval, 'chmg_wapu_update_products_hook' );
					}

				}

				return $chmg_wapu_new_interval;

		}
 	/*====== END CRON JOBS SETTINGS HTML FIELDS FUNCTIONS======*/

	/**
	 * Creates a cron job - 
	 *  
	 * @return void
	 */  
	public function chmg_wapu_update_products_exec(){

		//include_once( 'cron-jobs/chmg-woo-product-updates.php' );

		//wp_mail( 'nwachukwu16@gmail.com', 'Drive Inventory Update Status', 'The Drive Inventory on your website was updated at '.date('Y-m-s H:i:s') );
		$chmg_wapu_enable_cron_jobs_el =  get_option('chmg_wapu_enable_cron_jobs_el');
		
		if ('1' == $chmg_wapu_enable_cron_jobs_el){

			$chmg_wapu_choose_interval_el =  get_option('chmg_wapu_choose_interval_el');

			if ( !wp_next_scheduled( 'chmg_wapu_update_products_hook' ) ) {
				wp_schedule_event( time(), $chmg_wapu_choose_interval_el, 'chmg_wapu_update_products_hook' );
			}
		}else{
			$timestamp = wp_next_scheduled( 'chmg_wapu_update_products_hook' );
			wp_unschedule_event( $timestamp, 'chmg_wapu_update_products_hook' );
		}
		
	}

	/**
	 * Handles the function for updating the product data
	 * Called during the CRON execution
	 * @return void
	 */
	public function chmg_wapu_update_products_cron(){
		
		include_once( 'cron-jobs/chmg-woo-product-updates.php' );

	}

	/**
	 * Create a custom cron exec intervals
	 *
	 * @param [array] $schedules
	 * @return void
	 */ 
	public function chmg_wapu_custom_cron_schedules($schedules){
		if(!isset($schedules["1min"])){
			$schedules["1min"] = array(
				'interval' => 1*60,
				'display' => __('Once every minute'));
		}
		if(!isset($schedules["3min"])){
			$schedules["3min"] = array(
				'interval' => 3*60,
				'display' => __('Once every 3 minutes'));
		}
		if(!isset($schedules["5min"])){
			$schedules["5min"] = array(
				'interval' => 5*60,
				'display' => __('Once every 5 minutes'));
		}
		if(!isset($schedules["30min"])){
			$schedules["30min"] = array(
				'interval' => 30*60,
				'display' => __('Once every 30 minutes'));
		}
		return $schedules;
	}

}
