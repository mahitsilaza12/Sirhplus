<?php

namespace Sirhplus\Api\Salary\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

abstract class AbstractSalaryRequest extends ValueObject implements Request
{
    public function __construct(
        public string $companyUuid = '',
        public string $firstname = '',
        public string $lastname = '',
        public string $email = '',
        public string $phone = '',
        public string $sex = '',
        public string $dateOfBirth = '',
    ) {
    }
}
