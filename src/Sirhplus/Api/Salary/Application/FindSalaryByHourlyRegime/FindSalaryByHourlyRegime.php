<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindSalaryByHourlyRegime
 */
final class FindSalaryByHourlyRegime implements FindSalaryByHourlyRegimeInterface
{
    /**
     * @param SalaryRepositoryInterface $repository
     */
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findSalariesByType(HourlyRegimeUuid::fromString($request->uuid), 'hourlyRegime');

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}