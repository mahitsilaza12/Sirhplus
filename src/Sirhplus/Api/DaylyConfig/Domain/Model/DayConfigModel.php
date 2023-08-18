<?php

namespace Sirhplus\Api\DaylyConfig\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class DayConfigModel
 */
abstract class DayConfigModel extends ValueObject implements Request
{
    /**
     * @param array $dayConfig
     * @param string $uuid
     */
    public function __construct( public array $dayConfig = [], public string $uuid = ''
    ) {
    }

    /**
     * @param Request $request
     * @return DayConfigModel
     */
    public abstract static function create(Request $request): DayConfigModel;
}