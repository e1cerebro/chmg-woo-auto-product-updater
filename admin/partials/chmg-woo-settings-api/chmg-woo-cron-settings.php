<?php
class CHMG_WOO_CRON_SETTINGS{
   
    private $plugin_name;
    
    public function __construct( $plugin_name ) {
      require_once __DIR__ .'../../custom-functions/chmg-woo-db-utils.php';
 		$this->plugin_name = $plugin_name;
     }
    
     public function register_section(){

			  /******** Start Cron Job Section ********/
          add_settings_section(
            'chmg_wapu_cron_section',
            __( 'Cron Jobs', TEXT_DOMAIN ),
            '',
            $this->plugin_name.'-cron-job-settings'
          );
     }

     public function register_fields(){
       
        /******** Start Cron Job Field ********/
              /*====== Enable Cron Jobs ======*/
              add_settings_field(
                'chmg_wapu_enable_cron_jobs_el',
                __( 'Enable Cron Jobs', TEXT_DOMAIN),
                [$this,'chmg_wapu_enable_cron_jobs_cb'],
                $this->plugin_name.'-cron-job-settings',
                'chmg_wapu_cron_section'
                );
              register_setting( $this->plugin_name.'-cron-job-settings', 'chmg_wapu_enable_cron_jobs_el');
        
              /*====== Execution Interval ======*/
              add_settings_field(
                'chmg_wapu_choose_interval_el',
                __( 'Execution Interval', TEXT_DOMAIN),
                [$this,'chmg_wapu_choose_interval_cb'],
                $this->plugin_name.'-cron-job-settings',
                'chmg_wapu_cron_section'
                );
              register_setting($this->plugin_name.'-cron-job-settings', 'chmg_wapu_choose_interval_el', [$this, 'chmg_wapu_choose_interval_sanitize']);

              add_settings_field(
                'chmg_wapu_exclude_categories_el',
                __( 'Exclude Categories', TEXT_DOMAIN),
                [$this,'chmg_wapu_exclude_categories_cb'],
                $this->plugin_name.'-cron-job-settings',
                'chmg_wapu_cron_section'
            );
            register_setting( $this->plugin_name.'-cron-job-settings', 'chmg_wapu_exclude_categories_el');
             
          /******** End Cron Job Field ********/
     }
	 
	/* ---------- START CARD BLOCK HTML FIELDS --------------- */
       	/*====== START CRON JOBS SETTINGS HTML FIELDS FUNCTIONS======*/
		function chmg_wapu_enable_cron_jobs_cb(){
			$chmg_wapu_enable_cron_jobs_el =  get_option('chmg_wapu_enable_cron_jobs_el');
			?>

			<div class="chmg-wapu-input">
				<label for="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>">
					<input <?php echo ("1" == $chmg_wapu_enable_cron_jobs_el ) ?  "checked" : "" ; ?> name="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>" type="checkbox" id="<?php echo esc_attr('chmg_wapu_enable_cron_jobs_el'); ?>" value="1">
						Toggle this to enable/disable cron jobs</label>
			</div>

			<?php
		}
		
		function chmg_wapu_choose_interval_cb(){
			$chmg_wapu_choose_interval_el =  get_option('chmg_wapu_choose_interval_el');
			?>

			<div class="chmg-wapu-input">
				<select name="<?php echo esc_attr('chmg_wapu_choose_interval_el'); ?>">
					<?php foreach( CRON_INTERVALS as $key => $value): ?>
						<option <?php echo ($chmg_wapu_choose_interval_el == $key ) ?  "selected" : "" ; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php
    }
    
    public function chmg_wapu_exclude_categories_cb(){
           
      $chmg_wapu_exclude_categories_el =  get_option('chmg_wapu_exclude_categories_el');
      ?>

      <div class="chmg-wapu-input">

          <select  data-placeholder="Choose categories..." class="chosen-select" name="chmg_wapu_exclude_categories_el[]" multiple >
              <?php foreach(CHMG_WOO_DB_Utils::get_all_product_categories() as $cat): ?>
                  <option <?php echo @in_array($cat->name, $chmg_wapu_exclude_categories_el) ? 'SELECTED' : ''; ?>  value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
              <?php endforeach; ?>
          </select>

      </div>

      <?php
  }
	/* ---------- END CARD BLOCK HTML FIELDS --------------- */
}