<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface OrderInterface
 */
interface OrderInterface extends ExtensibleDataInterface
{
    const LAKUM_LOYALTY_DISCOUNT = 'lakum_loyalty_discount';

    /**
     * @return float
     */
    public function getLakumLoyaltyDiscount();

    /**
     * @param float $value
     *
     * @return $this
     */
    public function setLakumLoyaltyDiscount($value);

}
