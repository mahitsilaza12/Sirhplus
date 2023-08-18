<?php

namespace Sirhplus\Api\User\Application\Add;

use Sirhplus\Api\User\Domain\UserModel;
use Symfony\Component\Security\Core\User\UserInterface;

interface AddUserInterface
{
    /**
     * @param UserModel $model
     * @return User
     */
    public function add(UserModel $model): UserInterface;
}
