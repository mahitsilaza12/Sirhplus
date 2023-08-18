<?php

namespace Sirhplus\Api\AbsencePlan\Domain;

final class ShowAbsencePlanByIdResult
{
    /**
     * @param object $object
     */
    public function __construct(public object $object)
    {
    }
}
