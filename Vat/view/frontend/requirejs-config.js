var config = {
    config:
        {
            mixins: {
                'Magento_Checkout/js/action/place-order': {
                    'Falcon_Vat/js/action/set-billing-address-mixin': true
                },
                    'Magento_Checkout/js/action/set-shipping-information': {
                        'Falcon_Vat/js/action/set-shipping-information-mixin': true
                    },
                'Magento_Checkout/js/action/set-billing-address': {
                    'Falcon_Vat/js/action/set-billing-address-mixin': true
                }
            }
        }
}
