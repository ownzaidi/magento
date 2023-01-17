<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model;

use Magento\Sales\Model\Order as SalesOrder;
use Falcon\RewardPoints\Api\Data\OrderInterface;

/**
 * Class Order
 */
class Order extends SalesOrder implements OrderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getLakumLoyaltyDiscount()
    {
        return $this->getData(self::LAKUM_LOYALTY_DISCOUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setLakumLoyaltyDiscount($value)
    {
        return $this->setData(self::LAKUM_LOYALTY_DISCOUNT, $value);
    }

}
