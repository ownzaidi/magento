<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api;

use Falcon\RewardPoints\Api\Data\LakumHistoryInterface;
use Falcon\RewardPoints\Api\Data\LakumInterface;

/**
 * Interface SpendingManagementInterface
 */
interface SpendingManagementInterface
{

    /**
     * @param string $amount
     *
     * @return \Falcon\Order\Api\Data\Response\CartResponseInterface|string
     */
    public function loyaltyDiscount($amount);

    /**
     * @return \Falcon\Order\Api\Data\Response\CartResponseInterface
     */
    public function remove();

    /**
     * @return LakumHistoryInterface|false
     */
    public function history();

    /**
     * @return LakumInterface|false
     */
    public function balance();
}
