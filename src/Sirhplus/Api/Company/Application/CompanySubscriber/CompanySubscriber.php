<?php

namespace Sirhplus\Api\Company\Application\CompanySubscriber;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Model\CompanySubscriberModel;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CompanySubscriber
 */
final class CompanySubscriber implements CompanySubscriberInterface
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
     */
    public function execute(Request $request): ?Response
    {
        $company = $this->repository->findCompanyById(CompanyUuid::fromString($request->getUuid()))->object;
        $this->repository->subscriber($company, CompanySubscriberModel::create($request));

        return null;
    }
}
