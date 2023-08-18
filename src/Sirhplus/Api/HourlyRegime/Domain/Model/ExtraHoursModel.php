<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

class ExtraHoursModel extends ValueObject implements Request
{

    /**
     * @param boolean $accountAdditionalHour
     * @param string $frequency
     */
    public function __construct(
        public bool $accountAdditionalHour = false,
        public string $frequency = '',
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            (bool)$request->accountAdditionalHour,
            $request->frequency,
        );
    }
}