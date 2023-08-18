<?php

namespace Sirhplus\Api\Company\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyHoldingResultSet;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Model\AbstractCompanyModel;
use Sirhplus\Api\Company\Domain\Model\AddCompanyModel;
use Sirhplus\Api\Company\Domain\Model\CompanySubscriberModel;
use Sirhplus\Api\Company\Domain\Model\EditCompanyModel;
use Sirhplus\Api\Company\Domain\Repository\AssignRepositoryInterface;
use Sirhplus\Api\Company\Domain\Repository\CompanyHoldingRepositoryInterface;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Api\Company\Domain\ShowCompanyByIdResultSet;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Symfony6\Entity\Company;
use Symfony6\Entity\Subscription;
use Symfony6\Entity\User;

/**
 * class CompanyRepository
 */
class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface,
    CompanyHoldingRepositoryInterface, AssignRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @param AddCompanyModel $model
     * @return ShowCompanyByIdResultSet
     */
    public function add(AddCompanyModel $model): ShowCompanyByIdResultSet
    {
        $company = (new Company())
            ->setName($model->general()->name())
            ->setLogo($model->general()->logo())
            ->setLegalStructure($model->general()->legalStructure())
            ->setSocialReason($model->general()->socialReason())
            ->setCreatedAt($model->general()->createdAt())
            ->setSales($model->general()->sales())
            ->setAddress($model->general()->address())
            ->setPostalCode($model->general()->postalCode())
            ->setCity($model->general()->city())
            ->setSite($model->general()->site())
            ->setPhoneNumber($model->general()->phoneNumber())
            ->setLeadingStatus($model->others()->leadingStatus())
            ->setSchedule($model->others()->schedule())
            ->setAssignment($model->others()->assignment())
        ;

        $this->_em->persist($company);
        $this->addIdentificationCompany($company, $model);
        $this->_em->flush();

        return new ShowCompanyByIdResultSet($company);
    }

    /**
     * @param Company $company
     * @param AbstractCompanyModel $model
     * @return void
     */
    private function addIdentificationCompany(Company $company, AbstractCompanyModel $model)
    {
        $identification = $company->getIdentification();
        $identification
            ->setSiren($model->identification()->siren())
            ->setSiret($model->identification()->siret())
            ->setTva($model->identification()->tva())
            ->setRcs($model->identification()->rcs())
            ->setSector($model->identification()->activity()->sector())
            ->setCode($model->identification()->activity()->code())
            ->setDetails($model->identification()->collectiveAgreement()->details())
            ->setIdcc($model->identification()->collectiveAgreement()->idcc())
            ->setProvisioning($model->identification()->organism()->provisioning())
            ->setHealthComplementary($model->identification()->organism()->healthComplementary())
            ->setPensionFund($model->identification()->organism()->pensionFund())
        ;

        $this->_em->persist($identification);
        $company->setIdentification($identification);
        $this->_em->persist($company);
    }

    /**
     * @param CompanyUuid $uuid
     * @return ShowCompanyByIdResultSet
     * @throws CompanyNotFoundException
     */
    public function findCompanyById(CompanyUuid $uuid): ShowCompanyByIdResultSet
    {
        return ($object = $this->find($uuid))
                ? new ShowCompanyByIdResultSet($object)
                : throw new CompanyNotFoundException();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return CompanyResultSet
     * @throws QueryException
     */
    public function getMatching(Select $select, Criteria $criteria): CompanyResultSet
    {
        $companies = $this->createQueryBuilder($criteria->getAlias())
            ->select($select->getFields())
            ->addCriteria($criteria->getCriteria())
            ->getQuery()
            ->execute();

        return new CompanyResultSet($companies, $this->count([]));
    }

    /**
     * @param Company $company
     * @param EditCompanyModel $model
     * @return void
     */
    public function edit(Company $company, EditCompanyModel $model) :void
    {
        $company
            ->setName($model->general()->name())
            ->setLogo($model->general()->logo())
            ->setLegalStructure($model->general()->legalStructure())
            ->setSocialReason($model->general()->socialReason())
            ->setCreatedAt($model->general()->createdAt())
            ->setSales($model->general()->sales())
            ->setAddress($model->general()->address())
            ->setPostalCode($model->general()->postalCode())
            ->setCity($model->general()->city())
            ->setSite($model->general()->site())
            ->setLeadingStatus($model->others()->leadingStatus())
            ->setSchedule($model->others()->schedule())
            ->setAssignment($model->others()->assignment())
        ;

        $this->_em->persist($company);
        $this->addIdentificationCompany($company, $model);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyHoldingResultSet
     */
    public function getHoldingAndFilialByCompanyUuid(CompanyUuid $uuid): CompanyHoldingResultSet
    {
        // TODO: Implement getHoldingAndFilialByCompanyId() method.
        $query = <<<EOF
                WITH RECURSIVE generation AS (
                    SELECT id,
                         name,
                         parent_id,
                         0 AS generation_number
                    FROM company
                    WHERE parent_id IS NULL
                    AND id = ?
                UNION ALL
                    SELECT child.id,
                         child.name,
                         child.parent_id,
                         generation_number+1 AS generation_number
                    FROM company child
                    JOIN generation g
                      ON g.id = child.parent_id
                 
                )
                SELECT  g.id, 
                		g.name,
                		c.id as parent
                FROM generation g
                JOIN company c
                ON g.parent_id = c.id
                ORDER BY generation_number;
        EOF;

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Company::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'name', 'name');
        $rsm->addFieldResult('u', 'parent_id', 'parent_id');

        $query = $this->_em->createNativeQuery($query, $rsm);
        $query->setParameter(1, $uuid, 'uuid');

        return new CompanyHoldingResultSet($query->getResult());
    }

    /**
     * @param CompanyUuid $companyUuid
     * @param UserUuid $userUuid
     * @return void
     * @throws CompanyNotFoundException
     * @throws UserNotFound
     */
    public function assignPropertyToCompany(CompanyUuid $companyUuid, UserUuid $userUuid): void
    {
        if (!($company = $this->find($companyUuid))) {
            throw new CompanyNotFoundException();
        }

        if (!($user = $this->_em->find(User::class, $userUuid))) {
            throw new UserNotFound($userUuid->toRfc4122());
        }

        $company->setProperty($user);
        $this->_em->persist($company);
        $this->_em->flush();
    }

    /**
     * @param Company $company
     * @param CompanySubscriberModel $model
     * @return void
     */
    public function subscriber(Company $company, CompanySubscriberModel $model): void
    {
        $company->setSubscription($this->getSubscriptionById(CompanyUuid::fromString($model->subscriptionUuid)));

        $this->_em->persist($company);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $companyUuid
     * @param UserUuid $userUuid
     * @return void
     * @throws CompanyNotFoundException
     */
    public function unassignedProperty(CompanyUuid $companyUuid, UserUuid $userUuid): void
    {
        if (!($company = $this->findOneBy(['id' => $companyUuid, 'property' => $userUuid]))) {
            throw new CompanyNotFoundException();
        }
        $company->setProperty(null);
        $this->_em->persist($company);
        $this->_em->flush();
    }

    public function updateLogo(CompanyUuid $companyUuid, string $logo): void
    {
        if (!($company = $this->find($companyUuid))) {
            throw new CompanyNotFoundException();
        }
        $company->setLogo($logo);
        $this->_em->persist($company);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $uuid
     * @return object
     */
    private function getSubscriptionById(CompanyUuid $uuid): object
    {
        return $this->_em->find(Subscription::class, $uuid);
    }
}
