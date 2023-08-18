<?php

namespace Sirhplus\Api\User\Application\SendEmailResetPassword;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

final class SendEmailResetPasswordRequest extends ValueObject implements Request
{
    public string $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
