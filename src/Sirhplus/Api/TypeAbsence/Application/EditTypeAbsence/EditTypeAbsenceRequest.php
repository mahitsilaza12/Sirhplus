<?php

namespace Sirhplus\Api\TypeAbsence\Application\EditTypeAbsence;

use Sirhplus\Api\TypeAbsence\Application\TypeAbsenceRequest;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class EditTypeAbsenceRequest
 */
final class EditTypeAbsenceRequest extends ValueObject implements Request
{
    /**
     * @var string
     */
    public string $uuid;
    public string $absenceUuid;
    
   /**
     * @param string $typeRights
     * @param integer $rights
     * @param string $accumulationPeriod
     * @param string $rightsRenewalDate
     * @param string $accumulationFrequency
     * @param string $consumptionPeriod
     * @param string $methodOfReduction
     * @param boolean $absence
     * @param boolean $validation
     * @param string $postponement
     * @param boolean $limitPerWeek
     * @param string $absenceUuid
     * 
     */
    public function __construct(
        public string $typeRights = '',
        public float $rights = 0,
        public string $accumulationPeriod = '',
        public string $rightsRenewalDate = '',
        public string $accumulationFrequency = '',
        public string $consumptionPeriod = '',
        public string $methodOfReduction = '',
        public bool $absence = false,
        public bool $validation = false,
        public string $postponement = '',
        public bool $limitPerWeek = false,
        string $absenceUuid = null,
        public string $restrictionLimitPerWeek = '',

    ) 
    {
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
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->absenceUuid;
    }

    /**
     * @param string $absenceUuid  
     * @return self
     */
    public function setid(string $absenceUuid): self
    {
        $this->absenceUuid = $absenceUuid;

        return $this;
    }
}