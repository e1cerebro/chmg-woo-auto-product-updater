
<?php
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'chmg-woo-sheet-mappings';
    if( isset( $_GET[ 'tab' ] ) ) {
        $active_tab = $_GET[ 'tab' ];
    } 
?>


<div class="wrap">
    <?php settings_errors(); ?>
    <h1><?php echo get_admin_page_title(); ?></h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=chmg-woo-auto-product-updater_settings&tab=chmg-woo-sheet-mappings" class="nav-tab <?php echo $active_tab == 'chmg-woo-sheet-mappings' ? 'nav-tab-active' : ''; ?>">Sheet Mapping</a>
        <a href="?page=chmg-woo-auto-product-updater_settings&tab=chmg-woo-product-settings" class="nav-tab <?php echo $active_tab == 'chmg-woo-product-settings' ? 'nav-tab-active' : ''; ?>">Product Settings</a>
        <a href="?page=chmg-woo-auto-product-updater_settings&tab=chmg-woo-notification-settings" class="nav-tab <?php echo $active_tab == 'chmg-woo-notification-settings' ? 'nav-tab-active' : ''; ?>">Notification Settings</a>
        <a href="?page=chmg-woo-auto-product-updater_settings&tab=chmg-woo-authorization-settings" class="nav-tab <?php echo $active_tab == 'chmg-woo-authorization-settings' ? 'nav-tab-active' : ''; ?>">Authorization Settings</a>
        <a href="?page=chmg-woo-auto-product-updater_settings&tab=chmg-woo-cron-job-settings" class="nav-tab <?php echo $active_tab == 'chmg-woo-cron-job-settings' ? 'nav-tab-active' : ''; ?>">Auto Sync Settings</a>
     </h2>

    
   

     <form method="post" action="options.php">
        <?php 
           if( $active_tab == 'chmg-woo-sheet-mappings' ) {
                settings_fields($this->plugin_name.'_settings');
                do_settings_sections($this->plugin_name.'_settings');
                submit_button();
            }
           else if( $active_tab == 'chmg-woo-product-settings' ) {
                settings_fields($this->plugin_name.'-product-settings');
                do_settings_sections($this->plugin_name.'-product-settings');
                submit_button();
            }
           else if( $active_tab == 'chmg-woo-notification-settings' ) {
                settings_fields($this->plugin_name.'-notification-settings');
                do_settings_sections($this->plugin_name.'-notification-settings');
                submit_button();
            }
           else if( $active_tab == 'chmg-woo-authorization-settings' ) {
            include_once( 'chmg-woo-auto-product-updater-integration.php' );
            }
           else if( $active_tab == 'chmg-woo-cron-job-settings' ) {
                settings_fields($this->plugin_name.'-cron-job-settings');
                do_settings_sections($this->plugin_name.'-cron-job-settings');
                submit_button();
            }
        ?>
    </form>

</div>