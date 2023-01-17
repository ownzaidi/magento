<?php
declare(strict_types=1);

namespace Falcon\Cms\Api;

/**
 * Interface
 *
 * Interface providing cms page
 *
 * @api
 */
interface CmsPageUrlInterface
{
    /**
     *
     * @param string $url
     * @return \Magento\Cms\Api\Data\PageInterface
     * @throws \Magento\Framework\Exception\AuthenticationException
     */
    public function getCmsPageUrl($url);

}
