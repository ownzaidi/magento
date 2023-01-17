<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model;

use Falcon\RewardPoints\Api\Data\LakumInterface;
use Magento\Framework\DataObject;

/**
 * Class Lakum
 */
class Lakum extends DataObject implements LakumInterface
{
    /**
     * Get loyaltyPoint
     *
     * @return float
     */
    public function getLoyaltyPoint()
    {
        return $this->getData(self::LOYALTY_POINT);
    }

    /**
     * Set loyaltyPoint
     * @return $this
     */
    public function setLoyaltyPoint($loyaltyPoint)
    {
        return $this->setData(self::LOYALTY_POINT, $loyaltyPoint);
    }

    /**
     * Get loyaltyAmount
     *
     * @return float
     */
    public function getLoyaltyAmount()
    {
        return $this->getData(self::LOYALTY_AMOUNT);
    }

    /**
     * Set loyaltyAmount
     * @return $this
     */
    public function setLoyaltyAmount($loyaltyAmount)
    {
        return $this->setData(self::LOYALTY_AMOUNT, $loyaltyAmount);
    }

    /**
     * Get pointBalance
     *
     * @return float
     */
    public function getPointBalance()
    {
        return $this->getData(self::POINT_BALANCE);
    }

    /**
     * Set pointBalance
     * @return $this
     */
    public function setPointBalance($pointBalance)
    {
        return $this->setData(self::POINT_BALANCE, $pointBalance);
    }

    /**
     * Get pointBalanceAmount
     *
     * @return float
     */
    public function getPointBalanceAmount()
    {
        return $this->getData(self::POINT_BALANCE_AMOUNT);
    }

    /**
     * Set pointBalanceAmount
     * @return $this
     */
    public function setPointBalanceAmount($pointBalanceAmount)
    {
        return $this->setData(self::POINT_BALANCE_AMOUNT, $pointBalanceAmount);
    }
}
