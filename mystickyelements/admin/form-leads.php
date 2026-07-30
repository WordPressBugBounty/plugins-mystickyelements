<?php
global $wpdb;
$where_search = '';
$table_name = $wpdb->prefix . "mystickyelement_contact_lists";
$whereCond = [];
$elements_widgets = get_option( 'mystickyelements-widgets' );
if (isset($_POST['stickyelement-contatc-submit']) && !wp_verify_nonce($_POST['stickyelement-contatc-submit'], 'stickyelement-contatc-submit')) {

    echo '<div class="error settings-error notice is-dismissible "><p><strong>' . esc_html__('Unable to complete your request', 'mystickyelements') . '</p></strong></div>';

} elseif (isset($_POST['stickyelement-contatc-submit']) && wp_verify_nonce($_POST['stickyelement-contatc-submit'], 'stickyelement-contatc-submit')) {
    if (isset($_POST['delete_message']) && !empty($_POST['delete_message']) && !wp_doing_ajax()) {

        $count = count($_POST['delete_message']);
        foreach ($_POST['delete_message'] as $key => $ID) {
            if (is_int($ID)) {
                $ID = sanitize_text_field($ID);
                $query = "DELETE FROM {$table_name} WHERE ID = %d";
                $query = $wpdb->prepare($query, $ID);
                //$wpdb->query($query);

                $wpdb->delete($table_name, array( 'ID' => sanitize_text_field($ID) ), array( '%d' ));
            }
        }
        echo '<div class="updated settings-error notice is-dismissible "><p><strong>' . esc_html__($count . ' message deleted.', 'mystickyelements'). '</p></strong></div>';

    }
}
$elements_widgets = get_option('mystickyelements-widgets');
$custom_fields = array();
if (!empty($elements_widgets)) {
    foreach ($elements_widgets as $key => $value) {
        $widget_no = '-' . $key;
        if ($key == 0) {
            $widget_no = '';
        }
        $contact_form = get_option('mystickyelements-contact-form' . $widget_no);

        if (!empty($contact_form['custom_fields'])) {
            foreach ($contact_form['custom_fields'] as $value) {
                $custom_fields[] = $value['custom_field_name'];
            }
        }
    }
}
if (isset($_REQUEST['search-contact']) && $_REQUEST['search-contact'] != '') {
    $searchContent = sanitize_text_field($_REQUEST['search-contact']);
    $where_search  = "WHERE contact_name LIKE %s OR contact_email LIKE %s OR contact_phone LIKE %s OR contact_message LIKE %s";
    $whereCond     = [
        '%' . $wpdb->esc_like($searchContent) . '%',
        '%' . $wpdb->esc_like($searchContent) . '%',
        '%' . $wpdb->esc_like($searchContent) . '%',
        '%' . $wpdb->esc_like($searchContent) . '%'
    ];
}
$customPagHTML = "";
$items_per_page = 10;
$page = (isset($_GET['cpage'])) ? abs((int)$_GET['cpage']) : 1;
$offset = ($page * $items_per_page) - $items_per_page;

$chatway_action = isset($_GET['mse_action']) ? sanitize_text_field($_GET['mse_action']) : null;
$nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : null;
if (!empty($whereCond)) {
    // Rebuild the query strings with placeholders to ensure correct parameter binding for both search filters and pagination.
    $total_query = "SELECT count(*) FROM {$table_name} WHERE contact_name LIKE %s OR contact_email LIKE %s OR contact_phone LIKE %s OR contact_message LIKE %s ORDER BY ID DESC";
    $total_query = $wpdb->prepare($total_query, $whereCond);

    $whereCond[] = $offset;
    $whereCond[] = $items_per_page;
    $query = "SELECT * FROM {$table_name} WHERE contact_name LIKE %s OR contact_email LIKE %s OR contact_phone LIKE %s OR contact_message LIKE %s ORDER BY ID DESC LIMIT %d, %d";
    $query = $wpdb->prepare($query, $whereCond);

} else {
    $total_query = "SELECT count(*) FROM {$table_name} ORDER BY ID DESC";
    $whereCond = [$offset, $items_per_page];
    $query = "SELECT * FROM {$table_name} ORDER BY ID DESC LIMIT %d, %d";
    $query = $wpdb->prepare($query, $whereCond);
}

$total      = $wpdb->get_var($total_query);
$result     = $wpdb->get_results($query);
$total_page = ceil($total / $items_per_page);
$start_from         = $offset + 1;
$to                 = $offset + min($items_per_page, count($result));
?>
<div class="wrap mse-wrap mystickyelement-wrap px-5">
    <div class="mystickyelement-dashboard">
        <div class="flex items-center justify-between h-full gap-8">
            <div class="heading-title flex flex-col gap-1 text-[#1d2327]">
                <div class="text-gray-700 text-3xl font-semibold"><?php esc_html_e('Contact Form Leads', 'mystickyelements'); ?></div>
                <?php if (count($result) > 0) { ?>
                    <div class="text-sm text-[#1d2327]"><?php esc_html_e('View and export all leads collected through your sticky elements.', 'mystickyelements') ?></div>
                <?php } ?>
            </div>
            <div>
                <?php if (count($result) > 0) { ?>
                    <a href="<?php echo admin_url("admin.php?page=my-sticky-elements-leads&mse_action=download_csv_file&nonce=".wp_create_nonce('stickyelement-download-csv-file')); ?>" class="mse-primary-button" id="wpappp_export_to_csv" value="Export to CSV">
                        <?php esc_html_e('Export CSV', 'mystickyelements'); ?>
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php if (count($result) > 0 || !empty($where_search)) { ?>
            <input type="hidden" id="delete_nonce" name="delete_nonce" value="<?php echo wp_create_nonce("mysticky_elements_delete_nonce") ?>"/>
            <div class="border border-[#F1F1F1] rounded-lg mse-shadow mse-form-leads mt-5">
                <div class="p-4 flex flex-col md:flex-row md:justify-between md:items-center">
                    <div>
                        <?php if (count($result) > 0) { ?>
                            <form action="<?php echo admin_url("admin.php?page=my-sticky-elements-leads"); ?>" method="post">
                                <div class="actions bulkactions">
                                    <input type="submit" id="doaction" class="delete-button bg-red-100 border rounded-md text-[#c10007] border-red-[#c10007] cursor-pointer px-3 py-1.5" value="<?php esc_attr_e('Delete', 'mystickyelements'); ?>">
                                    <?php wp_nonce_field('stickyelement-contatc-submit', 'stickyelement-contatc-submit'); ?>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                    <div>
                        <form action="<?php echo admin_url("admin.php?page=my-sticky-elements-leads"); ?>" method='get'>
                            <input type="hidden" name="page" value='my-sticky-elements-leads'/>
                            <div class="search-box relative">
                                <label class="screen-reader-text" for="post-search-input"><?php esc_html_e('Search', 'mystickyelements');?></label>
                                <input type="search" id="post-search-input" class="search-input" name="search-contact" value="<?php echo (isset($_GET['search-contact']) && $_GET['search-contact'] != '') ? esc_attr($_GET['search-contact']) : ''; ?>" placeholder="Search by name, email, phone, widget name">
                                <button type="submit" class="mse-search-button">
                                    <span class="sr-only"><?php esc_html_e('Search', 'mystickyelements'); ?></span>
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.833 15.834L12.208 12.209M14.1663 7.50065C14.1663 11.1825 11.1816 14.1673 7.49967 14.1673C3.81778 14.1673 0.833008 11.1825 0.833008 7.50065C0.833008 3.81875 3.81778 0.833984 7.49967 0.833984C11.1816 0.833984 14.1663 3.81875 14.1663 7.50065Z" stroke="#717680" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if ($result) { ?>
                    <table border="1" class="mse-table">
                        <tr>
                            <th class="text-center"><?php esc_html_e('Bulk', 'mystickyelements'); ?></th>
                            <th class="text-left"><?php esc_html_e('Widget Name', 'mystickyelements'); ?></th>
                            <th class="text-left"><?php esc_html_e('Contact', 'mystickyelements'); ?></th>
                            <th class="text-left"><?php esc_html_e('Message', 'mystickyelements'); ?></th>
                            <th class="text-left"><?php esc_html_e('Date', 'mystickyelements'); ?></th>
                            <th><?php esc_html_e('URL', 'mystickyelements'); ?></th>
                            <th style="width:11%"><?php esc_html_e('Delete', 'mystickyelements'); ?></th>
                        </tr>
                        <?php
                        foreach ($result as $res) {
                            error_log(print_r($res, true));
                            $widget_name = isset($res->widget_element_name) && !empty($res->widget_element_name) ? $res->widget_element_name : esc_attr((isset($elements_widgets[0])) ? $elements_widgets[0] : 'MyStickyElements #1');
                            ?>
                            <tr>
                                <td class="text-center"><input id="cb-select-80" class="cb-select-blk" type="checkbox" name="delete_message[]" value="<?php echo esc_attr($res->ID); ?>"></td>
                                <td><?php echo esc_attr($widget_name); ?></td>
                                <td>
                                    <ul>
                                        <?php if (!empty($res->contact_name)) { ?>
                                            <li><b><?php esc_html_e('Name: ', 'mystickyelements'); ?></b><?php echo esc_html($res->contact_name); ?></li>
                                        <?php } ?>
                                        <?php if (!empty($res->contact_phone)) {?>
                                            <li><b><?php esc_html_e('Phone: ', 'mystickyelements'); ?></b><?php echo esc_html($res->contact_phone); ?></li>
                                        <?php } ?>
                                        <?php if (!empty($res->contact_email)) {?>
                                            <li><b><?php esc_html_e('Email: ', 'mystickyelements'); ?></b><?php echo esc_html($res->contact_email); ?></li>
                                        <?php } ?>
                                        <?php if (!empty($res->ip_address)) {?>
                                            <li><b><?php esc_html_e('IP Address: ', 'mystickyelements'); ?></b><?php echo esc_html($res->ip_address); ?></li>
                                        <?php } ?>
                                        <?php if (!empty($res->contact_option)) {?>
                                            <li><b><?php esc_html_e('Dropdown: ', 'mystickyelements'); ?></b><?php echo esc_html($res->contact_option); ?></li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <td><?php echo wpautop($res->contact_message); ?></td>
                                <td><?php echo (isset($res->message_date)) ? $res->message_date : '-'; ?></td>
                                <td>
                                    <?php if ($res->page_link) : ?>
                                        <a href="<?php echo esc_url($res->page_link); ?>" target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center mse-action-buttons">
                                    <button type="button" data-delete="<?php echo esc_attr($res->ID); ?>" class="mse-delete-entry">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" svg-inline="" role="presentation" focusable="false" tabindex="-1"><path d="M2 4h12M5.333 4V2.667a1.333 1.333 0 011.334-1.334h2.666a1.333 1.333 0 011.334 1.334V4m2 0v9.333a1.334 1.334 0 01-1.334 1.334H4.667a1.334 1.334 0 01-1.334-1.334V4h9.334z" stroke="#3A5365" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        <span class="sr-only"><?php esc_html_e('Delete', 'mystickyelements'); ?></span>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                <?php } elseif (!empty($where_search)) { ?>
                    <div class="p-5 text-center flex flex-col gap-1">
                        <?php esc_html_e('No records found related to your search.', 'mystickyelements'); ?>
                        <a href="<?php echo esc_sql(admin_url("admin.php?page=my-sticky-elements-leads")) ?>"><?php esc_html_e('Back to all records', 'mystickyelements'); ?></a>
                    </div>
                <?php } ?>

                <?php if (count($result) > 0) { ?>
                    <div class="flex items-center flex-col md:flex-row justify-between gap-3 p-4">
                        <div class="text-sm">
                            Showing records from <?php echo esc_attr($start_from) ?> to <?php echo esc_attr($to) ?> from <?php echo esc_attr($total) ?> records
                        </div>
                        <?php if ($total_page > 1) { ?>
                            <div class="contactleads-pagination">
                                <?php
                                $big = 999999999; // need an unlikely integer
                            echo paginate_links(array(
                                    'base' => add_query_arg('cpage', '%#%'),
                                    'format' => '',
                                    'current' => $page,
                                    'total' =>  $total_page
                            ));?>
                            </div>
                        <?php }?>
                    </div>
                <?php } ?>
            </div>

            <?php if (count($result) > 0) { ?>
                <div class="bg-red-50 border-1 border-red-400 rounded-lg p-4 mt-8 flex justify-between gap-10 items-center">
                    <div class="flex gap-4 items-center">
                        <div>
                            <div class="h-10 w-10 flex items-center justify-center bg-red-200 rounded-full text-red-600!">
                                <svg class="w-auto h-4" width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 4.08333H2.41667M2.41667 4.08333H15.75M2.41667 4.08333V15.75C2.41667 16.192 2.59226 16.6159 2.90482 16.9285C3.21738 17.2411 3.64131 17.4167 4.08333 17.4167H12.4167C12.8587 17.4167 13.2826 17.2411 13.5952 16.9285C13.9077 16.6159 14.0833 16.192 14.0833 15.75V4.08333H2.41667ZM4.91667 4.08333V2.41667C4.91667 1.97464 5.09226 1.55072 5.40482 1.23816C5.71738 0.925595 6.14131 0.75 6.58333 0.75H9.91667C10.3587 0.75 10.7826 0.925595 11.0952 1.23816C11.4077 1.55072 11.5833 1.97464 11.5833 2.41667V4.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col gap-0.5 flex-1">
                            <div class="text-base font-semibold"><?php esc_html_e('Delete all leads permanently', 'mystickyelements');?> </div>
                            <div><?php esc_html_e('This will permanently delete all leads from the database.', 'mystickyelements');?> </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="wpappp_buton delete-all-leads-button" id="mystickyelement_delete_all_leads" >
                            <svg class="w-auto h-4" width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 4.08333H2.41667M2.41667 4.08333H15.75M2.41667 4.08333V15.75C2.41667 16.192 2.59226 16.6159 2.90482 16.9285C3.21738 17.2411 3.64131 17.4167 4.08333 17.4167H12.4167C12.8587 17.4167 13.2826 17.2411 13.5952 16.9285C13.9077 16.6159 14.0833 16.192 14.0833 15.75V4.08333H2.41667ZM4.91667 4.08333V2.41667C4.91667 1.97464 5.09226 1.55072 5.40482 1.23816C5.71738 0.925595 6.14131 0.75 6.58333 0.75H9.91667C10.3587 0.75 10.7826 0.925595 11.0952 1.23816C11.4077 1.55072 11.5833 1.97464 11.5833 2.41667V4.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <?php esc_attr_e('Delete All Leads', 'mystickyelements');?>
                        </button>
                        <input type="hidden" id="delete_nonce" name="delete_nonce" value="<?php echo esc_attr(wp_create_nonce('mysticky_menu_delete_nonce')) ?>" />
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="border border-[#F1F1F1] rounded-lg mse-shadow mse-form-leads mt-5 p-5 text-center">
                <?php esc_html_e('No contact form leads found!', 'mystickyelements');?>
            </div>
        <?php } ?>
    </div>
</div>