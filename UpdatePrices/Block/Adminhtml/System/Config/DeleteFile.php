<?php

namespace Falcon\UpdatePrices\Block\Adminhtml\System\Config;

use Magento\Framework\View\Element\Html\Link;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;

class DeleteFile extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $urlBuilder;

    public function __construct(
        Context $context,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $url = $this->urlBuilder->getUrl('price/file/delete'); // Controller URL

        // Create the delete button HTML
        $buttonHtml = '<button type="button" class="action-secondary" onclick="deleteFile()">
                         Delete Processed File
                       </button>
                       <script type="text/javascript">
                           function deleteFile() {
                               if (confirm("Are you sure you want to delete the processed chunks file?")) {
                                   window.location.href = "' . $url . '";
                               }
                           }
                       </script>';

        return $buttonHtml;
    }
}
