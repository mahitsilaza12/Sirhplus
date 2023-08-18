<?php

namespace Sirhplus\Api\Company\Application\GetHoldingAndFilial;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\CompanyHoldingRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class GetHoldingAndFilialByCompanyId
 */
final class GetHoldingAndFilialByCompanyId implements GetHoldingAndFilialByCompanyIdInterface
{
    /**
     * @param CompanyHoldingRepositoryInterface $repository
     */
    public function __construct(private readonly CompanyHoldingRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
        return new CompaniesHoldingResponse(
            $this->repository->getHoldingAndFilialByCompanyUuid(CompanyUuid::fromString($request->uuid))->data()
        );
    }
}
