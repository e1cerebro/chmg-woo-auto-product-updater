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

?>

<div class="wrap">
    
        <h1>Settings</h1>

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
                         <input class="regular-text" type="text" name="chmg_wapu_sheet_id" value="<?php echo esc_attr($chmg_wapu_sheet_id_el); ?>" >                   
                    </div>

                </td>
            </tr>
            <tr>
                <th scope="row">Sheet Name</th>
                <td>
                    <div class="chmg_wapu_input">
                        <input class="regular-text" type="text" name="chmg_wapu_sheet_name" value="" >                    
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


<?php

if(isset($_POST['submit'])){
    // Get the API client and construct the service object.
    $client = getCClient();
    $service = new Google_Service_Sheets($client);

    $spreadsheetId = get_option('chmg_wapu_sheet_id_el');
    echo $spreadsheetId;
    $sheets   = $service->spreadsheets->get($spreadsheetId)[sheets];
    
    foreach ($sheets as $row){

        $sheetName = $row->properties->title;

        $response = $service->spreadsheets_values->get($spreadsheetId, $sheetName);
        
        $values   = $response->getValues();

        foreach ($values as $key => $row){
            echo "<br/><hr>SHEET NAME: ".$sheetName;

           if($key !=0 ){

            $chmg_wapu_skip_key = get_option('chmg_wapu_skip_product_el');
            $chmg_wapu_skip = $row[$chmg_wapu_skip_key];


                if('no' == $chmg_wapu_skip){
                    processData($row);
                }

                 echo "<pre>"; 
                 print_r($row);
                 echo "</pre>";
           }

        }

    }



    //$range = 'Class Data!A2:E';
    #$range    = 'main sheet';
    #$response = $service->spreadsheets_values->get($spreadsheetId, $range);
    #$values   = $response->getValues();

    if (empty($sheets)) {
        print "No data found.\n";
    } else {
        print "Name, Major:\n";
        echo "<pre>"; 
            //print_r($sheets);
        echo "</pre>";

        /* foreach ($values as $row) {
            // Print columns A and E, which correspond to indices 0 and 4.
            printf("%s, %s\n", $row[0], $row[4]);
        } */
    }

}




 ?>



<?php

       /*  function getAccessToken(){
    
        }




       function getXClient()
        {
            $client = new Google_Client();
            $client->setApplicationName('Google Sheets API PHP Quickstart');
            $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
            $client->setAuthConfig(plugin_dir_path( dirname( __FILE__ ) ).'partials/credentials.json');
            $client->setAccessType('offline');
            $client->setPrompt('select_account consent');
        
            // Load previously authorized token from a file, if it exists.
            // The file token.json stores the user's access and refresh tokens, and is
            // created automatically when the authorization flow completes for the first
            // time.
            $tokenPath = 'token.json';
            if (file_exists($tokenPath)) {
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $client->setAccessToken($accessToken);
            }
            
            // If there is no previous token or it's expired.
            if ($client->isAccessTokenExpired()) {
                // Refresh the token if possible, else fetch a new one.
                if ($client->getRefreshToken()) {
                    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                } else {
                    // Request authorization from the user.
                    $authUrl = $client->createAuthUrl();
                    echo "<a href='".$authUrl."'> Click here to authorize this plugin to access you google sheets</a>";

                    //$authCode = trim(fgets(STDIN));
        
                    // Exchange authorization code for an access token.
                    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                    $client->setAccessToken($accessToken);
        
                    // Check to see if there was an error.
                    if (array_key_exists('error', $accessToken)) {
                        throw new Exception(join(', ', $accessToken));
                    }
                }
                // Save the token to a file.
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            }
            return $client;
        }
 */
        // Get the API client and construct the service object.
        //$client = getClient();
