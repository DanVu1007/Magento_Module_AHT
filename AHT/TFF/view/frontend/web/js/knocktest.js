define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'jquery',
    'Magento_Customer/js/customer-data'
], function(ko, Component, urlBuilder, storage, $, customerData) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'ViMagento_OrderGrid/knockout-test'
        },
        initialize: function () {
            this.customerName = ko.observableArray([]);
            this.customerData = ko.observable('');
            this._super();
        },

        addNewCustomer: function () {
            this.customerName.push({name:this.customerData()});
            this.customerData('');
        }
    })
})