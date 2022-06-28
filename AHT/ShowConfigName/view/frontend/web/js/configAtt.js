define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';
    return function(targetModule){
        var reloadPrice = targetModule.prototype._reloadPrice;
        var reloadPriceWrapper = wrapper.wrap(reloadPrice, function(original){
            original();
            var dynamic = this.options.spConfig.dynamic;
            console.log(dynamic);
            for (var code in dynamic){
                if (dynamic.hasOwnProperty(code)) {
                    var value = "";
                    var $placeholder = $('[itemprop='+code+']');
                    if(this.simpleProduct){
                        value = this.options.spConfig.dynamic[code][this.simpleProduct].value;
                    }
                    $placeholder.html(value);
                }
            }

        });

        targetModule.prototype._reloadPrice = reloadPriceWrapper;
        return targetModule;
    };
});