<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Remove;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveSite
 */
final class RemoveSite implements RemoveSiteInterface
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
        $this->repository->remove(SiteUuid::fromString($request->uuid));

        return null;
    }
}
