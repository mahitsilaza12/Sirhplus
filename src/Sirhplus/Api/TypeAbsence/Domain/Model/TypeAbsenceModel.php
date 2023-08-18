<?php

namespace Sirhplus\Api\TypeAbsence\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class TypeAbsenceModel
 */
abstract class TypeAbsenceModel  extends ValueObject implements Request
{

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
    ) {
    }

    /**
     * @param Request $request
     * @return TypeAbsenceModel
     */
    public abstract static function create(Request $request): TypeAbsenceModel;
}