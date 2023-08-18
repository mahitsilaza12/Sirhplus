<?php

namespace Sirhplus\Api\User\Application\ResetPassword;

use Sirhplus\Shared\Domain\Exception\InvalidPasswordException;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class ResetPasswordRequest
 *
 * @package Sirhplus\Api\User\Application\ResetPassword
 */
final class ResetPasswordRequest extends ValueObject implements Request
{
    public string $password;
    public string $confirmPassword;
    public string $token;

    /**
     * @param string $password
     * @param string $confirmPassword
     * @param string $token
     */
    public function __construct(string $password, string $confirmPassword, string $token)
    {
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->token = $token;
        $this->validate();
    }

    /**
     * @return void
     */
    private function validate(): void
    {
        if ($this->password !== $this->confirmPassword) {
            throw new InvalidPasswordException();
        }
    }
}
