<?php

namespace Sirhplus\Api\Functions\Application\AddFunction;

use Sirhplus\Api\Functions\Domain\Model\AddFunctionModel;
use Sirhplus\Api\Functions\Domain\Repository\FunctionRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class AddFunction implements AddFunctionInterface
{
    /**
     * @param FunctionRepositoryInterface $repository
     */
    public function __construct(private readonly FunctionRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
        // TODO: Implement execute() method.
        $this->repository->add(AddFunctionModel::create($request));

        return null;
    }
}
