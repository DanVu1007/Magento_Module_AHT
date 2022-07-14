define([
    'ko',
    'uiComponent',
    'mage/url',
    'mage/storage',
    'jquery',
    'Magento_Customer/js/customer-data'
], function(ko, Component, urlBuilder, storage, $, customerData) {
    'use strict';

    function productList(item) {
        var self = this;
        self.sku = ko.observable(item.sku);
        self.src = ko.observable(item.src);
        self.name = ko.observable(item.name);
        self.price = ko.observable(parseFloat(item.price).toFixed(2));
        self.getId = item.entity_id;
        self.qty = ko.observable(1);
        self.total_price = ko.computed(function() {
            if (self.qty() > 0) {
                return parseFloat(self.qty() * self.price()).toFixed(2);
            } else {
                alert("Sorry, the quantity should be 1 minimun");
                self.qty(1);
                return parseFloat(self.qty() * self.price()).toFixed(2);
            }
        });
        self.qtyDown = function() {
            if (self.qty() > 1) {
                self.qty(self.qty() - 1);
            }
        }
        self.qtyUp = function() {
            self.qty(self.qty() + 1);
        }
    }

    function model() {
        var self = this;
        self.search_keyword = ko.observable();
        self.search_result = ko.observableArray([]);
        self.product_table_list = ko.observableArray([]);
        self.currency = ko.observable();
        self.search_focused = ko.observable(false);
        self.result_focused = ko.observable(false);
        self.result_appear = ko.observable(true);
        self.result_appear_click = ko.computed(function() {
            if (self.search_focused()) {
                self.result_appear(true);
            } else {
                self.result_appear(self.result_focused());
            }
        });


        self.getKeyWord = function() {
            var self = this;
            var serviceUrl = urlBuilder.build('danpr/dpr/search');

            return storage.post(
                serviceUrl,
                JSON.stringify({ 'search_keyword': self.search_keyword() }),
                false
            ).done(
                function(response) {
                    var product = $.map(response.products, function(item) {
                        item['isCheck'] = ko.observable(self.checkIfExist(item));
                        return item;
                    });
                    self.search_result(product);
                    self.currency(response.currency);
                }
            ).fail(
                function(response) {
                    alert(response);
                }
            );
        };

        self.checkIfExist = function(item) {
            var exist = false;
            var idToCheck = item.entity_id;
            ko.utils.arrayFilter(self.product_table_list(), function(data) {
                if (idToCheck == data.getId) {
                    exist = true;
                }
            });
            return exist;
        };

        self.checkToTable = function(item) {
            var exist = false;
            var idToCheck = item.entity_id;
            var productToTable = [];
            ko.utils.arrayFilter(self.product_table_list(), function(data) {
                if (idToCheck == data.getId) {
                    exist = true;
                    productToTable = data;
                }
            });

            if (!exist && item.isCheck()) {
                self.product_table_list.push(new productList(item));
            } else if (exist && !item.isCheck()) {
                self.product_table_list.remove(productToTable);
            }
        };

        self.countLine = ko.computed(function() {
            return self.product_table_list().length;
        });

        self.countProduct = ko.computed(function() {
            var countProduct = 0;
            ko.utils.arrayFilter(self.product_table_list(), function(data) {
                countProduct = parseInt(countProduct) + parseInt(data.qty());
            });
            return parseInt(countProduct);
        });

        self.countPrice = ko.computed(function() {
            var countPrice = 0;
            ko.utils.arrayFilter(self.product_table_list(), function(data) {
                countPrice = parseFloat(countPrice) + parseFloat(data.total_price());
            });
            return parseFloat(countPrice).toFixed(2);
        });

        self.deleteProduct = function(item) {
            self.product_table_list.remove(item);
            var idToCheck = item.getId;
            ko.utils.arrayFilter(self.search_result(), function(data) {
                if (idToCheck == data.entity_id) {
                    data.isCheck(false);
                }
            })
        };

        self.addToCart = function() {
            var self = this;
            var serviceUrl = urlBuilder.build('fastorderpractice/index/add');
            var cartProducts = [];

            ko.utils.arrayFilter(self.product_table_list(), function(data) {
                cartProducts.push({
                    'product': data.getId,
                    'qty': data.qty()
                })
            });

            return storage.post(
                serviceUrl,
                JSON.stringify(cartProducts),
                false
            ).done(
                function(response) {
                    alert('Succeed adding to cart');
                    self.product_table_list([]);
                    self.search_result([]);
                    self.search_keyword('');
                    customerData.reload(['cart'], true);
                }
            ).fail(function() {
                alert('Fail to add to cart');
            });
        }
    }

    return Component.extend(new model());
})