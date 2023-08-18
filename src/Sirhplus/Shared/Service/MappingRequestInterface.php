<?php

namespace Sirhplus\Shared\Service;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;

/**
 * interface MappingRequestInterface
 */
interface MappingRequestInterface
{
    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject;
}
