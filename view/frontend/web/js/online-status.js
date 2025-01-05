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
        let onStatusChange = function (isOnline) {
            customerData.set('messages', {
                messages: [{
                    text: isOnline ? config.online_message : config.offline_message,
                    type: isOnline ? 'success' : 'error',
                }],
            });
        };

        Navigator.network.isOnline.subscribe(onStatusChange);
    }
});
