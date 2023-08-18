<?php

namespace Sirhplus\Api\DaylyConfig\Domain;

/**
 * class ShowDayConfigByIdResult
 */
final class ShowDayConfigByIdResult
{
    /**
     * @param object $object
     */
    public function __construct(public object $object)
    {
    }
}