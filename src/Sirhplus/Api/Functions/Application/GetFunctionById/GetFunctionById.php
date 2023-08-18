<?php

namespace Sirhplus\Api\Functions\Application\GetFunctionById;

use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Functions\Domain\Repository\FunctionRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 *
 */
final class GetFunctionById implements GetFunctionByIdInterface
{
    /**
     * @param FunctionRepositoryInterface $repository
     */
    public function __construct(private readonly FunctionRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findById(FunctionUuid::fromString($request->uuid))->object;

        return new GetFunctionByIdResponse($result);
    }
}
