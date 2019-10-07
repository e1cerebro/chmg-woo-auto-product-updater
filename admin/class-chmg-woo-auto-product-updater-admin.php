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

	public function chmg_wapu_admin_menu(){

		add_menu_page(
						$page_title = "Woo Store Option", 
						$menu_title = "Woo Store Option", 
						$capability = "manage_options", 
						$menu_slug  = $this->plugin_name, 
						$function 	= [$this, 'chmg_wapu_menu_cb'], 
						$icon_url   = '', 
						$position = 36);

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Woo Store Option", 
											$menu_title = "Woo Store Option", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name, 
											$function 	= [$this, 'chmg_wapu_menu_cb']
										 );

						add_submenu_page( 
											$parent_slug  = $this->plugin_name, 
											$page_title = "Sheet Integration", 
											$menu_title = "Integration", 
											$capability = "manage_options", 
											$menu_slug  = $this->plugin_name.'_integration', 
											$function 	= [$this, 'chmg_wapu_integration_menu_cb']
										 );
	}
 
	public function chmg_wapu_menu_cb(){

		include_once( 'partials/chmg-woo-auto-product-updater-admin-display.php' );
 	}	

	public function chmg_wapu_integration_menu_cb(){

		include_once( 'partials/chmg-woo-auto-product-updater-integration.php' );
 	}	

	public function chmg_wapu_settings_options(){

		/******** SECTION SETTINGS ********/
		add_settings_section(
			'chmg_wapu_general_section',
			__( 'Authorization Settings', 'chmg-woo-auto-product-updater' ),
			[$this, 'chmg_wapu_general_settings_section_cb' ],
			$this->plugin_name
		);

		/* Google Api */
		add_settings_field(
			'chmg_wapu_api_token_el',
			__( 'Google Authorization Key', TEXT_DOMAIN),
			[ $this,'chmg_wapu_api_token_cb'],
			$this->plugin_name,
			'chmg_wapu_general_section'
 		);
		register_setting( $this->plugin_name, 'chmg_wapu_api_token_el');

	}

	/* General settings callback */
	public function chmg_wapu_general_settings_section_cb(){

	}

	/* Field callback functions */
	public function chmg_wapu_api_token_cb(){
		$chmg_wapu_api_token_el =  get_option('chmg_wapu_api_token_el');
		?>

		<div class="chmg_bp-input">
		 	<input class="regular-text" type="text" name="<?php echo esc_attr('chmg_wapu_api_token_el'); ?>" value="<?php echo esc_attr($chmg_wapu_api_token_el); ?>" >
		</div>
		<p class="description"><?php _e("Paste the API access token here", TEXT_DOMAIN); ?></p>

		<?php
	}




}
