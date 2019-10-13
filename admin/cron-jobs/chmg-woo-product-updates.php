<?php

require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-google-utils.php';
require_once plugin_dir_path( __FILE__ ).'../partials/custom-functions/chmg-woo-price-settings.php';

 
$client = getCClient();
$service = new Google_Service_Sheets($client);

$spreadsheetId = get_option('chmg_wapu_sheet_id_el');
$sheets   = $service->spreadsheets->get($spreadsheetId)[sheets];

foreach ($sheets as $row){

    $sheetName = $row->properties->title;

    $response = $service->spreadsheets_values->get($spreadsheetId, $sheetName);
    
    $values   = $response->getValues();

    foreach ($values as $key => $row){

       if($key !=0 ){

        $chmg_wapu_skip_key = get_option('chmg_wapu_skip_product_el');
        $chmg_wapu_skip = $row[$chmg_wapu_skip_key];

            if('no' == $chmg_wapu_skip){
                processData($row);
            }
       }

    }

}