define([
    'Magento_Ui/js/form/element/abstract',
    'Magento_Checkout/js/action/select-payment-method'
], function (Component,selectPaymentMethodAction) {
    'use strict';

    return Component.extend({
        defaults: {
            imports: {
                update: 'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.country_id:value',
                vat:'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.vat:value'
            },
        },

        initialize: function () {
            this._super();
            return this;
        },
        update: function (value) {
            selectPaymentMethodAction(null);

        },
        vat: function (value) {
            selectPaymentMethodAction(null);

        }

    });
});
