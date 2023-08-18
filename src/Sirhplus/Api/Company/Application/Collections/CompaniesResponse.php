<?php

namespace Sirhplus\Api\Company\Application\Collections;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

/**
 * class CompaniesResponse
 */
final class CompaniesResponse extends AbstractCollectionsResponse
{
    public function __construct(array $data, int $total, int $page, int $size)
    {
        parent::__construct($data, $total, $page, $size);
    }
}
