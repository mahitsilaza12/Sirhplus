<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyTeamResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\FindTeamResultSet;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\CreateTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\EditTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\AssignTeamManagerInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\TeamRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\UnassignedTeamRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamNotFound;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Shared\Service\RoleManagerInterface;
use Symfony6\Entity\Company;
use Symfony6\Entity\Salary;
use Symfony6\Entity\Team;
use Symfony6\Entity\User;

/**
 * class TeamRepository
 */
final class TeamRepository extends ServiceEntityRepository implements TeamRepositoryInterface, AssignTeamManagerInterface,
    UnassignedTeamRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    /**
     * @param CreateTeamModel $model
     * @throws CompanyNotFoundException
     * @return void
     */
    public function create(CreateTeamModel $model): void
    {
        if (!($company = $this->getCompanyByUuid($model->companyUuid))) {
            throw new CompanyNotFoundException();
        }

        $team = (new Team())
            ->setCompany($company)
            ->setName($model->name);

        $this->_em->persist($team);
        $this->_em->flush();
    }

    /**
     * @param EditTeamModel $model
     * @return void
     */
    public function edit(EditTeamModel $model): void
    {
        if (!($team = $this->find($model->uuid))) {
            throw new TeamNotFound($model->uuid);
        }

        $team->setName($model->name);
        $this->_em->persist($team);
        $this->_em->flush();
    }

    /**
     * @param TeamUuid $uuid
     * @return void
     * @throws TeamNotFound
     */
    public function remove(TeamUuid $uuid): void
    {
        if (!($team = $this->find($uuid))) {
            throw new TeamNotFound($uuid);
        }
        $this->_em->remove($team);
        $this->_em->flush();
    }

    /**
     * @param TeamUuid $uuid
     * @return FindTeamResultSet
     * @throws TeamNotFound
     */
    public function findByUuid(TeamUuid $uuid): FindTeamResultSet
    {
        return ($object = $this->find($uuid))
            ? new FindTeamResultSet($object)
            : throw new TeamNotFound($uuid->toRfc4122());
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyTeamResultSet
     */
    public function findTeamByCompanyUuid(CompanyUuid $uuid): CompanyTeamResultSet
    {
        $result = $this->findBy(['company' => $uuid]);

        return new CompanyTeamResultSet($result, $this->count([]));
    }

    /**
     * @param array $users
     * @return void
     */
    public function assign(array $users = []): void
    {
        foreach ($users as $value) {
            /** @var User $user */
            if (!($user = $this->_em->find(User::class, $value))) {
                throw new UserNotFound($value);
            }
            $user->setRoles([RoleManagerInterface::ROLE_TEAM_RESPONSIBILITY]);
            $this->_em->persist($user);
        }
        $this->_em->flush();
    }

    /**
     * @param Salary $salary
     * @return void
     * @throws TeamNotFound
     */
    public function unassigned(Salary $salary): void
    {
        $salary->setTeam(null);
        $users = $salary->getUser();

        foreach ($users as $user) {
            $user->setRoles([RoleManagerInterface::ROLE_USER]);
            $this->_em->persist($user);
        }

        $this->_em->persist($salary);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $uuid
     * @return Company|null
     */
    private function getCompanyByUuid(CompanyUuid $uuid): ?Company
    {
        return $this->_em->find(Company::class, $uuid);
    }
}
