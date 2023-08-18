<?php

namespace Sirhplus\Api\Salary\Application\UnassignedFunction;

use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class UnassignedFunction
 */
final class UnassignedFunction implements UnassignedFunctionInterface
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
        $object = is_a($request, UnassignedFunctionRequest::class)
            ? UserUuid::fromString($request->user)
            : null;

        $this->repository->unassigned(FunctionUuid::fromString($request->uuid), $object);

        return null;
    }
}
