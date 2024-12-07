<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Falcon\ShippingCalculator\Model\Carrier\Flatrate;

use Magento\Quote\Model\Quote\Address\RateRequest;

class ItemPriceCalculator extends \Magento\OfflineShipping\Model\Carrier\Flatrate\ItemPriceCalculator
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig )
    {
        $this->scopeConfig=$scopeConfig;
    }

    /**
     * @param RateRequest $request
     * @param int $basePrice
     * @param int $freeBoxes
     * @return float
     */
    public function getShippingPricePerItem(
        \Magento\Quote\Model\Quote\Address\RateRequest $request,
        $basePrice,
        $freeBoxes
    ) {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $atShipping=$this->scopeConfig->getValue('carriers/flatrate/at_shipping',$storeScope);
        $deShipping=$this->scopeConfig->getValue('carriers/flatrate/de_shipping',$storeScope);
        $chShipping=$this->scopeConfig->getValue('carriers/flatrate/ch_shipping',$storeScope);
        $otShipping=$this->scopeConfig->getValue('carriers/flatrate/ot_shipping',$storeScope);


        if ($request->getDestCountryId() == 'DE' && $request->getPackageQty() < 100) {
            $price = $deShipping;
        } elseif ($request->getDestCountryId() == 'DE' && $request->getPackageQty() >= 100) {
            $priceQty = $request->getPackageQty() * $this->scopeConfig->getValue('carriers/flatrate/de_shipping_more',$storeScope);;
            if ($priceQty > $deShipping)
            {
                $price=$priceQty;
            }else{
                $price=$deShipping;
            }
        } elseif ($request->getDestCountryId() == 'AT' && $request->getPackageQty() >= 100) {
            $priceQty = $request->getPackageQty() * $this->scopeConfig->getValue('carriers/flatrate/at_shipping_more',$storeScope);;
            if ($priceQty > $atShipping)
            {
                $price=$priceQty;
            }else{
                $price=$atShipping;
            }
        } elseif ($request->getDestCountryId() == 'AT' && $request->getPackageQty() < 100) {
            $price = $atShipping;
        } elseif ($request->getDestCountryId() == 'CH' && $request->getPackageQty() >= 100) {
            $priceQty = $request->getPackageQty() * $this->scopeConfig->getValue('carriers/flatrate/ch_shipping_more',$storeScope);
            if ($priceQty > $chShipping)
            {
                $price=$priceQty;
            }else{
                $price=$chShipping;
            }
        } elseif ($request->getDestCountryId() == 'CH' && $request->getPackageQty() < 100) {
            $price = $chShipping;
        } elseif($request->getPackageQty() < 100) {
            $price = $otShipping;
        }
        elseif($request->getPackageQty() >= 100) {
            $priceQty = $request->getPackageQty() * $this->scopeConfig->getValue('carriers/flatrate/ot_shipping_more',$storeScope);;
            if ($priceQty > $otShipping)
            {
                $price=$priceQty;
            }else{
                $price=$otShipping;
            }
        }
        return $price;
    }

}
