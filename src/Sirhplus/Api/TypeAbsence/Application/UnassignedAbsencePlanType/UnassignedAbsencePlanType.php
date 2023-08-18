<?php

namespace Sirhplus\Api\TypeAbsence\Application\UnassignedAbsencePlanType;

use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class UnassignedAbsencePlanType
 */
final class UnassignedAbsencePlanType implements UnassignedAbsencePlanTypeInterface
{
    /**
     * @param TypeAbsenceRepositoryInterface $repository
     */
    public function __construct(private readonly TypeAbsenceRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        // if (!$request->absencePlanId) {
        //     throw new InvalidValueException();
        // }
        $this->repository->unassignTypeAbsenceByAbsensePlan(TypeAbsenceUuid::fromString($request->getId()), $request->absencePlanId, TypeAbsence::class);
    
        return null;
    }
}