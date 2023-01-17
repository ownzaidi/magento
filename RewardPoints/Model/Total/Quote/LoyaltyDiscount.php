<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Model\Total\Quote;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;

class LoyaltyDiscount extends AbstractTotal
{
    /**
     * @var PriceCurrencyInterface
     */
    protected $_priceCurrency;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * LoyaltyDiscount constructor.
     * @param PriceCurrencyInterface $priceCurrency
     * @param RequestInterface $request
     */
    public function __construct(
        PriceCurrencyInterface $priceCurrency,
        RequestInterface $request,
    ) {
        $this->_priceCurrency = $priceCurrency;
        $this->request = $request;
    }

    /**
     * Collect
     *
     * @param Quote $quote
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @return $this|bool
     */
    public function collect(
        Quote $quote,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        if (!($items = $shippingAssignment->getItems())
            || in_array(
                $this->request->getFullActionName(),
                ['multishipping_checkout_overviewPost', 'multishipping_checkout_overview'],
                true
            )
        ) {
            return $this;
        }

        $loyaltyDiscount = $quote->getLakumLoyaltyDiscount();

        $baseToQuoteRate = $quote->getBaseToQuoteRate() ?: 1;
        $baseLoyaltyDiscount = $this->_priceCurrency->roundPrice($loyaltyDiscount / $baseToQuoteRate);

        $baseSubtotalWithDiscount = $total->getBaseSubtotalWithDiscount() > 0 ?
            $total->getBaseSubtotalWithDiscount() : 0;
        $subtotalWithDiscount = $total->getSubtotalWithDiscount() > 0 ? $total->getSubtotalWithDiscount() : 0;

        if ($baseLoyaltyDiscount > $baseSubtotalWithDiscount) {
            $baseLoyaltyDiscount = $baseSubtotalWithDiscount;
        }

        if ($loyaltyDiscount > $subtotalWithDiscount) {
            $loyaltyDiscount = $subtotalWithDiscount;
        }

        $quote->setLakumBaseLoyaltyDiscount($quote->getLakumBaseLoyaltyDiscount() + $baseLoyaltyDiscount);

        $total->setBaseGrandTotal(
            $total->getBaseGrandTotal() -
            $baseLoyaltyDiscount
        );
        $total->setGrandTotal(
            $total->getGrandTotal() -
            $loyaltyDiscount
        );

        if ($total->getGrandTotal() < 0) {
            $total->setBaseGrandTotal(0);
            $total->setGrandTotal(0);
        }

        return $this;
    }

    /**
     * Retrieve reward total data
     *
     * @param Quote $quote
     * @param Total $total
     *
     * @return array|null
     */
    public function fetch(Quote $quote, Total $total)
    {
        $totals = [];
        if ($this->request->getFullActionName() !== 'multishipping_checkout_overview') {
            $discount = $quote->getLakumLoyaltyDiscount();
            if ($discount > 0.001) {
                $totals[] = [
                    'code' => 'lakum_loyalty_discount',
                    'title' => __('Lakum Discount'),
                    'value' => $discount,
                ];
            }
        }

        return $totals;
    }
}
