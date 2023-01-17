<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api\Data;

interface LakumInterface
{
    const LOYALTY_POINT = 'loyalty_point';
    const LOYALTY_AMOUNT = 'loyalty_amount';
    const POINT_BALANCE = 'point_balance';
    const POINT_BALANCE_AMOUNT = 'point_balance_amount';

    /**
     * Get loyaltyPoint
     *
     * @return float
     */
    public function getLoyaltyPoint();

    /**
     * Set loyaltyPoint
     * @param float $loyaltyPoint
     * @return $this
     */
    public function setLoyaltyPoint($loyaltyPoint);

    /**
     * Get loyaltyAmount
     *
     * @return float
     */
    public function getLoyaltyAmount();

    /**
     * Set loyaltyAmount
     * @param float $loyaltyAmount
     * @return $this
     */
    public function setLoyaltyAmount($loyaltyAmount);

    /**
     * Get pointBalance
     *
     * @return float
     */
    public function getPointBalance();

    /**
     * Set pointBalance
     * @param float $pointBalance
     * @return $this
     */
    public function setPointBalance($pointBalance);

    /**
     * Get pointBalanceAmount
     *
     * @return float
     */
    public function getPointBalanceAmount();

    /**
     * Set pointBalanceAmount
     * @param float $pointBalanceAmount
     * @return $this
     */
    public function setPointBalanceAmount($pointBalanceAmount);

}
