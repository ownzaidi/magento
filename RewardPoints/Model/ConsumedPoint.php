<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model;

use Falcon\RewardPoints\Api\Data\ConsumedPointInterface;
use Magento\Framework\DataObject;

/**
 * Class Consumed
 */
class ConsumedPoint extends DataObject implements ConsumedPointInterface
{

    /**
     * @return string
     */
    public function getAccountsStatuses()
    {
        return $this->getData(self::ACCOUNTS_STATUSES);
    }

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountsStatuses($accountStatus)
    {
        return $this->setData(self::ACCOUNTS_STATUSES, $accountStatus);
    }

    /**
     * @return string
     */
    public function getAccNumbers()
    {
        return $this->getData(self::ACC_NUMBERS);
    }

    /**
     * @param $accNumber
     * @return $this
     */
    public function setAccNumbers($accNumber)
    {
        return $this->setData(self::ACC_NUMBERS, $accNumber);
    }

    /**
     * @return float
     */
    public function getTransactionsDate()
    {
        return $this->getData(self::TRANSACTIONS_DATE);
    }

    /**
     * @param $transactionDate
     * @return $this
     */
    public function setTransactionsDate($transactionDate)
    {
        return $this->setData(self::TRANSACTIONS_DATE, $transactionDate);
    }

    /**
     * @return string
     */
    public function getLinesItemNo()
    {
        return $this->getData(self::LINES_ITEM_NO);
    }

    /**
     * @param $lineItemNo
     * @return $this
     */
    public function setLinesItemNo($lineItemNo)
    {
        return $this->setData(self::LINES_ITEM_NO, $lineItemNo);
    }

    /**
     * @return float
     */
    public function getPoint()
    {
        return $this->getData(self::POINT);
    }

    /**
     * @param $points
     * @return $this
     */
    public function setPoint($points)
    {
        return $this->setData(self::POINT, $points);
    }

    /**
     * @return float
     */
    public function getPurchasePoint()
    {
        return $this->getData(self::PURCHASE_POINT);
    }

    /**
     * @param $purchasePoints
     * @return $this
     */
    public function setPurchasePoint($purchasePoints)
    {
        return $this->setData(self::PURCHASE_POINT, $purchasePoints);
    }

    /**
     * @return float
     */
    public function getAmounts()
    {
        return $this->getData(self::AMOUNT);
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmounts($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    /**
     * @return float
     */
    public function getSubTransactionsType()
    {
        return $this->getData(self::SUB_TRANSACTIONS_TYPE);
    }

    /**
     * @param $subTransactionType
     * @return $this
     */
    public function setSubTransactionsType($subTransactionType)
    {
        return $this->setData(self::SUB_TRANSACTIONS_TYPE, $subTransactionType);
    }

    /**
     * @return string
     */
    public function getOperationsType()
    {
        return $this->getData(self::OPERATIONS_TYPE);
    }

    /**
     * @param $operationType
     * @return $this
     */
    public function setOperationsType($operationType)
    {
        return $this->setData(self::OPERATIONS_TYPE, $operationType);
    }

    /**
     * @return string
     */
    public function getSubTransactionsTypeDescription()
    {
        return $this->getData(self::SUB_TRANSACTIONS_TYPE_DESCRIPTION);
    }

    /**
     * @param $subTransactionTypeDescription
     * @return $this
     */
    public function setSubTransactionsTypeDescription($subTransactionTypeDescription)
    {
        return $this->setData(self::SUB_TRANSACTIONS_TYPE_DESCRIPTION, $subTransactionTypeDescription);
    }
}
