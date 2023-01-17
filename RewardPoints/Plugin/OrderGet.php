<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderExtension;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemExtension;
use Magento\Sales\Api\Data\OrderItemExtensionFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\Collection;
use Falcon\RewardPoints\Model\Order;
use Falcon\RewardPoints\Model\OrderFactory;

/**
 * Class OrderGet
 * @package Leanscale\RewardPoints\Plugin
 */
class OrderGet
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var OrderExtensionFactory
     */
    protected $orderExtensionFactory;

    /**
     * @var OrderItemExtensionFactory
     */
    protected $orderItemExtensionFactory;

    /**
     * OrderGet constructor.
     *
     * @param OrderFactory $orderFactory
     * @param OrderExtensionFactory $orderExtensionFactory
     * @param OrderItemExtensionFactory $orderItemExtensionFactory
     */
    public function __construct(
        OrderFactory $orderFactory,
        OrderExtensionFactory $orderExtensionFactory,
        OrderItemExtensionFactory $orderItemExtensionFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->orderExtensionFactory = $orderExtensionFactory;
        $this->orderItemExtensionFactory = $orderItemExtensionFactory;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param Collection $resultOrder
     *
     * @return Collection
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        Collection $resultOrder
    ) {
        /** @var  $order */
        foreach ($resultOrder->getItems() as $order) {
            $this->afterGet($subject, $order);
        }

        return $resultOrder;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $resultOrder
     *
     * @return OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ) {
        $resultOrder = $this->getOrderReward($resultOrder);

        return $resultOrder;
    }

    /**
     * @param OrderInterface $order
     *
     * @return OrderInterface
     */
    protected function getOrderReward(OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes();
        if ($extensionAttributes && $extensionAttributes->getLoyaltyReward()) {
            return $order;
        }

        try {
            /** @var Order $orderData */
            $orderData = $this->orderFactory->create()->load($order->getEntityId());
        } catch (NoSuchEntityException $e) {
            return $order;
        }

        /** @var OrderExtension $orderExtension */
        $orderExtension = $extensionAttributes ? $extensionAttributes : $this->orderExtensionFactory->create();
        $orderExtension->setLoyaltyReward($orderData);
        $order->setExtensionAttributes($orderExtension);

        return $order;
    }
}
