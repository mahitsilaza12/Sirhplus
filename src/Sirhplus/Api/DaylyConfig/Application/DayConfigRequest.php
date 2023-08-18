<?php

namespace Sirhplus\Api\DaylyConfig\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

abstract class DayConfigRequest extends ValueObject implements Request
{
    /**
     * @param array $dayConfig
     * @param string $uuid
     */
    public function __construct(
        public array $dayConfig = [],
        string $uuid = null
    ) {
    }
}