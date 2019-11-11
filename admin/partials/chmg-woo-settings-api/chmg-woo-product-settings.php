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
		
		add_settings_field(
            'chmg_wapu_exclude_categories_el',
            __( 'Exclude Categories', TEXT_DOMAIN),
            [$this,'chmg_wapu_exclude_categories_cb'],
            $this->plugin_name.'-product-settings',
            'chmg_wapu_product_settings_section'
        );
        register_setting(  $this->plugin_name.'-product-settings', 'chmg_wapu_exclude_categories_el');
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


        public function chmg_wapu_exclude_categories_cb(){
           
            $chmg_wapu_exclude_categories_el =  get_option('chmg_wapu_exclude_categories_el');
            ?>
    
            <div class="chmg-wapu-input">

                <select  data-placeholder="Choose categories..." class="chosen-select" name="chmg_wapu_exclude_categories_el[]" multiple >
                    <?php foreach(CHMG_WOO_DB_Utils::get_all_product_categories() as $cat): ?>
                        <option <?php echo @in_array($cat->name, $chmg_wapu_exclude_categories_el) ? 'SELECTED' : ''; ?>  value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
    
            <?php
        }
	/* ---------- END CARD BLOCK HTML FIELDS --------------- */
}