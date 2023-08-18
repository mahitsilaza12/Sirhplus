<?php

namespace Sirhplus\Api\MandatoryBreak\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\MandatoryBreak\Domain\MandatoryBreakNotFoundException;
use Sirhplus\Api\MandatoryBreak\Domain\MandatoryBreakResultSet;
use Sirhplus\Api\MandatoryBreak\Domain\Model\AddMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\Model\EditMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Api\MandatoryBreak\Domain\ShowMandatoryBreakByIdResult;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Domain\Exception\valueErrorNameException;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony6\Entity\HourlyRegime;
use Symfony6\Entity\MandatoryBreak;

/**
 * class MandatoryBreakRepository
 */
final class MandatoryBreakRepository extends ServiceEntityRepository implements MandatoryBreakRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent:: __construct($registry, MandatoryBreak::class);
    }

    /**
     * @param AddMandatoryBreakModel $model
     * @return void
     */
    public function add(AddMandatoryBreakModel $model): void
    {
        $findName =  $this->findOneBy(array('name'=>$model->name));
        if($findName) {
             throw new valueErrorNameException();
        }
        $mandatory = (new MandatoryBreak())
            ->setName($model->name)
            ->setWorkingTimes($model->workingTimes)
            ->setPause($model->pause);
            $this->_em->persist($mandatory);
            $mandatory->setHourlyRegime($this->getHourlyRegimeId(HourlyRegimeUuid::fromString(($model->uuid))));
            $this->_em->flush();
    }

    /**
     * @param integer $id
     * @return ShowMandatoryBreakByIdResult
     * @throws MandatoryBreakNotFoundException
     */
    public function findMandatoryBreakById(HourlyRegimeUuid $uuid): ShowMandatoryBreakByIdResult
    {
        return ($object = $this->find($uuid))
            ? new ShowMandatoryBreakByIdResult($object)
            : throw new MandatoryBreakNotFoundException();   
    }

    /**
     * @param MandatoryBreak $mandatoryBreak
     * @param EditMandatoryBreakModel $model
     * @return void
     */
    public function edit(MandatoryBreak $mandatory, EditMandatoryBreakModel $model): void
    {
        $mandatory 
                ->setName($model->name)
                ->setWorkingTimes($model->workingTimes)
                ->setPause($model->pause);
        $this->_em->persist($mandatory);
        $mandatory->setHourlyRegime($this->getHourlyRegimeId(HourlyRegimeUuid::fromString(($model->uuid))));
        $this->_em->flush();
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function remove(string $uuid): void
    {
        /**
         * @var MandatoryBreak @mandatoryBreak
         */
        if(!($mandatory = $this->find($uuid))) {
            throw new MandatoryBreakNotFoundException();
        }
        $this->_em->remove($mandatory);
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
        $mandatory = $this->createQueryBuilder($criteria->getAlias())
                          ->select($select->getFields())
                          ->addCriteria($criteria->getCriteria())
                          ->getQuery()
                          ->execute();
                          
        return new MandatoryBreakResultSet($mandatory, $this->count([]));
    }

     /**
     * @param HourlyRegimeUuid $uuid
     * @return object
     */
    private function getHourlyRegimeId(HourlyRegimeUuid $uuid): object
    {
        return $this->_em->find(HourlyRegime::class, $uuid);
    }
}