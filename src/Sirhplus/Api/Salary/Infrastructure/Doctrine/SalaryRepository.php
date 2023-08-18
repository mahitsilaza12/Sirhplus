<?php

namespace Sirhplus\Api\Salary\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\Salary\Domain\Model\AddSalaryModel;
use Sirhplus\Api\Salary\Domain\Model\EditSalaryModel;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\Salary\Domain\SalaryNotFoundException;
use Sirhplus\Api\Salary\Domain\SalaryResultSet;
use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Api\Salary\Domain\ShowSalaryByIdResult;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Sirhplus\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony6\Entity\AbsencePlan;
use Symfony6\Entity\Crew;
use Symfony6\Entity\Functions;
use Symfony6\Entity\HourlyRegime;
use Symfony6\Entity\Salary;
use Symfony6\Entity\Site;
use Symfony6\Entity\User;

/**
 * class SalaryRepository
 */
final class SalaryRepository  extends ServiceEntityRepository implements SalaryRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct( $registry, Salary::class);
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet
    {
        $salary = $this->createQueryBuilder($criteria->getAlias())
                       ->select($select->getFields())
                       ->addCriteria($criteria->getCriteria())
                       ->getQuery()
                       ->execute();

        return new SalaryResultSet($salary, $this->count([]));
    }

    /**
     * @param AddSalaryModel $model
     * @return void
     */
    public function add(AddSalaryModel $model, UserInterface $user): void
    {
        $salary = (new Salary())
            ->setHiringDate($model->salary()->hiringDate())
            ->setStatus(true);

        $this->_em->persist($salary);
        $user->setSalary($salary);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param Salary $salary
     * @param EditSalaryModel $model
     * @return void
     */
    public function edit(Salary $salary, EditSalaryModel $model): void
    {
        $salary->setHiringDate($model->salary()->hiringDate());

        $this->_em->persist($salary);
        $this->_em->flush();
    }

    /**
     *
     * @param SalaryUuid $uuid
     * @return ShowSalaryByIdResult
     * @throws SalaryNotFoundException
     */
    public function findSalaryById(SalaryUuid $uuid): ShowSalaryByIdResult
    {
        return ($object = $this->find($uuid))
            ? new ShowSalaryByIdResult($object)
            : throw new SalaryNotFoundException();
    }

    /**
     * @param FunctionUuid $uuid
     * @param UserUuid|null $userUuid
     * @return void
     */
    public function unassigned(FunctionUuid $uuid, ?UserUuid $userUuid = null): void
    {
        if (null !== $userUuid) {
            $this->unassignedUserFunction($userUuid);
            return;
        }
        $result = $this->findBy(['function' => $uuid]);

        if ($result) {
            foreach ($result as $value) {
                $value->setFunction(null);
                $this->_em->persist($value);
            }
            $this->_em->flush();
        }
    }

    /**
     * @param TeamUuid $teamUuid
     * @param UserUuid $userUuid
     * @return Salary
     */
    public function findSalaryByTeamUuid(TeamUuid $teamUuid, UserUuid $userUuid): Salary
    {
        $user = $this->_em->find(User::class, $userUuid);
        $salary = $user->getSalary();

        return $this->findOneBy(['id' => $salary->getId(), 'team' => $teamUuid]);
    }

    /**
     * @param SalaryUuid $uuid
     * @param string $logo
     * @return void
     */
    public function updateLogo(SalaryUuid $uuid, string $logo): void
    {
        if (!($salary = $this->find($uuid))) {
            throw new SalaryNotFoundException();
        }
        $salary->setLogo($logo);
        $this->_em->persist($salary);
        $this->_em->flush();
    }

    /**
     * Find salaries by type. eg: site|team|etc
     * @param Uuid $uuid
     * @param string $type
     * @return SalaryResultSet|null
     */
    public function findSalariesByType(Uuid $uuid, string $type): ?SalaryResultSet
    {
        $result = $this->findBy([$type => $uuid]);

        return $result ? new SalaryResultSet($result, \count($result)) : null;
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getUserById(int $id): object
    {
        return $this->_em->find(User::class, $id);
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getSiteById(int $id): object
    {
        return $this->_em->find(Site::class, $id);
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getAbsencePlanById(int $id): object
    {
        return $this->_em->find(AbsencePlan::class, $id);
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getCrewById(int $id): object
    {
        return $this->_em->find(Crew::class, $id);
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getFunctionsById(int $id): object
    {
        return $this->_em->find(Functions::class, $id);
    }

    /**
     * @param integer $id
     * @return object
     */
    private function getHourlyRegimeById(int $id): object
    {
        return $this->_em->find(HourlyRegime::class, $id);
    }

    /**
     * @param UserUuid $userUuid
     * @return void
     */
    private function unassignedUserFunction(UserUuid $userUuid): void
    {
        $result = $this->_em->find(User::class, $userUuid);
        $salary = $result->getSalary();
        $salary->setFunction(null);

        $this->_em->persist($salary);
        $this->_em->flush();
    }
}
