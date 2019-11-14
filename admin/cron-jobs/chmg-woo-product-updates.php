<?php

require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-google-utils.php';
require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-price-settings.php';
require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-process-emails.php';

 
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
        $message = $e->getMessage().date('Y-m-s H:i:s');
        ChmgWapuEmail::send_error_mail($message);
     }
     
 }
 
 if(!empty($sheets)){

    //array to hold products not found while updating store
    $products_non_exits_arr = [];
    $chmg_wapu_exclude_categories_el =  get_option('chmg_wapu_exclude_categories_el');

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
            $message = $e->getMessage()." \nDate:".date('Y-m-s H:i:s');
            ChmgWapuEmail::send_error_mail($message);     
         }

         /* Check if any values were returned */
         if(!empty($values)){
             foreach ($values as $key => $row){
                 /* Skip the first row - we dont need to loop through the row that have column names*/
                 if($key != 0 ){
 
                     $chmg_wapu_skip_key = get_option('chmg_wapu_skip_product_el');
                     $chmg_wapu_skip = $row[$chmg_wapu_skip_key];
 
                     if('-1' == $chmg_wapu_skip_key){
                        $response =  processData($row, $chmg_wapu_exclude_categories_el , true);
                        if(!empty($response)){
                            array_push($products_non_exits_arr, $response);
                        }
                    }elseif('no' == $chmg_wapu_skip){
                        $response = processData($row, $chmg_wapu_exclude_categories_el , true);
                        if(!empty($response)){
                            array_push($products_non_exits_arr, $response);
                        }
                    }else{
                        continue;
                    }
                 }
 
             }
         }else{
            
             ChmgWapuEmail::send_error_mail('Could not retrieve values for '.$sheetName.' sheet name');
         }

     }

    /* Send the email to the customer */
    if('1' == get_option('chmg_wapu_auto_sync_notification_el')){
        ChmgWapuEmail::send_sync_complete_mail($products_non_exits_arr, true);
    }

 }else{
    ChmgWapuEmail::send_error_mail('Could not find a sheet name from your query');     
 }
