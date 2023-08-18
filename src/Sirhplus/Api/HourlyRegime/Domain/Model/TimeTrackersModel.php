<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class TimeTrackersModel extends ValueObject implements Request
{
       /**
     * @param boolean $calculation
     * @param float $dayCalculation
     * @param boolean $limite
     * @param float $limitDay
     */
    public function __construct(
        public bool $calculation = false,
        public float $dayCalculation = 0,
        public bool $limite = false,
        public float $limitDay = 0,
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            (bool)$request->calculation,
            (float)$request->dayCalculation,
            (bool)$request->limite,
            (float)$request->limitDay,
        );
    }
}