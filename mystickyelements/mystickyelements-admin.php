<?php

if (!class_exists('MyStickyElementsPage_pro')) {

    class MyStickyElementsPage_pro
    {
        public function __construct()
        {

            add_action('admin_menu', array( $this, 'add_mystickyelement_plugin_page' ), 9);
            add_action('plugins_loaded', array( $this, 'mystickyelements_load_plugin_textdomain' ));
            add_action('admin_enqueue_scripts', array( $this, 'mystickyelements_admin_enqueue_script' ), 99);
            add_action('admin_head', array( $this, 'mystickyelement_inline_css_admin' ));
            add_action('admin_init', array($this, 'check_for_redirection'));
            add_action('wp_ajax_mystickyelement-social-tab', array( $this, 'mystickyelement_social_tab_add' ));
            add_action('wp_ajax_mystickyelement_delete_db_record', array( $this, 'mystickyelement_delete_db_record' ));
            add_action('wp_ajax_get_mse_chatway_status', array( $this, 'get_mse_chatway_status' ));

            add_action('wp_ajax_myStickyelements_intro_popup_action', array( $this, 'myStickyelements_intro_popup_action' ));
            add_action('wp_ajax_mystickyelement_widget_status', array( $this, 'mystickyelement_widget_status' ));
            add_action('wp_ajax_mystickyelement_widget_rename', array( $this, 'mystickyelement_widget_rename' ));
            add_action('wp_ajax_mystickyelement_widget_delete', array( $this, 'mystickyelement_widget_delete' ));
            add_filter('plugin_action_links_'.MYSTICKYELEMENTS_BASE, array( $this, 'settings_link' ));

            add_action('admin_footer', array( $this, 'mystickyelements_deactivate' ));
            /* Send message to owner */
            add_action('wp_ajax_mystickyelements_admin_send_message_to_owner', array( $this, 'mystickyelements_admin_send_message_to_owner' ));
            add_action('wp_ajax_mystickyelements_plugin_deactivate', array( $this, 'mystickyelements_plugin_deactivate' ));


            add_action('wp_ajax_my_sticky_elements_bulks', array( $this, 'my_sticky_elements_bulks' ));

            add_action('wp_ajax_mystickyelements_review_box', [$this, "mystickyelements_review_box"]);
            add_action('wp_ajax_mystickyelements_review_box_message', [$this, "mystickyelements_review_box_message"]);

            add_action('mse_inline_pro_button', [$this, 'mse_inline_pro_button' ], 9);
            add_action('mse_pro_button', [$this, 'mse_pro_button' ], 9);
        }

        public function mse_pro_button()
        {
            ?>
            <a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade")); ?>" class="mse-upgrade-now-button large-button" target="blank">
                <?php esc_html_e('Upgrade Now', 'mystickyelements'); ?>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#092030" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        <?php }

        public function mse_inline_pro_button()
        {
            $upgrade_url = admin_url('admin.php?page=my-sticky-elements-upgrade');
            ?>
                <div class="relative inline-flex inline-upgrade-link">
                    <a href="<?php echo esc_url($upgrade_url); ?>" target="_blank">
                        <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.7525 3.19918C17.5738 3.04995 17.3566 2.95397 17.126 2.9222C16.8953 2.89043 16.6603 2.92414 16.4478 3.01949L12.4947 4.77731L10.1978 0.636682C10.0881 0.443367 9.929 0.282603 9.73687 0.170762C9.54474 0.0589211 9.3264 0 9.10409 0C8.88177 0 8.66343 0.0589211 8.4713 0.170762C8.27917 0.282603 8.12012 0.443367 8.01034 0.636682L5.71346 4.77731L1.76034 3.01949C1.54745 2.92428 1.31218 2.89052 1.08111 2.92203C0.850039 2.95354 0.632393 3.04906 0.452773 3.1978C0.273153 3.34653 0.138723 3.54255 0.0646786 3.76369C-0.00936533 3.98483 -0.02007 4.22228 0.0337749 4.44918L2.01815 12.9101C2.05609 13.0739 2.1269 13.2283 2.22627 13.3639C2.32565 13.4996 2.45152 13.6136 2.59627 13.6992C2.79225 13.8165 3.01631 13.8786 3.24471 13.8789C3.35574 13.8787 3.46619 13.8629 3.57284 13.832C7.18988 12.832 11.0105 12.832 14.6275 13.832C14.9578 13.9188 15.309 13.8711 15.6041 13.6992C15.7497 13.6147 15.8763 13.501 15.9758 13.3652C16.0753 13.2294 16.1456 13.0744 16.1822 12.9101L18.1744 4.44918C18.2276 4.22221 18.2163 3.98488 18.1418 3.76399C18.0672 3.54311 17.9324 3.34747 17.7525 3.19918Z" fill="url(#paint0_linear_12203_17671)"/>
                        </svg>
                    </a>
                    <div class="mse-upgrade-box flex flex-col gap-4 items-center justify-center">
                        <div class="mse-upgrade-icon">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.1824 8.06186C25.9315 7.85233 25.6266 7.71758 25.3027 7.67297C24.9789 7.62837 24.6489 7.6757 24.3507 7.80958L18.8005 10.2776L15.5756 4.4641C15.4215 4.19268 15.1982 3.96697 14.9284 3.80994C14.6587 3.65292 14.3521 3.57019 14.04 3.57019C13.7279 3.57019 13.4213 3.65292 13.1516 3.80994C12.8818 3.96697 12.6585 4.19268 12.5044 4.4641L9.27954 10.2776L3.72934 7.80958C3.43044 7.6759 3.10011 7.6285 2.77569 7.67274C2.45127 7.71698 2.1457 7.85109 1.89351 8.05992C1.64132 8.26874 1.45258 8.54395 1.34862 8.85443C1.24466 9.16492 1.22963 9.49829 1.30523 9.81686L4.09131 21.6961C4.14458 21.926 4.24399 22.1428 4.38351 22.3332C4.52303 22.5237 4.69976 22.6838 4.903 22.8039C5.17814 22.9686 5.49273 23.0558 5.81341 23.0562C5.96929 23.0559 6.12436 23.0337 6.27409 22.9904C11.3524 21.5863 16.7166 21.5863 21.7949 22.9904C22.2586 23.1123 22.7517 23.0452 23.166 22.8039C23.3705 22.6853 23.5482 22.5257 23.6879 22.335C23.8276 22.1443 23.9263 21.9268 23.9777 21.6961L26.7748 9.81686C26.8495 9.4982 26.8337 9.16498 26.729 8.85486C26.6243 8.54473 26.435 8.27005 26.1824 8.06186Z" fill="white"/>
                            </svg>
                        </div>
                        <div class="text-center text-sm font-medium color-[#092030]">
                            <?php esc_html_e('Upgrade now to enjoy awesome Pro features!', 'mystickyelements'); ?>
                        </div>
                        <div class="text-center">
                            <a href="<?php echo esc_url($upgrade_url); ?>" target="_blank" class="mse-upgrade-now-button">
                                <?php esc_html_e('Upgrade Now', 'mystickyelements'); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 12L10 8L6 4" stroke="#092030" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
        }


        public function settings_link($links)
        {
            $settings_link = '<a href="'.admin_url("admin.php?page=my-sticky-elements").'">Settings</a>';
            $links['need_help'] = '<a href="https://premio.io/help/mystickyelements" target="_blank">'.__('Need help?', 'mystickyelements').'</a>';

            $links['go_pro'] = '<a href="'.admin_url("admin.php?page=my-sticky-elements-upgrade").'" style="color: #FF5983; font-weight: bold; display: inline-block; border: solid 1px #FF5983; border-radius: 4px; padding: 0 5px;">'.__('Upgrade', 'mystickyelements').'</a>';

            array_unshift($links, $settings_link);
            return $links;
        }

        /*
         * Load Plugin text domain.
         */

        public function mystickyelements_load_plugin_textdomain()
        {
            load_plugin_textdomain('mystickyelements', false, dirname(plugin_basename(__FILE__)).'/languages/');
        }

        /*
         * enqueue admin side script and style.
         */
        public function mystickyelements_admin_enqueue_script($page)
        {
            if ($page == 'mystickyelements_page_my-sticky-elements-chatway-plugin') {
                wp_enqueue_script('thickbox', null, array('jquery'));
                wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
                return;
            }
            if (isset($_GET['page']) && ($_GET['page'] == 'my-sticky-elements' || $_GET['page'] == 'my-sticky-elements-leads' || $_GET['page'] == 'my-sticky-elements-new-widget' || $_GET['page'] == 'recommended-plugins' || $_GET['page'] == 'my-sticky-elements-analytics' || $_GET['page'] == 'my-sticky-elements-integration' || $_GET['page'] == 'my-sticky-elements-upgrade'  || $_GET['page'] == 'my-sticky-elements-chatway-plugin')) {

                $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
                if ($is_shown) {
                    wp_enqueue_script('mailcheck-js', plugins_url('/dist/js/mailcheck.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_script('autocomplete-email-js', plugins_url('/dist/js/email-autocomplete.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION, true);
                    wp_enqueue_style('mystickyelements-help-css', plugins_url('/dist/css/mystickyelements-help.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_style_add_data('mystickyelements-help-css', 'rtl', 'replace');
                } else {
                    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600,700');
                    wp_enqueue_style('font-awesome-css', plugins_url('/dist/css/font-awesome.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_style('wp-color-picker');
                    wp_enqueue_style('mystickyelements-admin-css', plugins_url('/dist/css/mystickyelements-admin.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_style('mse-app', plugins_url('/dist/css/app.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);

                    wp_enqueue_style('select2-css', plugins_url('/dist/css/select2.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_style('mystickyelements-front-css', plugins_url('/dist/css/mystickyelements-front.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_style('mystickyelements-help-css', plugins_url('/dist/css/mystickyelements-help.css', __FILE__), array(), MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_style('wp-jquery-ui-dialog');
                    wp_enqueue_script('jquery-ui-dialog');
                    wp_enqueue_script('wp-color-picker');
                    wp_enqueue_script('jquery-ui-sortable');
                    wp_enqueue_script('jquery-effects-shake');
                    wp_enqueue_media();

                    wp_enqueue_script('thickbox', null, array('jquery'));
                    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');

                    wp_enqueue_style("mystickyelements-star-rating-svg", plugins_url('dist/css/star-rating-svg.css', __FILE__), [], MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_script("mystickyelements-star-rating-svg", plugins_url('dist/js/star-rating-svg.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION);

                    //wp_enqueue_script('plugin-install', admin_url('/js/plugin-install.min', __FILE__), array( 'jquery' ), MY_STICKY_ELEMENT_VERSION, true ) ;
                    wp_enqueue_script('select2-js', plugins_url('dist/js/select2.js', __FILE__), array( 'jquery' ), MY_STICKY_ELEMENT_VERSION, true) ;
                    wp_enqueue_script('timepicker-js', plugins_url('dist/js/timepicker.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION, false);
                    wp_enqueue_script('confetti-js', plugins_url('dist/js/confetti.js', __FILE__), array( 'jquery' ), MY_STICKY_ELEMENT_VERSION, true) ;

                    wp_enqueue_script('mailcheck-js', plugins_url('dist/js/mailcheck.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION);
                    wp_enqueue_script('autocomplete-email-js', plugins_url('dist/js/email-autocomplete.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION, true);

                    wp_enqueue_script('mystickyelements-js', plugins_url('dist/js/mystickyelements-admin.js', __FILE__), array('jquery'), MY_STICKY_ELEMENT_VERSION, true);
                    wp_enqueue_script('mse-app', plugins_url('dist/js/app.js', __FILE__), array('jquery'), MY_STICKY_ELEMENT_VERSION, true);

                    $locale_settings = array(
                        'ajaxurl' => admin_url('admin-ajax.php'),
                        'ajax_nonce' => wp_create_nonce('mystickyelements'),
                        'has_js_access' => current_user_can("unfiltered_html") ? true : false,
                        'js_message' => esc_html__("Please remove the JavaScript from the channels or ask the website's administrator to give you access to add JavaScript.", "mystickyelements"),
                        'remove' => esc_html__("Remove", "mystickyelements")
                    );
                    wp_localize_script('mystickyelements-js', 'mystickyelements', $locale_settings);
                }
            }

            if (isset($_GET['page']) && $_GET['page'] == 'my-sticky-elements-upgrade') {
                wp_enqueue_style('mystickyelements-pricing-table', plugins_url('dist/css/pricing-table.css', __FILE__), [], MY_STICKY_ELEMENT_VERSION);
                $queryArgs = [
                    'family' => 'Poppins:wght@400;500;600;700&display=swap',
                    'subset' => 'latin,latin-ext',
                ];
                wp_enqueue_style('google-poppins-fonts', add_query_arg($queryArgs, "//fonts.googleapis.com/css2"), [], null);

                wp_enqueue_script('mystickyelements-slick', plugins_url('dist/js/slick.js', __FILE__), ['jquery'], MY_STICKY_ELEMENT_VERSION);
            }
        }

        public function check_for_redirection()
        {
            $page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
            if ($page == 'my-sticky-elements-leads') {
                $total_leads = $this->total_my_sticky_elements_widgets(); // Total number of my sticky elements contact form leads
                $contact_form_channel_active = $this->is_contact_form_channel_active(); // True if contact form is enabled, false otherwise
                if ($total_leads == 0 && !$contact_form_channel_active) {
                    wp_redirect(admin_url('admin.php?page=my-sticky-elements'));
                    exit;
                }
            }
        }

        public function mystickyelement_inline_css_admin()
        {
            global $submenu;
            $parent_slug = 'my-sticky-elements';
            $elements_widgets 			= get_option('mystickyelements-widgets');
            $total_leads = $this->total_my_sticky_elements_widgets(); // Total number of my sticky elements contact form leads
            $contact_form_channel_active = $this->is_contact_form_channel_active(); // True if contact form is enabled, false otherwise

            if (isset($submenu[$parent_slug])) {
                foreach ($submenu[$parent_slug] as &$item) {
                    if (isset($item[2]) && $item[2] === 'my-sticky-elements-leads') {
                        $item[4] = 'mse-admin-menu-leads'; // add your class here
                    }
                    if (isset($item[2]) && $item[2] === 'my-sticky-elements-new-widget') {
                        $item[4] = 'mse-admin-menu-upgrade'; // add your class here
                    }
                    if (isset($item[0]) && $item[0] === 'MSE upgrade') {
                        $item[4] = 'mse-admin-menu-upgrade'; // add your class here
                    }
                }
            }

            ?>
			<style>  
				.mse-admin-menu-upgrade {
					display: none !important;
				}
				<?php
                    if (empty($elements_widgets)) {
                        echo '#toplevel_page_my-sticky-elements ul.wp-submenu .wp-first-item {
							display: none !important;
						}';
                    }
            if ($total_leads == 0 && !$contact_form_channel_active) {
                echo '#toplevel_page_my-sticky-elements ul.wp-submenu .mse-admin-menu-leads {
							display: none !important;
						}';
            }
            ?>
			</style>
			<?php
        }


        /**
         * Total number of my sticky elements contact form leads
         *
         * @return int Total number of contact form leads
         */
        public function total_my_sticky_elements_widgets()
        {
            global $wpdb;
            $tableName = $wpdb->prefix . 'mystickyelement_contact_lists';
            $total_leads = 0;
            // Check if table exists using prepared statement for security
            $table_check = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $tableName));
            if ($table_check === $tableName) {
                // Use prepared statement with identifier placeholder for table name
                $total_leads = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM %i", $tableName));
                $total_leads = absint($total_leads);
            }
            return $total_leads;
        }


        /**
         * Is contact Form active
         *
         * @return bool True if contact form is enabled, false otherwise
         */
        public function is_contact_form_channel_active()
        {
            $contact_form = get_option('mystickyelements-contact-form', false);

            // Check if contact form exists and is enabled
            if ($contact_form && isset($contact_form['enable']) && intval($contact_form['enable']) === 1) {
                return true;
            }

            return false;
        }

        /*
         * Add My Sticky Element Page in admin menu.
         */
        public function add_mystickyelement_plugin_page()
        {


            $getData = filter_input_array(INPUT_GET);
            if (isset($getData['hide_mserecommended_plugin']) && isset($getData['nonce'])) {
                if (current_user_can('manage_options')) {
                    $nonce = $getData['nonce'];
                    if (wp_verify_nonce($nonce, "mse_recommended_plugin")) {
                        update_option('hide_mserecommended_plugin', true);
                    }
                }
            }
            $hide_mserecommended_plugin = get_option('hide_mserecommended_plugin');
            $elements_widgets 			= get_option('mystickyelements-widgets');

            $total_leads = $this->total_my_sticky_elements_widgets(); // Total number of my sticky elements contact form leads
            $contact_form_channel_active = $this->is_contact_form_channel_active(); // True if contact form is enabled, false otherwise
            $new_widget_link 			= (!empty($elements_widgets)) ? 'my-sticky-elements-new-widget' : 'my-sticky-elements&widget=0';
            $default_widget_name = 'Dashboard';
            add_menu_page(
                'Settings Admin',
                'My Sticky Elements',
                'manage_options',
                'my-sticky-elements',
                array( $this, 'mystickyelements_admin_settings_page' ),
                'dashicons-sticky'
            );
            if (!empty($elements_widgets) && count($elements_widgets) > 0) {
                add_submenu_page(
                    'my-sticky-elements',
                    'Settings Admin',
                    'Dashboard',
                    'manage_options',
                    'my-sticky-elements',
                    array( $this, 'mystickyelements_admin_settings_page' )
                );
            } else {
                add_submenu_page(
                    'my-sticky-elements',
                    'Settings Admin',
                    '+ Create New Widget',
                    'manage_options',
                    $new_widget_link,
                    array( $this, 'mystickyelements_admin_new_widget_page' )
                );
            }
            add_submenu_page(
                'my-sticky-elements',
                'Settings Admin',
                'MSE upgrade',
                'manage_options',
                $new_widget_link,
                array( $this, 'mystickyelements_admin_new_widget_page' )
            );



            if (class_exists('Chatway')) {
                add_submenu_page(
                    'my-sticky-elements',
                    'Settings Admin',
                    'Chatway Live Chat',
                    'manage_options',
                    'manage-chatway-plugin',
                    array( $this, 'mystickyelements_manage_chatway_plugin' )
                );
            } else {
                add_submenu_page(
                    'my-sticky-elements',
                    'Settings Admin',
                    'Chatway Live Chat',
                    'manage_options',
                    'my-sticky-elements-chatway-plugin',
                    array( $this, 'mystickyelements_install_chatway_plugin' )
                );
            }

            if ($contact_form_channel_active == true) {
                add_submenu_page(
                    'my-sticky-elements',
                    'Settings Admin',
                    'Integrations',
                    'manage_options',
                    'my-sticky-elements-integration',
                    array( $this, 'mystickyelements_admin_integration_page' )
                );
            }


            add_submenu_page(
                'my-sticky-elements',
                'Settings Admin',
                'Widget Analytics',
                'manage_options',
                'my-sticky-elements-analytics',
                [
                    $this,
                    'mystickyelements_admin_widget_analytics_page',
                ]
            );

            add_submenu_page(
                'my-sticky-elements',
                'Settings Admin',
                'Contact Form Leads',
                'manage_options',
                'my-sticky-elements-leads',
                array( $this, 'mystickyelements_admin_leads_page' )
            );
            if (!$hide_mserecommended_plugin) {
                add_submenu_page(
                    'my-sticky-elements',
                    'Recommended Plugins',
                    'Recommended Plugins',
                    'manage_options',
                    'recommended-plugins',
                    array( $this, 'mystickyelements_recommended_plugins' )
                );
            }


            add_submenu_page(
                'my-sticky-elements',
                'Upgrade to Pro ⭐️',
                'Upgrade to Pro ⭐️',
                'manage_options',
                'my-sticky-elements-upgrade',
                array( $this, 'mystickyelements_admin_upgrade_to_pro' )
            );

        }

        public function mystickyelements_admin_widget_analytics_page()
        {
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';

            } else {
                include('mystickyelements-admin-widgetanalytics.php');
            }
        }

        public static function sanitize_options($value, $type = "")
        {
            if (!is_array($value)) {
                $value = stripslashes($value);
            }
            if ($type == "int") {
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            } elseif ($type == "email") {
                $value = sanitize_email($value);
            } elseif ($type == "url") {
                $value = esc_url_raw($value);
            } elseif ($type == "sql") {
                $value = esc_sql($value);
            } else {
                $value = sanitize_text_field($value);
            }
            return $value;
        }

        public function mystickyelements_admin_upgrade_to_pro()
        {
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';
            } else {
                include_once 'upgrade-to-pro.php';
            }
        }

        /*
         * My Sticky Elements Settings Page
         *
         */
        public function mystickyelements_admin_settings_page()
        {
            global $wpdb;
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            if ($is_shown != 1) {
                /* Signup Form When first time activate plugin */
                require_once MYSTICKYELEMENTS_PATH . 'admin/stickyelements-review-popup.php';
            }

            $widget_tab_index = 'mystickyelements-contact-form';
            if (isset($_POST['mystickyelement-submit']) && !wp_verify_nonce($_POST['mystickyelement-submit'], 'mystickyelement-submit')) {

                echo '<div class="error settings-error notice is-dismissible "><p><strong>' . esc_html__('Unable to complete your request', 'mystickyelements'). '</p></strong></div>';

            } elseif (isset($_POST['general-settings']) && !empty($_POST['general-settings']) && wp_verify_nonce($_POST['mystickyelement-submit'], 'mystickyelement-submit')) {

                /* Save/Update Contact Form tab */
                $widget_tab_index = isset($_POST['hide_tab_index']) ? $_POST['hide_tab_index'] : 'mystickyelements-contact-form';

                $elements_widgets[] = $_POST['widget_name'];


                update_option('mystickyelements-widgets', $elements_widgets);

                $contact_field = filter_var_array($_POST['contact-field']);
                update_option('mystickyelements-contact-field', $contact_field);

                $post = array();
                if (isset($_POST['contact-form'])) {
                    $contact = $_POST['contact-form'];

                    if (isset($contact['enable'])) {
                        $post['enable'] = self::sanitize_options($contact['enable'], "int");
                    }

                    if (isset($contact['name'])) {
                        $post['name'] = self::sanitize_options($contact['name'], "int");
                    }

                    if (isset($contact['name_require'])) {
                        $post['name_require'] = self::sanitize_options($contact['name_require'], "int");
                    }

                    if (isset($contact['name_value'])) {
                        $post['name_value'] = self::sanitize_options($contact['name_value']);
                    }

                    if (isset($contact['phone'])) {
                        $post['phone'] = self::sanitize_options($contact['phone'], "int");
                    }

                    if (isset($contact['phone_require'])) {
                        $post['phone_require'] = self::sanitize_options($contact['phone_require'], "int");
                    }

                    if (isset($contact['phone_formate'])) {
                        $post['phone_formate'] = self::sanitize_options($contact['phone_formate'], "int");
                    }

                    if (isset($contact['phone_value'])) {
                        $post['phone_value'] = self::sanitize_options($contact['phone_value']);
                    }

                    if (isset($contact['email'])) {
                        $post['email'] = self::sanitize_options($contact['email'], "int");
                    }

                    if (isset($contact['email_require'])) {
                        $post['email_require'] = self::sanitize_options($contact['email_require'], "int");
                    }

                    if (isset($contact['email_value'])) {
                        $post['email_value'] = self::sanitize_options($contact['email_value']);
                    }

                    if (isset($contact['message'])) {
                        $post['message'] = self::sanitize_options($contact['message'], "int");
                    }

                    if (isset($contact['message_require'])) {
                        $post['message_require'] = self::sanitize_options($contact['message_require'], "int");
                    }

                    if (isset($contact['message_value'])) {
                        $post['message_value'] = self::sanitize_options($contact['message_value']);
                    }
                    if (isset($contact['dropdown'])) {
                        $post['dropdown'] = self::sanitize_options($contact['dropdown'], "int");
                    }

                    if (isset($contact['dropdown_require'])) {
                        $post['dropdown_require'] = self::sanitize_options($contact['dropdown_require'], "int");
                    }

                    if (isset($contact['submit_button_background_color'])) {
                        $post['submit_button_background_color'] = self::sanitize_options($contact['submit_button_background_color']);
                    }

                    if (isset($contact['submit_button_text_color'])) {
                        $post['submit_button_text_color'] = self::sanitize_options($contact['submit_button_text_color']);
                    }

                    if (isset($contact['submit_button_text'])) {
                        $post['submit_button_text'] = self::sanitize_options($contact['submit_button_text']);
                    }

                    if (isset($contact['tab_background_color'])) {
                        $post['tab_background_color'] = self::sanitize_options($contact['tab_background_color']);
                    }

                    if (isset($contact['tab_text_color'])) {
                        $post['tab_text_color'] = self::sanitize_options($contact['tab_text_color']);
                    }
                    if (isset($contact['form_bg_color'])) {
                        $post['form_bg_color'] = self::sanitize_options($contact['form_bg_color']);
                    }
                    if (isset($contact['headine_text_color'])) {
                        $post['headine_text_color'] = self::sanitize_options($contact['headine_text_color']);
                    }

                    if (isset($contact['text_in_tab'])) {
                        $post['text_in_tab'] = self::sanitize_options($contact['text_in_tab']);
                    }

                    if (isset($contact['contact_title_text'])) {
                        $post['contact_title_text'] = self::sanitize_options($contact['contact_title_text']);
                    }

                    if (isset($contact['send_leads'])) {
                        $post['send_leads'] = array_map([self::class, 'sanitize_options'], $contact['send_leads']);
                    }

                    if (isset($contact['sent_to_mail'])) {
                        $post['sent_to_mail'] = self::sanitize_options($contact['sent_to_mail']);
                    }

                    if (isset($contact['direction'])) {
                        $post['direction'] = self::sanitize_options($contact['direction']);
                    }

                    if (isset($contact['direction'])) {
                        $post['direction'] = self::sanitize_options($contact['direction']);
                    }

                    if (isset($contact['desktop'])) {
                        $post['desktop'] = self::sanitize_options($contact['desktop'], "int");
                    }

                    if (isset($contact['mobile'])) {
                        $post['mobile'] = self::sanitize_options($contact['mobile'], "int");
                    }
                    if (isset($contact['dropdown-placeholder'])) {
                        $post['dropdown-placeholder'] = self::sanitize_options($contact['dropdown-placeholder']);
                    }
                    if (isset($contact['dropdown-option'])) {
                        $post['dropdown-option'] = filter_var_array($contact['dropdown-option']);
                    }
                    if (isset($contact['redirect'])) {
                        $post['redirect'] = self::sanitize_options($contact['redirect'], "int");
                    }
                    if (isset($contact['redirect_link'])) {
                        $post['redirect_link'] = self::sanitize_options($contact['redirect_link']);
                    }

                    if (isset($contact['close_form_automatic'])) {
                        $post['close_form_automatic'] = self::sanitize_options($contact['close_form_automatic'], "int");
                    }

                    if (isset($contact['close_after'])) {
                        $post['close_after'] = self::sanitize_options($contact['close_after'], "int");
                    }
                }
                update_option('mystickyelements-contact-form', $post);

                /* Save/Update Social Channels tabs */
                $social_channels = array();
                if (isset($_POST['social-channels'])) {
                    if (!empty($_POST['social-channels'])) {
                        $social_channels = $_POST['social-channels'];
                        foreach ($social_channels as $key => $val) {
                            $social_channels[$key] = self::sanitize_options($val, "int");
                        }
                    }
                }
                update_option('mystickyelements-social-channels', $social_channels);

                $social_channels_tab = array();
                if (isset($_POST['social-channels-tab'])) {
                    if (!empty($_POST['social-channels-tab'])) {
                        foreach ($_POST['social-channels-tab'] as $key => $option) {
                            if (isset($option['text'])) {
                                if (strpos($key, 'custom_channel') !== false) {
                                    if (is_super_admin()) {
                                        $option['text'] = self::sanitize_options($option['text']);
                                    } else {
                                        $option['text'] = esc_url($option['text']);
                                    }
                                } elseif (strpos($key, 'custom_shortcode') !== false) {
                                    $option['text'] = $option['text'];
                                } else {
                                    $option['text'] = self::sanitize_options($option['text']);
                                }
                            }
                            if (isset($option['desktop'])) {
                                $option['desktop'] = self::sanitize_options($option['desktop'], "int");
                            }
                            if (isset($option['mobile'])) {
                                $option['mobile'] = self::sanitize_options($option['mobile'], "int");
                            }
                            if (isset($option['bg_color'])) {
                                $option['bg_color'] = self::sanitize_options($option['bg_color']);
                            }
                            if (isset($option['icon_text'])) {
                                $option['icon_text'] = self::sanitize_options($option['icon_text']);
                            }
                            if (isset($option['hover_text'])) {
                                $option['hover_text'] = self::sanitize_options($option['hover_text']);
                            }
                            if (isset($option['open_new_tab'])) {
                                $option['open_new_tab'] = self::sanitize_options($option['open_new_tab']);
                            }
                            if (isset($option['pre_set_message'])) {
                                $option['pre_set_message'] = self::sanitize_options($option['pre_set_message']);
                            }

                            $social_channels_tab[$key] = $option;
                        }
                    }
                }
                update_option('mystickyelements-social-channels-tabs', $social_channels_tab);

                /* Save/Update General Settings */
                $general_setting = array();
                if (isset($_POST['general-settings'])) {
                    if (!empty($_POST['general-settings'])) {
                        foreach ($_POST['general-settings'] as $key => $value) {
                            $general_setting[$key] = self::sanitize_options($value);
                        }
                    }
                }
                update_option('mystickyelements-general-settings', $general_setting);

                /* Send Email Afte set email */
                if (isset($_POST['contact-form']['send_leads']) && $_POST['contact-form']['send_leads'] == 'mail' && $_POST['contact-form']['sent_to_mail'] != '' && !get_option('mystickyelements-contact-mail-sent')) {
                    $send_mail = $_POST['contact-form']['sent_to_mail'];

                    $subject = "Great job! You created your contact form successfully";
                    $message = 'Thanks for using MyStickyElements! If you see this message in your spam folder, please click on "Report not spam" so you will get the next leads into your inbox.';


                    $blog_name = get_bloginfo('name');
                    $blog_email = get_bloginfo('admin_email');

                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    $headers .= 'From: ' . $blog_name . ' <' . $blog_email . '>' ."\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

                    if (wp_mail($send_mail, $subject, $message, $headers)) {
                        update_option('mystickyelements-contact-mail-sent', true);
                    }
                }
                $this->mystickyelements_clear_all_caches();

                if (isset($_POST['save_and_view_dashboard']) && !empty($_POST['save_and_view_dashboard'])) {
                    echo '<script type="text/javascript"> jQuery("#loader").show(); </script>';

                    if (isset($_POST['widgest_status']) && $_POST['widgest_status'] == 0) {
                        echo '<script>window.location.href = "'.admin_url("admin.php?page=my-sticky-elements&first_widget=1&widget_saved=true").'";</script>';
                        exit;
                    } else {
                        echo '<script>window.location.href = "'.admin_url("admin.php?page=my-sticky-elements&widget_saved=true").'";</script>';
                        exit;
                    }
                }
                if (isset($_POST['save_view']) && $_POST['save_view'] == 'Save View') {

                    echo '<script type="text/javascript"> jQuery("#loader").show(); </script>';

                    if (isset($_POST['widgest_status']) && $_POST['widgest_status'] == 0) {
                        echo '<script>window.location.href = "'.admin_url("admin.php?page=my-sticky-elements&first_widget=1&widget_saved=true").'";</script>';
                    } else {
                        echo '<script>window.location.href = "'.admin_url("admin.php?page=my-sticky-elements&widget_saved=true").'";</script>';
                    }
                }


                if (isset($_POST['widgest_status']) && $_POST['widgest_status'] == 0) {
                    $this->show_save_popup();
                }
                echo '<script>window.location.href = "'.admin_url("admin.php?page=my-sticky-elements&widget=0&widget_saved=true").'";</script>';
                exit;

            }

            $contact_field = get_option('mystickyelements-contact-field');
            $is_widgest_create = 1;
            if (empty($contact_field)) {
                $is_widgest_create = 'my-sticky-elements-new-widget';
                $contact_field = array( 'name', 'phone', 'email', 'message', 'dropdown' );
            }
            $contact_form = get_option('mystickyelements-contact-form');
            $social_channels = get_option('mystickyelements-social-channels');
            $social_channels_tabs = get_option('mystickyelements-social-channels-tabs');
            $general_settings = get_option('mystickyelements-general-settings');

            if (!$contact_form && !$social_channels && !$social_channels_tabs && !$general_settings) {
                $contact_form 			= mystickyelement_default_settings('contact_form');
                $social_channels 		= mystickyelement_default_settings('social_channels');
                $social_channels_tabs 	= mystickyelement_default_settings('social_channels_tabs');
                $general_settings 		= mystickyelement_default_settings('general_settings');
            }
            if (!isset($general_settings['position'])) {
                $general_settings['position'] = 'left';
            }
            if (!isset($general_settings['position_mobile'])) {
                $general_settings['position_mobile'] = 'left';
            }
            $social_channels_lists = mystickyelements_social_channels();

            $upgrade_url = admin_url("admin.php?page=my-sticky-elements-upgrade");
            $is_pro_active = false;
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';

            } else {

                $default_fonts = array('Arial', 'Tahoma', 'Verdana', 'Helvetica', 'Times New Roman', 'Trebuchet MS', 'Georgia', 'Open Sans Hebrew');

                if (isset($general_settings['font_family']) && $general_settings['font_family'] != "") :
                    if (!in_array($general_settings['font_family'], $default_fonts)):
                        ?>
                <link href="https://fonts.googleapis.com/css?family=<?php echo esc_attr($general_settings['font_family']); ?>:400,500,600,700"
                      rel="stylesheet" type="text/css" class="sfba-google-font">
					  <?php endif;?>
                <style>
                    .myStickyelements-preview-ul .mystickyelements-social-icon {
                        font-family: <?php echo esc_attr((isset($general_settings['font_family']) && $general_settings['font_family'] == 'System Stack') ? '-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif' : $general_settings['font_family']);?>}
                </style>
				<?php endif;
                if (!isset($_GET['widget']) && isset($_GET['page'])) {
                    include_once('admin/stickyelements-dashboard.php');
                } else {
                    include_once('admin/stickyelements-settings.php');

                    $mystickyelements_popup_status = get_option('mystickyelements_intro_popup');
                    if ($mystickyelements_popup_status == 'show') {
                        ?>
						
						<div class="contactform-sendleads-upgrade-popup mystickyelements-action-popup-open mystickyelements-intro-popup mystickyelements-blue-popup" style="display:block;">
							<div class="popup-ui-widget-header">
								<span id="ui-id-1" class="ui-dialog-title"><?php esc_html_e("Welcome to My Sticky Elements", "mystickyelements");?></span>
								
								<span class="close-dialog" data-from="intro-popup">						
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#31373D" d="M22.238 18.004l9.883-9.883c1.172-1.171 1.172-3.071 0-4.243-1.172-1.171-3.07-1.171-4.242 0l-9.883 9.883-9.883-9.882c-1.171-1.172-3.071-1.172-4.243 0-1.171 1.171-1.171 3.071 0 4.243l9.883 9.882-9.907 9.907c-1.171 1.171-1.171 3.071 0 4.242.585.586 1.354.879 2.121.879s1.536-.293 2.122-.879l9.906-9.906 9.882 9.882c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879c1.172-1.171 1.172-3.071 0-4.242l-9.881-9.883z"/></svg>
								</span>
							</div>
							<div class="ui-widget-content">
								<p><?php _e('Select your contact form fields, chat, and social channels. Need help? Visit our ', 'mystickyelements'); ?><a href="https://premio.io/help/mystickyelements/?utm_soruce=wordpressmystickyelements" target="_blank"><?php _e('Help Center', 'mystickyelements'); ?></a><?php _e(' and check the video.', 'mystickyelements'); ?></p>
								
								<iframe width="420" height="240" src="https://www.youtube.com/embed/VR9S_yuN1ko" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<input type="hidden" id="myStickyelements_update_popup_status" value="<?php echo wp_create_nonce("myStickyelements_update_popup_status") ?>">
							</div>
							<div class="popup-ui-dialog-buttonset">
								<a href="#" class="new-upgrade-button mystickyelement-goto-button">Go to My Sticky Elements</a>
							</div>
						</div>
						<div id="mystickyelement_intro_popup_overlay" class="stickyelement-overlay" style="display:block;"></div>
						<?php
                    }
                }

                ?>
                
                <?php
                $table_name = $wpdb->prefix . "mystickyelement_contact_lists";
                $result = $wpdb->get_results("SELECT count(*) as count FROM {$table_name} ORDER BY ID DESC");

                if ($result[0]->count != 0 && !get_option('myStickyelements_show_leads')) { ?>
					<div id="myStickyelements-new-lead-confirm" style="display:none;" title="<?php esc_attr_e('Congratulations 🎉', 'mystickyelements'); ?>">
						<p><?php _e('You just got your first My Sticky Elements lead. Click on the Show Me button to display your contact form leads', 'mystickyelements'); ?></p>
						<p><?php _e('<a style="color: #000;" href="'.esc_url($upgrade_url).'" target="_blank"><strong>Upgrade to Pro</strong></a> to get leads on your email with more customization and awesome features 🚀', 'mystickyelements'); ?></p>
					</div>
					<script>
						( function( $ ) {
							"use strict";
							$(document).ready(function(){
								jQuery( "#myStickyelements-new-lead-confirm" ).dialog({
                                    closeText: "",
									resizable: false,
									modal: true,
									draggable: false,
									height: 'auto',
									width: 400,
                                    dialogClass: 'first-mse-lead',
									buttons: {
										"Show Me": {
												click: function () {
													window.location = "<?php echo admin_url('admin.php?page=my-sticky-elements-leads')?>";
													//$(this).dialog('close');
												},
												text: 'Show Me',
												class: 'mse-primary-button'
											},
											"Not Now": {
												click: function () {
													$(this).dialog('close');
												},
												text: 'Not Now',
												class: 'mse-secondary-button'
											},
									}
								});
							});
						})( jQuery );
					</script>
					<?php
                    update_option('myStickyelements_show_leads', 1);
                }
                ?>
				<div id="mystickyelement-save-confirm" style="display:none;" title="<?php esc_attr_e('Icons\' text isn\'t supported in this template', 'mystickyelements'); ?>">
					<p><?php _e("The selected template doesn't support icons'text, please change to the Default templates. Would you like to publish it anyway?", 'mystickyelements'); ?></p>
				</div>
				<?php



                if (isset($_GET['first_widget']) && $_GET['first_widget'] == 1) {
                    $this->show_save_popup();
                }

            }
        }

        public function show_save_popup()
        {
            ?>
			<div class="main-popup-mystickyelement-bg first-widget-popup">
				<div class="main-popup-mystickyelement-bg mystickyelement_container_popupbox">
					<div class="firstwidget-popup-contain">
						<img src="<?php echo MYSTICKYELEMENTS_URL; ?>/images/firstwidget_congratulations.svg">
						<h4><?php _e('Congratulations! 🎉', 'mystickyelements'); ?></h4>
						<p><?php _e('Your first widget is now up and running on your website!', 'mystickyelements'); ?></p>
						<div class="first-widget-popup-contant">
							<h4><?php _e('Upgrade to pro today', 'mystickyelements'); ?></h4>
							<p> <?php _e('🛠️ Show unlimited social icon such as Whatsapp,twitter,phone and so on', 'mystickyelements') ?> </p>
							<p> <?php _e('📱Create multiple widgets for different devices, pages and languages.', 'mystickyelements') ?> </p>
							<p> <?php _e('📈 Unlock analytics about each channel usage and different widgets ', 'mystickyelements') ?> </p>
							<p> <?php _e('📩 Get contact form leads to Your email and integrate with MailChimp and MailPoet', 'mystickyelements') ?> </p>
						</div>
						<a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements-upgrade"));?>" class="mystickymenu btn-black btn-back-dashboard"><?php _e('Upgrade to Pro', 'mystickyelements');?></a><br>
						<a href="#" class="mystickymenu btn-black btn-dashboard btn-close-dashboard"><?php _e('Close', 'mystickyelements');?></a>
					</div>
					<div class="popup-modul-close-btn firstwidget-model"><a href="<?php echo esc_url(admin_url("admin.php?page=my-sticky-elements")); ?>" class="close-chaty-maxvisitor-popup stickyelement-save-close-wrap" id="close-first-popup"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 5L5 15" stroke="#4A4A4A" stroke-width="2.08" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 5L15 15" stroke="#4A4A4A" stroke-width="2.08" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>
				</div>
			</div>
			<div class="stickyelement-overlay" id="success-popup-overlay"  data-id=""></div>
			<?php
        }

        public function mystickyelement_social_tab_add($key, $element_widget_no = '')
        {
            global $social_channel_count;
            if (isset($_POST['is_ajax']) && $_POST['is_ajax'] == true) {
                if (!current_user_can('manage_options')) {
                    wp_die(0);
                }
                check_ajax_referer('mystickyelements', 'wpnonce');
            }
            include MYSTICKYELEMENTS_PATH . '/admin/social-tab.php';
        }

        /*
         * My Sticky Elements Integration page
         *
         */
        public function mystickyelements_admin_integration_page()
        {
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            ;
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';

            } else {
                include('mystickyelements-admin-integration.php');
            }
        }

        /*
         * My Sticky Elements Contact Leads
         *
         */
        public function mystickyelements_admin_leads_page()
        {
            global $wpdb;

            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';
            } else {
                include MYSTICKYELEMENTS_PATH.'admin/form-leads.php';
            }
        }

        public function mystickyelements_recommended_plugins()
        {
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            ;
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';
            } else {
                include_once 'recommended-plugins.php';
            }
        }

        public function mystickyelements_manage_chatway_plugin()
        {
            ?>
			<script>
				window.location.href= '<?php echo admin_url("admin.php?page=chatway")?>'
			</script>
			<?php
            exit;
        }
        public function mystickyelements_install_chatway_plugin()
        {
            include_once 'admin/chatway-plugin.php';
        }


        /*
         * My Sticky Elements Create New Widget
         *
         */
        public function mystickyelements_admin_new_widget_page()
        {
            //  update 2nd time if update mail is not submited by user
            $is_shown = MSE_SIGNUP_CLASS::check_modal_status();
            ;
            if ($is_shown) {
                /* Signup Form When first time activate plugin */
                include_once MYSTICKYELEMENTS_PATH . '/admin/email-signup.php';
                return;
            }

            $upgrade_url = admin_url("admin.php?page=my-sticky-elements-upgrade");
            ?>
			<div class="mystickyelement-new-widget-wrap">
				<?php include_once MYSTICKYELEMENTS_PATH . 'mystickyelements-widget.php';?>				
			</div>
			<?php
        }

        public function get_mse_chatway_status()
        {
            if (! current_user_can('manage_options')) {
                wp_send_json_error(array( 'message' => __('You are not allowed to perform this action.', 'mystickyelements') ), 403);
            }
            check_ajax_referer('mystickyelements', 'wpnonce');
            $status = is_plugin_active('chatway-live-chat/chatway.php') ? 'active' : '';
            wp_send_json_success(array( 'status' => $status ));
        }

        public function mystickyelement_delete_db_record()
        {
            global $wpdb;
            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            check_ajax_referer('mystickyelements', 'wpnonce');
            if (isset($_POST['ID']) && $_POST['ID'] != '' && wp_verify_nonce($_POST['delete_nonce'], "mysticky_elements_delete_nonce")) {
                $ID = sanitize_text_field($_POST['ID']);
                $table = $wpdb->prefix . 'mystickyelement_contact_lists';
                $ID = self::sanitize_options($ID, "sql");
                $delete_sql = $wpdb->prepare("DELETE FROM {$table} WHERE id = %d", $ID);
                $delete = $wpdb->query($delete_sql);
            }

            if (isset($_POST['all_leads']) && $_POST['all_leads'] == 1 && wp_verify_nonce($_POST['delete_nonce'], "mysticky_elements_delete_nonce")) {
                $table = $wpdb->prefix . 'mystickyelement_contact_lists';
                $delete = $wpdb->query("TRUNCATE TABLE $table");
            }
            wp_die();
        }

        public function myStickyelements_intro_popup_action()
        {
            if (! current_user_can('manage_options')) {
                wp_die(0);
            }

            if (!empty($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], 'myStickyelements_update_popup_status')) {
                update_option("mystickyelements_intro_popup", "hide");
            }
            echo esc_attr("1");
            die;
        }

        public function mystickyelements_admin_send_message_to_owner()
        {

            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            $response = array();
            $response['status'] = 0;
            $response['error'] = 0;
            $response['errors'] = array();
            $response['message'] = "";
            $errorArray = [];
            $errorMessage = esc_html__("%s is required", "mystickyelements");
            $postData = $_POST;
            if (!isset($postData['textarea_text']) || trim($postData['textarea_text']) == "") {
                $error = array(
                    "key"   => "textarea_text",
                    "message" => esc_html__("Please enter your message", 'mystickyelements')
                );
                $errorArray[] = $error;
            }
            if (!isset($postData['user_email']) || trim($postData['user_email']) == "") {
                $error = array(
                    "key"   => "user_email",
                    "message" => sprintf($errorMessage, __("Email", 'mystickyelements'))
                );
                $errorArray[] = $error;
            } elseif (!filter_var($postData['user_email'], FILTER_VALIDATE_EMAIL)) {
                $error = array(
                    'key' => "user_email",
                    "message" => "Email is not valid"
                );
                $errorArray[] = $error;
            }
            if (empty($errorArray)) {
                if (!isset($_REQUEST['nonce']) || empty($_REQUEST['nonce'])) {
                    $error = array(
                        'key' => "nonce",
                        "message" => "Your request is not valid"
                    );
                    $errorArray[] = $error;
                } elseif (!wp_verify_nonce($_REQUEST['nonce'], "mystickyelements_send_message_to_owner")) {
                    $error = array(
                        'key' => "nonce",
                        "message" => "Your request is not valid"
                    );
                    $errorArray[] = $error;
                }
            }
            if (empty($errorArray)) {
                global $current_user;
                $text_message = $postData['textarea_text'];
                $email = $postData['user_email'];
                $domain = site_url();
                $user_name = $current_user->first_name." ".$current_user->last_name;

                $response['status'] = 1;

                /* sending message to Crisp */
                $post_message = array();

                $message_data = array();
                $message_data['key'] = "Plugin";
                $message_data['value'] = "My Sticky Elements";
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Domain";
                $message_data['value'] = $domain;
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Email";
                $message_data['value'] = $email;
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Message";
                $message_data['value'] = $text_message;
                $post_message[] = $message_data;

                $api_params = array(
                    'domain' => $domain,
                    'email' => $email,
                    'url' => site_url(),
                    'name' => $user_name,
                    'message' => $post_message,
                    'plugin' => "MSE",
                    'type' => "Need Help",
                );

                /* Sending message to Crisp API */
                $crisp_response = wp_safe_remote_post("https://premioapps.com/premio/send-message-api.php", array('body' => $api_params, 'timeout' => 15, 'sslverify' => true));

                if (is_wp_error($crisp_response)) {
                    wp_safe_remote_post("https://premioapps.com/premio/send-message-api.php", array('body' => $api_params, 'timeout' => 15, 'sslverify' => false));
                }
            } else {
                $response['error'] = 1;
                $response['errors'] = $errorArray;
            }
            wp_send_json($response);
            wp_die();
        }

        public function mystickyelement_widget_status()
        {
            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            check_ajax_referer('mystickyelements', 'wpnonce');

            if (isset($_POST['widget_id']) && $_POST['widget_id'] != '' && isset($_POST['widget_status']) && $_POST['widget_status'] != '') {
                $stickyelements_widgets = get_option('stickyelements_widgets');
                if ( ! is_array( $stickyelements_widgets ) ) {
                    $stickyelements_widgets = array();
                }
                $widget_id = $_POST['widget_id'];
                $widget_status = $_POST['widget_status'];
                $stickyelements_widgets[$widget_id]['status'] = $widget_status;
                update_option('stickyelements_widgets', $stickyelements_widgets);

            }
            wp_die();
        }

        public function my_sticky_elements_bulks()
        {
            global $wpdb;

            if (! current_user_can('manage_options')) {
                wp_die(0);
            }

            check_ajax_referer('mystickyelements', 'wpnonce');

            if (isset($_POST['wpnonce'])) {
                $bulks = isset($_POST['bulks']) ? $_POST['bulks'] : array();
                foreach ($bulks as $key => $bulk) {
                    $ID = sanitize_text_field($bulk);
                    $table = $wpdb->prefix . 'mystickyelement_contact_lists';
                    $ID = self::sanitize_options($ID, "sql");
                    $delete_sql = $wpdb->prepare("DELETE FROM {$table} WHERE id = %d", $ID);
                    $delete = $wpdb->query($delete_sql);
                }
            }
            wp_die();
        }

        public function mystickyelement_widget_rename()
        {

            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            check_ajax_referer('mystickyelements', 'wpnonce');

            if (isset($_POST['widget_id']) && $_POST['widget_id'] != '' && isset($_POST['widget_rename']) && $_POST['widget_rename'] != '') {

                $stickyelements_widgets = get_option('mystickyelements-widgets');
                $widget_id = $_POST['widget_id'];
                $widget_rename = $_POST['widget_rename'];

                $stickyelements_widgets[$widget_id] = $widget_rename;
                update_option('mystickyelements-widgets', $stickyelements_widgets);
            }
            wp_die();
        }

        public function mystickyelement_widget_delete()
        {

            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            check_ajax_referer('mystickyelements', 'wpnonce');

            if (isset($_POST['widget_id']) && $_POST['widget_id'] != '' && isset($_POST['widget_delete']) && $_POST['widget_delete'] == 1) {

                $elements_widgets = get_option('mystickyelements-widgets');
                $stickyelements_widgets_status = get_option('stickyelements_widgets');
                $mystickyelements_widget = self::sanitize_options($_POST['widget_id']);

                foreach ($elements_widgets as $key => $widget_value) {
                    $element_widget_no = '';
                    if ($key != 0) {
                        $element_widget_no = '-' . esc_attr($key);
                    }
                    delete_option('mystickyelements-contact-field' . $element_widget_no);
                    delete_option('mystickyelements-contact-form' . $element_widget_no);
                    delete_option('mystickyelements-social-channels' . $element_widget_no);
                    delete_option('mystickyelements-social-channels-tabs' . $element_widget_no);
                    delete_option('mystickyelements-general-settings' . $element_widget_no);
                }

                delete_option('mystickyelements-widgets');
                delete_option('stickyelements_widgets');

            }
            wp_die();
        }


        public function mystickyelements_deactivate()
        {
            global $pagenow;

            if ('plugins.php' !== $pagenow) {
                return;
            }

            include MYSTICKYELEMENTS_PATH . 'mystickyelements-deactivate-form.php';
        }

        public function mystickyelements_plugin_deactivate()
        {
            global $current_user;
            if (! current_user_can('manage_options')) {
                wp_die(0);
            }
            check_ajax_referer('mystickyelements_deactivate_nonce', 'nonce');

            $postData = $_POST;
            $errorCounter = 0;
            $response = array();
            $response['status'] = 0;
            $response['message'] = "";
            $response['valid'] = 1;
            if (!isset($postData['reason']) || empty($postData['reason'])) {
                $errorCounter++;
                $response['message'] = "Please provide reason";
            } elseif (!isset($postData['reason']) || empty($postData['reason'])) {
                $errorCounter++;
                $response['message'] = "Please provide reason";
            } else {
                $nonce = $postData['nonce'];
                if (!wp_verify_nonce($nonce, 'mystickyelements_deactivate_nonce')) {
                    $response['message'] = esc_html__("Your request is not valid", "mystickyelements");
                    $errorCounter++;
                    $response['valid'] = 0;
                }
            }
            if ($errorCounter == 0) {
                global $current_user;
                $plugin_info = get_plugin_data(MYSTICKYELEMENTS_PATH. 'mystickyelements.php');
                $postData = $_POST;
                $email = "none@none.none";

                if (isset($postData['email_id']) && !empty($postData['email_id']) && filter_var($postData['email_id'], FILTER_VALIDATE_EMAIL)) {
                    $email = $postData['email_id'];
                }
                $domain = site_url();
                $user_name = $current_user->first_name . " " . $current_user->last_name;

                $response['status'] = 1;

                /* sending message to Crisp */
                $post_message = array();

                $message_data = array();
                $message_data['key'] = "Plugin";
                $message_data['value'] = "My Sticky Elements";
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Plugin Version";
                $message_data['value'] = $plugin_info['Version'];
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Domain";
                $message_data['value'] = $domain;
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Email";
                $message_data['value'] = $email;
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "WordPress Version";
                $message_data['value'] = esc_attr(get_bloginfo('version'));
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "PHP Version";
                $message_data['value'] = PHP_VERSION;
                $post_message[] = $message_data;

                $message_data = array();
                $message_data['key'] = "Message";
                $message_data['value'] = $postData['reason'];
                $post_message[] = $message_data;

                $api_params = array(
                    'domain' => $domain,
                    'email' => $email,
                    'url' => site_url(),
                    'name' => $user_name,
                    'message' => $post_message,
                    'plugin' => "MSE",
                    'type' => "Uninstall",
                );

                /* Sending message to Crisp API */
                $crisp_response = wp_safe_remote_post("https://premioapps.com/premio/send-message-api.php", array('body' => $api_params, 'timeout' => 15, 'sslverify' => true));

                if (is_wp_error($crisp_response)) {
                    wp_safe_remote_post("https://premioapps.com/premio/send-message-api.php", array('body' => $api_params, 'timeout' => 15, 'sslverify' => false));
                }
            }
            echo json_encode($response);
            wp_die();
        }

        /*
         * clear cache when any option is updated
         *
         */
        public function mystickyelements_clear_all_caches()
        {

            try {
                global $wp_fastest_cache;
                // if W3 Total Cache is being used, clear the cache
                if (function_exists('w3tc_flush_all')) {
                    w3tc_flush_all();
                }
                /* if WP Super Cache is being used, clear the cache */
                if (function_exists('wp_cache_clean_cache')) {
                    global $file_prefix, $supercachedir;
                    if (empty($supercachedir) && function_exists('get_supercache_dir')) {
                        $supercachedir = get_supercache_dir();
                    }
                    wp_cache_clean_cache($file_prefix);
                }

                if (class_exists('WpeCommon')) {
                    //be extra careful, just in case 3rd party changes things on us
                    if (method_exists('WpeCommon', 'purge_memcached')) {
                        //WpeCommon::purge_memcached();
                    }
                    if (method_exists('WpeCommon', 'clear_maxcdn_cache')) {
                        //WpeCommon::clear_maxcdn_cache();
                    }
                    if (method_exists('WpeCommon', 'purge_varnish_cache')) {
                        //WpeCommon::purge_varnish_cache();
                    }
                }

                if (method_exists('WpFastestCache', 'deleteCache') && !empty($wp_fastest_cache)) {
                    $wp_fastest_cache->deleteCache();
                }
                if (function_exists('rocket_clean_domain')) {
                    rocket_clean_domain();
                    // Preload cache.
                    if (function_exists('run_rocket_sitemap_preload')) {
                        run_rocket_sitemap_preload();
                    }
                }

                if (class_exists("autoptimizeCache") && method_exists("autoptimizeCache", "clearall")) {
                    autoptimizeCache::clearall();
                }

                if (class_exists("LiteSpeed_Cache_API") && method_exists("autoptimizeCache", "purge_all")) {
                    LiteSpeed_Cache_API::purge_all();
                }

                if (class_exists('\Hummingbird\Core\Utils')) {

                    $modules   = \Hummingbird\Core\Utils::get_active_cache_modules();
                    foreach ($modules as $module => $name) {
                        $mod = \Hummingbird\Core\Utils::get_module($module);

                        if ($mod->is_active()) {
                            if ('minify' === $module) {
                                $mod->clear_files();
                            } else {
                                $mod->clear_cache();
                            }
                        }
                    }
                }

                /* Clear nitropack plugin cache */
                if (function_exists('nitropack_purge_cache') && function_exists('nitropack_sdk_purge')) {
                    nitropack_sdk_purge(null, null, 'Manual purge of all pages');
                }

            } catch (Exception $e) {
                return 1;
            }
        }

        public function mystickyelements_review_box()
        {

            if (current_user_can('manage_options')) {
                $nonce = filter_input(INPUT_POST, 'nonce');
                $days  = filter_input(INPUT_POST, 'days');
                if (!empty($nonce) && wp_verify_nonce($nonce, 'mystickyelements')) {
                    if ($days == -1) {
                        add_option("mystickyelements_hide_review_box", "1");
                        update_option("get_mystickyelements_page_views", -1);
                    } else {
                        $date = date("Y-m-d", strtotime("+".$days." days"));
                        update_option("mystickyelements_show_review_box_after", $date);
                        update_option("get_mystickyelements_page_views", 4);
                    }
                }
            }
            wp_die();
        }
        public function mystickyelements_review_box_message()
        {
            if (current_user_can('manage_options')) {
                $nonce = filter_input(INPUT_POST, 'nonce');
                if (!empty($nonce) && wp_verify_nonce($nonce, 'mystickyelements')) {
                    add_option("mystickyelements_hide_review_box", "1");
                    update_option("get_mystickyelements_page_views", -1);
                    $rating  = filter_input(INPUT_POST, 'rating');
                    $message = filter_input(INPUT_POST, 'message');

                    if ($message != '') {
                        global $current_user;
                        $postMessage = [];

                        $domain    = site_url();
                        $user_name = $current_user->first_name." ".$current_user->last_name;
                        $email     = $current_user->user_email;

                        $messageData          = [];
                        $messageData['key']   = "email";
                        $messageData['value'] = $email;
                        $postMessage[]        = $messageData;

                        $messageData          = [];
                        $messageData['key']   = "website";
                        $messageData['value'] = $domain;
                        $postMessage[]        = $messageData;

                        $messageData          = [];
                        $messageData['key']   = "message";
                        $messageData['value'] = $message;
                        $postMessage[]        = $messageData;

                        $messageData          = [];
                        $messageData['key']   = "rating";
                        $messageData['value'] = $rating;
                        $postMessage[]        = $messageData;

                        $apiParams = [
                            'title'   => 'Review for My Sticky Elements WordPress',
                            'domain'  => $domain,
                            'email'   => "contact@premio.io",
                            'url'     => site_url(),
                            'name'    => $user_name,
                            'message' => $postMessage,
                            'plugin'  => 'My Sticky Elements',
                            'type'    => "Review",
                        ];

                        // Sending message to Crisp API
                        $apiResponse = wp_safe_remote_post("https://premioapps.com/premio/send-feedback-api.php", ['body' => $apiParams, 'timeout' => 15, 'sslverify' => true]);

                        if (is_wp_error($apiResponse)) {
                            wp_safe_remote_post("https://premioapps.com/premio/send-feedback-api.php", ['body' => $apiParams, 'timeout' => 15, 'sslverify' => false]);
                        }
                    }
                }
                wp_die();
            }
        }


    }
}


if (is_admin()) {
    $my_settings_page = new MyStickyElementsPage_pro();
    //include_once "class-review-box.php";
    include_once "class-upgrade-box.php";
}
