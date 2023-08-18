<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceByAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindTypeAbsenceByAbsencePlan
 */
final class FindTypeAbsenceByAbsencePlan implements FindTypeAbsenceByAbsencePlanInterface
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
        return new FindTypeAbsenceByAbsencePlanResponse(
            $this->repository->findTypeAbsenceByAbsencePlan(TypeAbsenceUuid::fromString($request->absenceUuid))->object
        );
    }
}