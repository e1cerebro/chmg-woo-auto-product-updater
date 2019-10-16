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
											$page_title = "Auto Sync", 
											$menu_title = "Auto Sync", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name.'_automation', 
											$function 	= [$this, 'chmg_wapu_automation_menu_cb']
										 );

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Authorize Sheet", 
											$menu_title = "Authorize Sheet", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name.'_integration', 
											$function 	= [$this, 'chmg_wapu_authorize_menu_cb']
										 );

					

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Settings", 
											$menu_title = "Settings", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name.'_settings', 
											$function 	= [$this, 'chmg_wapu_settings_menu_cb']
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
 
			/******** Start Sheet Mapping Section ********/
				add_settings_section(
					'chmg_wapu_section',
					__( 'Map Sheet To Columns', TEXT_DOMAIN ),
					[$this, 'chmg_wapu_settings_section_cb'],
					$this->plugin_name.'_settings'
				);
			/******** End Sheet Mapping Section ********/
			
			/******* Start Sheet Mapping Field ********/
				/*====== PRODUCT SKU SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_product_sku_el',
					__( 'Product SKU', TEXT_DOMAIN),
					[$this,'chmg_wapu_product_sku_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_product_sku_el');
		
				/*====== MAP PRICE SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_map_price_el',
					__( 'MAP Price', TEXT_DOMAIN),
					[$this,'chmg_wapu_map_price_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_map_price_el');

				/*====== Swap MAP with regular price when product is on sale ======*/
				add_settings_field(
					'chmg_wapu_set_map_price_el',
					__( 'MAP &#10152; Regular Price', TEXT_DOMAIN),
					[$this,'chmg_wapu_set_map_price_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_set_map_price_el');
	

				/*====== REGULAR PRICE SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_regular_price_el',
					__( 'Regular Price', TEXT_DOMAIN),
					[$this,'chmg_wapu_regular_price_cb'],
				$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_regular_price_el');

				/*====== SALES PRICE SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_sales_price_el',
					__( 'Sales Price', TEXT_DOMAIN),
					[$this,'chmg_wapu_sales_price_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_sales_price_el');
	

				/*====== SHORT DESCRIPTION SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_short_description_el',
					__( 'Short Description', TEXT_DOMAIN),
					[$this,'chmg_wapu_short_description_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_short_description_el');
	
				/*====== MAIN DESCRIPTION SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_main_description_el',
					__( 'Main Description', TEXT_DOMAIN),
					[$this,'chmg_wapu_main_description_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_main_description_el');

				/*====== ON SALE INDICATOR SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_on_sale_el',
					__( 'On Sale Indicator', TEXT_DOMAIN),
					[$this,'chmg_wapu_on_sale_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_on_sale_el');
				
				/*====== SKIP PRODUCT SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_skip_product_el',
					__( 'Ignore Product', TEXT_DOMAIN),
					[$this,'chmg_wapu_skip_product_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_skip_product_el');
			/******* End Sheet Mapping Field ********/

			/******** Start Cron Job Section ********/
				add_settings_section(
					'chmg_wapu_cron_section',
					__( 'Cron Jobs', TEXT_DOMAIN ),
					[$this, 'chmg_wapu_settings_section_cb'],
					$this->plugin_name.'_automation'
				);
			/******** End Cron Job Section ********/

			/******** Start Cron Job Field ********/

				/*====== Enable Cron Jobs ======*/
				add_settings_field(
					'chmg_wapu_enable_cron_jobs_el',
					__( 'Enable Cron Jobs', TEXT_DOMAIN),
					[$this,'chmg_wapu_enable_cron_jobs_cb'],
					$this->plugin_name.'_automation',
					'chmg_wapu_cron_section'
					);
				register_setting( $this->plugin_name.'_automation', 'chmg_wapu_enable_cron_jobs_el');
	
				/*====== Execution Interval ======*/
				add_settings_field(
					'chmg_wapu_choose_interval_el',
					__( 'Execution Interval', TEXT_DOMAIN),
					[$this,'chmg_wapu_choose_interval_cb'],
					$this->plugin_name.'_automation',
					'chmg_wapu_cron_section'
					);
				register_setting( $this->plugin_name.'_automation', 'chmg_wapu_choose_interval_el', [$this, 'chmg_wapu_choose_interval_sanitize']);
			
			/******** End Cron Job Field ********/
	}

	
  
    /***** CALL BACK FUNCTIONS *******/
    function chmg_wapu_settings_section_cb(){

    }

	/*============ Start Sheet Mapping  HMTL creation functions ============*/
		/**
		 * Create the HTML for the product SKU
		 *
		 * @return void
		 */ 
		function chmg_wapu_product_sku_cb(){
			$chmg_wapu_product_sku_el =  get_option('chmg_wapu_product_sku_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_product_sku_el'); ?>" id="<?php echo esc_attr('chmg_wapu_product_sku_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
 						<?php else: ?>
							<option <?php echo ($chmg_wapu_product_sku_el== $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>					<?php endforeach; ?>
				</select>
			</div>

			<?php
		}
		
		/**
		 * Create the MAP price HTML
		 *
		 * @return void
		 */
		function chmg_wapu_map_price_cb(){
			$chmg_wapu_map_price_el =  get_option('chmg_wapu_map_price_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_map_price_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
 						<?php else: ?>
							<option <?php echo ($chmg_wapu_map_price_el== $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}
		
		/**
		 * Generate the HTML for Regular Price
		 *
		 * @return void
		 */ 
		function chmg_wapu_regular_price_cb(){
			$chmg_wapu_regular_price_el =  get_option('chmg_wapu_regular_price_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_regular_price_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
							<option <?php echo ($chmg_wapu_regular_price_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php else: ?>
							<option <?php echo ($chmg_wapu_regular_price_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}

		/**
		 * Create HTML for sales price
		 *
		 * @return void
		 */
		function chmg_wapu_sales_price_cb(){
			$chmg_wapu_sales_price_el =  get_option('chmg_wapu_sales_price_el');
			?>
	
			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_sales_price_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
							<option <?php echo ($chmg_wapu_sales_price_el== $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php else: ?>
							<option <?php echo ($chmg_wapu_sales_price_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>						
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}

		/**
		 * Create HTML for short description
		 *
		 * @return void
		 */
		function chmg_wapu_short_description_cb(){
			$chmg_wapu_short_description_el =  get_option('chmg_wapu_short_description_el');
			?>
	
			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_short_description_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
							<option <?php echo ($chmg_wapu_short_description_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php else: ?>
							<option <?php echo ($chmg_wapu_short_description_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>						
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}

		/**
		 * Create HTML for Main Description
		 *
		 * @return void
		 */
		function chmg_wapu_main_description_cb(){
			$chmg_wapu_main_description_el =  get_option('chmg_wapu_main_description_el');
			?>
	
			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_main_description_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
							<option <?php echo ($chmg_wapu_main_description_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php else: ?>
							<option <?php echo ($chmg_wapu_main_description_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}
	
		/**
		 * Create HTML for the on sale indicator
		 *
		 * @return void
		 */
		function chmg_wapu_on_sale_cb(){
			$chmg_wapu_on_sale_el =  get_option('chmg_wapu_on_sale_el');
			?>
	
			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_on_sale_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
						<option <?php echo ($chmg_wapu_on_sale_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>	
 						<?php else: ?>
							<option <?php echo ($chmg_wapu_on_sale_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php endif ?>					
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}
	
		/**
		 * Create HTM for the skip product indicator
		 *
		 * @return void
		 */ 
		function chmg_wapu_skip_product_cb(){
			$chmg_wapu_skip_product_el =  get_option('chmg_wapu_skip_product_el');
			?>
	
			<div class="chmg_wapu_input">
				<select name="<?php echo esc_attr('chmg_wapu_skip_product_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' != $key): ?>	
							<option <?php echo ($chmg_wapu_skip_product_el== $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
						<?php else: ?>
							<option <?php echo ($chmg_wapu_skip_product_el== $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo "<strong>".$value."</strong>"; ?></option>	
						<?php endif ?>
					<?php endforeach; ?>
				</select>
			</div>
	
			<?php
		}


	/*============ End Sheet Mapping HMTL creation functions ============*/
 

	/*====== START GENERAL SETTINGS HTML FIELDS FUNCTIONS======*/
		function chmg_wapu_sheet_id_cb(){
			$chmg_wapu_sheet_id_el =  get_option('chmg_wapu_sheet_id_el');
			?>

			<div class="chmg-wapu-input">
				<input class="regular-text" type="text" name="<?php echo esc_attr('chmg_wapu_sheet_id_el'); ?>" value="<?php echo esc_attr($chmg_wapu_sheet_id_el); ?>" >
			</div>

			<?php
		}

		function chmg_wapu_set_map_price_cb(){
			$chmg_wapu_set_map_price_el =  get_option('chmg_wapu_set_map_price_el');
			?>

			<div class="chmg-wapu-input">
				<label for="<?php echo esc_attr('chmg_wapu_set_map_price_el'); ?>">
					<input <?php echo ("1" == $chmg_wapu_set_map_price_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_set_map_price_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_set_map_price_el'); ?>" value="1">
						Show MAP price when product is on sale</label>
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


	/*====== START CRON JOBS SETTINGS HTML FIELDS FUNCTIONS======*/
		function chmg_wapu_enable_cron_jobs_cb(){
			$chmg_wapu_enable_cron_jobs_el =  get_option('chmg_wapu_enable_cron_jobs_el');
			?>

			<div class="chmg-wapu-input">
				<label for="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>">
					<input <?php echo ("1" == $chmg_wapu_enable_cron_jobs_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>" value="1">
						Toggle this to enable/disable cron jobs</label>
			</div>

			<?php
		}
		
		function chmg_wapu_choose_interval_cb(){
			$chmg_wapu_choose_interval_el =  get_option('chmg_wapu_choose_interval_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_choose_interval_el'); ?>">
					<?php foreach( CRON_INTERVALS as $key => $value): ?>
						<option <?php echo ($chmg_wapu_choose_interval_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php
		}
		
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
