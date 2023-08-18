<?php

namespace Sirhplus\Api\Functions\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

abstract class FunctionRequest extends ValueObject implements Request
{
    /**
     * @param string $uuid
     * @param string $name
     */
    public function __construct(public string $uuid = '', public string $name = '')
    {
    }
}
