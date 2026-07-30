<?php
$elements_widgets = get_option('mystickyelements-widgets');
//get_option( 'mystickyelements-contact-field' );
$stickyelements_widgets = get_option('stickyelements_widgets');
if (!isset($stickyelements_widgets[0]['status'])) {
    $widget_status = 1;
}
if (isset($stickyelements_widgets[0]['status'])) {
    $widget_status = $stickyelements_widgets[0]['status'];
}
$class = 'mystickyelement-dashboard-free';
$mse_class = is_plugin_active('chatway-live-chat/chatway.php') ? 'has-chatway-chat' : '';
$upgrade_url = admin_url('admin.php?page=my-sticky-elements-upgrade');
?>
<div class="sr-only">
    <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.7525 3.19918C17.5738 3.04995 17.3566 2.95397 17.126 2.9222C16.8953 2.89043 16.6603 2.92414 16.4478 3.01949L12.4947 4.77731L10.1978 0.636682C10.0881 0.443367 9.929 0.282603 9.73687 0.170762C9.54474 0.0589211 9.3264 0 9.10409 0C8.88177 0 8.66343 0.0589211 8.4713 0.170762C8.27917 0.282603 8.12012 0.443367 8.01034 0.636682L5.71346 4.77731L1.76034 3.01949C1.54745 2.92428 1.31218 2.89052 1.08111 2.92203C0.850039 2.95354 0.632393 3.04906 0.452773 3.1978C0.273153 3.34653 0.138723 3.54255 0.0646786 3.76369C-0.00936533 3.98483 -0.02007 4.22228 0.0337749 4.44918L2.01815 12.9101C2.05609 13.0739 2.1269 13.2283 2.22627 13.3639C2.32565 13.4996 2.45152 13.6136 2.59627 13.6992C2.79225 13.8165 3.01631 13.8786 3.24471 13.8789C3.35574 13.8787 3.46619 13.8629 3.57284 13.832C7.18988 12.832 11.0105 12.832 14.6275 13.832C14.9578 13.9188 15.309 13.8711 15.6041 13.6992C15.7497 13.6147 15.8763 13.501 15.9758 13.3652C16.0753 13.2294 16.1456 13.0744 16.1822 12.9101L18.1744 4.44918C18.2276 4.22221 18.2163 3.98488 18.1418 3.76399C18.0672 3.54311 17.9324 3.34747 17.7525 3.19918Z" fill="url(#paint0_linear_12203_17671)"/>
        <defs>
            <linearGradient id="paint0_linear_12203_17671" x1="9.10372" y1="0" x2="9.10372" y2="13.8789" gradientUnits="userSpaceOnUse">
                <stop stop-color="#F69D01"/>
                <stop offset="1" stop-color="#F65901"/>
            </linearGradient>
        </defs>
    </svg>
</div>
<div class="wrap mse-wrap mystickyelement-wrap <?php echo esc_attr($mse_class);?>">
    <div class="mystickyelement-dashboard py-5 <?php echo esc_attr($class);?>">
        <div class="container">
            <?php if (!empty($elements_widgets) && $elements_widgets != '') :?>
                <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pb-5">
                    <div class="text-gray-700 text-3xl font-semibold">
                        <?php esc_html_e('Dashboard', 'mystickyelements'); ?>
                    </div>
                    <div class="inline-flex items-center gap-3">
                        <a href="<?php echo admin_url('admin.php?page=my-sticky-elements-new-widget')?>" class="mse-primary-button">
                            <i class="fas fa-plus-circle"></i>
                            <?php esc_html_e("Create a New Widget", 'mystickyelements') ?>
                        </a>
                    </div>
                </div>
                <div class="mystickyelement-widgets">
                    <table class="mystickyelement-widgets-lists mse-table dashboard-table">
                        <thead>
                            <tr>
                                <th class="w-25 text-center!"><?php esc_html_e('Status', 'mystickyelements');?></th>
                                <th class="text-left!"><?php esc_html_e('My Sticky Elements', 'mystickyelements');?></th>
                                <th class="w-25 text-center!"><?php esc_html_e('Edit', 'mystickyelements');?></th>
                                <th class="w-35 text-center!"><?php esc_html_e('Quick Action', 'mystickyelements');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($elements_widgets) && $elements_widgets != '') :
                            foreach ($elements_widgets as $key => $value) :
                                if (!isset($stickyelements_widgets[$key]['status'])) {
                                    $widget_status = 1;
                                }

                                if (isset($stickyelements_widgets[$key]['status'])) {
                                    $widget_status = $stickyelements_widgets[$key]['status'];
                                }
                                ?>
                                <tr id="stickyelement-widget-<?php echo esc_attr($key);?>">
                                    <td class="w-25 text-center!">
                                        <label class="myStickyelements-switch p-0! m-0! w-12!">
                                            <input type="checkbox" data-id="<?php echo esc_attr($key);?>" class="mystickyelement-widgets-lists-enabled" name="stickyelement-widget-enabled" id= "mystickyelement-widget-enabled-<?php echo esc_attr($key); ?>" value="1" <?php checked($widget_status, 1); ?> />
                                            <span class="slider round"></span>
                                        </label>

                                        <div class="mystickyelements-action-popup-open mystickyelements-action-popup-status" id="widget-status-popup-<?php echo esc_attr($key); ?>" style="display:none;">
                                            <div class="popup-ui-widget-header">
                                                <span id="ui-id-1" class="ui-dialog-title"><?php esc_html_e('Are you sure?', 'mystickyelements');?></span><span class="close-dialog" data-id="<?php echo esc_attr($key); ?>" data-from ='widget-status'> &#10006 </span>
                                            </div>
                                            <div id="widget-delete-confirm" class="ui-widget-content">
                                                <p>
                                                    <?php esc_html_e("You're about to turn off the widget. By turning it off, this widget won't appear on your website. Are you sure?", 'mystickyelements'); ?>
                                                </p>
                                            </div>
                                            <div class="popup-ui-dialog-buttonset flex justify-end gap-4">
                                                <button type="button" class="btn-disable-cancel mse-secondary-button" data-id="<?php echo esc_attr($key);?>">
                                                    <?php esc_html_e('Disable anyway', 'mystickyelements');?>
                                                </button>
                                                <button type="button" class="mystickyelement-keep-widget-btn mse-primary-button" data-id="<?php echo esc_attr($key); ?>">
                                                    <?php esc_html_e('Keep using', 'mystickyelements');?>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="mystickyelement-status-popup-overlay-<?php echo esc_attr($key);?>" class="stickyelement-overlay" style="display:none;" data-id="<?php echo esc_attr($key); ?>" data-from="widget-status"></div>
                                    </td>
                                    <td>
                                        <a class="text-gray-700! text-sm!" href="<?php echo admin_url('admin.php?page=my-sticky-elements&load_from=dashboard&widget='.$key)?>">
                                            <?php echo esc_html($value)?>
                                        </a>
                                    </td>
                                    <td class="w-25 text-center!">
                                        <a href="<?php echo admin_url('admin.php?page=my-sticky-elements&load_from=dashboard&widget='.$key)?>" class="mystickyelement-widgets-lists-edit-btn hover:bg-[#1447e6]! hover:text-white! focus-visible:text-white! focus-visible:[#1447e6]! focus-visible:rounded-full! focus:rounded-full!" >
                                            <i class="fas fa-pencil-alt"></i>
                                            <span class="sr-only"><?php esc_html_e('Edit', 'mystickyelements'); ?></span>
                                        </a>
                                    </td>
                                    <td class="w-35 text-center!">
                                        <div class="mystickyelement-quick-action-wrap">
                                            <div class="mystickyelements-custom-fields-tooltip">
                                                <a href="#"class="mystickyelements-tooltip dashboard mystickyelemt-rename-widget"  data-id="<?php echo esc_attr($key); ?>">
                                                    <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.93754 1.83337H12.6024C12.7766 1.83343 12.9442 1.8996 13.0715 2.01852C13.1988 2.13743 13.2762 2.30023 13.2881 2.47401C13.2999 2.6478 13.2454 2.81961 13.1355 2.95473C13.0256 3.08985 12.8684 3.17821 12.6959 3.20196L12.6024 3.20837H11.4584V18.7917H12.6005C12.7667 18.7917 12.9272 18.8519 13.0524 18.9611C13.1776 19.0703 13.259 19.2211 13.2816 19.3857L13.288 19.4792C13.288 19.6453 13.2279 19.8059 13.1187 19.9311C13.0095 20.0563 12.8586 20.1377 12.694 20.1603L12.6005 20.1667H8.93754C8.76335 20.1667 8.59568 20.1005 8.4684 19.9816C8.34112 19.8626 8.26372 19.6999 8.25185 19.5261C8.23998 19.3523 8.29451 19.1805 8.40444 19.0454C8.51436 18.9102 8.67148 18.8219 8.84404 18.7981L8.93754 18.7917H10.0825V3.20837H8.93754C8.77141 3.20837 8.61089 3.1482 8.48569 3.039C8.36048 2.92981 8.27905 2.77896 8.25646 2.61437L8.25004 2.52087C8.25005 2.35474 8.31021 2.19423 8.41941 2.06902C8.52861 1.94381 8.67945 1.86238 8.84404 1.83979L8.93754 1.83337ZM16.7255 4.58062C17.5154 4.58135 18.2728 4.89546 18.8313 5.45401C19.3899 6.01255 19.704 6.76989 19.7047 7.55979L19.7084 14.4385C19.7089 15.1993 19.4182 15.9316 18.8959 16.4849C18.3736 17.0382 17.6594 17.3706 16.8997 17.414L16.7292 17.4185H12.3796V4.57971H16.7246L16.7255 4.58062ZM9.16396 4.58062L9.15937 17.4167H4.81254C4.02258 17.4167 3.26495 17.103 2.70628 16.5445C2.1476 15.986 1.83362 15.2284 1.83337 14.4385V7.55979C1.83337 6.76967 2.14725 6.0119 2.70595 5.4532C3.26465 4.8945 4.02242 4.58062 4.81254 4.58062H9.16396V4.58062Z" fill="currentColor"/>
                                                    </svg>
                                                </a>
                                                <p>Rename</p>
                                            </div>

                                            <div class="mystickyelements-custom-fields-tooltip">
                                                <a class="mystickyelements-tooltip dashboard mse-duplicate-record" href="<?php echo admin_url('admin.php?copy-from='.$key.'&page=my-sticky-elements-new-widget');?>">
                                                    <i class="fas fa-copy"></i>
                                                </a>
                                                <p><?php esc_html_e('Duplicate', 'mystickyelements');?></p>
                                            </div>

                                            <div class="mystickyelement-delete-widget mystickyelements-custom-fields-tooltip" data-id="<?php echo esc_attr($key);?>">
                                                <a class="mystickyelements-tooltip dashboard delete-mse-record" href="#">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <p>
                                                    <?php esc_html_e('Delete', 'mystickyelements');?>
                                                </p>
                                            </div>

                                            <div class="mystickyelements-action-popup-open" id="stickyelement-action-popup-<?php echo esc_attr($key); ?>" style="display:none;">
                                                <div class="popup-ui-widget-header">
                                                    <div id="ui-id-1" class="ui-dialog-title">
                                                        <?php esc_html_e('Are you sure about deleting the widget?', 'mystickyelements');?>
                                                    </div>
                                                    <span class="close-dialog" data-id="<?php echo esc_attr($key); ?>" data-from ='widget-delete'>
                                                        &#10006
                                                    </span>
                                                </div>
                                                <div id="widget-delete-confirm" class="ui-widget-content">
                                                    <p>
                                                        <?php esc_html_e("Are you sure want to delete the widget? By doing this, you'll delete your saved settings, channels, & information within the widget. You will lose the widget permanently and will not be able to retrieve it.", 'mystickyelements'); ?>
                                                    </p>
                                                </div>
                                                <div class="popup-ui-dialog-buttonset flex items-center gap-3">
                                                    <button type="button" class="btn-cancel mse-secondary-button" data-id="<?php echo esc_attr($key);?>"><?php esc_html_e('Cancel', 'mystickyelements');?></button>
                                                    <button type="button" class="mystickyelement-delete-widget-btn mse-danger-button" data-id="<?php echo esc_attr($key); ?>" data-url="<?php echo admin_url("admin.php?page=my-sticky-elements"); ?>"><?php esc_html_e('Delete anyway', 'mystickyelements');?></button>
                                                </div>
                                            </div>
                                            <div id="mystickyelement-action-popup-overlay-<?php echo esc_attr($key);?>" class="stickyelement-overlay" style="display:none;" data-id="<?php echo esc_attr($key); ?>" data-from="widget-action"></div>

                                            <div class="mystickyelements-action-popup-open mystickyelements-action-popup-rename mystickyelements-action-popup-status" id="stickyelement-widget-rename-popup-<?php echo esc_attr($key); ?>" style="display:none;">
                                                <div class="popup-ui-widget-header">
                                                    <span id="ui-id-1" class="ui-dialog-title"><?php esc_html_e('Rename widget', 'mystickyelements')?></span>
                                                    <span class="close-dialog" data-id="<?php echo esc_attr($key); ?>" data-from='widget-rename'>&#10006</span>
                                                </div>
                                                <div id="widget-delete-confirm" class="ui-widget-content">
                                                    <input type="text" name="widget_rename" id="widget_rename_<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>" />
                                                </div>
                                                <div class="popup-ui-dialog-buttonset flex items-center gap-3">
                                                    <button type="button" class="mystickyelement-cancel-without-color-widget-btn mse-secondary-button" data-id="<?php echo esc_attr($key); ?>"><?php  esc_html_e('Cancel', 'mystickyelements');?></button>
                                                    <button type="button" class="mystickyelement-btn-rename mse-primary-button" data-id="<?php echo esc_attr($key);?>"><?php  esc_html_e('Rename', 'mystickyelements');?></button>
                                                </div>
                                            </div>
                                            <div id="mystickyelement-rename-popup-overlay-<?php echo esc_attr($key); ?>" class="stickyelement-overlay" style="display:none;" data-id="<?php echo esc_attr($key); ?>" data-from="widget-rename"></div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                global $wpdb;
                $table_name = $wpdb->prefix."mystickyelement_contact_lists";
                $result     = $wpdb->get_results("SELECT * FROM ".$table_name." ORDER BY ID DESC LIMIT 5");
                function dateDiffInDays($date1, $date2)
                {
                    $diff = (strtotime($date2) - strtotime($date1));
                    return abs(round($diff / 86400));

                }//end dateDiffInDays()


                function set_lead_message($message_date, $contact_name)
                {
                    $messageDate = date_format($message_date, "d-M-Y");
                    $messageTime = date_format($message_date, "h:i A");
                    $currentDate = date("d-M-Y");
                    $days        = dateDiffInDays($currentDate, $messageDate);

                    if (empty($contact_name)) {
                        $contact_name = esc_html__('Visitor', 'mystickyelements');
                    }

                    if ($days == 0) {
                        $message = "<p><span>".$contact_name."</span> has left message on today on ".$messageTime."</p>";
                    } elseif ($days == 1) {
                        $message = "<p><span>".$contact_name."</span> has left message on 1 day ago on ".$messageTime."</p>";
                    } elseif ($days == 2) {
                        $message = "<p><span>".$contact_name."</span> has left message on 2 days ago on ".$messageTime."</p>";
                    } elseif ($days == 3) {
                        $message = "<p><span>".$contact_name."</span> has left message on 3 days ago on ".$messageTime."</p>";
                    } elseif ($days == 4) {
                        $message = "<p><span>".$contact_name."</span> has left message on 4 days ago on ".$messageTime."</p>";
                    } elseif ($days == 5) {
                        $message = "<p><span>".$contact_name."</span> has left message on 5 days ago on ".$messageTime."</p>";
                    } elseif ($days == 6) {
                        $message = "<p><span>".$contact_name."</span> has left message on 6 days ago on ".$messageTime."</p>";
                    } elseif ($days == 7) {
                        $message = "<p><span>".$contact_name."</span> has left message on 7 days ago on ".$messageTime."</p>";
                    } elseif ($days == 8) {
                        $message = "<p><span>".$contact_name."</span> has left message on 8 days ago on ".$messageTime."</p>";
                    } elseif ($days == 9) {
                        $message = "<p><span>".$contact_name."</span> has left message on 9 days ago on ".$messageTime."</p>";
                    } elseif ($days == 10) {
                        $message = "<p><span>".$contact_name."</span> has left message on 10 days ago on ".$messageTime."</p>";
                    } else {
                        $message = "<p><span>".$contact_name."</span> has left message on ".$messageDate." on ".$messageTime."</p>";
                    }//end if



                    return $message;

                }//end set_lead_message()


?>
                <div class="mystickyelement-tab-boxes flex flex-col lg:flex-row">
                    <div class="mystickyelement-tab-box-documentation">
                        <div class="mystickyelement-tab-boxes-wrap">
                            <div class="mystickyelement-tab-box title-box flex gap-1.5 items-center text-base! text-grey-700!">
                                <i class="far fa-edit"></i><?php esc_html_e('Documentation', 'mystickyelements');?>
                            </div>
                            <div class="mystickyelement-tab-box-content p-5">
                                <ul class="documents-wrap-list">
                                    <li><a href="https://premio.io/help/mystickyelements/how-to-use-my-sticky-elements/" target="_blank"><?php esc_html_e('How to use MyStickyElements like a pro?', 'mystickyelements');?></a></li>
                                    <li><a href="https://premio.io/help/mystickyelements/how-to-use-my-sticky-elements/" target="_blank"><?php esc_html_e('How do I change or translate My Sticky Elements placeholders?', 'mystickyelements');?></a></li>
                                    <li><a href="https://premio.io/help/mystickyelements/how-to-use-my-sticky-elements/" target="_blank"><?php esc_html_e('How do I send my contact form leads to email?', 'mystickyelements');?></a></li>
                                    <li><a href="https://premio.io/help/mystickyelements/how-to-use-my-sticky-elements/" target="_blank"><?php esc_html_e('How do I create a custom link or JavaScript channel?', 'mystickyelements');?></a></li>
                                    <li><a href="https://premio.io/help/mystickyelements/how-to-use-my-sticky-elements/" target="_blank"><?php esc_html_e('How do I create a custom shortcode/HTML channel to your widget?', 'mystickyelements');?></a></li>
                                </ul>
                                <div class="mystickyelement-tab-boxes-btn-wrap">
                                    <a href="https://premio.io/help/mystickyelements/" target="_blank" class="mse-secondary-button small-button main-button">
                                        <?php esc_html_e('Explore all docs', 'mystickyelements');?>
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mystickyelement-tab-box-form-leads">
                        <div class="mystickyelement-tab-boxes-wrap">
                            <div class="mystickyelement-tab-box title-box flex gap-1.5 items-center text-base! text-grey-700!">
                                <i class="fas fa-history"></i><?php esc_html_e('Recent Form Leads', 'mystickyelements');?>
                            </div>
                            <?php
                            if (count($result) > 0) {
                                ?>
                                <div class="mystickyelement-tab-box-content p-5">
                                    <ul class="leads-wrap-list">
                                        <?php
                                        foreach ($result as $lead) {
                                            $messageDate  = date_create($lead->message_date);
                                            $contact_name = $lead->contact_name;
                                            $message      = set_lead_message($messageDate, $contact_name);
                                            echo "<li>".$message."</li>";
                                        }
                                        ?>
                                    </ul>
                                    <div class="mystickyelement-tab-boxes-btn-wrap">
                                        <a href="<?php echo admin_url('admin.php?page=my-sticky-elements-leads')?>" class="mse-secondary-button small-button main-button">
                                            <?php esc_html_e('View all leads', 'mystickyelements');?>
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="mystickyelement-tab-box-content mystickyelement-tab-box-content-empty-leads p-5">
                                    <img class="max-w-full mx-auto" src="<?php echo esc_url(MYSTICKYELEMENTS_URL) ?>/images/no_lead.svg" width="269" height="184"/>
                                    <p><strong><?php esc_html_e("You're all caught up.", "mystickyelements");?></strong><?php esc_html_e("When you receive a new lead, it'll show up here.", "mystickyelements");?></p>
                                </div>
                                <?php
                            }//end if
                            ?>
                        </div>
                    </div>
                    <div class="mystickyelement-tab-box-integration">
                        <div class="mystickyelement-tab-boxes-wrap">
                            <div class="mystickyelement-tab-box title-box flex gap-1.5 items-center text-base! text-grey-700!">
                                <i class="fas fa-link"></i><?php esc_html_e('Integration', 'mystickyelements');?>
                            </div>
                            <div class="mystickyelement-tab-box-content mystickyelement-tab-box-content-integration p-5 relative mse-pro-rules">
                                <div class="mystickyelement-tab-integration-row">
                                    <div class="mystickyelement-tab-integration-col integration-logo">
                                        <img src="<?php echo esc_url(MYSTICKYELEMENTS_URL) ?>/images/mailchimp.png" width="25px" height="25px">
                                    </div>
                                    <div class="mystickyelement-tab-integration-col-title flex-1">
                                        <h3><?php esc_html_e('Mailchimp', 'mystickyelements');?></h3>
                                        <p class="text-gray-500!"><?php esc_html_e('Sync your leads automatically to your Mailchimp list', 'mystickyelements'); ?></p>
                                    </div>
                                    <div class="mystickyelement-tab-integration-action">
                                        <a class="mse-secondary-button small-button main-button whitespace-nowrap" href="<?php echo esc_url($upgrade_url) ?>" target="_blank">
                                            <?php esc_html_e('Connect', 'mystickyelements'); ?>
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="mystickyelement-tab-integration-row">
                                    <div class="mystickyelement-tab-integration-col integration-logo">
                                        <img src="<?php echo esc_url(MYSTICKYELEMENTS_URL) ?>/images/mailpoet.png" width="25px" height="25px">
                                    </div>
                                    <div class="mystickyelement-tab-integration-col-title flex-1">
                                        <h3><?php esc_html_e('Mailpoet', 'mystickyelements');?></h3>
                                        <p class="text-gray-500!"><?php esc_html_e('Sync your leads automatically to your Mailpoet list', 'mystickyelements');?></p>
                                    </div>
                                    <div class="mystickyelement-tab-integration-action">
                                        <a class="mse-secondary-button small-button main-button whitespace-nowrap" href="<?php echo esc_url($upgrade_url) ?>" target="_blank">
                                            <?php esc_html_e('Connect', 'mystickyelements'); ?>
                                            <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="mse-pro-modal">
                                    <?php do_action('mse_pro_button') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="mystickyelement-tab-boxes flex flex-col lg:flex-row">
					<div class="mystickyelement-tab-box-Chatway ">
						<div class="mystickyelement-tab-boxes-wrap">
                            <div class="chatway-installed">
								<div class="mystickyelement-tab-box title-box Chatway-activate">
									<label><?php esc_html_e('Chatway', 'mystickyelements');?></label>

									<a href="<?php echo admin_url('admin.php?page=chatway')?>" target="_blank" class="mse-secondary-button small-button main-button">
                                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.3669 22.7087L9.00454 19.846L10.1913 21.7047C10.1913 21.7047 9.43739 21.5704 8.75067 21.8989C8.06394 22.2273 7.3669 22.7087 7.3669 22.7087Z" fill="#0038A5"/><path d="M6.19341 21.3436C6.06426 21.0492 5.7976 20.838 5.48147 20.7796L1.5873 20.0607C0.667542 19.8909 0 19.0888 0 18.1535V6.53588C0 5.10561 0.700916 3.76614 1.87601 2.95077L4.38973 1.20656C5.38282 0.517475 6.60698 0.246381 7.79816 0.451756L16.7802 2.00039C18.6407 2.32116 20 3.93487 20 5.82278V14.6237C20 15.6655 19.5809 16.6635 18.8372 17.393L15.6382 20.5305C14.4251 21.7202 12.6985 22.2263 11.0351 21.8798L9.17661 21.4926C8.84529 21.4235 8.50196 21.5322 8.27074 21.7794L7.48924 22.6146C7.25139 22.8689 6.83107 22.797 6.6912 22.4782L6.19341 21.3436Z" fill="#0446DE"/><path d="M4.26402 4.3534C2.31122 3.95658 0.484924 5.44908 0.484924 7.4418V17.3662C0.484924 18.3011 1.15191 19.1029 2.07118 19.2732L5.92902 19.9876C6.25151 20.0473 6.52196 20.266 6.64786 20.5688L6.99399 21.4014C7.09887 21.6537 7.4341 21.7046 7.60906 21.4947L8.27676 20.6939C8.47749 20.4531 8.78223 20.3242 9.0948 20.3479L12.1623 20.5803C13.71 20.6976 15.0304 19.4734 15.0304 17.9213V8.12613C15.0304 7.2039 14.3809 6.40923 13.4772 6.22558L4.26402 4.3534Z" fill="#0038A5"/><path d="M4.05471 4.34384C2.85779 4.11172 1.74609 5.02853 1.74609 6.24776V16.4525C1.74609 17.4163 2.45394 18.2339 3.40788 18.3719L6.05423 18.7546C6.37641 18.8012 6.6537 19.0064 6.79253 19.3008L7.1644 20.0896C7.26724 20.3424 7.60161 20.396 7.77835 20.188L8.3385 19.538C8.55472 19.2871 8.88406 19.1639 9.21187 19.2113L12.8133 19.7322C13.9827 19.9014 15.0303 18.9944 15.0303 17.8128V8.07175C15.0303 7.14301 14.3719 6.34464 13.4601 6.16783L4.05471 4.34384Z" fill="white"/><path d="M10.9095 14.5922L5.31137 13.6108C4.90406 13.5394 4.57266 13.8652 4.73023 14.2475C5.24204 15.4894 6.67158 17.4417 9.20419 16.7908C9.72572 16.6567 10.9053 15.9787 11.2377 15.0756C11.3207 14.85 11.1463 14.6337 10.9095 14.5922Z" fill="#0446DE"/><ellipse cx="5.50291" cy="9.96607" rx="0.992567" ry="1.70154" transform="rotate(-4.90348 5.50291 9.96607)" fill="#0446DE"/><ellipse cx="10.7489" cy="10.9349" rx="0.992567" ry="1.70154" transform="rotate(-4.90348 10.7489 10.9349)" fill="#0446DE"/></svg>
                                        <?php esc_html_e('Manage Live Chat', 'mystickyelements');?>
                                    </a>
								</div>
                            </div>
                            <div class="chatway-not-installed">
								<div class="mystickyelement-tab-box title-box flex gap-1.5 items-center text-base! text-grey-700!">
									<?php esc_html_e('Add Live Chat & AI Chatbot to Your Website', 'mystickyelements');?>
								</div>
								<div class="mystickyelement-tab-box-content p-5">
                                    <div class="text-sm"><?php esc_html_e('Use Chatway’s live chat and AI support agent to answer questions instantly, automate conversations, and support your visitors 24/7.', 'mystickyelements');?></div>
									<div class="mystickyelement-tab-boxes-btn-wrap">
										<a class="mse-secondary-button small-button main-button" href="<?php echo esc_url(admin_url('admin.php?page=my-sticky-elements-chatway-plugin'))?>" target="_blank" class="btn">
											<svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.3669 22.7087L9.00454 19.846L10.1913 21.7047C10.1913 21.7047 9.43739 21.5704 8.75067 21.8989C8.06394 22.2273 7.3669 22.7087 7.3669 22.7087Z" fill="#0038A5"/><path d="M6.19341 21.3436C6.06426 21.0492 5.7976 20.838 5.48147 20.7796L1.5873 20.0607C0.667542 19.8909 0 19.0888 0 18.1535V6.53588C0 5.10561 0.700916 3.76614 1.87601 2.95077L4.38973 1.20656C5.38282 0.517475 6.60698 0.246381 7.79816 0.451756L16.7802 2.00039C18.6407 2.32116 20 3.93487 20 5.82278V14.6237C20 15.6655 19.5809 16.6635 18.8372 17.393L15.6382 20.5305C14.4251 21.7202 12.6985 22.2263 11.0351 21.8798L9.17661 21.4926C8.84529 21.4235 8.50196 21.5322 8.27074 21.7794L7.48924 22.6146C7.25139 22.8689 6.83107 22.797 6.6912 22.4782L6.19341 21.3436Z" fill="#0446DE"/><path d="M4.26402 4.3534C2.31122 3.95658 0.484924 5.44908 0.484924 7.4418V17.3662C0.484924 18.3011 1.15191 19.1029 2.07118 19.2732L5.92902 19.9876C6.25151 20.0473 6.52196 20.266 6.64786 20.5688L6.99399 21.4014C7.09887 21.6537 7.4341 21.7046 7.60906 21.4947L8.27676 20.6939C8.47749 20.4531 8.78223 20.3242 9.0948 20.3479L12.1623 20.5803C13.71 20.6976 15.0304 19.4734 15.0304 17.9213V8.12613C15.0304 7.2039 14.3809 6.40923 13.4772 6.22558L4.26402 4.3534Z" fill="#0038A5"/><path d="M4.05471 4.34384C2.85779 4.11172 1.74609 5.02853 1.74609 6.24776V16.4525C1.74609 17.4163 2.45394 18.2339 3.40788 18.3719L6.05423 18.7546C6.37641 18.8012 6.6537 19.0064 6.79253 19.3008L7.1644 20.0896C7.26724 20.3424 7.60161 20.396 7.77835 20.188L8.3385 19.538C8.55472 19.2871 8.88406 19.1639 9.21187 19.2113L12.8133 19.7322C13.9827 19.9014 15.0303 18.9944 15.0303 17.8128V8.07175C15.0303 7.14301 14.3719 6.34464 13.4601 6.16783L4.05471 4.34384Z" fill="white"/><path d="M10.9095 14.5922L5.31137 13.6108C4.90406 13.5394 4.57266 13.8652 4.73023 14.2475C5.24204 15.4894 6.67158 17.4417 9.20419 16.7908C9.72572 16.6567 10.9053 15.9787 11.2377 15.0756C11.3207 14.85 11.1463 14.6337 10.9095 14.5922Z" fill="#0446DE"/><ellipse cx="5.50291" cy="9.96607" rx="0.992567" ry="1.70154" transform="rotate(-4.90348 5.50291 9.96607)" fill="#0446DE"/><ellipse cx="10.7489" cy="10.9349" rx="0.992567" ry="1.70154" transform="rotate(-4.90348 10.7489 10.9349)" fill="#0446DE"/></svg>
											<?php esc_html_e('Add A Live Chat Widget', 'mystickyelements');?>
										</a>
									</div>
								</div>
                            </div>
						</div>
					</div>
                    <div class="hidden md:inline-flex!"></div>
                    <div class="hidden md:inline-flex!"></div>
				</div>


            <?php else :?>
                <div class="mystickyelement-welcome-wrap">
                    <div class="mystickyelement-welcome-img">
                        <img src="<?php echo esc_url(MYSTICKYELEMENTS_URL) ?>/images/welcome_img.svg" width="438" height="317" alt="Welcome Image" />
                    </div>
                    <div class="mystickyelement-heading">
                        <h3><?php esc_html_e('Welcome to My Sticky Elements', 'mystickyelements'); ?> 🎉</h3>
                    </div>

                    <div class="mystickyelement-content">
                        <ul>
                            <li><?php esc_html_e('Add different elements like forms, chat icons, social media icon channels, custom fields, and combine them together into 1 element', 'mystickyelements'); ?></li>
                            <li><?php esc_html_e('Customize your form, chat, and social icons as you see fit', 'mystickyelements'); ?></li>
                            <li><?php esc_html_e('Configure triggers & targeting rules for the behavior of the widget. Explore advanced settings for fine tuning even the smallest detail', 'mystickyelements'); ?></li>

                            <li>Discover more on our <a href="https://premio.io/help/mystickyelements" target="_blank">Help Center</a> for video tutorials and documentation</li>
                        </ul>
                    </div>

                    <div class="create-mystickyelement mystickyelement-widgets-btn-wrap">
                        <a href="<?php echo admin_url('admin.php?page=my-sticky-elements&widget=0')?>" class="btn"><span><i class="fas fa-plus"></i></span> Create Your First Widget</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="mystickyelements-action-popup-open mystickyelements-action-popup-export mystickyelements-action-popup-blue ui-dialog" id="stickyelement-widget-export-popup" style="display:none;">
	<div class="popup-ui-widget-header">
		<h3 class="dialog-title"><?php esc_html_e('Widget Successfully Exported! 🎉', 'mystickyelements')?></h3>
		<span class="close-dialog">&#10006</span>
	</div>
	<div id="widget-export-confirm" class="ui-widget-content">
		<img src="<?php echo esc_url(MYSTICKYELEMENTS_URL) ?>/images/import-mse-widget.png">

		<p><?php printf(esc_html__('Use the %sImport Widget%s button on the left side of the Create a New Widget button to import a widget file.', 'mystickyelements'), '<strong>', '</strong>');?> </p>
	</div>
	<div class="popup-ui-dialog-buttonset">
		<button type="button" class="mystickyelement-btn-ok btn-close-dialog mse-primary-button"><?php  esc_html_e('Got it', 'mystickyelements');?></button>
	</div>
</div>
<div id="mystickyelement-export-popup-overlay" class="stickyelement-overlay" style="display:none;"></div>

<div class="mystickyelements-action-popup-open mystickyelements-action-popup-import mystickyelements-action-popup-blue ui-dialog" id="stickyelement-widget-import-popup" style="display:none;">
	<div class="popup-ui-widget-header">
		<span class="close-dialog">&#10006</span>
	</div>
	<form method="post" id="mse_import_widget_frm" enctype="multipart/form-data">
		<div id="widget-import-confirm" class="ui-widget-content">
			<div class="mystickyelements-upload-container" >
				<div id="mystickyelements-uploadfile" class="mystickyelements-upload-area mystickyelements-upload-area" >
					<div id="mystickyelements-upload-content" class="mystickyelements-upload-content">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17.3 10.1C17.3 7.60001 15.2 5.70001 12.5 5.70001C10.3 5.70001 8.4 7.10001 7.9 9.00001H7.7C5.7 9.00001 4 10.7 4 12.8C4 14.9 5.7 16.6 7.7 16.6H9.5V15.2H7.7C6.5 15.2 5.5 14.1 5.5 12.9C5.5 11.7 6.5 10.5 7.7 10.5H9L9.3 9.40001C9.7 8.10001 11 7.20001 12.5 7.20001C14.3 7.20001 15.8 8.50001 15.8 10.1V11.4L17.1 11.6C17.9 11.7 18.5 12.5 18.5 13.4C18.5 14.4 17.7 15.2 16.8 15.2H14.5V16.6H16.7C18.5 16.6 19.9 15.1 19.9 13.3C20 11.7 18.8 10.4 17.3 10.1Z M14.1245 14.2426L15.1852 13.182L12.0032 10L8.82007 13.1831L9.88072 14.2438L11.25 12.8745V18H12.75V12.8681L14.1245 14.2426Z" />
                        </svg>
                        <span>
                            <?php esc_html_e('Drag and Drop the JSON file', 'mystickyelements'); ?>
                        </span>
						<?php esc_html_e('Or', 'mystickyelements'); ?>
						<button type="button" id="select-file-button" class="mse-primary-button"><?php esc_html_e('Select File', 'mystickyelements'); ?></button>
					</div>
				</div>
                <input type="file" id="mse_import_widget" name="mse_import_widget" />
				<a class="a-link" href="https://premio.io/help/mystickyelements/how-to-import-export-widget" target="_blank">
                    <?php esc_html_e('Learn more about exporting widgets', 'mystickyelements');?>
                </a>
			</div>

		</div>

		<div id="widget-import-widget" class="ui-widget-content" style="display:none">
			<h4><?php esc_html_e('Widget name', 'mystickyelements');?></h4>
			<input type="text" id="mse_import_widget_name" name="mse_import_widget_name" placeholder="<?php esc_html_e('copy-of-widget-name', 'mystickyelements');?>"/>
			<p class="mse_import_success" style="display:none;"><?php esc_html_e('Import widget successfully.', 'mystickyelements');?></p>
		</div>

		<div id="widget-import-error" class="ui-widget-content" style="display:none">
			<p><?php  esc_html_e('⚠️ Invalid File', 'mystickyelements');?></p>
		</div>
	</form>
	<div class="popup-ui-dialog-buttonset">
		<button type="button" class="btn-close-dialog mse-secondary-button" data-id="<?php echo isset($key) ? esc_attr($key) : ''; ?>"><?php  esc_html_e('Cancel', 'mystickyelements');?></button>
		<button type="button" class="btn-blue mystickyelement-btn-import mse-primary-button"><?php  esc_html_e('Import', 'mystickyelements');?></button>
		<button type="button" class="btn-blue mystickyelement-btn-import-retry mse-primary-button" style="display:none;"><?php  esc_html_e('Retry', 'mystickyelements');?></button>
		<button type="button" class="btn-blue mystickyelement-btn-import-widget" style="display:none;"><?php  esc_html_e('Create New Widget', 'mystickyelements');?></button>
	</div>

</div>
<div id="mystickyelement-import-popup-overlay" class="stickyelement-overlay" style="display:none;"></div>
