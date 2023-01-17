<?php
declare(strict_types=1);

namespace Falcon\Cms\Model\Data;

use Falcon\Cms\Api\CmsPageUrlInterface;
use Magento\Cms\Model\PageRepository;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * @inheritdoc
 */
class CmsPageUrl implements CmsPageUrlInterface
{
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @param FilterBuilder $filterBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PageRepository $pageRepository
     */
    public function __construct(
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PageRepository $pageRepository
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @inerhitDoc
     */
    public function getCmsPageUrl($url)
    {
        $cmsPaageFilter[] = $this->filterBuilder
            ->setField('identifier')
            ->setConditionType('eq')
            ->setValue($url)
            ->create();
        $cmsSearchCriteria = $this->searchCriteriaBuilder
            ->addFilters($cmsPaageFilter)
            ->create();
        $items = $this->pageRepository->getList($cmsSearchCriteria)->getItems();
        foreach ($items as $item) {
            $id = $item->getId();
        }
        return $this->pageRepository->getById($id);
    }
}
