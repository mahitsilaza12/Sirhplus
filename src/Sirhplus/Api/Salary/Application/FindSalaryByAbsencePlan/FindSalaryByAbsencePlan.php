<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindSalaryByAbsencePlan
 */
final class FindSalaryByAbsencePlan implements FindSalaryByAbsencePlanInterface
{
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findSalariesByType(AbsencePlanUuid::fromString($request->uuid), 'absencePlan');

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}