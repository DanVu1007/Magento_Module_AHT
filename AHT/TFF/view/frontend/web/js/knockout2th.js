define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'jquery',
    'Magento_Customer/js/customer-data'
], function(ko, Component, urlBuilder, storage, $, customerData) {
    'use strict';


    function AppViewModel() {
        var self = this;
        self.search_keyword = ko.observable();

        self.getKeyWord = function () {
            var self = this;
            var serviceUrl = urlBuilder.build('danpr/Dpr/search');

            return storage.post(
                serviceUrl,
                JSON.stringify({'search_keyword': self.search_keyword}),
                false
            ).done(
                function (response) {
                    alert(response)
                }
            ).fail(
                function (response) {
                    alert(response + 'false');

                }
            );

        }
    }


    return Component.extend(new AppViewModel());
})
