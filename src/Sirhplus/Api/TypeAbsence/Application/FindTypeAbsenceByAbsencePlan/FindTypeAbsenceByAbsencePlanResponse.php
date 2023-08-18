<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceByAbsencePlan;

use Sirhplus\Shared\Service\Response;

/**
 * class FindTypeAbsenceByAbsencePlanResponse
 */
final class FindTypeAbsenceByAbsencePlanResponse implements Response
{
    /** @var array  */
    private array $data = [];

    /**
     * @param object $object
    */
    public function __construct(private readonly object $object)
    {
        $this->data = [];
        $this->mapping();
    }

    /**
     * @param object $object
    * @return array
    */
    public function getContent(): array
    {
        return $this->data;
    }

    private function mapping(): void
    {
        $object = $this->object;
        $this->data = [
            'uuid' => $this->object->getId()->toRfc4122(),
            'typeRights' => $object->getTypeRights(),
            'rights' => $object->getRights(),
            'accumulationPeriod' => $object->getAccumulationPeriod(),
            'rightsRenewalDate' => $object->getRightsRenewalDate(),
            'accumulationFrequency' => $object->getAccumulationFrequency(),
            'consumptionPeriod' => $object->getConsumptionPeriod(),
            'methodOfReduction' => $object->getMethodOfReduction(),
            'absence' => $object->isAbsence(),
            'validation' => $object->isvalidation(),
            'postponement' => $object->getPostponement(),
            'limitPerWeek' => $object->isLimitPerWeek(),
            'restrictionLimitPerWeek' => $object->getRestrictionLimitPerWeek(),
            'absencePlanUuid' => $object->getAbsencePlan()->getId(),
        ];
    }
}