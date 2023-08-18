<?php

namespace Sirhplus\Api\Company\Application\FindCompanyById;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindCompanyById
 */
final class FindCompanyById implements FindCompanyByIdInterface
{
    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
        return new ShowCompanyByIdResponse(
            $this->repository->findCompanyById(CompanyUuid::fromString($request->uuid))->object
        );
    }
}
