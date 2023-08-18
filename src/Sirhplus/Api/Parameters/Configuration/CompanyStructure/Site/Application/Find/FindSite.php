<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Find;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FindSite implements FindSiteInterface
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
        return new FindSiteResponse(
            $this->repository->findById(SiteUuid::fromString($request->uuid))->object
        );
    }
}
