<?php

namespace Falcon\UpdatePrices\Controller\Adminhtml\File;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Delete extends Action
{
    const FILE_PATH = '/import/processed_chunks.json';

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Context $context
     * @param Filesystem $filesystem
     */
    public function __construct(
        Context $context,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->filesystem = $filesystem;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        try {
            $varDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
            $filePath = $varDirectory->getAbsolutePath(self::FILE_PATH);

                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file
                    $this->messageManager->addSuccessMessage(__('The file has been deleted successfully.'));
                } else {
                    $this->messageManager->addErrorMessage(__('The file does not exist.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting the file: %1', $e->getMessage()));
            }

            // Redirect to the desired admin configuration page
            $redirectUrl = $this->getUrl('adminhtml/system_config/edit', ['section' => 'part_blue']);
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setUrl($redirectUrl);
    }
}
