<?php
/**
 * Help And Footer Menu Class
 *
 * @author  : Premio <contact@premio.io>
 * @license : GPL2
 * */

 if (defined('ABSPATH') === false) {
	exit;
}

// Class for help and footer menu
class MSE_HELP {


    // Allowed pages for showing the help menu
    private static $allowed_pages = ['my-sticky-elements', 'my-sticky-elements-new-widget', 'mystickyelements-upgrade-to-pro', 'my-sticky-elements-integration', 'my-sticky-elements-analytics', 'my-sticky-elements-leads', 'my-sticky-elements-upgrade']; 
    
    // constructor
    public function __construct() {  
         
        $page = $_GET['page'] ?? ''; 
        // Check if we're on one of those pages
        if (in_array($page, self::$allowed_pages, true)) {
            // register enqueue  css
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts')); 
            // add need help in footer
            add_action('admin_footer', array($this, 'admin_footer_need_help_content'));
        } 

        // add ajax action
        add_action('wp_ajax_hide_mse_help_cta', array($this, 'hide_mse_help_cta')); 
  
	}//end __construct()

    // load help settings
    public function load_help_settings(){
        define('MSE_FOOTER_HELP_DATA', array(
            'help_icon' => esc_url(MYSTICKYELEMENTS_URL."images/help/help-icon.svg"),
            'close_icon' => esc_url(MYSTICKYELEMENTS_URL."images/help/close.svg"), 
            'premio_site_info' => esc_url('https://premio.io/'),
            'help_center_link' => esc_url('https://premio.io/help/mystickyelements/?utm_source=pluginspage'),
            'footer_menu' => array( 
                'support' => array(
                    'title' => esc_html("Get Support", "mystickyelements"),
                    'link' =>  esc_url("https://premio.io/help/mystickyelements"),
                    'status' => true,
                ),
                'upgrade_to_pro' => array(
                    'title' => esc_html("Upgrade to Pro", "mystickyelements"),
                    'link' =>  esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")),
                    'status' => true,
                ),
                'recommended_plugins' => array(
                    'title' => esc_html("Recommended Plugins", "mystickyelements"),
                    'link' =>  esc_url(admin_url("admin.php?page=recommended-plugins")),
                    'status' => get_option("hide_mserecommended_plugin") ? false : true,
                ), 
                'live_link' => array(
                    'title' => esc_html("Add Live Chat", "mystickyelements"),
                    'link' =>  esc_url(admin_url("admin.php?page=my-sticky-elements-chatway-plugin")),
                    'status' => class_exists( 'Chatway' ) ? false : true,
                ), 
            ),
            'support_widget' => array(
                'upgrade_to_pro' => array(
                    'title' => esc_html("Upgrade to Pro", "mystickyelements"),
                    'link' =>  esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")),
                    'icon' => esc_url(MYSTICKYELEMENTS_URL."images/help/pro.svg"),
                ),
                'get_support' => array(
                    'title' => esc_html("Get Support", "mystickyelements"),
                    'link' =>   esc_url("https://premio.io/help/mystickyelements"),
                    'icon' => esc_url(MYSTICKYELEMENTS_URL."images/help/help-circle.svg"),
                ),
                'contact' => array(
                    'title' => esc_html("Contact Us", "mystickyelements"),
                    'link' =>  false,
                    'icon' => esc_url(MYSTICKYELEMENTS_URL."images/help/headphones.svg"),
                ),
            ),
        ));  
    }

    // enqueue scripts
    public function admin_enqueue_scripts(){ 
        // enqueue css
        wp_enqueue_style('mystickyelements-help-css', MYSTICKYELEMENTS_URL . 'css/help.css', array(), MY_STICKY_ELEMENT_VERSION);   

    } 

    // Need Help Footer Content
    public function admin_footer_need_help_content(){ 
        $this->load_help_settings(); 

        include_once MYSTICKYELEMENTS_PATH.'/admin/help.php';
    } 


    // Hide MSE Help CTA
    public function hide_mse_help_cta(){   
        $response = array();
        $response['status'] = 0;
        $response['error'] = 0;
        $response['data'] = array();
        $response['message'] = "";
        $postData = filter_input_array(INPUT_POST);
        $errorCounter = 0;
        if (!isset($postData['nonce']) || empty($postData['nonce'])) {
            $response['message'] =  esc_html__("Your request is not valid", 'mystickyelements');
            $errorCounter++;
        } else {
            $nonce = esc_attr($postData['nonce']);
            if(!wp_verify_nonce($nonce, 'hide_mse_help_cta')) {
                $response['message'] =  esc_html__("Your request is not valid", 'mystickyelements');
                $errorCounter++;
            }
        }
        if($errorCounter == 0) {
            $response['status'] = 1;
            add_option("mse_help_cta", "yes");
        }
        echo wp_json_encode($response); die; 
    
    }
    
}
new MSE_HELP();