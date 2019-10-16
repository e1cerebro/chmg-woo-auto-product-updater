<?php

require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-google-utils.php';
require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-price-settings.php';

 
 // Get the API client and construct the service object.
 $client = getCClient();
 $service = new Google_Service_Sheets($client);
 
 
 $spreadsheetId = get_option('chmg_wapu_sheet_id_el');
 
 /* Get the sheet Name from the form text field */
 $custom_sheets = trim(get_option('chmg_wapu_default_sheet_names_el'));
 
 /* Decide which of the sheet names to use */
 if(!empty($custom_sheets)){
    $sheets = explode(",",$custom_sheets);
 }else{

     /* get the available sheet names from the google ID provided */
     try {
         $sheets   = $service->spreadsheets->get($spreadsheetId)[sheets];
     } catch (Exception $e) {
   
        wp_mail( CHMG_WAPU_ADMIN_EMAIL, 'Woo Sync Error', $e->getMessage().date('Y-m-s H:i:s') );

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
            wp_mail( CHMG_WAPU_ADMIN_EMAIL, 'Woo Sync Error', $e->getMessage()." \nDate:".date('Y-m-s H:i:s') );
         }

         /* Check if any values were returned */
         if(!empty($values)){
             foreach ($values as $key => $row){
                 /* Skip the first row */
                 if($key != 0 ){
 
                     $chmg_wapu_skip_key = get_option('chmg_wapu_skip_product_el');
                     $chmg_wapu_skip = $row[$chmg_wapu_skip_key];
 
                     if('-1' == $chmg_wapu_skip_key){
                        processData($row);
                    }elseif('no' == $chmg_wapu_skip){
                        processData($row);
                    }else{
                        continue;
                    }
                 }
 
             }
         }else{
             wp_mail( CHMG_WAPU_ADMIN_EMAIL, 'Woo Sync Error', "Couldn't find a sheet name \n".$e->getMessage()." \nDate:".date('Y-m-s H:i:s') );

         }

     }

         wp_mail( CHMG_WAPU_ADMIN_EMAIL, 'Woo Sync Completed', "Your store have been synced with the google sheet." );

 }else{
         wp_mail( CHMG_WAPU_ADMIN_EMAIL, 'Woo Sync Error', "Couldn't find a sheet name \n".$e->getMessage()." \nDate:".date('Y-m-s H:i:s') );
 }
