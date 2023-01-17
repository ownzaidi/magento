<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Api\Data;


interface LakumHistoryInterface
{
    const ACCOUNT_NUMBER = 'AccountNumber';
    const MEMBER_NAME = 'MemberName';
    const MEMBER_UNIVERSAL_ID = 'MemberUniversalId';
    const MOBILE_NUMBER = 'MobileNumber';
    const POINTS_BALANCE = 'PointsBalance';
    const POINTS_BALANCE_AMOUNT = 'PointsBalanceAmount';
    const GAINED_POINTS = 'GainedPoints';
    const CONSUMED_POINTS = 'ConsumedPoints';
    const POINTS_WILL_BE_EXPIRED = 'PointsWillBeExpired';
    const EXPIRED_POINTS = 'ExpiredPoints';
    const TRANSFER_POINTS = 'TransferPoints';
    const ACCOUNT_STATUS = 'AccountStatus';
    const WAITING_POINTS = 'WaitingPoints';
    const LOYALITY_AMOUNT = 'LoyalityAmount';
    const PURCHASE_RATE = 'PurchaseRate';
    const LOYALITY_POINTS = 'LoyalityPoints';
    const PREF_LANG = 'PrefLang';
    const CREATED_DATE = 'CreatedDate';
    const EXPIRY_DATE = 'ExpiryDate';
    const IS_ACTIVE = 'isActive';
    const GAINED_POINTS_DETAIL = 'GainedPointsDetail';
    const CONSUMED_POINTS_DETAIL = 'ConsumedPointsDetail';
    const TRANSFER_POINTS_DETAIL = 'TransferPointsDetail';

    /**
     * @return string
     */
    public function getAccountNumber();

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber);

    /**
     * @return string
     */
    public function getMemberName();

    /**
     * @param $memberName
     * @return $this
     */
    public function setMemberName($memberName);

    /**
     * @return string
     */
    public function getMemberUniversalId();

    /**
     * @param $memberUniversalId
     * @return $this
     */
    public function setMemberUniversalId($memberUniversalId);

    /**
     * @return string
     */
    public function getMobileNumber();

    /**
     * @param $mobileNumber
     * @return $this
     */
    public function setMobileNumber($mobileNumber);

    /**
     * @return float
     */
    public function getPointsBalance();

    /**
     * @param $pointsBalance
     * @return $this
     */
    public function setPointsBalance($pointsBalance);

    /**
     * @return float
     */
    public function getPointsBalanceAmount();

    /**
     * @param $pointsBalanceAmount
     * @return $this
     */
    public function setPointsBalanceAmount($pointsBalanceAmount);

    /**
     * @return float
     */
    public function getGainedPoints();

    /**
     * @param $gainedPoints
     * @return $this
     */
    public function setGainedPoints($gainedPoints);

    /**
     * @return float
     */
    public function getConsumedPoints();

    /**
     * @param $consumedPoints
     * @return $this
     */
    public function setConsumedPoints($consumedPoints);

    /**
     * @return float
     */
    public function getPointsWillBeExpired();

    /**
     * @param $pointsWillBeExpired
     * @return $this
     */
    public function setPointsWillBeExpired($pointsWillBeExpired);

    /**
     * @return float
     */
    public function getExpiredPoints();

    /**
     * @param $expiredPoints
     * @return $this
     */
    public function setExpiredPoints($expiredPoints);

    /**
     * @return float
     */
    public function getTransferPoints();

    /**
     * @param $transferPoints
     * @return $this
     */
    public function setTransferPoints($transferPoints);

    /**
     * @return string
     */
    public function getAccountStatus();

    /**
     * @param $accountStatus
     * @return $this
     */
    public function setAccountStatus($accountStatus);

    /**
     * @return float
     */
    public function getWaitingPoints();

    /**
     * @param $waitingPoints
     * @return $this
     */
    public function setWaitingPoints($waitingPoints);

    /**
     * @return float
     */
    public function getLoyalityAmount();

    /**
     * @param $loyalityAmount
     * @return $this
     */
    public function setLoyalityAmount($loyalityAmount);

    /**
     * @return float
     */
    public function getPurchaseRate();

    /**
     * @param $purchaseRate
     * @return $this
     */
    public function setPurchaseRate($purchaseRate);

    /**
     * @return float
     */
    public function getLoyalityPoints();

    /**
     * @param $loyalityPoints
     * @return $this
     */
    public function setLoyalityPoints($loyalityPoints);

    /**
     * @return string
     */
    public function getPrefLang();

    /**
     * @param $prefLang
     * @return $this
     */
    public function setPrefLang($prefLang);

    /**
     * @return string
     */
    public function getCreatedDate();

    /**
     * @param $createdDate
     * @return $this
     */
    public function setCreatedDate($createdDate);

    /**
     * @return string
     */
    public function getExpiryDate();

    /**
     * @param $expiryDate
     * @return $this
     */
    public function setExpiryDate($expiryDate);

    /**
     * @return string
     */
    public function getisActive();

    /**
     * @param $isActive
     * @return $this
     */
    public function setisActive($isActive);

    /**
     * @return \Falcon\RewardPoints\Api\Data\GainedPointInterface[]
     */
    public function getGainedPointDetails();

    /**
     * @param $gainedPointsDetail
     * @return \Falcon\RewardPoints\Api\Data\GainedPointInterface[]
     */
    public function setGainedPointDetails($gainedPointsDetail);

    /**
     * @return \Falcon\RewardPoints\Api\Data\ConsumedPointInterface[]
     */
    public function getConsumedPointDetails();

    /**
     * @param $consumedPointsDetail
     * @return \Falcon\RewardPoints\Api\Data\ConsumedPointInterface[]
     */
    public function setConsumedPointDetails($consumedPointsDetail);
    /**
     * @return \Falcon\RewardPoints\Api\Data\TransferPointInterface[]
     */
    public function getTransferPointDetails();

    /**
     * @param $transferPointsDetail
     * @return \Falcon\RewardPoints\Api\Data\TransferPointInterface[]
     */
    public function setTransferPointDetails($transferPointsDetail);

}
