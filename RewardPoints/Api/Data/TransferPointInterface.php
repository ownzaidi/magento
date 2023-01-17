<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api\Data;

interface TransferPointInterface
{
    const ACCOUNTS_STATUS = 'AccountStatus';
    const ACC_NUMBER = 'AccNumber';
    const TRANSACTION_DATE = 'TransactionDate';
    const LINE_ITEM_NO = 'LineItemNo';
    const POINTS = 'Points';
    const PURCHASE_POINTS = 'PurchasePoints';
    const AMOUNTS = 'Amount';
    const SUB_TRANSACTION_TYPE = 'SubTransactionType';
    const OPERATION_TYPE = 'OperationType';
    const SUB_TRANSACTION_TYPE_DESCRIPTION = 'SubTransactionTypeDescription';

    /**
     * @return $this
     */
    public function getAccountsStatus();

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountsStatus($accountStatus);

    /**
     * @return string
     */
    public function getAccNumber();

    /**
     * @param $accNumber
     * @return $this
     */
    public function setAccNumber($accNumber);

    /**
     * @return string
     */
    public function getTransactionDate();

    /**
     * @param $transactionDate
     * @return $this
     */
    public function setTransactionDate($transactionDate);

    /**
     * @return string
     */
    public function getLineItemNo();

    /**
     * @param $lineItemNo
     * @return $this
     */
    public function setLineItemNo($lineItemNo);

    /**
     * @return float
     */
    public function getPoints();

    /**
     * @param $points
     * @return $this
     */
    public function setPoints($points);

    /**
     * @return float
     */
    public function getPurchasePoints();

    /**
     * @param $purchasePoints
     * @return $this
     */
    public function setPurchasePoints($purchasePoints);

    /**
     * @return float
     */
    public function getAmount();

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount);

    /**
     * @return float
     */
    public function getSubTransactionType();

    /**
     * @param $subTransactionType
     * @return $this
     */
    public function setSubTransactionType($subTransactionType);

    /**
     * @return string
     */
    public function getOperationType();

    /**
     * @param $operationType
     * @return $this
     */
    public function setOperationType($operationType);

    /**
     * @return string
     */
    public function getSubTransactionTypeDescription();

    /**
     * @param $subTransactionTypeDescription
     * @return $this
     */
    public function setSubTransactionTypeDescription($subTransactionTypeDescription);

}
