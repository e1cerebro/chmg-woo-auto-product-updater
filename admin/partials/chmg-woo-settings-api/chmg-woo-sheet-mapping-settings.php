<?php
class CHMG_WOO_SHEET_MAPPING_SETTINGS{
   
    private $plugin_name;
    
    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
     }
    
     public function register_section(){

        add_settings_section(
          'chmg_wapu_section',
          __( 'Map Sheet To Columns', TEXT_DOMAIN ),
		  [$this,'chmg_wapu_sheet_mapping_section_cb'],
          $this->plugin_name.'_settings'
        );
     }
     public function register_fields(){
        /*====== PRODUCT SKU SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_product_sku_el',
					__( 'Product SKU', TEXT_DOMAIN),
					[$this,'chmg_wapu_product_sku_cb'],
					$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_product_sku_el');
		
			
				/*====== PRODUCT NAME SETTINGS ======*/
				add_settings_field(
					'chmg_wapu_product_name_el',
					__( 'Product Name', TEXT_DOMAIN),
					[$this,'chmg_wapu_product_name_cb'],
				$this->plugin_name.'_settings',
					'chmg_wapu_section'
				);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_product_name_el');


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
		
     }
	 
	/* ---------- START CARD BLOCK HTML FIELDS --------------- */

		public function chmg_wapu_sheet_mapping_section_cb(){
			echo "<p>Please map the corresponding columns for these fields in your google sheet</p>";
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
		
		/**
		 * Generate the HTML for Regular Price
		 *
		 * @return void
		 */ 
		function chmg_wapu_product_name_cb(){
			$chmg_wapu_product_name_el =  get_option('chmg_wapu_product_name_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_product_name_el'); ?>">
					<?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
						<?php if( '-1' == $key): ?>	
 						<?php else: ?>
							<option <?php echo ($chmg_wapu_product_name_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>	
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
	/* ---------- END CARD BLOCK HTML FIELDS --------------- */
}