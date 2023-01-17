<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model\Api;

use Falcon\Customer\Api\CustomerRepositoryInterface;
use Falcon\Erp\Service\HmgClient;
use Falcon\RewardPoints\Api\Data\ConsumedPointInterfaceFactory;
use Falcon\RewardPoints\Api\Data\GainedPointInterfaceFactory;
use Falcon\RewardPoints\Api\Data\LakumHistoryInterfaceFactory;
use Falcon\RewardPoints\Api\Data\LakumInterfaceFactory;
use Falcon\RewardPoints\Api\Data\TransferPointInterfaceFactory;
use Falcon\RewardPoints\Api\SpendingManagementInterface;
use Exception;
use Magento\Authorization\Model\CompositeUserContext;
use Magento\Checkout\Model\Session;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\CartTotalRepositoryInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\Data\TotalsInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Model\ResourceModel\Quote\QuoteIdMaskFactory as QuoteIdMaskResourceFactory;
use Falcon\Order\Api\IntegrationManagementInterface as OrderIntegrationManagementInterface;


/**
 * Class SpendingManagement
 */
class SpendingManagement implements SpendingManagementInterface
{

    /**
     * @var CartRepositoryInterface
     */
    protected $cartRepository;

    /**
     * Cart total repository.
     *
     * @var CartTotalRepositoryInterface
     */
    protected $cartTotalRepository;

    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var QuoteIdMaskResourceFactory
     */
    protected $quoteIdMaskResourceFactory;
    /**
     * @var HmgClient
     */
    protected $hmgClient;
    /**
     * @var LakumInterfaceFactory
     */
    protected LakumInterfaceFactory $lakum;
    /**
     * @var DataObjectHelper
     */
    protected DataObjectHelper $dataObjectHelper;
    /**
     * @var ConsumedPointInterfaceFactory
     */
    protected ConsumedPointInterfaceFactory $consumedInterfaceFactory;
    /**
     * @var GainedPointInterfaceFactory
     */
    protected GainedPointInterfaceFactory $gainedInterfaceFactory;
    /**
     * @var LakumHistoryInterfaceFactory
     */
    protected LakumHistoryInterfaceFactory $lakumHistoryInterfaceFactory;
    /**
     * @var TransferPointInterfaceFactory
     */
    protected TransferPointInterfaceFactory $transferPointInterfaceFactory;
    protected $customerRepository;
    /**
     * @var CompositeUserContext
     */
    private CompositeUserContext $userContext;

    protected $integrationManagement;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param CartTotalRepositoryInterface $cartTotalRepository
     * @param Session $checkoutSession
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param QuoteIdMaskResourceFactory $quoteIdMaskResourceFactory
     * @param HmgClient $hmgClient
     * @param CompositeUserContext $userContext
     * @param LakumInterfaceFactory $lakum
     * @param DataObjectHelper $dataObjectHelper
     * @param ConsumedPointInterfaceFactory $consumedInterfaceFactory
     * @param GainedPointInterfaceFactory $gainedInterfaceFactory
     * @param LakumHistoryInterfaceFactory $lakumHistoryInterfaceFactory
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartTotalRepositoryInterface $cartTotalRepository,
        Session $checkoutSession,
        QuoteIdMaskFactory $quoteIdMaskFactory,
        QuoteIdMaskResourceFactory $quoteIdMaskResourceFactory,
        HmgClient $hmgClient,
        CompositeUserContext $userContext,
        LakumInterfaceFactory $lakum,
        DataObjectHelper $dataObjectHelper,
        ConsumedPointInterfaceFactory $consumedInterfaceFactory,
        GainedPointInterfaceFactory $gainedInterfaceFactory,
        LakumHistoryInterfaceFactory $lakumHistoryInterfaceFactory,
        TransferPointInterfaceFactory $transferPointInterfaceFactory,
        CustomerRepositoryInterface $customerRepository,
        OrderIntegrationManagementInterface $integrationManagement

    ) {
        $this->cartRepository = $cartRepository;
        $this->cartTotalRepository = $cartTotalRepository;
        $this->checkoutSession = $checkoutSession;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->quoteIdMaskResourceFactory = $quoteIdMaskResourceFactory;
        $this->hmgClient = $hmgClient;
        $this->userContext = $userContext;
        $this->lakum = $lakum;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->consumedInterfaceFactory = $consumedInterfaceFactory;
        $this->gainedInterfaceFactory = $gainedInterfaceFactory;
        $this->lakumHistoryInterfaceFactory = $lakumHistoryInterfaceFactory;
        $this->transferPointInterfaceFactory = $transferPointInterfaceFactory;
        $this->customerRepository = $customerRepository;
        $this->integrationManagement=$integrationManagement;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate($cartId, $points)
    {
        /** @var Quote $quote */
        $quote = $this->getQuote($cartId);

        $quote->setLsRewardSpend($points);

        $this->validateQuote($quote);

        $quote->collectTotals();
        $this->cartRepository->save($quote);

        return $this->cartTotalRepository->get($quote->getId());
    }

    /**
     * @param string $cartId
     *
     * @return CartInterface
     * @throws NoSuchEntityException
     */
    public function getQuote($cartId)
    {
        return $this->cartRepository->get($cartId);
    }

    /**
     * @param Quote $quote
     *
     * @return void
     * @throws LocalizedException
     */
    protected function validateQuote(Quote $quote)
    {
        if ($quote->getItemsCount() === 0) {
            throw new LocalizedException(
                __('Totals calculation is not applicable to empty cart.')
            );
        }
    }

    /**
     * @param $amount
     * @return \Falcon\Order\Api\Data\Response\CartResponseInterface|string
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function loyaltyDiscount($amount)
    {
        /** @var Quote $quote */
        $amount = $amount * 0.05;
        $customerId = $this->userContext->getUserId();
        $customer = $this->customerRepository->getById($customerId);
        $lakumAccountNumber = $customer->getLakumAccountNumber();
        if (!$lakumAccountNumber) {
            $nationalId = $customer->getNationalId();
            if ($nationalId) {
                $lakumAccountInfo = $this->hmgClient->getLakumAccountNumber($nationalId);
                try {
                    $lakumAccountNumber = $lakumAccountInfo['AccountNumber'];
                    $customer->setLakumAccountNumber($lakumAccountNumber);
                    if ($lakumAccountInfo['Status'] == "Active") {
                        $customer->setLakumAccountStatus(1);

                    }
                    $this->customerRepository->save($customer);
                } catch (Exception $e) {
                    throw new \Magento\Framework\Webapi\Exception(__('Lakum Account Number not exists'), 400);

                }
            }
        }
        $cart = $this->cartRepository->getActiveForCustomer($customerId);
        try {
            /** @var string $cartId */
            $quote = $this->getQuote($this->getQuoteId($cart->getId()));
            if ($lakumAccountNumber) {
                $response = $this->hmgClient->setLakumBurnPoint($lakumAccountNumber, $amount, $quote->getId(),
                    $quote->getCreatedAt());
                if ($response["Message"] != "Saved successfully.") {
                    throw new \Magento\Framework\Webapi\Exception(__('Lakum Account does not exists'), 400);
                }
            }
        } catch (Exception $e) {
            throw new \Magento\Framework\Webapi\Exception(__('Lakum Burn point data return null'), 400);
        }


        if ((float)$amount <= 0) {
            throw new InputException(__('Discount amount must be greater than zero'));
        }

        $quote->setLakumLoyaltyDiscount((float)$amount);
        $this->validateQuote($quote);
        $quote->collectTotals();
        $this->cartRepository->save($quote);
        return $this->integrationManagement->getCart($cart->getId());
    }

    /**
     * Get quote id
     *
     * @param string $quoteId
     * @return int
     */
    private function getQuoteId($quoteId)
    {
        if (!is_numeric($quoteId)) {
            $quoteIdMask = $this->quoteIdMaskFactory->create();
            $this->quoteIdMaskResourceFactory->create()->load($quoteIdMask, $quoteId, 'masked_id');
            $quoteId = $quoteIdMask->getQuoteId();
        }

        return $quoteId;
    }

    /**
     * @inheritdoc
     */
    public function remove()
    {
        /** @var Quote $quote */
        $customerId = $this->userContext->getUserId();
        $cart = $this->cartRepository->getActiveForCustomer($customerId);
        try {
            $quote = $this->getQuote($this->getQuoteId($cart->getId()));
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $quote->setLakumLoyaltyDiscount(0);
        $quote->collectTotals();
        $this->cartRepository->save($quote);

        return $this->integrationManagement->getCart($cart->getId());
    }

    /**
     * @inheriDoc
     */
    public function history()
    {
        $customerId = $this->userContext->getUserId();
        $customer = $this->customerRepository->getById($customerId);
        $lakumAccountNumber = $customer->getLakumAccountNumber();
        if ($lakumAccountNumber) {
            $array = $this->hmgClient->getLakumHistory($lakumAccountNumber, 'true');

            $lakumObject = $this->lakumHistoryInterfaceFactory->create();
            $gainedObjects = [];
            foreach ($array['GainedPointsDetails'] as $indexarray) {
                $gainedObject = $this->gainedInterfaceFactory->create();
                $gainedObject->setAccountsStatus($indexarray['AccountStatus']);
                $gainedObject->setAccNumber($indexarray['AccNumber']);
                $gainedObject->setTransactionDate($indexarray['TransactionDate']);
                $gainedObject->setLineItemNo($indexarray['LineItemNo']);
                $gainedObject->setPoints($indexarray['Points']);
                $gainedObject->setPurchasePoints($indexarray['PurchasePoints']);
                $gainedObject->setAmount($indexarray['Amount']);
                $gainedObject->setSubTransactionType($indexarray['SubTransactionType']);
                $gainedObject->setOperationType($indexarray['OperationType']);
                $gainedObject->setSubTransactionTypeDescription($indexarray['SubTransactionTypeDescription']);
                $gainedObjects[] = $gainedObject;


            }
            $consumedObjects = [];
            foreach ($array['ConsumedPointsDetails'] as $indexarray) {
                $consumedobject = $this->consumedInterfaceFactory->create();
                $consumedobject->setAccountsStatuses($indexarray['AccountStatus']);
                $consumedobject->setAccNumbers($indexarray['AccNumber']);
                $consumedobject->setTransactionsDate($indexarray['TransactionDate']);
                $consumedobject->setLinesItemNo($indexarray['LineItemNo']);
                $consumedobject->setPoint($indexarray['Points']);
                $consumedobject->setPurchasePoint($indexarray['PurchasePoints']);
                $consumedobject->setAmounts($indexarray['Amount']);
                $consumedobject->setSubTransactionsType($indexarray['SubTransactionType']);
                $consumedobject->setOperationsType($indexarray['OperationType']);
                $consumedobject->setSubTransactionsTypeDescription($indexarray['SubTransactionTypeDescription']);
                $consumedObjects[] = $consumedobject;
            }
            $transferObjects = [];
            foreach ($array['TransferPointsDetails'] as $indexarray) {
                $transferObject = $this->transferPointInterfaceFactory->create();
                $transferObject->setAccountsStatus($indexarray['AccountStatus']);
                $transferObject->setAccNumber($indexarray['AccNumber']);
                $transferObject->setTransactionDate($indexarray['TransactionDate']);
                $transferObject->setLineItemNo($indexarray['LineItemNo']);
                $transferObject->setPoints($indexarray['Points']);
                $transferObject->setPurchasePoints($indexarray['PurchasePoints']);
                $transferObject->setAmount($indexarray['Amount']);
                $transferObject->setSubTransactionType($indexarray['SubTransactionType']);
                $transferObject->setOperationType($indexarray['OperationType']);
                $transferObject->setSubTransactionTypeDescription($indexarray['SubTransactionTypeDescription']);
                $transferObjects[] = $transferObject;
            }
            $lakumObject->setAccountNumber($array['AccountNumber']);
            $lakumObject->setMemberName($array['MemberName']);
            $lakumObject->setMemberUniversalId($array['MemberUniversalId']);
            $lakumObject->setMobileNumber($array['MobileNumber']);
            $lakumObject->setPointsBalance($array['PointsBalance']);
            $lakumObject->setPointsBalanceAmount($array['PointsBalanceAmount']);
            $lakumObject->setGainedPoints($array['GainedPoints']);
            $lakumObject->setConsumedPoints($array['ConsumedPoints']);
            $lakumObject->setPointsWillBeExpired($array['PointsWillBeExpired']);
            $lakumObject->setExpiredPoints($array['ExpiredPoints']);
            $lakumObject->setTransferPoints($array['TransferPoints']);
            $lakumObject->setAccountStatus($array['AccountStatus']);
            $lakumObject->setWaitingPoints($array['WaitingPoints']);
            $lakumObject->setLoyalityAmount($array['LoyalityAmount']);
            $lakumObject->setPurchaseRate($array['PurchaseRate']);
            $lakumObject->setLoyalityPoints($array['LoyalityPoints']);
            $lakumObject->setPrefLang($array['PrefLang']);
            $lakumObject->setCreatedDate($array['CreatedDate']);
            $lakumObject->setExpiryDate($array['ExpiryDate']);
            $lakumObject->setisActive($array['isActive']);
            $lakumObject->setGainedPointDetails($gainedObjects);
            $lakumObject->setConsumedPointDetails($consumedObjects);
            $lakumObject->setTransferPointDetails($transferObjects);
            return $lakumObject;
        }
        return false;

    }

    /**
     * @inheriDoc
     */
    public function balance()
    {
        $customerId = $this->userContext->getUserId();
        $customer = $this->customerRepository->getById($customerId);
        $lakumAccountNumber = $customer->getLakumAccountNumber();
        if ($lakumAccountNumber) {
            $data = $this->hmgClient->getLakumHistory($lakumAccountNumber, 'true');
            $lakumData = $this->lakum->create();
            $lakumData->setLoyaltyPoint($data['LoyalityPoints']);
            $lakumData->setLoyaltyAmount($data['LoyalityAmount']);
            $lakumData->setPointBalance($data['PointsBalance']);
            $lakumData->setPointBalanceAmount($data['PointsBalanceAmount']);
            return $lakumData;
        }

        return false;
    }
}
