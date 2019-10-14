<?php

require plugin_dir_path( __FILE__ ) . '../vendor/autoload.php';


/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */

 
function getCClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig(plugin_dir_path( dirname( __FILE__ ) ).'../partials/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    $chmg_wapu_access_token = get_option('chmg_wapu_api_token_el');
    $access_token           = get_option('sheet_access_token', false);

    if(false == $access_token){
        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($chmg_wapu_access_token);
        update_option( 'sheet_access_token', $accessToken, true);
    }else{
        $accessToken  = get_option( 'sheet_access_token' );
    }

    $client->setAccessToken($accessToken);

    // Check to see if there was an error.
    if (array_key_exists('error', $accessToken)) {
        throw new Exception(join(', ', $accessToken));
    }

    return $client;
}