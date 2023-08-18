<?php

namespace Sirhplus\Api\Company\Application\EditCompany;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Model\EditCompanyModel;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\ApplicationService;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditCompany
 */
final class EditCompany implements ApplicationService
{
    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     * @throws \Exception
     */
    public function execute(Request $request): ?Response
    {
        $company = $this->repository->findCompanyById(CompanyUuid::fromString($request->getUuid()))->object;
        $this->repository->edit($company, EditCompanyModel::create($request));

        return null;
    }
}
