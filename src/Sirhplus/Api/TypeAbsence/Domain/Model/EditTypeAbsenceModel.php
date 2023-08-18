<?php

namespace Sirhplus\Api\TypeAbsence\Domain\Model;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class EditTypeAbsenceModel
 */
final class EditTypeAbsenceModel extends TypeAbsenceModel
{
    /**
     * @param boolean $visibility
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
        public string $restrictionLimitPerWeek = '',
        public string $uuid = '',
    ) 
    {
        parent:: __construct(
            $typeRights, $rights, $accumulationPeriod,
            $rightsRenewalDate, $accumulationFrequency, $consumptionPeriod, $methodOfReduction, $absence,
            $validation, $postponement, $limitPerWeek, $restrictionLimitPerWeek, $uuid
        );
    }

    /**
     * @param Request $request
     * @return EditTypeAbsenceModel
     */
    public static function create(Request $request): EditTypeAbsenceModel
    {
        return new self(
            $request->typeRights,
            $request->rights,
            $request->accumulationPeriod,
            $request->rightsRenewalDate,
            $request->accumulationFrequency,
            $request->consumptionPeriod,
            $request->methodOfReduction,
            $request->absence,
            $request->validation,
            $request->postponement,
            $request->limitPerWeek,
            $request->restrictionLimitPerWeek,
            $request->uuid,
        );
    }
}