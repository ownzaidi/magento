<?php

namespace Falcon\Vat\Model\Sales\Total\Quote;

use Magento\Customer\Api\Data\AddressInterfaceFactory as CustomerAddressFactory;
use Magento\Customer\Api\Data\RegionInterfaceFactory as CustomerAddressRegionFactory;
use Magento\Framework\Serialize\Serializer\Json;

class Tax extends \Magento\Tax\Model\Sales\Total\Quote\Tax
{

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $session;

    /**
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param \Magento\Tax\Api\TaxCalculationInterface $taxCalculationService
     * @param \Magento\Tax\Api\Data\QuoteDetailsInterfaceFactory $quoteDetailsDataObjectFactory
     * @param \Magento\Tax\Api\Data\QuoteDetailsItemInterfaceFactory $quoteDetailsItemDataObjectFactory
     * @param \Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory
     * @param CustomerAddressFactory $customerAddressFactory
     * @param CustomerAddressRegionFactory $customerAddressRegionFactory
     * @param \Magento\Tax\Helper\Data $taxData
     * @param \Magento\Checkout\Model\Session $session
     * @param Json|null $serializer
     */
    public function __construct(
        \Magento\Tax\Model\Config $taxConfig,
        \Magento\Tax\Api\TaxCalculationInterface $taxCalculationService,
        \Magento\Tax\Api\Data\QuoteDetailsInterfaceFactory $quoteDetailsDataObjectFactory,
        \Magento\Tax\Api\Data\QuoteDetailsItemInterfaceFactory $quoteDetailsItemDataObjectFactory,
        \Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory,
        CustomerAddressFactory $customerAddressFactory,
        CustomerAddressRegionFactory $customerAddressRegionFactory,
        \Magento\Tax\Helper\Data $taxData,
        \Magento\Checkout\Model\Session $session,
        Json $serializer = null
    ) {
        $this->session=$session;
        parent::__construct($taxConfig, $taxCalculationService, $quoteDetailsDataObjectFactory,
            $quoteDetailsItemDataObjectFactory, $taxClassKeyDataObjectFactory, $customerAddressFactory,
            $customerAddressRegionFactory, $taxData, $serializer);
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this|Tax
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {

        $countryId = $quote->getShippingAddress()->getCountryId();
        if ($quote->getCustomerIsGuest() != 0) {
            $vat = $quote->getShippingAddress()->getExtensionAttributes()->getVat();
            if ($vat==null)
            {
                $vat= $quote->getShippingAddress()->getVatId();
                if ($vat == null){
                    $vat = $quote->getBillingAddress()->getExtensionAttributes()->getVat();
                }
            }
            if ($countryId != 'DE' && $vat != null) {
                $total->setGrandTotal($total->getGrandTotal() - $total->getTaxAmount());
                $total->setBaseGrandTotal($total->getBaseGrandTotal() - $total->getTaxAmount());
                $total->setTaxAmount(0);
            }
        } else {
            if ($quote->getCustomerTaxvat() != null && $countryId != 'DE') {
                $total->setGrandTotal($total->getGrandTotal() - $total->getTaxAmount());
                $total->setBaseGrandTotal($total->getBaseGrandTotal() - $total->getTaxAmount());
                $total->setTaxAmount(0);
            }
        }
        return $this;
    }

}
