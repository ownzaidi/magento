<?php

namespace Falcon\RewardPoints\Model;

use Falcon\RewardPoints\Api\Data\LakumHistoryInterface;
use Magento\Framework\DataObject;

/**
 * Class Lakum History
 */
class LakumHistory extends DataObject implements LakumHistoryInterface
{
    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->getData(self::ACCOUNT_NUMBER);
    }

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        return $this->setData(self::ACCOUNT_NUMBER, $accountNumber);
    }

    /**
     * @return string
     */
    public function getMemberName()
    {
        return $this->getData(self::MEMBER_NAME);
    }

    /**
     * @param $memberName
     * @return $this
     */
    public function setMemberName($memberName)
    {
        return $this->setData(self::MEMBER_NAME, $memberName);
    }

    /**
     * @return string
     */
    public function getMemberUniversalId()
    {
        return $this->getData(self::MEMBER_UNIVERSAL_ID);
    }

    /**
     * @param $memberUniversalId
     * @return $this
     */
    public function setMemberUniversalId($memberUniversalId)
    {
        return $this->setData(self::MEMBER_UNIVERSAL_ID, $memberUniversalId);
    }

    /**
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->getData(self::MOBILE_NUMBER);
    }

    /**
     * @param $mobileNumber
     * @return $this
     */
    public function setMobileNumber($mobileNumber)
    {
        return $this->setData(self::MOBILE_NUMBER, $mobileNumber);
    }

    /**
     * @return float
     */
    public function getPointsBalance()
    {
        return $this->getData(self::POINTS_BALANCE);
    }

    /**
     * @param $pointsBalance
     * @return $this
     */
    public function setPointsBalance($pointsBalance)
    {
        return $this->setData(self::POINTS_BALANCE, $pointsBalance);
    }

    /**
     * @return float
     */
    public function getPointsBalanceAmount()
    {
        return $this->getData(self::POINTS_BALANCE_AMOUNT);
    }

    /**
     * @param $pointsBalanceAmount
     * @return $this
     */
    public function setPointsBalanceAmount($pointsBalanceAmount)
    {
        return $this->setData(self::POINTS_BALANCE, $pointsBalanceAmount);
    }

    /**
     * @return float
     */
    public function getGainedPoints()
    {
        return $this->getData(self::GAINED_POINTS);
    }

    /**
     * @param $gainedPoints
     * @return $this
     */
    public function setGainedPoints($gainedPoints)
    {
        return $this->setData(self::GAINED_POINTS, $gainedPoints);
    }

    /**
     * @return float
     */
    public function getConsumedPoints()
    {
        return $this->getData(self::CONSUMED_POINTS);
    }

    /**
     * @param $consumedPoints
     * @return $this
     */
    public function setConsumedPoints($consumedPoints)
    {
        return $this->setData(self::CONSUMED_POINTS, $consumedPoints);
    }

    /**
     * @return float
     */
    public function getPointsWillBeExpired()
    {
        return $this->getData(self::POINTS_WILL_BE_EXPIRED);
    }

    /**
     * @param $pointsWillBeExpired
     * @return $this
     */
    public function setPointsWillBeExpired($pointsWillBeExpired)
    {
        return $this->setData(self::POINTS_WILL_BE_EXPIRED, $pointsWillBeExpired);
    }

    /**
     * @return float
     */
    public function getExpiredPoints()
    {
        return $this->getData(self::EXPIRED_POINTS);
    }

    /**
     * @param $expiredPoints
     * @return $this
     */
    public function setExpiredPoints($expiredPoints)
    {
        return $this->setData(self::EXPIRED_POINTS, $expiredPoints);
    }

    /**
     * @return float
     */
    public function getTransferPoints()
    {
        return $this->getData(self::TRANSFER_POINTS);
    }

    /**
     * @param $transferPoints
     * @return $this
     */
    public function setTransferPoints($transferPoints)
    {
        return $this->setData(self::TRANSFER_POINTS, $transferPoints);
    }

    /**
     * @return string
     */
    public function getAccountStatus()
    {
        return $this->getData(self::ACCOUNT_STATUS);
    }

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountStatus($accountStatus)
    {
        return $this->setData(self::ACCOUNT_STATUS, $accountStatus);
    }

    /**
     * @return float
     */
    public function getWaitingPoints()
    {
        return $this->getData(self::WAITING_POINTS);
    }

    /**
     * @param $waitingPoints
     * @return $this
     */
    public function setWaitingPoints($waitingPoints)
    {
        return $this->setData(self::WAITING_POINTS, $waitingPoints);
    }

    /**
     * @return float
     */
    public function getLoyalityAmount()
    {
        return $this->getData(self::LOYALITY_AMOUNT);
    }

    /**
     * @param $loyalityAmount
     * @return $this
     */
    public function setLoyalityAmount($loyalityAmount)
    {
        return $this->setData(self::LOYALITY_AMOUNT, $loyalityAmount);
    }

    /**
     * @return float
     */
    public function getPurchaseRate()
    {
        return $this->getData(self::PURCHASE_RATE);
    }

    /**
     * @param $purchaseRate
     * @return $this
     */
    public function setPurchaseRate($purchaseRate)
    {
        return $this->setData(self::PURCHASE_RATE, $purchaseRate);
    }

    /**
     * @return float
     */
    public function getLoyalityPoints()
    {
        return $this->getData(self::LOYALITY_POINTS);
    }

    /**
     * @param $loyalityPoints
     * @return $this
     */
    public function setLoyalityPoints($loyalityPoints)
    {
        return $this->setData(self::LOYALITY_POINTS, $loyalityPoints);
    }

    /**
     * @return string
     */
    public function getPrefLang()
    {
        return $this->getData(self::PREF_LANG);
    }

    /**
     * @param $prefLang
     * @return $this
     */
    public function setPrefLang($prefLang)
    {
        return $this->setData(self::PREF_LANG, $prefLang);
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->getData(self::CREATED_DATE);
    }

    /**
     * @param $createdDate
     * @return $this
     */
    public function setCreatedDate($createdDate)
    {
        return $this->setData(self::CREATED_DATE, $createdDate);
    }

    /**
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->getData(self::EXPIRY_DATE);
    }

    /**
     * @param $expiryDate
     * @return $this
     */
    public function setExpiryDate($expiryDate)
    {
        return $this->setData(self::EXPIRY_DATE, $expiryDate);
    }

    /**
     * @return string
     */
    public function getisActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @param $isActive
     * @return $this
     */
    public function setisActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @return \Falcon\RewardPoints\Api\Data\GainedPointInterface[]
     */
    public function getGainedPointDetails()
    {
        return $this->getData(self::GAINED_POINTS_DETAIL);
    }

    /**
     * @param $gainedPointsDetail
     * @return $this
     */
    public function setGainedPointDetails($gainedPointsDetail)
    {
        return $this->setData(self::GAINED_POINTS_DETAIL, $gainedPointsDetail);
    }

    /**
     * @return \Falcon\RewardPoints\Api\Data\ConsumedPointInterface[]
     */
    public function getConsumedPointDetails()
    {
        return $this->getData(self::CONSUMED_POINTS_DETAIL);
    }

    /**
     * @param $consumedPointsDetail
     * @return $this
     */
    public function setConsumedPointDetails($consumedPointsDetail)
    {
        return $this->setData(self::CONSUMED_POINTS_DETAIL, $consumedPointsDetail);
    }

    /**
     * @return \Falcon\RewardPoints\Api\Data\TransferPointInterface[]
     */
    public function getTransferPointDetails()
    {
        return $this->getData(self::TRANSFER_POINTS_DETAIL);
    }

    /**
     * @param $transferPointsDetail
     * @return $this
     */
    public function setTransferPointDetails($transferPointsDetail)
    {
        return $this->setData(self::TRANSFER_POINTS_DETAIL, $transferPointsDetail);
    }
}
