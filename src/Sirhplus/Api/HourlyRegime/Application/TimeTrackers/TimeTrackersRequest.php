<?php

namespace Sirhplus\Api\HourlyRegime\Application\TimeTrackers;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class TimeTrackersRequest
 */
final class TimeTrackersRequest extends ValueObject implements Request
{
    /**
     * @var string
     */
    private string $uuid;

    /**
     * @param boolean $calculation
     * @param integer $dayCalculation
     * @param boolean $limite
     * @param integer $limitDay
     */
    public function __construct(
        public bool $calculation = false,
        public int $dayCalculation = 0,
        public bool $limite = false,
        public int $limitDay = 0,
    ) {
    }  
    
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return TimeTrackersRequest
     */
    public function setId(string $uuid): TimeTrackersRequest
    {
        $this->uuid = $uuid;

        return $this;
    } 
}