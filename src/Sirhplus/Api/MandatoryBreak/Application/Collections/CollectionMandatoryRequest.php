<?php

namespace Sirhplus\Api\MandatoryBreak\Application\Collections;

use Sirhplus\Shared\Service\Request;

final class CollectionMandatoryRequest implements Request
{
     /**
     * @param int $hourlyRegimeId
     */
    public function __construct(public int $hourlyRegimeId = 0)
    {
    }

    /**
     * @param integer $hourlyRegimeId
     * @return CollectionMandatoryRequest
     */
    public function sethourlyRegimeId(int $hourlyRegimeId): CollectionMandatoryRequest
    {
        $this->hourlyRegimeId = $hourlyRegimeId;

        return $this;
    }
}