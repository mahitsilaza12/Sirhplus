<?php

namespace Sirhplus\Api\MandatoryBreak\Application\Collections;

use Sirhplus\Shared\Domain\ResultSet\AbstractCollectionsResponse;
/**
 * class MandatoryBreakResponse
 */
class MandatoryBreakResponse extends AbstractCollectionsResponse
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