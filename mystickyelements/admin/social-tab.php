<?php
$social_channel = (isset($_POST['social_channel'])) ? $_POST['social_channel'] : $key;

if ($social_channel != '') {
    $social_channels_tabs = get_option('mystickyelements-social-channels-tabs' . $element_widget_no, true);
    /* Return when Is Empty key found and isajax not set */
    if (isset($social_channels_tabs['is_empty']) && $social_channels_tabs['is_empty'] == 1 && !isset($_POST['is_ajax'])) {
        return;
    }
    $social_channel_value = (isset($social_channels_tabs[$key])) ? $social_channels_tabs[$key] : array();
    if (strpos($social_channel, 'custom_channel') !== false || strpos($social_channel, 'custom_shortcode') !== false) {
        $custom_channel_temp = '';
        if (strpos($social_channel, 'custom_channel') !== false) {
            $custom_channel_temp = $social_channel;
            $social_channel = 'custom_channel';
        }
        if (strpos($social_channel, 'custom_shortcode') !== false) {
            $custom_channel_temp = $social_channel;
            $social_channel = 'custom_shortcode';
        }

        $social_channels_lists = mystickyelements_custom_social_channels();
        $social_channels_list = $social_channels_lists[$social_channel];

        if (isset($social_channel_value['channel_type']) && $social_channel_value['channel_type'] != '' && $social_channel_value['channel_type'] != 'custom') {
            $custom_social_channels_lists = mystickyelements_social_channels();

            $social_channel_value['class'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['class'];
            $social_channels_list['class'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['class'];
            $social_channel_value['fontawesome_icon'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['class'];
            $social_channels_list['fontawesome_icon'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['class'];
            if (isset($custom_social_channels_lists[$social_channel_value['channel_type']]['custom_svg_icon'])) {
                $social_channel_value['custom_svg_icon'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['custom_svg_icon'];
                $social_channels_list['custom_svg_icon'] = $custom_social_channels_lists[$social_channel_value['channel_type']]['custom_svg_icon'];
            }
        }

        if ($custom_channel_temp != '') {
            $social_channel = $custom_channel_temp;
        }
        if (isset($_POST['channel_key']) && $_POST['channel_key'] != '') {
            $social_channel = $social_channel . '_' . $_POST['channel_key'];
        }
    } else {
        $social_channels_lists 	= mystickyelements_social_channels();
        $social_channels_list 	= (isset($social_channels_lists[$social_channel])) ? $social_channels_lists[$social_channel] : [];
        if (empty($social_channels_list)) {
            return;
        }
    }

    $social_channels_list['text'] = isset($social_channels_list['text']) ? $social_channels_list['text'] : "";
    $social_channels_list['icon_text'] = isset($social_channels_list['icon_text']) ? $social_channels_list['icon_text'] : "";
    $social_channels_list['icon_text_size'] = isset($social_channels_list['icon_text_size']) ? $social_channels_list['icon_text_size'] : "";
    $social_channels_list['background_color'] = isset($social_channels_list['background_color']) ? $social_channels_list['background_color'] : "";
    $social_channels_list['hover_text'] = isset($social_channels_list['hover_text']) ? $social_channels_list['hover_text'] : "";

    if (empty($social_channel_value)) {

        $social_channel_value['text'] = '';//$social_channels_list['text'];

        $social_channel_value['bg_color'] = $social_channels_list['background_color'];
        $social_channel_value['icon_text'] = $social_channels_list['icon_text'];
        $social_channel_value['icon_text_size'] = $social_channels_list['icon_text_size'];
        $social_channel_value['hover_text'] = $social_channels_list['hover_text'];
        $social_channel_value['desktop'] = 1;
        $social_channel_value['mobile'] = 1;
        $social_channel_value['icon_color'] = '';
    }

    if (!isset($social_channel_value['icon_text'])) {
        $social_channel_value['icon_text'] = '';
    }
    if (!isset($social_channel_value['icon_text_size'])) {
        $social_channel_value['icon_text_size'] = '';
    }
    if (!isset($social_channel_value['icon_color'])) {
        $social_channel_value['icon_color'] = '';
    }
    if (!isset($social_channel_value['pre_set_message'])) {
        $social_channel_value['pre_set_message'] = '';
    }

    if (isset($social_channels_list['custom']) && $social_channels_list['custom'] == 1 && isset($social_channel_value['fontawesome_icon']) && $social_channel_value['fontawesome_icon'] != '') {
        $social_channels_list['class'] = $social_channel_value['fontawesome_icon'];
    } else {
        $social_channel_value['fontawesome_icon'] = '';
    }


    if (!isset($social_channels_list['custom_icon']) && !isset($social_channel_value['custom_icon'])) {
        $social_channel_value['custom_icon'] = '';
    }

    if ($key == 'line') {
        echo "<style>.social-channels-item .social-channel-input-box-section .social-" . $key . " svg .fil1{ fill:" . $social_channel_value['icon_color'] . "}</style>";
    }
    if ($key == 'qzone') {
        echo "<style>.social-channels-item .social-channel-input-box-section .social-" . $key . " svg .fil2{ fill:" . $social_channel_value['icon_color'] . "}</style>";
    }

    $social_channel_value['text'] = str_replace('\"', '"', $social_channel_value['text']);
    $social_channel_value['channel_type'] = (isset($social_channel_value['channel_type'])) ? $social_channel_value['channel_type'] : '';
    $social_channel_value['open_new_tab'] = (isset($social_channel_value['open_new_tab'])) ? $social_channel_value['open_new_tab'] : '';
    $social_channel_value['use_whatsapp_web'] = (isset($social_channel_value['use_whatsapp_web'])) ? $social_channel_value['use_whatsapp_web'] : '';
    $social_channel_value['mobile'] = (isset($social_channel_value['mobile'])) ? $social_channel_value['mobile'] : '';
    $social_channel_value['desktop'] = (isset($social_channel_value['desktop'])) ? $social_channel_value['desktop'] : '';
    $channel_type = (isset($social_channel_value['channel_type'])) ? $social_channel_value['channel_type'] : '';
    $social_channel_value['icon_text_color'] = (isset($social_channel_value['icon_text_color'])) ? $social_channel_value['icon_text_color'] : '#ffffff';

    if ($channel_type != 'custom' && $channel_type != '') {
        if ($channel_type == 'whatsapp') {
            $social_channels_list['is_pre_set_message'] = 1;
        }
    }

    $channel_class	= (isset($social_channels_list['channel_class'])) ? $social_channels_list['channel_class'] : '';

    ?>
    <div id="social-channel-<?php echo esc_attr($social_channel); ?>" class="social-channels-item"
         data-slug="<?php echo esc_attr($social_channel); ?>">
        <div class="mystickyelements-move-handle"></div>
        <div class="social-channels-item-title social-channel-input-box-section flex gap-4 items-center">
            <label class="flex gap-2 items-center w-full">
							<span class="social-channels-list <?php echo esc_attr($channel_class);?> social-<?php echo esc_attr($social_channel); ?> social-<?php echo esc_attr($channel_type); ?>"
                                  style="background-color: <?php echo esc_attr($social_channel_value['bg_color']) ?>; color: <?php echo esc_attr($social_channel_value['icon_color']) ?>; position:relative;">
								<?php if (isset($social_channels_list['custom']) && $social_channels_list['custom'] == 1 && isset($social_channel_value['custom_icon']) && $social_channel_value['custom_icon'] != '' && isset($social_channel_value['fontawesome_icon']) && $social_channel_value['fontawesome_icon'] == ''): ?>
                                    <img class="<?php echo (isset($social_channel_value['stretch_custom_icon']) && $social_channel_value['stretch_custom_icon'] == 1) ? 'mystickyelements-stretch-custom-img' : ''; ?>" src="<?php echo esc_url($social_channel_value['custom_icon']); ?>" width="25" height="25"/>
                                <?php else:
                                    if (isset($social_channels_list['custom_svg_icon']) && $social_channels_list['custom_svg_icon'] != '') :
                                        echo $social_channels_list['custom_svg_icon'];  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    else:?>
                                        <i class="<?php echo esc_attr($social_channels_list['class']) ?>"></i>
                                    <?php endif;
                                endif; ?>
							</span>
                <span class="text-lg font-medium"><?php echo esc_html($social_channels_list['text'] . " Settings"); ?> </span>
            </label>
        </div>
        <div class="myStickyelements-setting-wrap-list input-link mse-field-wrap">
            <div class="mse-field-left">
                <label for="social_channel_<?php echo esc_attr($social_channel); ?>_icon_link" >
                    <?php if (isset($social_channels_list['icon_label']) && $social_channels_list['icon_label'] != "") {
                        echo esc_html($social_channels_list['icon_label'], 'mystickyelements');
                    } else {
                        esc_html_e('Icon Link', 'mystickyelements');
                    }
                    if (isset($social_channels_list['tooltip']) && $social_channels_list['tooltip'] != "") { ?>
                        <span class="social-tooltip">
                            <span>
                                <i class="fas fa-info"></i>
                                <span class="social-tooltip-popup">
                                    <?php echo wp_kses_post($social_channels_list['tooltip']); ?>
                                </span>
                            </span>
                        </span>
                    <?php } ?>
                </label>
            </div>
            <div class="px-wrap myStickyelements-inputs mse-field-right">
                <?php
                if (strpos($social_channel, 'custom_shortcode') !== false) { ?>
                    <textarea id="social_channel_<?php echo esc_attr($social_channel); ?>_icon_link"  class="mystickyelement-social-links-input <?php if (isset($social_channels_list['number_validation']) && $social_channels_list['number_validation'] == 1) : ?> mystickyelement-social-text-input<?php endif; ?>" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][text]" rows="3" cols="50" placeholder="<?php echo esc_attr($social_channels_list['placeholder']) ?>"><?php echo esc_attr(stripslashes($social_channel_value['text'])); ?></textarea>
                    <?php
                } else { ?>
                    <input type="text" class="mystickyelement-social-links-input <?php echo esc_attr($channel_type) ; ?><?php if (isset($social_channels_list['number_validation']) && $social_channels_list['number_validation'] == 1) : ?> mystickyelement-social-text-input<?php endif; ?>"
                           id="social_channel_<?php echo esc_attr($social_channel); ?>_icon_link" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][text]" value="<?php echo esc_attr(stripslashes($social_channel_value['text'])); ?>" placeholder="<?php echo esc_attr($social_channels_list['placeholder']) ?>"/>
                    <?php

                }
                ?>
            </div>
        </div>
        <div class="myStickyelements-setting-wrap-list device-option mse-field-wrap">
            <div class="mse-field-left">
                <label><?php esc_html_e('Devices', 'mystickyelements'); ?></label>
            </div>
            <div class="mse-field-right">
                <div class="flex w-full">
                    <ul class="flex w-full items-center gap-4">
                        <li>
                            <label>
                                <input type="checkbox" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][desktop]" data-social-channel-view="<?php echo esc_attr($social_channel); ?>" value="1" class="social-channel-view-desktop" id="social_channel_<?php echo esc_attr($social_channel); ?>_desktop" <?php checked(@$social_channel_value['desktop'], '1'); ?> />
                                <span class="inline-flex gap-1 items-center">
                                    <i class="fas fa-desktop"></i><?php esc_html_e('Desktop', 'mystickyelements'); ?>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][mobile]" data-social-channel-view="<?php echo esc_attr($social_channel); ?>" value="1" class="social-channel-view-mobile" id="social_channel_<?php echo esc_attr($social_channel); ?>_mobile" <?php checked(@$social_channel_value['mobile'], '1'); ?> />
                                <span class="inline-flex gap-1 items-center">
                                    <i class="fas fa-mobile-alt"></i><?php esc_html_e('Mobile', 'mystickyelements'); ?>
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (!isset($social_channels_list['icon_new_tab'])) : ?>
            <div class="myStickyelements-setting-wrap-list open-new-link-tab mse-field-wrap">
                <div class="mse-field-left">
                    <label for="social_channel_<?php echo esc_attr($social_channel); ?>_open_tab" ><?php esc_html_e('Open Link in a New Tab', 'mystickyelements'); ?></label>
                </div>
                <div class="mse-field-right">
                    <input type="checkbox" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][open_new_tab]" value="1" class="social-channel-view-desktop" id="social_channel_<?php echo esc_attr($social_channel); ?>_open_tab" <?php checked(@$social_channel_value['open_new_tab'], '1'); ?> />
                </div>
            </div>
        <?php endif; ?>
        <div class="mse-field-wrap myStickyelements-channel-view">
            <button type="button" class="social-setting" data-slug="<?php echo esc_html($social_channel); ?>">
                <span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.9332 9.99984C12.8444 10.2009 12.818 10.424 12.8572 10.6402C12.8964 10.8565 12.9995 11.056 13.1532 11.2132L13.1932 11.2532C13.3171 11.377 13.4155 11.5241 13.4826 11.6859C13.5497 11.8478 13.5842 12.0213 13.5842 12.1965C13.5842 12.3717 13.5497 12.5452 13.4826 12.7071C13.4155 12.869 13.3171 13.016 13.1932 13.1398C13.0693 13.2638 12.9223 13.3621 12.7604 13.4292C12.5986 13.4963 12.4251 13.5309 12.2498 13.5309C12.0746 13.5309 11.9011 13.4963 11.7392 13.4292C11.5774 13.3621 11.4303 13.2638 11.3065 13.1398L11.2665 13.0998C11.1094 12.9461 10.9098 12.843 10.6936 12.8038C10.4773 12.7646 10.2542 12.7911 10.0532 12.8798C9.85599 12.9643 9.68782 13.1047 9.56937 13.2835C9.45092 13.4624 9.38736 13.672 9.3865 13.8865V13.9998C9.3865 14.3535 9.24603 14.6926 8.99598 14.9426C8.74593 15.1927 8.40679 15.3332 8.05317 15.3332C7.69955 15.3332 7.36041 15.1927 7.11036 14.9426C6.86031 14.6926 6.71984 14.3535 6.71984 13.9998V13.9398C6.71467 13.7192 6.64325 13.5052 6.51484 13.3256C6.38644 13.1461 6.20699 13.0094 5.99984 12.9332C5.79876 12.8444 5.57571 12.818 5.35944 12.8572C5.14318 12.8964 4.94362 12.9995 4.7865 13.1532L4.7465 13.1932C4.62267 13.3171 4.47562 13.4155 4.31376 13.4826C4.15189 13.5497 3.97839 13.5842 3.80317 13.5842C3.62795 13.5842 3.45445 13.5497 3.29258 13.4826C3.13072 13.4155 2.98367 13.3171 2.85984 13.1932C2.73587 13.0693 2.63752 12.9223 2.57042 12.7604C2.50332 12.5986 2.46879 12.4251 2.46879 12.2498C2.46879 12.0746 2.50332 11.9011 2.57042 11.7392C2.63752 11.5774 2.73587 11.4303 2.85984 11.3065L2.89984 11.2665C3.05353 11.1094 3.15663 10.9098 3.19584 10.6936C3.23505 10.4773 3.20858 10.2542 3.11984 10.0532C3.03533 9.85599 2.89501 9.68782 2.71615 9.56937C2.53729 9.45092 2.32769 9.38736 2.11317 9.3865H1.99984C1.64622 9.3865 1.30708 9.24603 1.05703 8.99598C0.80698 8.74593 0.666504 8.40679 0.666504 8.05317C0.666504 7.69955 0.80698 7.36041 1.05703 7.11036C1.30708 6.86031 1.64622 6.71984 1.99984 6.71984H2.05984C2.2805 6.71467 2.49451 6.64325 2.67404 6.51484C2.85357 6.38644 2.99031 6.20699 3.0665 5.99984C3.15525 5.79876 3.18172 5.57571 3.14251 5.35944C3.10329 5.14318 3.00019 4.94362 2.8465 4.7865L2.8065 4.7465C2.68254 4.62267 2.58419 4.47562 2.51709 4.31376C2.44999 4.15189 2.41545 3.97839 2.41545 3.80317C2.41545 3.62795 2.44999 3.45445 2.51709 3.29258C2.58419 3.13072 2.68254 2.98367 2.8065 2.85984C2.93033 2.73587 3.07739 2.63752 3.23925 2.57042C3.40111 2.50332 3.57462 2.46879 3.74984 2.46879C3.92506 2.46879 4.09856 2.50332 4.26042 2.57042C4.42229 2.63752 4.56934 2.73587 4.69317 2.85984L4.73317 2.89984C4.89029 3.05353 5.08985 3.15663 5.30611 3.19584C5.52237 3.23505 5.74543 3.20858 5.9465 3.11984H5.99984C6.19702 3.03533 6.36518 2.89501 6.48363 2.71615C6.60208 2.53729 6.66565 2.32769 6.6665 2.11317V1.99984C6.6665 1.64622 6.80698 1.30708 7.05703 1.05703C7.30708 0.80698 7.64621 0.666504 7.99984 0.666504C8.35346 0.666504 8.6926 0.80698 8.94264 1.05703C9.19269 1.30708 9.33317 1.64622 9.33317 1.99984V2.05984C9.33402 2.27436 9.39759 2.48395 9.51604 2.66281C9.63449 2.84167 9.80266 2.98199 9.99984 3.0665C10.2009 3.15525 10.424 3.18172 10.6402 3.14251C10.8565 3.10329 11.056 3.00019 11.2132 2.8465L11.2532 2.8065C11.377 2.68254 11.5241 2.58419 11.6859 2.51709C11.8478 2.44999 12.0213 2.41545 12.1965 2.41545C12.3717 2.41545 12.5452 2.44999 12.7071 2.51709C12.869 2.58419 13.016 2.68254 13.1398 2.8065C13.2638 2.93033 13.3621 3.07739 13.4292 3.23925C13.4963 3.40111 13.5309 3.57462 13.5309 3.74984C13.5309 3.92506 13.4963 4.09856 13.4292 4.26042C13.3621 4.42229 13.2638 4.56934 13.1398 4.69317L13.0998 4.73317C12.9461 4.89029 12.843 5.08985 12.8038 5.30611C12.7646 5.52237 12.7911 5.74543 12.8798 5.9465V5.99984C12.9643 6.19702 13.1047 6.36518 13.2835 6.48363C13.4624 6.60208 13.672 6.66565 13.8865 6.6665H13.9998C14.3535 6.6665 14.6926 6.80698 14.9426 7.05703C15.1927 7.30708 15.3332 7.64621 15.3332 7.99984C15.3332 8.35346 15.1927 8.6926 14.9426 8.94264C14.6926 9.19269 14.3535 9.33317 13.9998 9.33317H13.9398C13.7253 9.33402 13.5157 9.39759 13.3369 9.51604C13.158 9.63449 13.0177 9.80266 12.9332 9.99984V9.99984Z" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <?php esc_html_e('Appearance Settings', 'mystickyelements'); ?>
            </button>
        </div>
        <div class="social-channel-setting" style="display:none;">
            <div class="mse-channel-setting">
                <div class="myStickyelements-custom-icon-image" <?php if (!isset($social_channels_list['custom']) || ($channel_type != '' && $channel_type != 'custom')) : ?>style="display:none;" <?php endif; ?>>
                    <div class="myStickyelements-custom-image-icon flex items-start gap-4 items-center">
                        <div class="myStickyelements-custom-image">
                            <input type="button" data-slug="<?php echo esc_attr($social_channel); ?>" class="mse-secondary-button social-custom-icon-upload-button small-button" value="<?php esc_html_e('Upload Custom Icon', 'mystickyelements'); ?>"/>

                            <div id="social-channel-<?php echo esc_attr($social_channel); ?>-icon" class="social-channel-icon" style="display:none; ">
                                <img src="<?php echo esc_url($social_channel_value['custom_icon']) ?>" id="social-channel-<?php echo esc_attr($social_channel); ?>-custom-icon-img" width="38" height="38"/>
                                <span class="social-channel-icon-close" data-slug="<?php echo esc_attr($social_channel); ?>">x</span>
                            </div>

                            <input type="hidden" id="social-channel-<?php echo esc_attr($social_channel); ?>-custom-icon" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][custom_icon]" value="<?php echo esc_url($social_channel_value['custom_icon']) ?>"/>
                            <div class="myStickyelements-setting-wrap-list myStickyelements-stretch-icon-wrap pt-2">
                                <label>
                                    <input type="checkbox" data-slug="<?php echo esc_attr($social_channel); ?>" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][stretch_custom_icon]" value="1" <?php checked(@$social_channel_value['stretch_custom_icon'], 1) ?> />&nbsp;<?php _e('Stretch custom icon', 'mystickyelements'); ?>
                                </label>
                            </div>
                        </div>
                        <div class="pt-6">Or</div>
                        <div class="myStickyelements-custom-icon">
                            <?php $fontawesome_icons = mystickyelements_fontawesome_icons(); ?>
                            <select id="mystickyelements-<?php echo esc_attr($social_channel); ?>-custom-icon" data-slug="<?php echo esc_attr($social_channel); ?>" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][fontawesome_icon]" class="social-channel-fontawesome-icon">
                                <option value=""><?php esc_html_e('Select FontAwesome Icon', 'mystickyelements'); ?></option>
                                <?php foreach ($fontawesome_icons as $icons): ?>
                                    <option value="<?php echo esc_attr($icons) ?>" <?php selected($social_channel_value['fontawesome_icon'], $icons) ?>><?php echo esc_html($icons); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="myStickyelements-setting-wrap-list mse-field-wrap" <?php if (!isset($social_channels_list['custom']) || (isset($social_channels_list['custom_html']))) : ?>style="display:none;" <?php endif; ?>>
                    <div class="mse-field-left">
                        <label for="social-channel-<?php echo esc_attr($social_channel); ?>_channel_type"><?php _e('Channel Type', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <select class="social-custom-channel-type" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][channel_type]" data-id="social-channel-<?php echo esc_attr($social_channel); ?>" id="social-channel-<?php echo esc_attr($social_channel); ?>_channel_type" data-slug="social-<?php echo esc_attr($social_channel); ?>">
                            <option value="custom" data-social-channel='<?php echo wp_json_encode($social_channels_list); ?>' <?php selected($social_channel_value['channel_type'], 'custom', true) ?>><?php _e('Custom channel', 'mystickyelements'); ?></option>
                            <?php foreach (mystickyelements_social_channels() as $csc_key => $csc_val):
                                if (isset($csc_val['custom']) && $csc_val['custom'] == 1) {
                                    continue;
                                }
                                unset($csc_val['tooltip']);
                                ?>
                                <option value="<?php echo esc_attr($csc_key); ?>" data-social-channel='<?php echo wp_json_encode($csc_val); ?>' <?php selected($social_channel_value['channel_type'], $csc_key, true) ?>><?php echo esc_html($csc_val['hover_text']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="myStickyelements-setting-wrap-list myStickyelements-background-color mse-field-wrap">
                    <div class="mse-field-left">
                        <label for="social-<?php echo esc_attr($social_channel); ?>-bg_color"><?php _e('Background Color', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <input type="text" data-slug="<?php echo esc_attr($social_channel); ?>" id="social-<?php echo esc_attr($social_channel); ?>-bg_color" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][bg_color]" class="mystickyelement-color" value="<?php echo esc_attr($social_channel_value['bg_color']); ?>"/>
                    </div>
                </div>
                <?php if (isset($social_channels_list['icon_color']) && $social_channels_list['icon_color'] == 1) : ?>
                    <div class="myStickyelements-setting-wrap-list myStickyelements-custom-icon-color mse-field-wrap">
                        <div class="mse-field-left">
                            <label for="social-<?php echo esc_attr($social_channel); ?>-icon_color"><?php _e('Icon Color', 'mystickyelements'); ?></label>
                        </div>
                        <div class="px-wrap myStickyelements-inputs mse-field-right">
                            <input type="text" data-soical-icon="<?php echo esc_attr($social_channel); ?>" id="social-<?php echo esc_attr($social_channel); ?>-icon_color" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][icon_color]" class="mystickyelement-color" value="<?php echo esc_attr($social_channel_value['icon_color']); ?>"/>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="myStickyelements-setting-wrap-list myStickyelements-custom-icon-text-color mse-field-wrap">
                    <div class="mse-field-left">
                        <label for="social-<?php echo esc_attr($social_channel); ?>-icon_text_color"><?php _e('Icon Text Color', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <input type="text" data-soical-text-color="<?php echo esc_attr($social_channel); ?>" id="social-<?php echo esc_attr($social_channel); ?>-icon_text_color" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][icon_text_color]" class="mystickyelement-color" value="<?php echo esc_attr($social_channel_value['icon_text_color']); ?>"/>
                    </div>
                </div>
                <div class="myStickyelements-setting-wrap-list mse-field-wrap">
                    <div class="mse-field-left">
                        <label for="social-<?php echo esc_attr($social_channel); ?>-icon_text"><?php _e('Icon Text', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <input type="text" class="myStickyelements-icon-text-input" id="social-<?php echo esc_attr($social_channel); ?>-icon_text" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][icon_text]" value="<?php echo esc_attr($social_channel_value['icon_text']); ?>" data-icontext="<?php echo esc_attr($social_channel); ?>" placeholder="<?php esc_html_e('Enter text here...', 'mystickyelements'); ?>"/>
                    </div>
                </div>

                <div class="myStickyelements-setting-wrap-list mse-field-wrap">
                    <div class="mse-field-left">
                        <label for="social-<?php echo esc_attr($social_channel); ?>-icon_text_size"><?php _e('Icon Text Size', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <input type="number" class="myStickyelements-icon-text-size" id="social-<?php echo esc_attr($social_channel); ?>-icon_text_size" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][icon_text_size]" value="<?php echo esc_attr($social_channel_value['icon_text_size']); ?>" min="0" data-icontextsize="<?php echo esc_attr($social_channel); ?>" placeholder="<?php esc_html_e('Enter font size here...', 'mystickyelements'); ?>"/>
                        <span class="input-px">PX</span>
                    </div>
                </div>
                <div class="myStickyelements-setting-wrap-list myStickyelements-on-hover-text mse-field-wrap">
                    <div class="mse-field-left">
                        <label for="social_channel_<?php echo esc_attr($social_channel); ?>_hover_text"><?php _e('Flyout Text', 'mystickyelements'); ?></label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <input type="text" id="social_channel_<?php echo esc_attr($social_channel); ?>_hover_text" class="social_channels_hover_text" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][hover_text]" value="<?php echo esc_attr($social_channel_value['hover_text']); ?>" data-icontext="<?php echo esc_attr($social_channel); ?>" placeholder="<?php esc_html_e('Enter text here...', 'mystickyelements'); ?>"/>
                    </div>
                </div>

                <div class="myStickyelements-setting-wrap-list myStickyelements-custom-pre-message mse-field-wrap"
                     <?php if (!isset($social_channels_list['is_pre_set_message'])) : ?>style="display:none;" <?php endif; ?>>
                    <div class="mse-field-left">
                        <label for="social_channel_<?php echo esc_attr($social_channel); ?>_pre_set_message">
                            <?php _e('Pre Set Message', 'mystickyelements'); ?>
                            <div class="mystickyelements-custom-fields-tooltip myStickyelements-country-tooltip">
                                <a href="#" class="mystickyelements-tooltip mystickyelements-new-custom-btn"><i class="fas fa-info"></i></a>
                                <p><?php esc_html_e('Add your own pre-set message that\'s automatically added to the user\'s message. You can also use merge tags and add the URL or the title of the current visitor\'s page. E.g. you can add the current URL of a product to the message so you know which product the visitor is talking about when the visitor messages you', 'mystickyelements'); ?></p>
                            </div>
                        </label>
                    </div>
                    <div class="px-wrap myStickyelements-inputs mse-field-right">
                        <div class="relative">
                            <input type="text" id="social_channel_<?php echo esc_attr($social_channel); ?>_pre_set_message" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][pre_set_message]" value="" placeholder="<?php esc_html_e('Enter message here...', 'mystickyelements'); ?>" disabled/>
                            <div class="absolute right-0 top-0 h-full flex items-center px-2">
                                <?php do_action('mse_inline_pro_button'); ?>
                            </div>
                        </div>
                        <span class="supported-tags mt-2 text-cht-gray-150">
                        <label class="social-custom-tooltip social-tooltip ">
                            <span class="mysticky-social-whatsapp-tags" data-tag="{title}">{title}<span class="social-tooltip-popup">
                                    <?php esc_html_e('{title} tag grabs the page title of the webpage', 'mystickyelements');?></span>
                            </span>
                        </label>
                         and
                            <label class="social-custom-tooltip social-tooltip ">
                                <span class="mysticky-social-whatsapp-tags" data-tag="{url}">{url}<span class="social-tooltip-popup">
                                        <?php esc_html_e('{url} tag grabs the URL of the webpage', 'mystickyelements');?></span>
                                </span>
                            </label>
                            tags are supported
                        </span>
                    </div>
                </div>
                <div class="myStickyelements-setting-wrap-list mse-field-wrap myStickyelements-use-whatsapp-web" <?php if (!isset($social_channels_list['use_whatsapp_web'])) : ?>style="display:none;" <?php endif; ?>>
                    <div class="px-wrap myStickyelements-inputs mse-field-right flex items-center">
                        <label for="social_channel_<?php echo esc_attr($social_channel); ?>_use_whatsapp_web">
                            <?php _e('Use WhatsApp Web directly on desktop', 'mystickyelements'); ?>
                            <span class="social-tooltip">
                                <span>
                                    <i class="fas fa-info"></i>
                                    <span class="social-tooltip-popup"><?php esc_html_e('Automatically send desktop visitors to WhatsApp Web by turning on the feature', 'mystickyelements');?></span>
                                </span>
                            </span>
                        </label>
                        <input type="checkbox" name="social-channels-tab[<?php echo esc_attr($social_channel); ?>][use_whatsapp_web]" value="1" class="social-channel-view-desktop" id="social_channel_<?php echo esc_attr($social_channel); ?>_use_whatsapp_web" <?php checked(@$social_channel_value['use_whatsapp_web'], '1'); ?> />
                    </div>
                </div>
            </div>
        </div>
        <div class="close-tooltip">
            <svg class="social-channel-close" data-slug="<?php echo esc_attr($social_channel); ?>" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="12" fill="#FDF2F2"/>
                <path d="M6.66666 8.66667H17.3333M16.6667 8.66667L16.0887 16.7613C16.0647 17.0977 15.9142 17.4125 15.6674 17.6424C15.4206 17.8722 15.0959 18 14.7587 18H9.24132C8.90408 18 8.57937 17.8722 8.33258 17.6424C8.08579 17.4125 7.93527 17.0977 7.91132 16.7613L7.33332 8.66667H16.6667ZM10.6667 11.3333V15.3333V11.3333ZM13.3333 11.3333V15.3333V11.3333ZM14 8.66667V6.66667C14 6.48986 13.9298 6.32029 13.8047 6.19526C13.6797 6.07024 13.5101 6 13.3333 6H10.6667C10.4898 6 10.3203 6.07024 10.1953 6.19526C10.0702 6.32029 9.99999 6.48986 9.99999 6.66667V8.66667H14Z" stroke="#C81E1E" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            <div class="tooltiptext">
                <a href="#" data-slug="<?php echo esc_attr($social_channel); ?>"><?php esc_html_e('Remove channel', 'mystickyelements'); ?></a>
            </div>
        </div>
    </div>
    <!-- end social channel tabs-->
    <?php

}
if (isset($_POST['is_ajax']) && $_POST['is_ajax'] == true) {
    wp_die();
}