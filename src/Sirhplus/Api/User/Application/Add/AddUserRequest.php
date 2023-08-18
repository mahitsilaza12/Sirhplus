<?php

namespace Sirhplus\Api\User\Application\Add;

use Sirhplus\Shared\Service\Request;

final class AddUserRequest implements Request
{
    /**
     * @param string $companyUuid
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $phoneNumber
     * @param string $sex
     * @param string $dateOfBirth
     */
    public function __construct(
        public string $companyUuid,
        public string $email,
        public string $firstName = '',
        public string $lastName = '',
        public string $phoneNumber = '',
        public string $sex = 'M',
        public string $dateOfBirth = ''
    ) {
    }
}
