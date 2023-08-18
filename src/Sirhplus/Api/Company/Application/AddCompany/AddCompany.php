<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Api\Company\Domain\Model\AddCompanyModel;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\ApplicationService;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AddCompany
 */
final class AddCompany implements AddCompanyInterface
{
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
        $result = $this->repository->add(AddCompanyModel::create($request));

        return new AddCompanyResponse($result->object);
    }
}
