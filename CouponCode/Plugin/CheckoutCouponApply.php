<?php

declare(strict_types=1);

namespace Falcon\CartPriceRule\Plugin;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\CouponManagement;
use Magento\SalesRule\Api\CouponRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * class for coupon valid from the Frontend API call
 */
class CheckoutCouponApply
{

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var FilterBuilder
     */
    protected FilterBuilder $filterBuilder;
    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    /**
     * @var CouponRepositoryInterface
     */
    protected CouponRepositoryInterface $couponRepository;

    /**
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param CouponRepositoryInterface $couponRepository
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        LoggerInterface $logger,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        CouponRepositoryInterface $couponRepository,
    ) {
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->couponRepository = $couponRepository;
    }

    /**
     * @param CouponManagement $subject
     * @param $cartId
     * @param $couponCode
     * @return array
     */
    public function beforeSet(CouponManagement $subject, $cartId, $couponCode): array
    {

        try {
            $ruleId = null;
            $websiteId = $this->storeManager->getStore()->getWebsiteId();
            $website_CouponCode = $websiteId . '_' . $couponCode;
            $couponCodeFilter[] = $this->filterBuilder
                ->setField('code')
                ->setConditionType('eq')
                ->setValue($website_CouponCode)
                ->create();
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilters($couponCodeFilter)
                ->create();

            $items = $this->couponRepository->getList($searchCriteria)->getItems();
            foreach ($items as $item) {
                $ruleId = $item->getRuleId();
            }
            if ($ruleId) {
                return [$cartId, $website_CouponCode];
            }
        } catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
        }
        return [$cartId, $couponCode];
    }
}

