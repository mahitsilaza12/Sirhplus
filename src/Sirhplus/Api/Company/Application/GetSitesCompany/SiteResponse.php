<?php

namespace Sirhplus\Api\Company\Application\GetSitesCompany;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

/**
 * class SiteResponse
 */
final class SiteResponse extends AbstractCollectionsResponse
{
    /**
     * @param array $data
     * @param int $total
     * @param int $page
     * @param int $size
     */
    public function __construct(array $data, int $total, int $page, int $size)
    {
        parent::__construct($data, $total, $page, $size);
    }
}
