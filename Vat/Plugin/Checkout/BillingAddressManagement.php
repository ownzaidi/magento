<?php


namespace Falcon\Vat\Plugin\Checkout;

class BillingAddressManagement
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Quote\Model\BillingAddressManagement $subject
     * @param $cartId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @param $useForShipping
     * @return void
     */
    public function beforeAssign(
        \Magento\Quote\Model\BillingAddressManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address,
        $useForShipping = false
    ) {

        $extAttributes = $address->getExtensionAttributes();
        if (!empty($extAttributes)) {

            try {
                $address->setVatId($extAttributes->getVat());
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }

        }

    }
}
