<?php

declare(strict_types=1);

namespace Falcon\RewardPoints\Block\Adminhtml\Customer\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

/**
 * Class Reward
 */
class Reward extends Generic implements TabInterface
{

    /**
     * Reward constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {

        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Return tab label
     *
     * @return Phrase
     */
    public function getTabLabel()
    {
        return __('Falcon Reward Points');
    }

    /**
     * Return tab title
     *
     * @return Phrase
     */
    public function getTabTitle()
    {
        return __('Falcon Reward Points');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return $this->getCustomerId();
    }

    /**
     * @return mixed
     */
    protected function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function isAjaxLoaded()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    protected function _prepareForm()
    {

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('loyalty_reward');
        $totalPointEarned = 0;
        $totalPointSpend = 0;
        $pointBalance = 0;
        $balanceFieldset = $form->addFieldset('reward_balance', ['legend' => __('Balance Information')]);
        $balanceFieldset->addField('point_earning', 'note', [
            'label' => __('Total Earning Points:'),
            'text' => '<strong>' . $totalPointEarned . '</strong>',
        ]);
        $balanceFieldset->addField('point_spend', 'note', [
            'label' => __('Total Spend Points:'),
            'text' => '<strong>' . $totalPointSpend . '</strong>',
        ]);
        $balanceFieldset->addField('point_balance', 'note', [
            'label' => __('Points Balance:'),
            'text' => '<strong>' . $pointBalance . '</strong>',
        ]);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
