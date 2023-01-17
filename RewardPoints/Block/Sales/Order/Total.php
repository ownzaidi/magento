<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Block\Sales\Order;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Block\Order\Totals;

/**
 * Class Total
 */
class Total extends Template
{

    /**
     * Total constructor.
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Init Totals
     */
    public function initTotals()
    {
        /** @var Totals $totalsBlock */
        $totalsBlock = $this->getParentBlock();
        $source = $totalsBlock->getSource();
        if ($source) {
            if ($source->getLakumLoyaltyDiscount() > 0) {
                $totalsBlock->addTotal(new DataObject([
                    'code' => 'lakum_loyalty_discount',
                    'field' => 'lakum_loyalty_discount',
                    'label' => __('Loyalty Discount'),
                    'value' => -$source->getLakumLoyaltyDiscount(),
                    'base_value' => -$source->getLakumBaseLoyaltyDiscount(),
                ]), 'subtotal');
            }

        }
    }
}
