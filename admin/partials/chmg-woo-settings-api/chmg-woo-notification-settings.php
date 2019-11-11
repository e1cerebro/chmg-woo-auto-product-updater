<?php
class CHMG_WOO_NOTIFICATION_SETTINGS{
   
    private $plugin_name;
    
    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
     }
    
     public function register_section(){
        add_settings_section(
            'chmg_wapu_notification_settings_section',
            __( 'Notification Settings', TEXT_DOMAIN ),
            '',
            $this->plugin_name.'-notification-settings'
        );
        
     }
     public function register_fields(){
 /******** Start Notification Field ********/
        add_settings_field(
          'chmg_wapu_mail_recipient_el',
          __( 'Email Recipient', TEXT_DOMAIN),
          [$this,'chmg_wapu_mail_recipient_cb'],
          $this->plugin_name.'-notification-settings',
          'chmg_wapu_notification_settings_section'
          );
        register_setting( $this->plugin_name.'-notification-settings', 'chmg_wapu_mail_recipient_el');

        /******** End Notification Field ********/

        			/******** Start Notification Field ********/
				add_settings_field(
					'chmg_wapu_manual_sync_notification_el',
					__( 'Manual Sync Notification', TEXT_DOMAIN),
					[$this,'chmg_wapu_manual_sync_notification_cb'],
					$this->plugin_name.'-notification-settings',
					'chmg_wapu_notification_settings_section'
					);
				register_setting($this->plugin_name.'-notification-settings', 'chmg_wapu_manual_sync_notification_el');

			/******** End Notification Field ********/


			/******** Start Auto Sync Notification Field ********/
				add_settings_field(
					'chmg_wapu_auto_sync_notification_el',
					__( 'Auto Sync Notification', TEXT_DOMAIN),
					[$this,'chmg_wapu_auto_sync_notification_cb'],
					$this->plugin_name.'-notification-settings',
					'chmg_wapu_notification_settings_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_auto_sync_notification_el');
			/******** End Auto Sync Notification Field ********/

			
			
			/******** Start Notification Field ********/
				add_settings_field(
					'chmg_wapu_email_who_el',
					__( 'Email Filter', TEXT_DOMAIN),
					[$this,'chmg_wapu_email_who_cb'],
          $this->plugin_name.'-notification-settings',
					'chmg_wapu_notification_settings_section'
					);
				register_setting( $this->plugin_name.'_settings', 'chmg_wapu_email_who_el');
			/******** End Notification Field ********/

     }
	 
	/* ---------- START CARD BLOCK HTML FIELDS --------------- */
       
	/*============ Start Notification  HMTL creation functions ============*/	
		function chmg_wapu_auto_sync_notification_cb(){
			$chmg_wapu_auto_sync_notification_el =  get_option('chmg_wapu_auto_sync_notification_el');
			?>

			<div class="chmg-wapu-input">
				<label for="<?php echo esc_attr('chmg_wapu_auto_sync_notification_el'); ?>">
					<input <?php echo ("1" == $chmg_wapu_auto_sync_notification_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_auto_sync_notification_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_auto_sync_notification_el'); ?>" value="1">
						Enable Notification</label>
			</div>

			<?php
		}
		function chmg_wapu_manual_sync_notification_cb(){
			$chmg_wapu_manual_sync_notification_el =  get_option('chmg_wapu_manual_sync_notification_el');
			?>

			<div class="chmg-wapu-input">
				<label for="<?php echo esc_attr('chmg_wapu_manual_sync_notification_el'); ?>">
					<input <?php echo ("1" == $chmg_wapu_manual_sync_notification_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_manual_sync_notification_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_manual_sync_notification_el'); ?>" value="1">
						Enable Notification</label>
			</div>

			<?php
		}

		function chmg_wapu_mail_recipient_cb(){
			$chmg_wapu_mail_recipient_el =  get_option('chmg_wapu_mail_recipient_el');
			?>

			<div class="chmg-wapu-input">
					<input class="regular-text"  name="<?php echo esc_attr('chmg_wapu_mail_recipient_el'); ?>" type="text" id="<?php echo esc_attr('chmg_wapu_mail_recipient_el'); ?>" value="<?php echo esc_attr($chmg_wapu_mail_recipient_el); ?>">
			</div>

			<?php
		}

		function chmg_wapu_email_who_cb(){
			$chmg_wapu_email_who_el =  get_option('chmg_wapu_email_who_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_email_who_el'); ?>">
						<option <?php echo ( 'admin_only' == $chmg_wapu_email_who_el ) ?  "selected" : "" ; ?> value="admin_only" ><?php echo esc_html('Admin Only', TEXT_DOMAIN); ?></option>
						<option <?php echo ( 'admin_and_others' == $chmg_wapu_email_who_el ) ?  "selected" : "" ; ?> value="admin_and_others" ><?php echo esc_html('Admin & Others', TEXT_DOMAIN); ?></option>
						<option <?php echo ( 'others_only' == $chmg_wapu_email_who_el ) ?  "selected" : "" ; ?> value="others_only" ><?php echo esc_html('Others Only', TEXT_DOMAIN); ?></option>
 				</select>
			</div>

			<?php
		}
 	/*============ End Notification  HMTL creation functions ============*/	
	/* ---------- END CARD BLOCK HTML FIELDS --------------- */
}