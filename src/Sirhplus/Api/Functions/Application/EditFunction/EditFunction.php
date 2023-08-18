<?php

namespace Sirhplus\Api\Functions\Application\EditFunction;

use Sirhplus\Api\Functions\Domain\Model\EditFunctionModel;
use Sirhplus\Api\Functions\Domain\Repository\FunctionRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditFunction
 */
final class EditFunction implements EditFunctionInterface
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
        // TODO: Implement execute() method.
        $this->repository->edit(EditFunctionModel::create($request));

        return null;
    }
}
