<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Create;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\CreateSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CreateSite
 */
final class CreateSite implements CreateSiteInterface
{
    /**
     * @param SiteRepositoryInterface $repository
     */
    public function __construct(private readonly SiteRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->create(CreateSiteModel::create($request));

        return null;
    }
}
