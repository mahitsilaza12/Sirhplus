<?php

namespace Sirhplus\Api\User\Domain\Repository;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\UserModel;
use Sirhplus\Api\User\Domain\UserResultSet;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Domain\Query\ObjectQuery;
use Sirhplus\Shared\Domain\ResultSet\AbstractResultSet;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface
{
    public const DEFAULT_PASSWORD = '123456789';

    /**
     * @param UserModel $model
     * @return UserInterface
     */
    public function add(UserModel $model): UserInterface;

    /**
     * @param UserInterface $user
     * @return void
     */
    public function save(UserInterface $user): void;

    /**
     * @param Select $select
     * @param Criteria $criteria
     * @return AbstractResultSet|ObjectQuery
     */
    public function getMatching(Select $select, Criteria $criteria): AbstractResultSet|ObjectQuery;

    /**
     * Retrieve all user do not have a user role
     * @param CompanyUuid $uuid
     * @return UserResultSet
     */
    public function getUsersNotSupAdmin(CompanyUuid $uuid): UserResultSet;

    /**
     * @param CompanyUuid $uuid
     * @param string $role
     * @return UserResultSet
     */
    public function getUsersAdmin(CompanyUuid $uuid, string $role): UserResultSet;

    /**
     * @param CompanyUuid $companyUuid
     * @param array $usersUuid
     * @return void
     */
    public function unassigned(CompanyUuid $companyUuid, array $usersUuid): void;
}
