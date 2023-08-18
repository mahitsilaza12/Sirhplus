<?php

namespace Sirhplus\Api\TypeAbsence\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanNotFoundException;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyTypeAbsenceResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\TypeAbsence\Domain\Model\AddTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceByIdModel;
use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Api\TypeAbsence\Domain\ShowTypeAbsenceByIdResult;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceNotFoundException;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceResultSet;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Exception\ObjectNotFound;
use Sirhplus\Shared\Domain\Exception\valueErrorNameException;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\AbsencePlan;
use Symfony6\Entity\Company;
use Symfony6\Entity\TypeAbsence;

/**
 * class TypeAbsenceRepository
 */
final class TypeAbsenceRepository extends ServiceEntityRepository implements TypeAbsenceRepositoryInterface
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAbsence::class);
    }

    /**
     * @param AddTypeAbsenceModel $model
     * @return ShowTypeAbsenceByIdResult
     */
    public function add(AddTypeAbsenceModel $model): ShowTypeAbsenceByIdResult
    {
        $Company = $this->_em->find(Company::class , $model->companyId);
        if(!($Company)) {
            throw new CompanyNotFoundException($$model->companyId);
        } 
        $find =  $this->findOneBy(array('type'=>$model->type, 'company' => $model->companyId));
        if($find) {
             throw new valueErrorNameException();
        }
        $typeAbsence = (new TypeAbsence())
                ->setType($model->type)
                ->setColor($model->color)
                ->setVisibility($model->visibility)
                ->setTypeRights("Accumulation")
                ->setRights(20)
                ->setAccumulationPeriod("janv-dec")
                ->setRightsRenewalDate("1er Janvier")
                ->setAccumulationFrequency("Début d'année d'accumulation")
                ->setConsumptionPeriod("Dans la période actuelle N")
                ->setMethodOfReduction("Basé sur la semaine type")
                ->setAbsence(true)
                ->setValidation(false)
                ->setPostponement("Les employés ne peuvent pas reporter les jours non consommés")
                ->setLimitPerWeek(false)
                ->setRestrictionLimitPerWeek("Jusqu'à 2 jours par semaine")
                ->setProtected(false)
                ;
        $this->_em->persist($typeAbsence);
        $typeAbsence->setCompany($this->getCompanyById(CompanyUuid::fromString($model->companyId)));
        $this->_em->flush();

        return new ShowTypeAbsenceByIdResult($typeAbsence);
    }

    /**
     * @param TypeAbsence $typeAbsence
     * @param EditTypeAbsenceModel $model
     * @return void
     */
    public function edit(TypeAbsence $typeAbsence, EditTypeAbsenceModel $model): void
    {
        $typeAbsence 
                ->setTypeRights($model->typeRights)
                ->setRights($model->rights)
                ->setAccumulationPeriod($model->accumulationPeriod)
                ->setRightsRenewalDate($model->rightsRenewalDate)
                ->setAccumulationFrequency($model->accumulationFrequency)
                ->setConsumptionPeriod($model->consumptionPeriod)
                ->setMethodOfReduction($model->methodOfReduction)
                ->setAbsence($model->absence)
                ->setValidation($model->validation)
                ->setPostponement($model->postponement)
                ->setLimitPerWeek($model->limitPerWeek)
                ->setRestrictionLimitPerWeek($model->restrictionLimitPerWeek);
        $this->_em->persist($typeAbsence);
        $typeAbsence->setAbsencePlan($this->getAbsencePlanById(AbsencePlanUuid::fromString($model->uuid)));
        $this->_em->flush();
    }

    /**
     * @param TypeAbsenceUuid $id
     * @return ShowTypeAbsenceByIdResult
     * @throws TypeAbsenceNotFoundException
     */
    public function findTypeAbsenceById(TypeAbsenceUuid $uuid): ShowTypeAbsenceByIdResult
    {
        return ($object = $this->find($uuid))
        ? new ShowTypeAbsenceByIdResult($object)
        : throw new TypeAbsenceNotFoundException();
    }
    
    /**
     * @param TypeAbsenceUuid $uuid
     * @return ShowTypeAbsenceByIdResult
     */
    public function findTypeAbsenceByAbsencePlan(TypeAbsenceUuid $uuid): ShowTypeAbsenceByIdResult
    {
        return ($object = $this->find($uuid))
        ? new ShowTypeAbsenceByIdResult($object)
        : throw new TypeAbsenceNotFoundException();
    }
    /**
     * @param TypeAbsenceUuid $uuid
     * @return void
     * @throws TypeAbsenceNotFoundException
     */
    public function remove(TypeAbsenceUuid $uuid): void
    {
         /** @var TypeAbsence $typeAbsence */
         if (!($typeAbsence = $this->find($uuid))) {
            throw new TypeAbsenceNotFoundException();
        }

        $this->_em->remove($typeAbsence);
        $this->_em->flush();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet
    {
        $typeAbsence = $this->createQueryBuilder($criteria->getAlias())
                            ->select($select->getFields())
                            ->addCriteria($criteria->getCriteria())
                            ->getQuery()
                            ->execute();

        return new TypeAbsenceResultSet($typeAbsence, $this->count([]));
    }
    
    /**
    * @param AbsencePlanUuid $uuid
    * @return object
    */
    private function getAbsencePlanById(AbsencePlanUuid $uuid): object
    {
        if(!($absencePlan = $this->_em->find(AbsencePlan::class, $uuid))) {
            throw new AbsencePlanNotFoundException($uuid);
        }
        return $absencePlan;
    }

    /**
     * @param TypeAbsence $typeAbsence
     * @param EditTypeAbsenceByIdModel $model
     * @return void
     */
    public function editById(TypeAbsence $typeAbsence, EditTypeAbsenceByIdModel $model): void
    {
        $typeAbsence 
                ->setType($model->type)
                ->setColor($model->color)
                ->setVisibility($model->visibility);
        $this->_em->persist($typeAbsence);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyTypeAbsenceResultSet
     * @throws CompanyNotFoundException
     */
    public function findTypeByCompany(CompanyUuid $uuid): CompanyTypeAbsenceResultSet
    {
        $result = $this->findBy(['company' => $uuid]);

        return new CompanyTypeAbsenceResultSet($result, $this->count([]));
    }
    /**
     * @param CompanyUuid $uuid
     * @return Company
     */
    private function getCompanyById(CompanyUuid $uuid): Company
    {
        return $this->_em->find(Company::class, $uuid);
    }

    /**
     * @param TypeAbsenceUuid $uuid
     * @param string $absencePlanId
     * @param string $entityClass
     * @return void
     */
    public function assignTypeAbsenceByAbsensePlan(TypeAbsenceUuid $uuid, string $absencePlanId, string $entityClass): void
    {
        if (!($object = $this->_em->find($entityClass, $uuid))) {
            throw new ObjectNotFound($uuid, $entityClass);
        }
        if(!($absencePlan = $this->_em->find(AbsencePlan::class, $absencePlanId))) {
            throw new AbsencePlanNotFoundException($absencePlanId);
        }
        $object->setAbsencePlan($absencePlan);
        $this->_em->persist($object);
        $this->_em->flush();
    }

    /**
     * @param TypeAbsenceUuid $uuid
     * @param string $absencePlanId
     * @param string $entityClass
     * @return void
     */
    public function unassignTypeAbsenceByAbsensePlan(TypeAbsenceUuid $uuid, string $absencePlanId, string $entityClass): void
    {
        if (!($object = $this->_em->find(TypeAbsence::class, $uuid))) {
            throw new ObjectNotFound($uuid, $entityClass);
        }
        if(!($absencePlan = $this->_em->find(AbsencePlan::class, $absencePlanId))) {
            throw new AbsencePlanNotFoundException($absencePlanId);
        }
        $object->setAbsencePlan(null);
        $this->_em->persist($object);
        $this->_em->flush();
    }
}