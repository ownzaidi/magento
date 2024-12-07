<?php
namespace Falcon\Vat\Observer;
class SaveToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
        $vat=$quote->getBillingAddress()->getExtensionAttributes()->getVat();
        if ($quote->getCustomerIsGuest() != 0) {
            $order = $event->getOrder();
            $order->setData('vat', $vat);
        }
    }
}
