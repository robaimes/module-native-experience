/**
 * Copyright © Rob Aimes - https://aimes.dev/
 * https://github.com/robaimes
 */
define([
    'Aimes_Substratum/js/model/navigator',
    'Magento_Customer/js/customer-data',
], function (Navigator, customerData) {
    'use strict';

    return function (config) {
        function onBatteryChange(batteryLevel) {
            const lowLevelWarning = parseInt(config.low_battery_percentage);

            if (batteryLevel > lowLevelWarning) {
                return;
            }

            customerData.set('messages', {
                messages: [{
                    text: config.low_battery_message,
                    type: 'warning',
                }],
            });
        }

        Navigator.battery.level.subscribe(onBatteryChange);
    }
});
