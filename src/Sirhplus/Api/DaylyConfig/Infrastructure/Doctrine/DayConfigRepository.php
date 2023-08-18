<?php

namespace Sirhplus\Api\DaylyConfig\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\DaylyConfig\Domain\DayConfigNotFoundException;
use Sirhplus\Api\DaylyConfig\Domain\DayConfigResultSet;
use Sirhplus\Api\DaylyConfig\Domain\DayConfigUuid;
use Sirhplus\Api\DaylyConfig\Domain\Model\AddDayConfigModel;
use Sirhplus\Api\DaylyConfig\Domain\Repository\DayConfigRepositoryInterface;
use Sirhplus\Api\DaylyConfig\Domain\ShowDayConfigByIdResult;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\DaylyConfig;
use Symfony6\Entity\HourlyRegime;

/**
 * class DayConfigRepository
 */
final class DayConfigRepository extends ServiceEntityRepository implements DayConfigRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DaylyConfig::class);
    }

    /**
     * @param AddDayConfigModel $model
     * @return void
     */
    public function add(AddDayConfigModel $model): void
    {
        $uuid = $model->uuid;
        if(isset($uuid)){
            $query = $this->createQueryBuilder('d')
            ->delete()
            ->andWhere('d.hourlyRegime = :uuid')
            ->setParameter('uuid', $uuid, 'uuid')
            ->getQuery();
            $query->execute();
        }
        $data = $model->dayConfig;
        foreach($data as $day){
        $dayConfig = (new DaylyConfig());
        $dayConfig->setDay($day['day']);
        $dayConfig->setStartTime($day['startTime']);
        $dayConfig->setEndTIme($day['endTIme']);
        $dayConfig->setStartBreakTime($day['startBreakTime']);
        $dayConfig->setEndBreakTime($day['endBreakTime']);
        $dayConfig->setAgreedWorkingHours($day['agreedWorkingHours']);
        $dayConfig->setType($day['type']);
        $dayConfig->setStatus($day['status']);
        $dayConfig->setHourlyRegime($this->getHourlyRegimeId(HourlyRegimeUuid::fromString(($model->uuid))));
        $this->_em->persist($dayConfig);
        }   
      $this->_em->flush();
    }

     /**
     * @param HourlyRegimeUuid $uuid
     * @return object
     */
    private function getHourlyRegimeId(HourlyRegimeUuid $uuid): object
    {
        return $this->_em->find(HourlyRegime::class, $uuid);
    }

    /**
     * @param HourlyRegimeUuid $uuid
     * @return ShowDayConfigByIdResult
     * @throws DayConfigNotFoundException
     */
    public function findById(HourlyRegimeUuid $uuid): ShowDayConfigByIdResult
    {
        return ($object = $this->_em->find(HourlyRegime::class, $uuid))
            ? new ShowDayConfigByIdResult($object)
            : throw new DayConfigNotFoundException();
    }

        /**
     * @param Select $select
     * @param Criteria $criteria
     * @return ObjectQuery
     */
    public function getMappingDayConfig(Select $select, Criteria $criteria): ObjectQuery
    {
        $alias = $criteria->getAlias();
        $dayConfig = $this->createQueryBuilder($alias)
                          ->select($select->getFields())
                          ->addCriteria($criteria->getCriteria())
                          ->innerJoin($alias. '.hourlyRegime', 'h')
                          ->where('h.id = :uuid')
                          ->setParameter('uuid', $criteria->options['hourlyRegime'], 'uuid');
        // dd($dayConfig);
        $hourlyRegime = $dayConfig
               ->getQuery()
               ->execute();
        return new ObjectQuery($hourlyRegime, $this->count([]));
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     */
    public function getMapping(Select $select, Criteria $criteria): AbstractResultSet
    {
        $dayConfig = $this->createQueryBuilder($criteria->getAlias())
                          ->select($select->getFields())
                          ->addCriteria($criteria->getCriteria())
                          ->getQuery()
                          ->execute();

        return new DayConfigResultSet($dayConfig, $this->count([]));
    }
}