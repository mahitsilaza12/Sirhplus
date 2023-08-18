<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByFunction;

use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindSalaryByFunction
 */
final class FindSalaryByFunction implements FindSalaryByFunctionInterface
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
        $result = $this->repository->findSalariesByType(FunctionUuid::fromString($request->uuid), 'function');

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
