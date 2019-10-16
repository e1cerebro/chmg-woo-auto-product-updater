<div class="wrap">
    
    <?php settings_errors(); ?>
    <h1><?php echo get_admin_page_title(); ?></h1>

     <form method="post" action="options.php">
        <?php 
            settings_fields($this->plugin_name.'_automation');
            do_settings_sections($this->plugin_name.'_automation');
            submit_button('Confirm Changes');
        ?>
    </form>

</div>