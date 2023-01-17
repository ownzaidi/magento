<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api\Data;

interface ConsumedPointInterface
{
    const ACCOUNTS_STATUSES = 'AccountStatus';
    const ACC_NUMBERS = 'AccNumber';
    const TRANSACTIONS_DATE = 'TransactionDate';
    const LINES_ITEM_NO = 'LineItemNo';
    const POINT = 'Points';
    const PURCHASE_POINT = 'PurchasePoints';
    const AMOUNT = 'Amount';
    const SUB_TRANSACTIONS_TYPE = 'SubTransactionType';
    const OPERATIONS_TYPE = 'OperationType';
    const SUB_TRANSACTIONS_TYPE_DESCRIPTION = 'SubTransactionTypeDescription';

    /**
     * @return string
     */
    public function getAccountsStatuses();

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountsStatuses($accountStatus);

    /**
     * @return string
     */
    public function getAccNumbers();

    /**
     * @param $accNumber
     * @return $this
     */
    public function setAccNumbers($accNumber);

    /**
     * @return string
     */
    public function getTransactionsDate();

    /**
     * @param $transactionDate
     * @return $this
     */
    public function setTransactionsDate($transactionDate);

    /**
     * @return string
     */
    public function getLinesItemNo();

    /**
     * @param $lineItemNo
     * @return $this
     */
    public function setLinesItemNo($lineItemNo);

    /**
     * @return float
     */
    public function getPoint();

    /**
     * @param $points
     * @return $this
     */
    public function setPoint($points);

    /**
     * @return float
     */
    public function getPurchasePoint();

    /**
     * @param $purchasePoints
     * @return $this
     */
    public function setPurchasePoint($purchasePoints);

    /**
     * @return float
     */
    public function getAmounts();

    /**
     * @param $amount
     * @return $this
     */
    public function setAmounts($amount);

    /**
     * @return float
     */
    public function getSubTransactionsType();

    /**
     * @param $subTransactionType
     * @return $this
     */
    public function setSubTransactionsType($subTransactionType);

    /**
     * @return string
     */
    public function getOperationsType();

    /**
     * @param $operationType
     * @return $this
     */
    public function setOperationsType($operationType);

    /**
     * @return string
     */
    public function getSubTransactionsTypeDescription();

    /**
     * @param $subTransactionTypeDescription
     * @return $this
     */
    public function setSubTransactionsTypeDescription($subTransactionTypeDescription);

}
