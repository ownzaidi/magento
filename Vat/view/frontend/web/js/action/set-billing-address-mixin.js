define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper,quote) {
    'use strict';

    return function (setBillingAddressAction) {
        return wrapper.wrap(setBillingAddressAction, function (originalAction, messageContainer) {

            var billingAddress = quote.billingAddress();

            if(billingAddress != undefined) {

                if (billingAddress['extension_attributes'] === undefined) {
                    billingAddress['extension_attributes'] = {};
                }

                if(billingAddress.customAttributes.length !== 0) {
                    billingAddress['extension_attributes']['vat'] = billingAddress.customAttributes[0]['value'];
                    // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
                }

            }

            return originalAction(messageContainer);
        });
    };
});
