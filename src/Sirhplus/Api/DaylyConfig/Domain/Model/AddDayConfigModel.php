<?php

namespace Sirhplus\Api\DaylyConfig\Domain\Model;

use Sirhplus\Shared\Service\Request;

/**
 * class AddDayConfigModel
 */
final class AddDayConfigModel extends DayConfigModel
{
    /**
     * @param array $dayConfig
     * @param string $uuid
     */
    public function __construct(public array $dayConfig = [], public string $uuid = ''
    ) {
        parent:: __construct($dayConfig, $uuid);
    }

    /**
     * @param Request $request
     * @return DayConfigModel
     */
    public static function create(Request $request): DayConfigModel
    {
        return new self($request->dayConfig, $request->uuid);
    }
}