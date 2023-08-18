<?php

namespace Sirhplus\Api\AbsencePlan\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanNotFoundException;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanResultSet;
use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Model\AddAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\Model\EditAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AssignAbsencePlanRepositoryInterface;
use Sirhplus\Api\AbsencePlan\Domain\ShowAbsencePlanByIdResult;
use Sirhplus\Api\Company\Domain\CompanyAbsencePlanResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UsersSalaryNotFound;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Exception\ObjectNotFound;
use Sirhplus\Shared\Domain\Exception\valueErrorNameException;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\AbsencePlan;
use Symfony6\Entity\Company;
use Symfony6\Entity\User;

/**
 * class AbsencePlanRepository
 */
final class AbsencePlanRepository extends ServiceEntityRepository implements AbsencePlanRepositoryInterface, AssignAbsencePlanRepositoryInterface
{

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbsencePlan::class);
    }

    /**
     * @param AddAbsencePlanModel $model
     * @return void
     */
    public function add(AddAbsencePlanModel $model): void
    {
        $find =  $this->findOneBy(array('name'=>$model->name, 'company' => $model->companyId));
        if($find) {
             throw new valueErrorNameException();
        }
        $absencePlan = (new AbsencePlan())
                    ->setName($model->name);
        $this->_em->persist($absencePlan);
        $absencePlan->setCompany($this->getCompanyById(CompanyUuid::fromString($model->companyId)));
        $this->_em->flush();
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
     * @param AbsencePlan $absencePlan
     * @param EditAbsencePlanModel $model
     * @return void
     */
    public function edit(AbsencePlan $absencePlan, EditAbsencePlanModel $model): void
    {
        $absencePlan
             ->setName($model->name);
        $this->_em->persist($absencePlan);
        $this->_em->flush();
    }

    /**
     * Undocumented function
     *
     * @param AbsencePlanUuid $uuid
     * @return ShowAbsencePlanByIdResult
     * @throws AbsencePlanNotFoundException
     */
    public function findAbsencePlanById(AbsencePlanUuid $uuid): ShowAbsencePlanByIdResult
    {
        return ($object = $this->find($uuid))
        ? new ShowAbsencePlanByIdResult($object)
        : throw new AbsencePlanNotFoundException();
    }

    /**
     * @param AbsencePlanUuid $uuid
     * @return void
     * @throws AbsencePlanNotFoundException
     */
    public function remove(AbsencePlanUuid $uuid): void
    {
         /** @var AbsencePlan $absencePlan */
         if (!($absencePlan = $this->find($uuid))) {
            throw new AbsencePlanNotFoundException();
        }

        $this->_em->remove($absencePlan);
        $this->_em->flush();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet
    {
        $absencePlan = $this->createQueryBuilder($criteria->getAlias())
        ->select($select->getFields())
        ->addCriteria($criteria->getCriteria())
        ->getQuery()
        ->execute();

        return new AbsencePlanResultSet($absencePlan, $this->count([]));
    }

    /**
     * @param AbsencePlanUuid $uuid
     * @param array $users
     * @param string $entityClass
     * @return void
     */
    public function assignSalaryAbsencePlan(AbsencePlanUuid $uuid, array $users, string $entityClass): void
    {
        $flush = false;
        foreach($users as $userId) {
            if(!($object = $this->_em->find($entityClass, $uuid))) {
                throw new ObjectNotFound($uuid[0], $entityClass);
            }
            if(!($user = $this->_em->find(User::class , $userId))) {
                throw new UserNotFound($userId);
            }   
            $salary = $user->getSalary();
            if(is_a($object, AbsencePlan::class)) {
                $salary->setAbsencePlan($object);
            }
         
            $this->_em->persist($salary);
            $flush = true;
        }
        if($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param AbsencePlanUuid $uuid
     * @param array $users
     * @param string $entityClass
     * @return void
     */
    public function UnAssignSalaryAbsencePlan(AbsencePlanUuid $uuid, array $users, string $entityClass): void
    {
         
        $flush = false;
        foreach($users as $userId) {
            if(!($object = $this->_em->find($entityClass, $uuid))) {
                throw new ObjectNotFound($uuid, $entityClass);
            }
          
            if(!($user = $this->_em->find(User::class , $userId))) {
                throw new UserNotFound($userId);
            }   
            $salary = $user->getSalary();
            if(is_a($object, AbsencePlan::class)) {
                $salary->setAbsencePlan(null);
            }
         
            $this->_em->persist($salary);
            $flush = true;
        }
        if($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return ObjectQuery
     */
    public function getMappingAssignAbsencePlan(Select $select, Criteria $criteria): ObjectQuery
    {
        $alias = $criteria->getAlias();
        $assign = $this->createQueryBuilder($alias)
                          ->select($select->getFields())
                          ->addCriteria($criteria->getCriteria())
                          ->innerJoin($alias. '.company', 'c')
                          ->where('absencePlan.id = :uuid')
                          ->setParameter('uuid', $criteria->options['companyUuid'], 'uuid');

        $users = $assign
               ->getQuery()
               ->execute();
        return new ObjectQuery($users, $this->count([]));
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyAbsencePlanResultSet
     */
    public function findAbsencePlanByCompanyUuid(CompanyUuid $uuid): CompanyAbsencePlanResultSet
    {
        $result = $this->findBy(['company' => $uuid]);

        return new CompanyAbsencePlanResultSet($result, $this->count([]));
    }
}