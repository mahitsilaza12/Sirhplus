<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Edit;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\EditSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditSite
 */
final class EditSite implements EditSiteInterface
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
        $this->repository->edit(EditSiteModel::create($request));

        return null;
    }
}
