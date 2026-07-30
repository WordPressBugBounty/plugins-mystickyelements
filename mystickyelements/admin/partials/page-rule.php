<?php
$url_options = array(
    'page_contains'   => esc_html__('Link that contain', "mystickyelements"),
    'page_has_url'    => esc_html__('A specific link', "mystickyelements"),
    'page_start_with' => esc_html__('Links starting with', "mystickyelements"),
    'page_end_with'   => esc_html__('Links ending with', "mystickyelements"),
    'wp_pages'        => esc_html__('WordPress Pages', "mystickyelements"),
    'wp_posts'        => esc_html__('WordPress Posts', "mystickyelements"),
    'wp_categories'   => esc_html__('WordPress Categories', "mystickyelements"),
    'wp_tags'         => esc_html__('WordPress Tags', "mystickyelements")
);
if (class_exists('WooCommerce')) {
    $url_options['wc_products'] = esc_html__('WooCommerce products', "mystickyelements");
    $url_options['wc_products_on_sale'] = esc_html__('WooCommerce products on sale', "mystickyelements");
}
?>
<div class="myStickyelements-page-option relative mse-pro-rules">
    <div class="url-content flex flex-col sm:flex-row gap-2.5 sm:items-center relative justify-between">
        <div class="flex flex-col xl:flex-row gap-2.5 xl:items-center flex-1">
            <div class="flex flex-col md:flex-row gap-2.5 md:items-center flex-1">
                <div class="myStickyelements-url-select flex-1">
                    <select name="general-settings[page_settings][<?php echo esc_attr($count); ?>][shown_on]" id="url_shown_on_<?php echo esc_attr($count)  ?>_option">
                        <option value="show_on" <?php echo esc_attr($option['shown_on'] == "show_on" ? "selected" : "") ?> ><?php esc_html_e('Show on', 'mystickyelements')?></option>
                        <option value="not_show_on" <?php echo esc_attr($option['shown_on'] == "not_show_on" ? "selected" : "") ?>><?php esc_html_e("Don't show on", "mystickyelements");?></option>
                    </select>
                </div>
                <div class="myStickyelements-url-option flex-1">
                <select class="myStickyelements-url-options" name="general-settings[page_settings][<?php echo esc_attr($count); ?>][option]" id="url_rules_<?php echo esc_attr($count) ?>_option">
                    <option disabled value=""><?php esc_html_e("Select Rule", "mystickyelements");?></option>
                    <?php foreach ($url_options as $key => $value) {
                        $selected = (isset($option['option']) && $option['option'] == $key) ? " selected='selected' " : "";
                        echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                    } ?>
                </select>
            </div>
            </div>
            <div class="myStickyelements-url-boxes flex flex-col flex-1 md:flex-row gap-2.5 md:items-center <?php echo esc_attr(empty($option['option']) || $option['option'] != "home" ? "active" : "") ?>">
                <div class="myStickyelements-url-box url-box flex-1 text-left md:text-right">
                    <span class='myStickyelements-url url-title <?php echo esc_attr(!in_array($option['option'], ["wp_pages", "wp_posts", "wp_categories", "wp_tags", "wc_products_on_sale", "wc_products"]) ? "active" : "") ?>'><?php echo esc_attr(site_url("/")); ?></span>
                    <span class='myStickyelements-wp_pages url-title <?php echo esc_attr($option['option'] == "wp_pages") ? "active" : "" ?>'><?php esc_html_e("Pages", 'mystickyelements'); ?></span>
                    <span class='myStickyelements-wp_posts url-title <?php echo esc_attr($option['option'] == "wp_posts") ? "active" : "" ?>'><?php esc_html_e("Posts", 'mystickyelements'); ?></span>
                    <span class='myStickyelements-wp_categories url-title <?php echo esc_attr($option['option'] == "wp_categories") ? "active" : "" ?>'><?php esc_html_e("Categories", 'mystickyelements'); ?></span>
                    <span class='myStickyelements-wp_tags url-title <?php echo esc_attr($option['option'] == "wp_tags") ? "active" : "" ?>'><?php esc_html_e("Tags", 'mystickyelements'); ?></span>
                    <span class='myStickyelements-wc_products url-title <?php echo esc_attr($option['option'] == "wc_products") ? "active" : "" ?>'><?php esc_html_e("Products", 'mystickyelements'); ?></span>
                    <span class='myStickyelements-wc_products_on_sale url-title <?php echo esc_attr($option['option'] == "wc_products_on_sale") ? "active" : "" ?>'><?php esc_html_e("Products", 'mystickyelements'); ?></span>
                </div>
                <div class="myStickyelements-url-values url-values flex-1">
                    <div class="url-setting-option url-default <?php echo esc_attr(!in_array($option['option'], ["wp_pages", "wp_posts", "wp_categories", "wp_tags", "wc_products_on_sale", "wc_products"]) ? "active" : "") ?>">
                        <input type="text" value="<?php echo esc_attr($option['value']) ?>" name="general-settings[page_settings][<?php echo esc_attr($count); ?>][value]" id="url_rules_<?php echo esc_attr($count); ?>_value" />
                    </div>
                    <div class="url-setting-option wp_pages-option <?php echo esc_attr($option['option'] == "wp_pages") ? "active" : "" ?>">
                        <?php
                        $page_ids = [];
if (isset($option['page_ids'])) {
    $page_ids = $option['page_ids'];
}?>
                        <select class="pages-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][page_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_page_ids">
                            <option value="all-data-items"><?php esc_html_e("All Pages", "mystickyelements") ?></option>
                            <?php foreach ($page_ids as $page_id) {
                                if ($page_id == "all-items") {?>
                                    <option value="all-items" selected><?php esc_html_e("All Pages", "mystickyelements"); ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo esc_attr($page_id) ?>" selected><?php echo get_the_title($page_id) ?></option>
                                <?php } ?>
                            <?php } ?> } ?>
                        </select>
                    </div>
                    <div class="url-setting-option wp_posts-option <?php echo esc_attr($option['option'] == "wp_posts") ? "active" : "" ?>">
                        <?php
                        $post_ids = [];
if (isset($option['post_ids'])) {
    $post_ids = $option['post_ids'];
}?>
                        <select class="posts-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][post_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_post_ids">
                            <?php foreach ($post_ids as $post_id) {
                                if ($post_id == "all-items") {?>
                                    <option value="all-items" selected><?php esc_html_e("All Posts", "mystickyelements"); ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo esc_attr($post_id) ?>" selected><?php echo get_the_title($post_id) ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="url-setting-option wp_categories-option <?php echo esc_attr($option['option']) == "wp_categories" ? "active" : "" ?>">
                        <?php
                        $category_ids = [];
                        if (isset($option['category_ids'])) {
                            $category_ids = $option['category_ids'];
                        } ?>
                        <select class="wp_categories-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][category_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_category_ids">
                            <?php foreach ($category_ids as $category_id) {
                                if ($category_id == "all-items") {?>
                                    <option value="all-items" selected><?php esc_html_e("All Categories", "mystickyelements"); ?></option>
                                <?php } else {
                                    $term_name = get_term($category_id)->name;
                                    if (!empty($term_name)) {?>
                                        <option value="<?php echo esc_attr($category_id) ?>" selected><?php echo esc_attr($term_name) ?></option>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="url-setting-option wp_tags-option <?php echo esc_attr($option['option'] == "wp_tags") ? "active" : "" ?>">
                        <?php
                        $tag_ids = [];
if (isset($option['tag_ids'])) {
    $tag_ids = $option['tag_ids'];
} ?>
                        <select class="wp_tags-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][tag_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_tag_ids">
                            <?php foreach ($tag_ids as $tag_id) {
                                if ($tag_id == "all-items") {?>
                                    <option value="all-items" selected><?php esc_html_e("All Tags", "mystickyelements"); ?></option>
                                <?php } else {
                                    $term_name = get_term($tag_id)->name;
                                    if (!empty($term_name)) {?>
                                        <option value="<?php echo esc_attr($tag_id) ?>" selected><?php echo esc_attr($term_name) ?></option>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <?php if (class_exists('WooCommerce')) { ?>
                        <div class="url-setting-option wc_products-option <?php echo esc_attr($option['option'] == "wc_products") ? "active" : "" ?>">
                            <?php
                            $products_ids = [];
                        if (isset($option['products_ids'])) {
                            $products_ids = $option['products_ids'];
                        } ?>
                            <select class="wc_products-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][products_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_products_ids">
                                <?php foreach ($products_ids as $products_id) {
                                    if ($products_id == "all-items") {?>
                                        <option value="all-items" selected><?php esc_html_e("All Products", "mystickyelements"); ?></option>
                                    <?php } else {
                                        if (get_the_title($products_id)) { ?>
                                            <option value="<?php echo esc_attr($products_id) ?>" selected><?php echo get_the_title($products_id) ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="url-setting-option wc_products_on_sale-option <?php echo esc_attr($option['option'] == "wc_products_on_sale") ? "active" : "" ?>">
                            <?php
                            $products_ids = [];
                        if (isset($option['wc_products_ids'])) {
                            $products_ids = $option['wc_products_ids'];
                        } ?>
                            <select class="wc_products_on_sale-options" multiple name="general-settings[page_settings][<?php echo esc_attr($count)  ?>][wc_products_ids][]" id="url_rules_<?php echo esc_attr($count)  ?>_wc_products_ids">
                                <?php foreach ($products_ids as $products_id) {
                                    if ($products_id == "all-items") {?>
                                        <option value="all-items" selected><?php esc_html_e("All Products", "mystickyelements"); ?></option>
                                    <?php } else {
                                        if (get_the_title($products_id)) { ?>
                                            <option value="<?php echo esc_attr($products_id) ?>" selected><?php echo get_the_title($products_id) ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </div><!-- -->
            </div>
        </div>
        <div class="myStickyelements-url-buttons flex-1 sm:flex-[0_0_40px]">
            <a class="myStickyelements-remove-rule" href="#">x</a>
        </div>
    </div>
    <div class="mse-pro-modal">
        <?php do_action('mse_pro_button') ?>
    </div>
</div>