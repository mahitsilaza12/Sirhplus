<?php

namespace Sirhplus\Shared\Domain\Doctrine\Repository;

use Sirhplus\Shared\Domain\ValueObject\Uuid;
/**
 * interface AssignTypeAbsenceByAbsencePlanRepositoryInterface
 */
interface AssignTypeAbsenceByAbsencePlanRepositoryInterface
{
    /**
     * @param Uuid $uuid
     * @param string $absencePlanId
     * @param string $entityClass
     * @return void
     */
    public function assignTypeAbsence(Uuid $uuid, string $absencePlanId, string $entityClass): void;
}