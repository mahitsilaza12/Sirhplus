<?php

namespace Sirhplus\Api\TypeAbsence\Application\AssignAbsencePlanType;

use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\TypeAbsence;

/**
 * class AssignAbsencePlanType
 */
final class AssignAbsencePlanType implements AssignAbsencePlanTypeInterface
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
        if (!$request->absencePlanId) {
            throw new InvalidValueException();
        }
        
        $this->repository->assignTypeAbsenceByAbsensePlan(TypeAbsenceUuid::fromString($request->getId()), $request->absencePlanId, TypeAbsence::class);
    
        return null;
    }
}