<?php

namespace Sirhplus\Api\TypeAbsence\Application\CollectionTypeAbsence;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;

/**
 * class CollectionTypeAbsenceResponse
 */
class CollectionTypeAbsenceResponse extends AbstractCollectionsResponse
{
    /**
     * @param array $data
     * @param integer $total
     * @param integer $page
     * @param integer $size
     */
    public function __construct(array $data, int $total, int $page, int $size)
    {
        parent::__construct($data, $total, $page, $size);
    }
}