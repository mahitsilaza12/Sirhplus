<?php

namespace Sirhplus\Api\User\Infrastructure\Doctrine;

use Doctrine\ORM\Query\QueryException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\FindManagerRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\User\Domain\UserModel;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Api\User\Domain\FindUserByEmail\FindUserByEmailInterface;
use Sirhplus\Api\User\Domain\Repository\AssignRepositoryInterface;
use Sirhplus\Api\User\Domain\Repository\SearchUserSalaryRepositoryInterface;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Api\User\Domain\UsersSalaryNotFound;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UserResultSet;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Exception\ObjectNotFound;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\Query\QueryParams;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Sirhplus\Shared\Domain\ValueObject\Uuid;
use Sirhplus\Shared\Service\RoleManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony6\Entity\Company;
use Symfony6\Entity\Salary;
use Symfony6\Entity\User;

/**
 * class UserRepository
 */
final class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, FindUserByEmailInterface,
    AssignRepositoryInterface, AssignSalaryRepositoryInterface, SearchUserSalaryRepositoryInterface, FindManagerRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry, private readonly UserPasswordHasherInterface $hasher)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param UserModel $model
     * @return UserInterface
     */
    public function add(UserModel $model): UserInterface
    {
        if (!($company = $this->_em->find(Company::class, $model->getCompanyUuid()))) {
            throw new CompanyNotFoundException();
        }

        $user = (new User())
            ->setCompany($company)
            ->setFirstName($model->getFirstName())
            ->setLastName($model->getLastName())
            ->setEmail($model->getEmail())
            ->setSex($model->getSex())
            ->setPhoneNumber($model->getPhoneNumber())
            ->setRoles([RoleManagerInterface::ROLE_USER])
            ->setDateOfBirth($model->getDob());
        $password = $this->hasher->hashPassword($user, $this::DEFAULT_PASSWORD);
        $user->setPassword($password);
        $this->save($user);

        return $user;
    }

    /**
     * @param string $email
     * @return null|UserInterface
     */
    public function findUserByEmail(string $email): ?UserInterface
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param UserInterface $user
     * @return void
     */
    public function save(UserInterface $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return ObjectQuery
     * @throws QueryException
     * @throws UsersSalaryNotFound
     */
    public function getMatching(Select $select, Criteria $criteria): ObjectQuery
    {
        $alias = $criteria->getAlias();
        $query = $this
                ->createQueryBuilder($alias)
                ->select($select->getFields())
                ->addCriteria($criteria->getCriteria())
                ->innerJoin($alias . '.company', 'c')
                ->where('c.id = :uuid')
                ->setParameter('uuid', $criteria->options['companyUuid'], 'uuid');

        $users = $query
                ->getQuery()
                ->execute();

        return new ObjectQuery($users, $this->count([]));
    }

    /**
     * @param CompanyUuid $uuid
     * @param array|null $users
     * @return void
     * @throws UserNotFound
     */
    public function assignAdminToCompany(CompanyUuid $uuid, ?array $users = []): void
    {
        foreach ($users as $user) {
            /** @var User $object */
            if (!($object = $this->findOneBy(['id' => $user, 'company' => $uuid]))) {
                throw new UserNotFound($user);
            }

            $object->setRoles([RoleManagerInterface::ROLE_ADMIN]);
            $this->_em->persist($object);
        }
        $this->_em->flush();
    }

    /**
     * @param Uuid $uuid
     * @param array $salaries
     * @param string $entityClass
     * @return void
     * @throws \ReflectionException
     */
    public function assign(Uuid $uuid, array $salaries, string $entityClass): void
    {
        $reflect = new \ReflectionClass($entityClass);
        $shortName = sprintf('set%s', $reflect->getShortName());

        /** @var Salary $salary */
        $flush = false;
        foreach ($salaries as $value) {
            if (!($object = $this->_em->find($entityClass, $uuid))) {
                throw new ObjectNotFound($uuid, $entityClass);
            }
            
            if (!($salary = $this->_em->find(Salary::class, $value))) {
                throw new UserNotFound($value);
            }
            $salary->$shortName($object);

            $this->_em->persist($salary);
            $flush = true;
        }

        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param QueryParams $query
     * @return AbstractResultSet
     */
    public function search(QueryParams $query): AbstractResultSet
    {
        // TODO: Implement search() method.
        $results = $this->createQueryBuilder('o')
            ->where($query->getPredicates())
            ->setParameters($query->getParameters())
            ->getQuery()
            ->execute();

        return new UserResultSet($results, $this->count([]));
    }

    /**
     * Retrieve all user don't have a user role
     * @param CompanyUuid $uuid
     * @return UserResultSet
     */
    public function getUsersNotSupAdmin(CompanyUuid $uuid): UserResultSet
    {
        $query = <<<EOF
            select id, last_name, first_name, responsibility, email, roles
                     from user u
                     WHERE u.company_id = ? AND (JSON_CONTAINS(u.roles, '["ROLE_ADMIN"]') 
                     OR JSON_CONTAINS(u.roles, '["ROLE_TEAM_RESPONSIBILITY"]') 
                     OR JSON_CONTAINS(u.roles, '["ROLE_USER"]'))
        EOF;

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(User::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'last_name', 'lastName');
        $rsm->addFieldResult('u', 'first_name', 'firstName');
        $rsm->addFieldResult('u', 'responsibility', 'responsibility');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'roles', 'roles');

        $query = $this->_em->createNativeQuery($query, $rsm);
        $query->setParameter(1, $uuid, 'uuid');

        return new UserResultSet($query->getResult(), 0);
    }

    /**
     * @param TeamUuid $uuid
     * @return UserResultSet|null
     */
    public function findTeamManagers(TeamUuid $uuid): ?UserResultSet
    {
        $query = <<<EOF
            select u.id, u.last_name, u.first_name, u.responsibility, u.email, u.roles
                     from user u inner join salary s on s.id = u.salary_id
                     inner join team t on t.id = s.team_id
                     WHERE t.id = ? AND (JSON_CONTAINS(u.roles, '["ROLE_TEAM_RESPONSIBILITY"]'))
        EOF;

        $rsm = new ResultSetMapping();
        $this->setResultSetMapping($rsm);
        $query = $this->_em->createNativeQuery($query, $rsm);
        $query->setParameter(1, $uuid, 'uuid');

        return new UserResultSet($query->getResult(), 0);
    }

    /**
     * @param CompanyUuid $companyUuid
     * @param array $usersUuid
     * @return void
     */
    public function unassigned(CompanyUuid $companyUuid, array $usersUuid): void
    {
        foreach ($usersUuid as $userUuid) {
            if (!($user = $this->findOneBy(['id' => $userUuid, 'company' => $companyUuid]))) {
                throw new UserNotFound($userUuid->toRfc4122());
            }
            $user->setRoles([RoleManagerInterface::ROLE_USER]);
            $this->save($user);
        }
    }

    public function getUsersAdmin(CompanyUuid $uuid, string $role): UserResultSet
    {
        $query = <<<EOF
            select id, last_name, first_name, responsibility, email, roles
                     from user u
                     WHERE u.company_id = ? AND (JSON_CONTAINS(u.roles, '["{$role}"]'))
        EOF;

        $rsm = new ResultSetMapping();
        $this->setResultSetMapping($rsm);
        $query = $this->_em->createNativeQuery($query, $rsm);
        $query->setParameter(1, $uuid, 'uuid');

        return new UserResultSet($query->getResult(), 0);
    }

    private function setResultSetMapping(ResultSetMapping $rsm): void
    {
        $rsm->addEntityResult(User::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'last_name', 'lastName');
        $rsm->addFieldResult('u', 'first_name', 'firstName');
        $rsm->addFieldResult('u', 'responsibility', 'responsibility');
        $rsm->addFieldResult('u', 'email', 'email');
        $rsm->addFieldResult('u', 'roles', 'roles');
    }
}
