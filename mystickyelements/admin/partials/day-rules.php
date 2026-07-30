<?php
$days = array(
    "0" => "Everyday of week",
    "1" => "Sunday",
    "2" => "Monday",
    "3" => "Tuesday",
    "4" => "Wednesday",
    "5" => "Thursday",
    "6" => "Friday",
    "7" => "Saturday",
    "8" => "Sunday to Thursday",
    "9" => "Monday to Friday",
    "10" => "Weekend",
);
?>
<div class="myStickyelements-page-option relative mse-pro-rules">
    <div class="url-content flex flex-col xl:flex-row gap-2.5 xl:items-center relative justify-between">
        <div class="flex flex-col sm:flex-row gap-2.5 sm:items-center flex-1">
            <div class="flex-1 flex flex-col gap-0.5 w-full md:w-1/2">
                <label class="myStickyelements-days-hours-label-wrap w-auto!">Timezone</label>
                <select class="gmt-data stickyelement-gmt-timezone gmt-timezone" name="general-settings[days-hours][<?php echo esc_attr($count); ?>][gmt]" id="days_rule_timezone_<?php echo esc_attr($count); ?>_option">
                    <option>Select Timezone</option>
                </select>
            </div>
            <div class="flex-1 flex flex-col gap-0.5 w-full ">
                <label class="myStickyelements-days-hours-label-wrap w-auto!">Select day</label>
                <select class="pr-7! text-ellipsis" name="general-settings[days-hours][<?php echo esc_attr($count); ?>][days]" id="days_rule_<?php echo esc_attr($count)  ?>_option">
                </select>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-2.5 sm:items-end flex-1">
            <div class="flex-1 flex flex-col gap-0.5 w-full ">
                <label class="myStickyelements-days-hours-label-wrap">From</label>
                <input type="text" class=" time-picker ui-timepicker-input timepicker_time" value="<?php echo esc_attr($day_hour['start_time']); ?>" name="general-settings[days-hours][<?php echo esc_attr($count); ?>][start_time]" id="start_time_<?php echo esc_attr($count) ?>" />
            </div>
            <div class="flex-1 flex flex-col gap-0.5 w-full ">
                <label class="myStickyelements-days-hours-label-wrap">To</label>
                <input type="text" class=" time-picker ui-timepicker-input timepicker_time" value="<?php echo esc_attr($day_hour['end_time']); ?>" name="general-settings[days-hours][<?php echo esc_attr($count) ?>][end_time]" id="end_time_<?php echo esc_attr($count) ?>" />
            </div>
            <div class="myStickyelements-url-buttons">
                <a class="myStickyelements-remove-rule" href="#">x</a>
            </div>
        </div>
    </div>
    <div class="mse-pro-modal">
        <?php do_action('mse_pro_button') ?>
    </div>
</div>
