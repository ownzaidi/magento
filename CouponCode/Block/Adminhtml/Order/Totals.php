<?php

declare(strict_types=1);

namespace Falcon\CartPriceRule\Block\Adminhtml\Order;

use Magento\Framework\DataObject;

/**
 *
 */
class Totals extends \Magento\Sales\Block\Adminhtml\Order\Totals
{
    /**
     * @return $this|Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        if ((double)$this->getOrder()->getDiscountAmount() == 0) {
            return $this;
        }

        /**
         * Remove value before underscore in discount
         */
        if ($this->getOrder()->getDiscountDescription()) {
            if (strrpos($this->getOrder()->getDiscountDescription(), '_') !== false) {
                $discountLabel = __('Discount (%1)', substr($this->getOrder()->getDiscountDescription(),
                    strrpos($this->getOrder()->getDiscountDescription(), '_') + 1));
            } else {
                $discountLabel = __('Discount (%1)', $this->getOrder()->getDiscountDescription());
            }
        } else {
            $discountLabel = __('Discount');
        }
        $this->_totals['discount'] = new DataObject(
            [
                'code' => 'discount',
                'value' => $this->getOrder()->getDiscountAmount(),
                'base_value' => $this->getOrder()->getBaseDiscountAmount(),
                'label' => $discountLabel,
            ]
        );

        return $this;
    }
}

