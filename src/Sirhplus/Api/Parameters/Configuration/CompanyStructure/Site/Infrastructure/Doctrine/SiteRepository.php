<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\FindSiteResultSet;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\CreateSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Model\EditSiteModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\Repository\SiteRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteNotFound;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\Company;
use Symfony6\Entity\Site;

/**
 * class SiteRepository
 */
final class SiteRepository extends ServiceEntityRepository implements SiteRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Site::class);
    }

    /**
     * @param CreateSiteModel $model
     * @return void
     */
    public function create(CreateSiteModel $model): void
    {
        $company = $this->getCompanyById($model->companyUuid);

        if (!$company) {
            throw new CompanyNotFoundException();
        }

        $site = (new Site())
            ->setName($model->name)
            ->setCompany($company);

        $this->_em->persist($site);
        $this->_em->flush();
    }

    /**
     * @param EditSiteModel $model
     * @throws SiteNotFound
     * @return void
     */
    public function edit(EditSiteModel $model): void
    {
        $site = $this->find($model->uuid);

        if (!$site) {
            throw new SiteNotFound($model->uuid->toRfc4122());
        }

        $site->setName($model->name);
        $this->_em->persist($site);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $companyUuidI
     * @return object
     */
    private function getCompanyById(CompanyUuid $companyUuidI): object
    {
        return $this->_em->find(Company::class, $companyUuidI);
    }

    /**
     * @param SiteUuid $uuid
     * @return FindSiteResultSet
     * @throws SiteNotFound
     */
    public function findById(SiteUuid $uuid): FindSiteResultSet
    {
        return ($site = $this->find($uuid))
            ? new FindSiteResultSet($site)
            : throw new SiteNotFound($uuid->toRfc4122());
    }

    /**
     * @param SiteUuid $uuid
     * @throws SiteNotFound
     */
    public function remove(SiteUuid $uuid): void
    {
        // TODO: Implement remove() method.
        if (!($site = $this->find($uuid))) {
            throw new SiteNotFound($uuid->toRfc4122());
        }

        $this->_em->remove($site);
        $this->_em->flush();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet|ObjectQuery
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet|ObjectQuery
    {
        $alias = $criteria->getAlias();
        $query = $this
            ->createQueryBuilder($alias)
            ->select($select->getFields())
            ->addCriteria($criteria->getCriteria())
            ->innerJoin($alias . '.company', 'c')
            ->where('c.id = :uuid')
            ->setParameter('uuid', $criteria->options['companyUuid'], 'uuid');

        $sites = $query
            ->getQuery()
            ->execute();

        return new ObjectQuery($sites, $this->count([]));
    }
}
