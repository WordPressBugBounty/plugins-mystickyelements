<?php
$mystickyelement_class =  (isset($_GET['page']) && $_GET['page'] == 'my-sticky-elements-settings' && !isset($_GET['widget'])) ? 'mystickyelement-wrap-default' : '' ;
$mystickyelement_class .= is_plugin_active('chatway-live-chat/chatway.php') ? ' has-chatway-chat' : '';
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
<form class="mystickyelements-form" method="post" action="#">
    <div class="mse-header flex gap-2 sm:gap-4 justify-between py-2 px-3 sm:px-5">
        <div class="mse-menu flex-1 flex gap-3 items-center justify-center">
            <div class="mse-tab-menu">
                <ul>
                    <li class="mse-tab-form mse-tab-1" data-tab="<?php esc_html_e('Contact Form', 'mystickyelements'); ?>">
                        <a class="active" href="#mystickyelements-tab-contact-form" data-step="1">
                            <span class="mse-tabs-subheading"><?php esc_html_e('1. Contact Form', 'mystickyelements'); ?></span>
                        </a>
                    </li>
                    <li class="mse-tab-channels mse-tab-2" data-tab="<?php esc_html_e('Select Channels', 'mystickyelements'); ?>">
                        <a href="#mystickyelements-tab-social-media" data-step="2">
                            <span class="mse-tabs-subheading"><?php esc_html_e('2. Select Channels', 'mystickyelements'); ?></span>
                        </a>
                    </li>
                    <li class="mse-tab-triggers mse-tab-3" data-tab="<?php  esc_html_e('Triggers and Targeting', 'mystickyelements'); ?>">
                        <a href="#mystickyelements-tab-display-settings" data-step="3">
                            <span class="mse-tabs-subheading"><?php  esc_html_e('3. Triggers and Targeting', 'mystickyelements'); ?></span>
                        </a>
                    </li>
                    <li class="mse-tab-4" data-tab="<?php esc_html_e('Add Live Chat', 'mystickyelements'); ?>">
                        <a href="#mystickyelements-tab-live-chatway" data-step="4">
                            <span class="mse-tabs-subheading"><?php esc_html_e('4. Add Live Chat', 'mystickyelements'); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mse-steps">
                <div class="progress-stat">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="whirlPath">
                        <circle cx="50" cy="50" r="46.5" stroke-linecap="round" fill="none" stroke-width="4.5"></circle>
                    </svg>
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="svg-progress">
                        <circle class="hidden" cx="50" cy="50" r="46.5" stroke-linecap="round" fill="none" stroke-width="4.5" id="step-progress" style="stroke-dashoffset: 0;"></circle>
                    </svg>
                    <span class="current-step" id="current-step">1/4</span>
                </div>
                <div class="process-step" id="process-step"><?php esc_html_e('Contact Form', 'mystickyelements'); ?></div>
            </div>
        </div>
        <div class="mse-actions flex gap-3 justify-between items-center">
            <div class="inline-flex gap-3 justify-between items-center">
                <button class="mse-prev-button" type="button" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M15.8333 10H4.16668" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10 15.8333L4.16668 9.99996L10 4.16663" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span>
                        <?php esc_html_e('Back', 'mystickyelements'); ?>
                    </span>
                </button>
                <button class="mse-next-button" type="button">
                    <span>
                        <?php esc_html_e('Next', 'mystickyelements'); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4.16677 10H15.8334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.0001 4.16663L15.8334 9.99996L10.0001 15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
            <div class="inline-flex gap-3 justify-between items-center gap-px">
                <button class="mse-save-button rounded-l-lg" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H13.3333L17.5 6.66667V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M14.1666 17.5V10.8334H5.83331V17.5" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M5.83331 2.5V6.66667H12.5" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="main-title">
                        <?php esc_html_e('Save Widget', 'mystickyelements'); ?>
                    </span>
                    <span class="short-title">
                        <?php esc_html_e('Save', 'mystickyelements'); ?>
                    </span>
                </button>
                <div class="relative more-form-buttons">
                    <button class="mse-option-button rounded-r-lg p-2! h-10.5" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <input type="submit" value="<?php esc_html_e('Save & View Dashboard', 'mystickyelements'); ?>" name="save_and_view_dashboard" class="mse-save-dashboard-button rounded-lg hidden">
                </div>
            </div>
        </div>
    </div>
    <h2 class="mystickyelement-empty-h2" style="font-size: 0px;margin-bottom: 0px;"></h2>
    <div class="wrap mse-wrap mystickyelement-wrap mystickyelements-pro-plugin-wrap <?php echo esc_attr($mystickyelement_class); ?>">
        <div class="mystickyelements-wrap my-5">
            <div class="mystickyelements-tabs-wrap mystickyelements-common-form-section flex flex-col lg:flex-row gap-5 border border-[#e5e7eb] rounded-lg bg-white">
                <div class="flex-1">
                    <?php
                    include('contact-forms.php');
                    include('social-media.php');
                    include('general-settings.php');
                    include('chatway.php');
                    ?>
			    </div>
                <div class="mse-preview-section flex-1 lg:flex-[0_0_400px]">
                    <?php include('sticktelements-preview.php'); ?>
                </div>
			</div>
			<input type="hidden" id="mystickyelement_save_confirm_status" name="mystickyelement_save_confirm_status" value=""/>
			<?php wp_nonce_field('mystickyelement-submit', 'mystickyelement-submit'); ?>
        </div>
    </div>

    <div class="mystickyelements-action-popup-open  mystickyelements-action-popup-status" id="mystickyelements-load-google-enable-popup" style="display:none;">
        <div class="popup-ui-widget-header">
            <span id="ui-id-1" class="ui-dialog-title"><?php esc_html_e("Are you sure?", 'mystickyelements')?></span>
        </div>
        <div id="widget-delete-confirm" class="ui-widget-content">
            <p><?php _e("You're about to turn off loading Google fonts from Google server. By turning it off, fonts will not be loaded by default and you have to manually load them to use properly. Are you sure?", 'mystickyelements');?></p>
        </div>

        <div class="popup-ui-dialog-buttonset flex justify-end gap-4">
            <button type="button" class="mystickyelement-cancel-widget-btn mse-secondary-button" id="mystickyelement-disable-loadfonts"  data-popupfrom="">
                <?php esc_html_e("Disable anyway", 'mystickyelements');?>
            </button>
            <button type="button" class="mystickyelement-btn-orange mystickyelement-btn-ok mse-primary-button" id="mystickyelement-button-keep-loadfonts">
                <?php esc_html_e('Keep using', 'mystickyelements');?>
            </button>
        </div>
    </div>
    <div id="mystickyelement-load-google-popup-overlay" class="stickyelement-overlay" style="display:none;"></div>
    <div class="mystickyelements-action-popup-open mystickyelements-missing-link-popup mystickyelements-action-popup-status" id="mystickyelements-missing-link-popup" style="display:none;">

        <div class="popup-ui-widget-header">
            <span id="ui-id-1" class="ui-dialog-title"><?php esc_html_e('Missing link', 'mystickyelements')?></span>
            <span class="close-dialog" data-id="0" data-from='widget-social-link'>&#10006</span>
        </div>
        <div id="widget-delete-confirm" class="ui-widget-content">
            <p>Please fill out the link information for all the selected channels</p>
        </div>

        <div class="popup-ui-dialog-buttonset flex items-center gap-3">
            <button type="button" class="mystickyelement-cancel-widget-btn mse-do-later-widget-btn mse-secondary-button"  data-popupfrom="">
                <?php esc_html_e("I'll do it later", 'mystickyelements');?>
            </button>
            <button type="button" class="mystickyelement-btn-orange mse-widget-btn-ok mse-primary-button" id="mystickyelement-button-ok">
                <?php esc_html_e('Ok', 'mystickyelements');?>
            </button>
        </div>
    </div>
    <div id="mystickyelement-missing-link-overlay" class="stickyelement-overlay" style="display:none;"></div>
</form>