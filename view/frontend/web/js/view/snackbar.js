/**
 * Copyright © Rob Aimes - https://aimes.dev/
 * https://github.com/robaimes
 */

define([
    'uiComponent',
    'ko',
    'jquery',
    'underscore',
    'escaper',
    'Magento_Customer/js/customer-data',
    'mage/cookies',
    'jquery/jquery-storageapi',
], function (Component, ko, $, _, escaper, customerData) {
    'use strict';

    return Component.extend({
        defaults: {
            allowedTags: ['div', 'span', 'b', 'strong', 'i', 'em', 'u', 'a'],
            cookieMessages: [],
            defaultLifetime: 10000,
            template: 'Aimes_NativeExperience/snackbar',
        },
        messages: ko.observableArray([]),

        /**
         * Initialise component logic
         *
         * @return void
         */
        initialize: function () {
            this._super();

            this.messages.subscribe(this.onMessagesChange.bind(this));

            this.initSessionMessages();
            this.initCookieMessages();
        },

        /**
         * Render any messages stored in customer data messages section and initialise subscriber
         */
        initSessionMessages: function () {
            const self = this;

            customerData.get('messages').subscribe(function (sectionData) {
                sectionData.messages.forEach(function (messageData, index, messages) {
                    self.addMessage(messageData.text, messageData.type);
                    messages.splice(index, 1); // Delete message from section after rendering
                });
            });
        },

        /**
         * Render messages from mage-messages cookie
         */
        initCookieMessages: function () {
            const self = this;
            const cookieMessages = _.unique(
                $.cookieStorage.get('mage-messages'),
                'text'
            );

            cookieMessages.forEach(function (messageData) {
                self.addMessage(messageData.text, messageData.type);
            });

            $.mage.cookies.set('mage-messages', '', {
                samesite: 'strict',
                domain: '',
            });
        },

        /**
         * Render a message in the snackbar
         *
         * @param message
         * @param type
         * @param lifetime
         */
        addMessage: function (message, type, lifetime) {
            const timestamp = Date.now();

            lifetime = typeof lifetime === 'number' ? lifetime : this.defaultLifetime;

            this.messages.push({
                message,
                type,
                lifetime,
                timestamp,
            });
        },

        /**
         * Remove a message from the snackbar
         *
         * @param messageToRemove {Object}
         *
         * @return {Object}
         */
        removeMessage: function (messageToRemove) {
            return this.messages.remove(function (message) {
                return message.timestamp === messageToRemove.timestamp;
            });
        },

        /**
         * Escape characters before rendering messages as HTML
         *
         * @param message {String}
         *
         * @return {String}
         */
        sanitizeMessage: function (message) {
            return escaper.escapeHtml(message, this.allowedTags);
        },

        /**
         * Callback from subscription event to the local messages property
         *
         * @param messages {Array<Object>}
         */
        onMessagesChange: function (messages) {
            if (!messages.length) {
                return;
            }

            const lastMessage = messages.slice(-1)[0];
            const lifetime = lastMessage.lifetime || this.defaultLifetime;

            setTimeout(this.removeMessage.bind(this), lifetime, lastMessage);
        },
    });
});
