<?php

namespace Sirhplus\Api\User\Application\ResetPassword;

use Sirhplus\Api\User\Domain\FindUserByEmail\FindUserByEmailInterface;
use Sirhplus\Api\User\Domain\ResetPassword\InvalidTokenException;
use Sirhplus\Api\User\Domain\ResetPassword\ResetPasswordInterface;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Shared\Domain\Token\GenerateTokenInterface;
use Sirhplus\Shared\Service\ApplicationService;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;

/**
 * class ResetPassword
 * @package Sirhplus\Api\User\Application\ResetPassword
 */
final class ResetPassword implements ApplicationService
{
    /**
     * @param ResetPasswordInterface $resetPassword
     * @param GenerateTokenInterface $generateToken
     * @param FindUserByEmailInterface $findUserByEmail
     */
    public function __construct(
        private readonly ResetPasswordInterface $resetPassword,
        private readonly GenerateTokenInterface $generateToken,
        private readonly FindUserByEmailInterface $findUserByEmail,
        private readonly UserRepositoryInterface $repository
    ) {
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
        $payloads = $this->generateToken->decode($request->token);

        if ($payloads['exp'] < time()) {
            throw new InvalidTokenException();
        }

        $user = $this->findUserByEmail->findUserByEmail($payloads['email']);

        if (!$user) {
            throw new UserNotFound();
        }

        $password = $this->resetPassword->encode($user, $request->password);
        $user->setPassword($password);
        $this->repository->save($user);

        return null;
    }
}
