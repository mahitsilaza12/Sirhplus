<?php

namespace Sirhplus\Api\HourlyRegime\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyHourlyRegimeResultSet;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeNotFoundException;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeResultSet;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Model\AddHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\EditHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\ExtraHoursModel;
use Sirhplus\Api\HourlyRegime\Domain\Model\TimeTrackersModel;
use Sirhplus\Api\HourlyRegime\Domain\Repository\AssignSalaryHourlyRepositoryInterface;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Api\HourlyRegime\Domain\ShowHourlyRegimeByIdResult;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UsersSalaryNotFound;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Api\User\Infrastructure\Doctrine\UserRepository;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Exception\ObjectNotFound;
use Sirhplus\Shared\Domain\Exception\valueErrorNameException;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\Company;
use Symfony6\Entity\HourlyRegime;
use Symfony6\Entity\User;

final class HourlyRegimeRepository extends ServiceEntityRepository implements HourlyRegimeRepositoryInterface, AssignSalaryHourlyRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HourlyRegime::class);
    }

    /**
     * @param AddHourlyRegimeModel $model
     * @return ShowHourlyRegimeByIdResult
     */
    public function add(AddHourlyRegimeModel $model): ShowHourlyRegimeByIdResult
    {
        $Company = $this->_em->find(Company::class , $model->additionalHour()->companyId);
        if(!($Company)) {
            throw new CompanyNotFoundException($$model->additionalHour()->companyId);
        } 
        $find =  $this->findOneBy(array('name'=>$model->additionalHour()->name, 'company' => $model->additionalHour()->companyId));
        if($find) {
            throw new valueErrorNameException();
        }
        $hourlyRegime = (new HourlyRegime())
            ->setName($model->additionalHour()->name);
          
        $this->_em->persist($hourlyRegime);
        $hourlyRegime->setCompany($this->getCompanyById(CompanyUuid::fromString($model->additionalHour()->companyId)));
        $this->_em->flush();

        return new ShowHourlyRegimeByIdResult($hourlyRegime);
    }

    /**
     * @param string $uuid
     * @return ShowHourlyRegimeByIdResult
     * @throws HourlyRegimeNotFoundException
     */
    public function findHourlyRegimeById(HourlyRegimeUuid $uuid): ShowHourlyRegimeByIdResult
    {
        return($object = $this->find($uuid))
              ? new ShowHourlyRegimeByIdResult($object)
              : throw new HourlyRegimeNotFoundException();
    }

    /**
     * @param HourlyRegime $hourlyRegime
     * @param EditHourlyRegimeModel $model
     * @return void
     */
    public function edit(HourlyRegime $hourlyRegime,EditHourlyRegimeModel $model): void
    {
            $hourlyRegime 
            ->setName($model->additionalHour()->name);
        $this->_em->persist($hourlyRegime);
        $this->_em->flush();
    }

    /**
     * @param string $uuid
     * @return void
     * @throws HourlyRegimeNotFoundException
     */
    public function remove(HourlyRegimeUuid $uuid): void
    {
        /**
         * @var HourlyRegime @hourlyRegime
         */
        if(!($hourlyRegime = $this->find($uuid))) {
            throw new HourlyRegimeNotFoundException();
        }
        $this->_em->remove($hourlyRegime);
        $this->_em->flush();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function getMapping(Select $select, Criteria $criteria): AbstractResultSet
    {
        $hourlyRegime = $this->createQueryBuilder($criteria->getAlias())
                             ->select($select->getFields())
                             ->addCriteria($criteria->getCriteria())
                             ->getQuery()
                             ->execute();

        return new HourlyRegimeResultSet($hourlyRegime, $this->count([]));
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
     * @param HourlyRegimeUuid $uuid
     * @param array $users
     * @return void
     */
    public function assignSalaryHourlyRegime(HourlyRegimeUuid $uuid, array $users, string $entityClass): void
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
            if(is_a($object, HourlyRegime::class)) {
                $salary->setHourlyRegime($object);
            }
         
            $this->_em->persist($salary);
            $flush = true;
        }
        if($flush) {
            $this->_em->flush();
        }
    }
    
    /**
     * @param HourlyRegimeUuid $uuid
     * @param array $users
     * @param string $entityClass
     * @return void
     */
    public function UnAssignSalaryHourlyRegime(HourlyRegimeUuid $uuid, array $users, string $entityClass): void
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
            if(is_a($object, HourlyRegime::class)) {
                $salary->setHourlyRegime(null);
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
     */
    public function getMappingAssign(Select $select, Criteria $criteria): ObjectQuery
    {
        $alias = $criteria->getAlias();
        $assign = $this->createQueryBuilder($alias)
                          ->select($select->getFields())
                          ->addCriteria($criteria->getCriteria())
                          ->innerJoin($alias. '.company', 'c')
                          ->where('hourlyRegime.id = :uuid')
                          ->setParameter('uuid', $criteria->options['companyUuid'], 'uuid');

        $users = $assign
               ->getQuery()
               ->execute();
        return new ObjectQuery($users, $this->count([]));
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyHourlyRegimeResultSet
     */
    public function findHourlyRegimeByCompanyUuid(CompanyUuid $uuid): CompanyHourlyRegimeResultSet
    {
        $result = $this->createQueryBuilder('o')
                        ->innerJoin('o.company', 'c')
                        ->where('c.id = :uuid')
                        ->setParameter('uuid', $uuid, 'uuid')
                        ->getQuery()
                        ->execute();

        return new CompanyHourlyRegimeResultSet($result, sizeof($result));
    }

    /**
     * @param HourlyRegime $hourlyRegime
     * @param ExtraHoursModel $model
     * @return void
     */
    public function editExtraHours(HourlyRegime $hourlyRegime, ExtraHoursModel $model): void
    {
        $hourlyRegime 
            ->setAccountAdditionalHour($model->accountAdditionalHour)
            ->setFrequency($model->frequency);
        $this->_em->persist($hourlyRegime);
        $this->_em->flush();
    }

    /**
     * @param HourlyRegime $hourlyRegime
     * @param TimeTrackersModel $model
     * @return void
     */
    public function editTimeTrackers(HourlyRegime $hourlyRegime, TimeTrackersModel $model): void
    {
        $hourlyRegime 
        ->setLimite($model->limite)
        ->setLimitDay($model->limitDay)
        ->setCalculation($model->calculation)
        ->setDayCalculation($model->dayCalculation);
        $this->_em->persist($hourlyRegime);
        $this->_em->flush();
    }
}
