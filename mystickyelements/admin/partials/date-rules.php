<div class="myStickyelements-date-schedule-box setting-content-relative myStickyelements-page-option relative mse-pro-rules">
    <div class="flex flex-col xl:flex-row gap-2.5 xl:items-end relative justify-between">
        <div class="flex flex-col sm:flex-row gap-2.5 sm:items-center flex-1">
            <div class="date-select-option flex-1">
                <label>
                    <?php esc_html_e('Start date ', 'mystickyelements');?>
                    <div class="mystickyelements-custom-fields-tooltip myStickyelements-country-tooltip">
                        <a href="#" class="mystickyelements-tooltip mystickyelements-new-custom-btn"><i class="fas fa-info"></i></a>
                        <p><?php esc_html_e('Schedule a date from which the widget will be displayed (the starting date is included)', "mystickyelements");?></p>
                    </div>
                </label>
                <input autocomplete="off" type="text" name="general-settings[date_schedule][<?php echo esc_attr($count)?>][start_date]"  value="<?php echo esc_attr($schedule['start_date'])?>" class="myStickyelements-datepicker myStickyelements-start-datepicker" id="date_schedule_<?php echo esc_attr($count)?>_start_date" data-end-date-id="date_schedule_<?php echo esc_attr($count)?>_end_date">
            </div>
            <div class="time-select-option flex-1">
                <label><?php esc_html_e('Start time ', 'mystickyelements');?></label>
                <input autocomplete="off" type="text" name="general-settings[date_schedule][<?php echo esc_attr($count)?>][start_time]"  value="<?php echo esc_attr($schedule['start_time'])?>" class="myStickyelements-timepicker" id="date_schedule_<?php echo esc_attr($count)?>_start_time">
            </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-2.5 sm:items-center flex-1">
            <div class="date-select-option flex-1">
                <label>
                    <?php esc_html_e('End date ', 'mystickyelements');?>
                    <div class="mystickyelements-custom-fields-tooltip myStickyelements-country-tooltip">
                        <a href="#" class="mystickyelements-tooltip mystickyelements-new-custom-btn"><i class="fas fa-info"></i></a>
                        <p><?php esc_html_e('Schedule a date from which the widget will stop being displayed (the end date is included)', "mystickyelements");?></p>
                    </div>
                </label>
                <input autocomplete="off" type="text" name="general-settings[date_schedule][<?php echo esc_attr($count)?>][end_date]"  value="<?php echo esc_attr($schedule['end_date'])?>" class="myStickyelements-datepicker myStickyelements-end-datepicker" id="date_schedule_<?php echo esc_attr($count)?>_end_date"  data-start-date-id="date_schedule_<?php echo esc_attr($count)?>_start_date">
            </div>
            <div class="time-select-option flex-1">
                <label><?php esc_html_e('End time ', 'mystickyelements');?></label>
                <input autocomplete="off" type="text" name="general-settings[date_schedule][<?php echo esc_attr($count)?>][end_time]"  value="<?php echo esc_attr($schedule['end_time'])?>" class="myStickyelements-timepicker" id="date_schedule_<?php echo esc_attr($count)?>_end_time">
            </div>
        </div>
        <div class="myStickyelements-url-buttons">
            <a class="myStickyelements-remove-date-schedule" href="#">x</a>
        </div>
    </div>
    <div class="mse-pro-modal">
        <?php do_action('mse_pro_button') ?>
    </div>
</div>