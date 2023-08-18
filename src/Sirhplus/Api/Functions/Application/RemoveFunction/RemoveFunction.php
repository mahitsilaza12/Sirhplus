<?php

namespace Sirhplus\Api\Functions\Application\RemoveFunction;

use Sirhplus\Api\Functions\Domain\FunctionNotFound;
use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Functions\Domain\Repository\FunctionRepositoryInterface;
use Sirhplus\Api\Salary\Application\UnassignedFunction\UnassignedFunctionInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveFunction
 */
final class RemoveFunction implements RemoveFunctionInterface
{
    /**
     * @param FunctionRepositoryInterface $repository
     * @param UnassignedFunctionInterface $service
     */
    public function __construct(
        private readonly FunctionRepositoryInterface $repository,
        private readonly UnassignedFunctionInterface $service
    ) {
    }

    /**
     * @param Request $request
     * @return Response|null
     * @throws FunctionNotFound
     */
    public function execute(Request $request): ?Response
    {
        $this->service->execute($request);
        $this->repository->remove(FunctionUuid::fromString($request->uuid));

        return null;
    }
}
