<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

/**
 * Class RewardPointsConvertData
 */
class RewardPointsConvertData implements ObserverInterface
{

    /**
     * @param Observer $observer
     *
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        /** @var Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        /** @var Order $order */
        $order = $observer->getEvent()->getOrder();

        if ($quote->getLakumLoyaltyDiscount()) {
            $order->setLakumLoyaltyDiscount($quote->getLakumLoyaltyDiscount())
                ->setLakumBaseLoyaltyDiscount($quote->getLakumBaseLoyaltyDiscount());
        }

        return $this;
    }
}
