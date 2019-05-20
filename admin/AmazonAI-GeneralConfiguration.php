<?php
/**
 * Class responsible for providing GUI for general configuration of the plugin
 *
 * @link       amazon.com
 * @since      2.5.0
 *
 * @package    Amazonpolly
 * @subpackage Amazonpolly/admin
 */

require_once __DIR__ . '/tim_limitless_consts.php';

class AmazonAI_GeneralConfiguration
{

  private $common;


    public function amazon_ai_add_menu()
    {
        $this->plugin_screen_hook_suffix = add_menu_page(__('Amazon AI', 'amazon-ai'), __('Amazon AI', 'amazon-ai'), 'manage_options', 'amazon_ai', array(
            $this,
            'amazonai_gui'
        ), '

		data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABs1BMVEUAAAD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mQD/mAD/mQD/mQD/ng3/uU//mQD/mAD/mAD/nAj/xnH/x3P/mQD/mQH/qCb/sDj/mgP/ohf/piL/mQD/mAD/uEz/3an/tEP/oBL/v1//15v/v1//mQD/mQD/zH7/26X/zYH/1JT/z4X/vlv/z4X/mQD/mQD/wWT/rjX/z4b/0o7/0Yz/2qL/z4b/mQD/nQr/mgP/x3T/x3L/3ar/w2j/3ar/mQD/piH/ng3/yHX/wmb/1pf/zYL/mQD/x3P/rDH/xW7/0In/vlv/2aD/mQD/yXj/u1T/pBz/x3P/1pj/zYH/mQD/qiv/z4b/u1X/mQP/rDD/1ZX/mQD/mAD/nQz/pBr/nAf/rjb/w2n/mQD/mAD/mwX/vVv/3q3/mQH/pyP/mQD/mAD////QNrphAAAALnRSTlMAAAAmdBFp1P0HS776AjGh8gVx5T3vYWNjY1v+Jtc5svgMXM39GnziAS2a5Qcs8LydqQAAAMpJREFUGNNd0bFKA0EUheH/nwyYgIVBLIUoiEUELX0jn8k3sjTEFCK6CzaCCBYWgsqx2GXN2lyYjzNz4YwAoEqSdKdu1B6/SY9O1WPJU5LPgLirLvpkm+QjuqdHDm+mSd513xO3MA9504OlPfqTJNm8Vpz9Q9nGZPLVI49nf8lJcgcV5tPRovkLFWY7I5xBRcaIVFydj3AlleI4WYJyqFcDXifPiCzUi0vJzW2SlhSStillXUop61KaNulKxtP++n2G5gGXkk33G/wC8OuIazoN13oAAAAASUVORK5CYII=

		');
        $this->plugin_screen_hook_suffix = add_submenu_page('amazon_ai', 'General', 'General', 'manage_options', 'amazon_ai', array(
            $this,
            'amazonai_gui'
        ));


    }

    public function amazonai_gui()
    {
?>
				 <div class="wrap">
				 <div id="icon-options-general" class="icon32"></div>
				 <h1>Amazon AI</h1>
				 <form method="post" action="options.php">
						 <?php

				settings_errors();
        settings_fields("amazon_ai");
        do_settings_sections("amazon_ai");
        submit_button();

?>
				 </form>

		 </div>
		 <?php
    }

    function display_options()
    {

        $this->common = new AmazonAI_Common();
        $this->common->init();

        // ************************************************* *
        // ************** CREDENTIALS SECTION ************** *
        add_settings_section('amazon_ai_credentials', "Credentials", array(
            $this,
            'credentials_gui'
        ), 'amazon_ai');

        add_settings_field('amazon_polly_credentials_radio', __(' <input id="amazon_radio" type="radio" name="credential_selector" value="amazon" onchange="toggleCheckbox(this)">AWS Credentials', 'amazonpolly'), array(
            $this,
            'amazon_polly_credentials_radio_gui'
        ), 'amazon_ai', 'amazon_ai_credentials');

        add_settings_field('amazon_polly_access_key', __('AWS access key:', 'amazonpolly'), array(
            $this,
            'access_key_gui'
        ), 'amazon_ai', 'amazon_ai_credentials', array(
            'label_for' => 'amazon_polly_access_key'
        ));
        add_settings_field('amazon_polly_secret_key', __('AWS secret key:', 'amazonpolly'), array(
            $this,
            'secret_key_gui'
        ), 'amazon_ai', 'amazon_ai_credentials', array(
            'label_for' => 'amazon_polly_secret_key'
        ));

        add_settings_field('tim_limitless_credentials_separator', __('<h2 style="width:100%; text-align:center; border-bottom: 1px solid #000; line-height:0.1em; margin:10px 0 20px;"><span style="background:#f1f1f1; padding:0 10px;">OR</span></h2>', 'amazonpolly'), array(
            $this,
            'tim_limitless_credentials_separator_gui'
        ), 'amazon_ai', 'amazon_ai_credentials', array(
            'label_for' => 'tim_limitless_credentials_separator_gui'
        ));

        add_settings_field('tim_limitless_credentials_radio', __(' <input id="trinity_radio" type="radio" name="credential_selector" value="trinity" onchange="toggleCheckbox(this)"> Free by Trinity Audio', 'amazonpolly'), array(
            $this,
            'tim_limitless_credentials_radio_gui'
        ), 'amazon_ai', 'amazon_ai_credentials');

        add_settings_field(TRINITY_CONNECTED, __('', 'amazonpolly'), array(
            $this,
            'tim_limitless_gui'
        ), 'amazon_ai', 'amazon_ai_credentials', array(
            'label_for' => TRINITY_CONNECTED
        ));

        register_setting('amazon_ai', 'amazon_polly_access_key');
        register_setting('amazon_ai', 'amazon_polly_secret_key');

        register_setting('amazon_ai', TRINITY_CONNECTED);
        register_setting(TIM_LIMITLESS, TIM_LIMITLESS_INSTALLKEY);
        register_setting(TIM_LIMITLESS,TIM_LIMITLESS_VIEWKEY);
        // ************** GENERAL SECTION ************** *
        add_settings_section('amazon_ai_general', "", array(
            $this,
            'general_gui'
        ), 'amazon_ai');
        if ($this->common->validate_amazon_polly_access()) {
            if(!$this->common->is_trinity_connected()){
                add_settings_field('amazon_polly_region', __('AWS Region:', 'amazonpolly'), array(
                    $this,
                    'region_gui'
                ), 'amazon_ai', 'amazon_ai_general', array(
                    'label_for' => 'amazon_polly_region'
                ));
            }
            add_settings_field('amazon_ai_source_language', __('Source language:', 'amazonpolly'), array(
                $this,
                'source_language_gui'
            ), 'amazon_ai', 'amazon_ai_general', array(
                'label_for' => 'amazon_ai_source_language'
            ));

            // ************************************************* *
            // ************** STORAGE SECTION ************** *
            if(!$this->common->is_trinity_connected()){
                add_settings_section('amazon_ai_storage', __('', 'amazonpolly'), array(
                    $this,
                    'storage_gui'
                ), 'amazon_ai');
                add_settings_field('amazon_polly_s3', __('Store audio in Amazon S3:', 'amazonpolly'), array(
                    $this,
                    's3_gui'
                ), 'amazon_ai', 'amazon_ai_storage', array(
                    'label_for' => 'amazon_polly_s3'
                ));
                add_settings_field('amazon_polly_cloudfront', __('Amazon CloudFront (CDN) domain name:', 'amazonpolly'), array(
                    $this,
                    'cloudfront_gui'
                ), 'amazon_ai', 'amazon_ai_storage', array(
                    'label_for' => 'amazon_polly_cloudfront'
                ));
            }
            // ************************************************* *
            // ************** OTHER SECTION ************** *
            add_settings_section('amazon_ai_other', __('', 'amazonpolly'), array(
                $this,
                'other_gui'
            ), 'amazon_ai');
            add_settings_field('amazon_polly_posttypes', __('Post types:', 'amazonpolly'), array(
                $this,
                'posttypes_gui'
            ), 'amazon_ai', 'amazon_ai_other', array(
                'label_for' => 'amazon_polly_posttypes'
            ));

            $powered_string = '"Powered by AWS';
            if ($this->common->is_trinity_connected()) $powered_string .= ' & TrinityAudio"';
            else $powered_string .= '"';
            add_settings_field('amazon_polly_poweredby', __('Display '.$powered_string.':', 'amazonpolly'), array(
                $this,
                'poweredby_gui'
            ), 'amazon_ai', 'amazon_ai_other', array(
                'label_for' => 'amazon_polly_poweredby'
            ));

            add_settings_field('amazon_ai_logging', __('Enable logging:', 'amazonpolly'), array(
                $this,
                'logging_gui'
            ), 'amazon_ai', 'amazon_ai_other', array(
                'label_for' => 'amazon_ai_logging'
            ));

            register_setting('amazon_ai', 'amazon_ai_source_language');
            register_setting('amazon_ai', 'amazon_polly_region');
            register_setting('amazon_ai', 'amazon_polly_s3');
            register_setting('amazon_ai', 'amazon_polly_cloudfront');
            register_setting('amazon_ai', 'amazon_polly_posttypes');
            register_setting('amazon_ai', 'amazon_polly_poweredby');
            register_setting('amazon_ai', 'amazon_ai_logging');

        }
        if($this->common->is_trinity_connected()){
            $this->common->create_tim_limitless_installkey();
        }

    }

    /**
     * Render the Post Type input box.
     *
     * @since  1.0.7
     */
    public function posttypes_gui() {
        $posttypes = $this->common->get_posttypes();
        echo '<input type="text" class="regular-text" name="amazon_polly_posttypes" id="amazon_polly_posttypes" value="' . esc_attr( $posttypes ) . '"> ';
        echo '<p class="description" for="amazon_polly_posttypes">Post types in your WordPress environment</p>';
    }

    function tim_limitless_gui(){
        if($this->common->is_trinity_connected()){
            $checked                = ' checked ';
        }else{
            $checked                = ' ';
        }
        echo '<input style="display:none;" type="checkbox" name="'.TRINITY_CONNECTED.'" id="'.TRINITY_CONNECTED.'" ' . esc_attr($checked) .'> <p class="description"></p>';
    }

    function tim_limitless_credentials_separator_gui(){
        //Empty;
    }

    function amazon_polly_credentials_radio_gui(){
        //EMPTY
    }

    function tim_limitless_credentials_radio_gui(){
        if($this->common->is_trinity_connected()){
            $trinity_connected      = true;
        }else{
            $trinity_connected      = false;
        }
        echo '<script>var trinity_connected='.json_encode($trinity_connected).';';
        echo 'var amazon_connected='.json_encode($this->common->validate_amazon_polly_access()).';</script>';
        echo '<script> 
                function toggleCheckbox(element)
                 {
                   var divsArray = ["'.AMAZON_POLLY_ACCESS_KEY_DIV.'","'.AMAZON_POLLY_SECRET_KEY_DIV.'"];
                   var otherMenu = ["amazon_polly_region","amazon_ai_source_language","amazon_polly_s3","amazon_polly_posttypes","amazon_polly_poweredby","amazon_ai_logging","cloudfront_description"];
                   var h2Elements = ["general_configuration","other_settings","cloud_storage"];
                   var trinityEnabled=document.getElementById("'.TRINITY_CONNECTED.'");
                   if(element.value=="trinity"){
                       trinityEnabled.checked="checked";
                       if(!trinity_connected && amazon_connected){
                          showDivs(otherMenu,"none",true);
                          showDivs(h2Elements,"none",false);
                       }
                       else if(!trinity_connected || !amazon_connected ){
                          showDivs(otherMenu,"none",true);
                          showDivs(h2Elements,"none",false);
                       }
                       else if(trinity_connected){
                         showDivs(otherMenu,"",true);
                          showDivs(h2Elements,"",false);
                       }
                   }else {
                       trinityEnabled.checked="";
                       if(trinity_connected){
                          showDivs(otherMenu,"none",true);
                          showDivs(h2Elements,"none",false);
                       }
                       else if(amazon_connected){
                       showDivs(otherMenu,"",true);
                       showDivs(h2Elements,"",false);
                       }
                       else if(!trinity_connected && !amazon_connected){
                          showDivs(otherMenu,"none",true);
                          showDivs(h2Elements,"none",false);
                       }
    
                   }
                 }
                 
                 function showDivs(elements,display,isTr){
                   for(var i=0;i<elements.length;i++){
                       try{
                         var element = document.getElementById(elements[i]);
                         if(isTr){
                            var tr=element.parentElement.parentElement;
                            tr.style.display = display;
                         }else{
                            element.style.display = display;
                         }
                   
                       }catch(e){
                            console.log(e);
                       }
                     
                   }
                 }
                 
                 window.onload = function () {
                 var element="";
                    if(trinity_connected){
                        element = document.getElementById("trinity_radio");
                        element.checked="checked";
                    }else{
                        element = document.getElementById("amazon_radio");
                        element.checked="checked";
                    }  
                   toggleCheckbox(element);
                 }
                 
                 </script>';
    }
    /**
     * Render the Access Key input for this plugin
     *
     * @since  1.0.0
     */
    function access_key_gui() {
        $access_key = get_option('amazon_polly_access_key');
        echo '<div id="amazon_polly_access_key_div"><input type="text" class="regular-text" name="amazon_polly_access_key" id="amazon_polly_access_key" value="' . esc_attr($access_key) . '" autocomplete="off"> ';
        echo '<p class="description" id="amazon_polly_access_key">Required only if you aren\'t using IAM roles</p><div>';
    }



    /**
     * Render the Secret Key input for this plugin
     *
     * @since  1.0.0
     */
    function secret_key_gui() {
        $secret_key = get_option('amazon_polly_secret_key');
        echo '<div id="amazon_polly_secret_key_div"><input type="password" class="regular-text" name="amazon_polly_secret_key" id="amazon_polly_secret_key" value="' . esc_attr($secret_key) . '" autocomplete="off"> ';
        echo '<p class="description" id="amazon_polly_access_key">Required only if you aren\'t using IAM roles</p></div>';
    }

    /**
     * Render the region input.
     *
     * @since  1.0.3
     */
    function region_gui() {

            $selected_region = $this->common->get_aws_region();

            $regions = array(
                'us-east-1' => 'US East (N. Virginia)',
                'us-east-2' => 'US East (Ohio)',
                'us-west-1' => 'US West (N. California)',
                'us-west-2' => 'US West (Oregon)',
                'eu-west-1' => 'EU (Ireland)',
                'eu-west-2' => 'EU (London)',
                'eu-west-3' => 'EU (Paris)',
                'eu-central-1' => 'EU (Frankfurt)',
                'ca-central-1' => 'Canada (Central)',
                'sa-east-1' => 'South America (Sao Paulo)',
                'ap-southeast-1' => 'Asia Pacific (Singapore)',
                'ap-northeast-1' => 'Asia Pacific (Tokyo)',
                'ap-southeast-2' => 'Asia Pacific (Sydney)',
                'ap-northeast-2' => 'Asia Pacific (Seoul)',
                'ap-south-1' => 'Asia Pacific (Mumbai)'
            );

            echo '<select name="amazon_polly_region" id="amazon_polly_region" >';
            foreach ($regions as $region_name => $region_label) {
                echo '<option label="' . esc_attr($region_label) . '" value="' . esc_attr($region_name) . '" ';
                if (strcmp($selected_region, $region_name) === 0) {
                    echo 'selected="selected"';
                }
                echo '>' . esc_attr__($region_label, 'amazon_polly') . '</option>';
            }
            echo '</select>';


    }

    /**
     * Render the 'store in S3' input.
     *
     * @since  1.0.0
     */
    function s3_gui()
    {

            $s3_bucket_name = $this->common->get_s3_bucket_name();
            $is_s3_enabled = $this->common->is_s3_enabled();

            if ( $is_s3_enabled ) {
              $checked                = ' checked ';
              $bucket_name_visibility = ' ';
            } else {
              $checked                = ' ';
              $bucket_name_visibility = 'display:none';
            }

            echo '<input type="checkbox" name="amazon_polly_s3" id="amazon_polly_s3" ' . esc_attr($checked) . ' > <p class="description"></p>';

            if ( $is_s3_enabled ) {
                echo '<label for="amazon_polly_s3" id="amazon_polly_s3_bucket_name_box" style="' . esc_attr($bucket_name_visibility) . '"> Your S3 Bucket name is <b>' . esc_attr($s3_bucket_name) . '</b></label>';
            }

            echo '<p class="description">Audio files are saved on and streamed from Amazon S3. Learn more <a target="_blank" href="https://aws.amazon.com/s3">https://aws.amazon.com/s3</a></p>';
    }



    /**
     * Render the translation source language input.
     *
     * @since  2.0.0
     */
    public function source_language_gui() {

      $selected_source_language = $this->common->get_source_language();

      echo '<select name="amazon_ai_source_language" id="amazon_ai_source_language" >';
      foreach ($this->common->get_all_languages() as $language_code) {
        $language_name = $this->common->get_language_name($language_code);
        echo '<option label="' . esc_attr($language_name) . '" value="' . esc_attr($language_code) . '" ';
        if (strcmp($selected_source_language, $language_code) === 0) {
          echo 'selected="selected"';
        }
        echo '>' . esc_attr__($language_name, 'amazon-polly') . '</option>';
      }

      echo '</select>';

    }



    /**
     * Render the 'use CloudFront' input.
     *
     * @since  1.0.0
     */
    public function cloudfront_gui()
    {

            $is_s3_enabled = $this->common->is_s3_enabled();
            if ( $is_s3_enabled ) {

                $cloudfront_domain_name = get_option('amazon_polly_cloudfront');
                echo '<input type="text" name="amazon_polly_cloudfront" class="regular-text" "id="amazon_polly_cloudfront" value="' . esc_attr($cloudfront_domain_name) . '" > ';
                echo '<p id="cloudfront_description" class="description">If you have set up CloudFront distribution for your S3 bucket, the name of the domain. For additional information and pricing, see: <a target="_blank" href="https://aws.amazon.com/cloudfront">https://aws.amazon.com/cloudfront</a> </p>';

            } else {
                echo '<p id="cloudfront_description" class="description">Amazon S3 Storage needs to be enabled</p>';
            }
    }

    /**
     * Render the 'Display "Powered by AWS" image' input.
     *
     * @since  2.6.0
     */
    function poweredby_gui()
    {
      $checked = $this->common->checked_validator("amazon_polly_poweredby");

      echo '<input type="checkbox" name="amazon_polly_poweredby" id="amazon_polly_poweredby" ' . esc_attr($checked) . ' > <p class="description"></p>';
      echo '<p class="description">This option let you to choose if you want to display <i>Display by AWS</i> logo on your website or (otherwise) add it to the content (like audio) which will be generated by the plugin</p>';
    }

    /**
     * Render the 'Enable Logging' input.
     *
     * @since  2.6.2
     */
    function logging_gui()
    {
      $checked = $this->common->checked_validator("amazon_ai_logging");
      echo '<input type="checkbox" name="amazon_ai_logging" id="amazon_ai_logging" ' . esc_attr($checked) . ' > <p class="description"></p>';
    }

    function other_gui()
    {
        echo '<h2 id="other_settings">Other settings</h2>';
    }

    function general_gui()
    {
        echo '<h2 id="general_configuration">General configuration</h2>';
    }

    function storage_gui()
    {
        echo '<h2 id="cloud_storage">Cloud storage</h2>';
    }

    function credentials_gui()
    {
        //Empty
    }


}
