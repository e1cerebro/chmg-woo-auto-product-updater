 <?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Chmg_Woo_Auto_Product_Updater
 * @subpackage Chmg_Woo_Auto_Product_Updater/admin/partials
 */

require_once __DIR__ .'/custom-functions/chmg-woo-google-utils.php';
require_once __DIR__ .'/custom-functions/chmg-woo-price-settings.php';


if(isset($_POST['submit'])){
    // Get the API client and construct the service object.
    $client = getCClient();
    $service = new Google_Service_Sheets($client);

    /* Get  the sheetID from the form input */
    $custom_sheetID = trim($_POST['chmg_wapu_sheet_id']);

    /* Decide which of the sheetID to use */
    if(!empty($custom_sheetID)){
        $spreadsheetId = $custom_sheetID;
    }else{
        $spreadsheetId = get_option('chmg_wapu_sheet_id_el');
    }

    /* Get the sheet Name from the form text field */
    $custom_sheets = trim($_POST['chmg_wapu_sheet_names']);
    
    /* Decide which of the sheet names to use */
    if(!empty($custom_sheets)){
       $sheets = explode(",",$custom_sheets);
    }else{

        /* get the available sheet names from the google ID provided */
        try {
            $sheets   = $service->spreadsheets->get($spreadsheetId)[sheets];
        } catch (Exception $e) {
            echo "<div class='error notice'>
                    <p>".$e->getMessage()."</p>
                </div>";
        }
        
    }


    if(!empty($sheets)){
        /* Loop through the sheet names */
        foreach ($sheets as $row){

            if(!empty($custom_sheets)){
                $sheetName = trim($row);
            }else{
                $sheetName = $row->properties->title;
            }

            /* Get the values from the current sheets */
            try {
                $response = $service->spreadsheets_values->get($spreadsheetId, $sheetName);
                $values   = $response->getValues();
            } catch (Exception $e) {
                echo "<div class='error notice'>
                        <p>".$e->getMessage()."</p>
                    </div>";
                
            }

            /* Check if any values were returned */
            if(!empty($values)){
                foreach ($values as $key => $row){
                    /* Skip the first row */
                    if($key != 0 ){
    
                        $chmg_wapu_skip_key = get_option('chmg_wapu_skip_product_el');
                        $chmg_wapu_skip = $row[$chmg_wapu_skip_key];
    
                            if('no' == $chmg_wapu_skip){
                                processData($row);
                            }
                    }
    
                }
            }else{
                echo "<div class='error notice'>
                    <p> Couldn't find a sheet name</p>
                </div>";
            }

        }

        echo "<div class='updated notice'>
                <p><strong>Awesome!</strong> Your store have been synched with the google sheet.</p>
            </div>";
    }else{
        echo "<div class='error notice'>
                <p> Couldn't find a sheet name</p>
            </div>";
    }
 
}

 ?>

<div class="wrap">
    
    <h1><?php echo get_admin_page_title(); ?></h1>

     <form method="post" action="">
        <table class="form-table" role="presentation">
          <tbody>
            <tr>
                <th scope="row">Sheet ID</th>
                <td>
                    <div class="chmg_wapu_input">
                        <?php
                            $chmg_wapu_sheet_id_el =  get_option('chmg_wapu_sheet_id_el');
                         ?>
                         <input class="regular-text" type="text" required name="chmg_wapu_sheet_id" value="<?php echo esc_attr($chmg_wapu_sheet_id_el); ?>" >                   
                    </div>

                </td>
            </tr>
            <tr>
                <th scope="row">Sheet Name</th>
                <td>
                    <div class="chmg_wapu_input">
                        <?php
                            $chmg_wapu_default_sheet_names_el =  get_option('chmg_wapu_default_sheet_names_el');
                        ?>
                        <textarea name="chmg_wapu_sheet_names" cols="70" id="chmg_wapu_sheet_names"   rows="5" ><?php echo esc_attr($chmg_wapu_default_sheet_names_el); ?></textarea>
                        <p class="description">Separate more than one sheet name with comma (,) eg clothe, music </p>
                    </div>

                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Update Store">
        </p>   
    </form>

</div>