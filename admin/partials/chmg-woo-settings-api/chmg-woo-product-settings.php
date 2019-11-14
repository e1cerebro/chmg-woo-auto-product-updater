<?php
class CHMG_WOO_PRODUCT_SETTINGS{
   
    private $plugin_name;
    
    public function __construct( $plugin_name ) {
        require_once __DIR__ .'../../custom-functions/chmg-woo-db-utils.php';
 		$this->plugin_name = $plugin_name;
     }
    
     public function register_section(){

        add_settings_section(
            'chmg_wapu_product_settings_section',
            __( 'Product Settings', TEXT_DOMAIN ),
            '',
            $this->plugin_name.'-product-settings'
        );
     }
     
     public function register_fields(){
		
		add_settings_field(
            'chmg_wapu_product_variation_description_el',
            __( 'Product Variation Description', TEXT_DOMAIN),
            [$this,'chmg_wapu_product_variation_description_cb'],
            $this->plugin_name.'-product-settings',
            'chmg_wapu_product_settings_section'
        );
        register_setting(  $this->plugin_name.'-product-settings', 'chmg_wapu_product_variation_description_el');
		
		 
     }
	 
	 	/* ---------- START CARD BLOCK HTML FIELDS --------------- */
        public function chmg_wapu_product_variation_description_cb(){
            $chmg_wapu_product_variation_description_el =  get_option('chmg_wapu_product_variation_description_el');
            ?>
    
            <div class="chmg-wapu-input">
                <label for="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>">
                    <input <?php echo ("1" ==$chmg_wapu_product_variation_description_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_product_variation_description_el'); ?>" value="1">
                        Update product variations description</label>
            </div>
    
            <?php
        }

	/* ---------- END CARD BLOCK HTML FIELDS --------------- */
}