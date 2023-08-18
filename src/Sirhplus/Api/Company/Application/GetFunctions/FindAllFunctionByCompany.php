<?php

namespace Sirhplus\Api\Company\Application\GetFunctions;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Functions\Domain\Repository\FindFunctionByCompanyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllFunctionByCompany
 */
final class FindAllFunctionByCompany implements FindAllFunctionByCompanyInterface
{
    /**
     * @param FindFunctionByCompanyRepositoryInterface $repository
     */
    public function __construct(private readonly FindFunctionByCompanyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findFunctionByCompany(CompanyUuid::fromString($request->uuid));

        return new FunctionsResponse(
            $result->getData(),
            $result->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}
