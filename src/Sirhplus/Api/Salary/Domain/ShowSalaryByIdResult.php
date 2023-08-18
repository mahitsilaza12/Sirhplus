<?php

namespace Sirhplus\Api\Salary\Domain;

/**
 * class ShowSalaryByIdResult
 */
final class ShowSalaryByIdResult
{
    /**
     * @param object $object
     */
    public function __construct(public object $object)
    {
    }
}
