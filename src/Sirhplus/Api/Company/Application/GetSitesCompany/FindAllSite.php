<?php

namespace Sirhplus\Api\Company\Application\GetSitesCompany;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteResultSet;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllSite
 */
final class FindAllSite implements FindAllSiteInterface
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
        $alias = 'site';
        $criteria = new Criteria(
            $request->getFilters(),
            $request->getSort(),
            $request->getPage(),
            $request->getSize(),
            $alias,
            ['companyUuid' => CompanyUuid::fromString($request->uuid)]
        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $query = $this->repository->getMatching($select, $criteria);
        $result = new SiteResultSet($query->getObjects(), $query->getTotal());

        return new SiteResponse(
            $result->getData(),
            $result->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}
