<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model;

use Falcon\RewardPoints\Api\Data\GainedPointInterface;
use Falcon\RewardPoints\Api\Data\TransferPointInterface;
use Magento\Framework\DataObject;

/**
 * Class Transfer
 */
class TransferPoint extends DataObject implements TransferPointInterface
{

    /**
     * @return string
     */
    public function getAccountsStatus()
    {
        return $this->getData(self::ACCOUNTS_STATUS);
    }

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountsStatus($accountStatus)
    {
        return $this->setData(self::ACCOUNTS_STATUS, $accountStatus);
    }

    /**
     * @return string
     */
    public function getAccNumber()
    {
        return $this->getData(self::ACC_NUMBER);
    }

    /**
     * @param $accNumber
     * @return $this
     */
    public function setAccNumber($accNumber)
    {
        return $this->setData(self::ACC_NUMBER, $accNumber);
    }

    /**
     * @return float
     */
    public function getTransactionDate()
    {
        return $this->getData(self::TRANSACTION_DATE);
    }

    /**
     * @param $transactionDate
     * @return $this
     */
    public function setTransactionDate($transactionDate)
    {
        return $this->setData(self::TRANSACTION_DATE, $transactionDate);
    }

    /**
     * @return string
     */
    public function getLineItemNo()
    {
        return $this->getData(self::LINE_ITEM_NO);
    }

    /**
     * @param $lineItemNo
     * @return $this
     */
    public function setLineItemNo($lineItemNo)
    {
        return $this->setData(self::LINE_ITEM_NO, $lineItemNo);
    }

    /**
     * @return float
     */
    public function getPoints()
    {
        return $this->getData(self::POINTS);
    }

    /**
     * @param $points
     * @return $this
     */
    public function setPoints($points)
    {
        return $this->setData(self::POINTS, $points);
    }

    /**
     * @return float
     */
    public function getPurchasePoints()
    {
        return $this->getData(self::PURCHASE_POINTS);
    }

    /**
     * @param $purchasePoints
     * @return $this
     */
    public function setPurchasePoints($purchasePoints)
    {
        return $this->setData(self::PURCHASE_POINTS, $purchasePoints);
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->getData(self::AMOUNTS);
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNTS, $amount);
    }

    /**
     * @return float
     */
    public function getSubTransactionType()
    {
        return $this->getData(self::SUB_TRANSACTION_TYPE);
    }

    /**
     * @param $subTransactionType
     * @return $this
     */
    public function setSubTransactionType($subTransactionType)
    {
        return $this->setData(self::SUB_TRANSACTION_TYPE, $subTransactionType);
    }

    /**
     * @return string
     */
    public function getOperationType()
    {
        return $this->getData(self::OPERATION_TYPE);
    }

    /**
     * @param $operationType
     * @return $this
     */
    public function setOperationType($operationType)
    {
        return $this->setData(self::OPERATION_TYPE, $operationType);
    }

    /**
     * @return string
     */
    public function getSubTransactionTypeDescription()
    {
        return $this->getData(self::SUB_TRANSACTION_TYPE_DESCRIPTION);
    }

    /**
     * @param $subTransactionTypeDescription
     * @return $this
     */
    public function setSubTransactionTypeDescription($subTransactionTypeDescription)
    {
        return $this->setData(self::SUB_TRANSACTION_TYPE_DESCRIPTION, $subTransactionTypeDescription);
    }
}
