<?php

    //require_once __DIR__ .'/settings-api/chmg-woo-sheet-settings.php';

    #add_action('admin_init', 'chmg_wapu_settings_api_options');
?>

<div class="wrap">
    
    <?php settings_errors(); ?>
    <h1><?php echo get_admin_page_title(); ?></h1>

     <form method="post" action="options.php">
        <?php 
            settings_fields($this->plugin_name.'_settings');
            do_settings_sections($this->plugin_name.'_settings');
            submit_button();
        ?>
    </form>

</div>