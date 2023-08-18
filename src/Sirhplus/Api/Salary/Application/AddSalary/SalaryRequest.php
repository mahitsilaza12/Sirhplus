<?php

namespace Sirhplus\Api\Salary\Application\AddSalary;

use Sirhplus\Shared\Service\Request;

/**
 * class SalaryRequest
 *
 * @package Sirhplus\Api\Salary\Application\AddSalary
 */
final class SalaryRequest implements Request
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
