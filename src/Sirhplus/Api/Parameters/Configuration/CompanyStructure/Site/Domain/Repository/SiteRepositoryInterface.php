<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\FindSiteResultSet;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\CreateSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\EditSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteNotFound;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;

/**
 * interface SiteRepositoryInterface
 */
interface SiteRepositoryInterface
{
    /**
     * @param CreateSiteModel $model
     * @return void
     */
    public function create(CreateSiteModel $model): void;

    /**
     * @param EditSiteModel $model
     * @throws SiteNotFound
     * @return void
     */
    public function edit(EditSiteModel $model): void;

    /**
     * @param SiteUuid $uuid
     * @return FindSiteResultSet
     * @throws SiteNotFound
     */
    public function findById(SiteUuid $uuid): FindSiteResultSet;

    /**
     * @param SiteUuid $uuid
     * @throws SiteNotFound
     */
    public function remove(SiteUuid $uuid): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet|ObjectQuery
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet|ObjectQuery;
}
