<?php


  
    /***** CALL BACK FUNCTIONS *******/

    function chmg_wapu_settings_section_cb(){

    }

   

    /* Field callback functions */
    function chmg_wapu_product_sku_cb(){
        $chmg_wapu_product_sku_el =  get_option('chmg_wapu_product_sku_el');
        ?>

        <div class="chmg_wapu_input">
            <select name="product_sku_map" id="product_sku_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php
    }


    /* Field callback functions */
	function chmg_wapu_regular_price_cb(){
        $chmg_wapu_regular_price_el =  get_option('chmg_wapu_regular_price_el');
		?>

		<div class="chmg_wapu_input">
            <select name="regular_price_map" id="regular_price_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
		</div>
 
		<?php
    }

    function chmg_wapu_sales_price_cb(){
		$chmg_wapu_sales_price_el =  get_option('chmg_wapu_sales_price_el');
		?>

		<div class="chmg_wapu_input">
            <select name="sales_price_map" id="sales_price_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

		<?php
    }
    

    function chmg_wapu_short_description_cb(){
		$chmg_wapu_short_description_el =  get_option('chmg_wapu_short_description_el');
		?>

		<div class="chmg_wapu_input">
            <select name="short_description_map" id="short_description_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
		<?php
    }


    function chmg_wapu_main_description_cb(){
        $chmg_wapu_main_description_el =  get_option('chmg_wapu_main_description_el');
        ?>

        <div class="chmg_wapu_input">
            <select name="main_description_map" id="main_description_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php
    }

    function chmg_wapu_on_sale_cb(){
        $chmg_wapu_on_sale_el =  get_option('chmg_wapu_on_sale_el');
        ?>

        <div class="chmg_wapu_input">
            <select name="on_sale_map" id="on_sale_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php
    }

    function chmg_wapu_skip_product_cb(){
        $chmg_wapu_skip_product_el =  get_option('chmg_wapu_skip_product_el');
        ?>

        <div class="chmg_wapu_input">
            <select name="skip_product_map" id="skip_product_map">
                <?php foreach( ALPHABETS_MAPPING as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo 'Map to column - '.$value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php
    }

    function chmg_wapu_sheet_id_cb(){
        $chmg_wapu_sheet_id_el =  get_option('chmg_wapu_sheet_id_el');
        ?>

        <div class="chmg_wapu_input">
            <input class="regular-text" type="text" name="<?php echo esc_attr('chmg_wapu_sheet_id_el'); ?>" value="<?php echo esc_attr($chmg_wapu_sheet_id_el); ?>" >
        </div>

        <?php
    }