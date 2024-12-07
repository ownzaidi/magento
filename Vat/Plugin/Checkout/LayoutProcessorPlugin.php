<?php
namespace Falcon\Vat\Plugin\Checkout;

class LayoutProcessorPlugin
{

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $session;

    /**
     * @param \Magento\Customer\Model\Session $session
     */
    public function __construct(\Magento\Customer\Model\Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        if (!$this->session->isLoggedIn()) {
            $customAttributeCode = 'vat';
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'vat'
                ],
                'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
                'label' => __('USt - IdNr.'),
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 131,
                'id' => 'vat'
            ];

            $configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
            foreach ($configuration as $paymentGroup => $groupConfig) {
                if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {

                    $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children'][$customAttributeCode] = [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            'customScope' => 'billingAddress.custom_attributes',
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                            'options' => [],
                            'id' => 'vat'
                        ],
                        'dataScope' => 'billingAddress.custom_attributes' . '.' . $customAttributeCode,
                        'label' => 'USt - IdNr.',
                        'provider' => 'checkoutProvider',
                        'visible' => true,
                        'validation' => [],
                        'sortOrder' => 131,
                        'id' => 'vat'
                    ];
                }
            }

        }
        return $jsLayout;
    }

}
