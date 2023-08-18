<?php

namespace Sirhplus\Api\AbsencePlan\Application\UnAssignedAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AssignAbsencePlanRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\AbsencePlan;

/**
 * class UnAssignedAbsencePlan
 */
final class UnAssignedAbsencePlan implements UnAssignedAbsencePlanInterface
{
    /**
     * @param AssignAbsencePlanRepositoryInterface $repository
     */
    public function __construct(private readonly AssignAbsencePlanRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->UnAssignSalaryAbsencePlan(AbsencePlanUuid::fromString($request->getUuid()), $request->users, AbsencePlan::class);

        return null;
    }
}