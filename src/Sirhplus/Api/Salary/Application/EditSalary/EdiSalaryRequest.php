<?php

namespace Sirhplus\Api\Salary\Application\EditSalary;

use Sirhplus\Api\Salary\Application\AbstractSalaryRequest;
use Sirhplus\Api\Salary\Application\AddSalary\SalaryRequest;

/**
 * class EdiSalaryRequest
 *
 * @package Sirhplus\Api\Salary\Application\EditSalary
 */
final class EdiSalaryRequest extends AbstractSalaryRequest
{
    /**
     * @param string $uuid
     * @param string $companyUuid
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param string $sex
     * @param string $dateOfBirth
     */
    public function __construct(
        private string $uuid = '',
        string $companyUuid = '',
        string $firstname = '',
        string $lastname = '',
        string $email = '',
        string $phone = '',
        string $sex = '',
        string $dateOfBirth = ''
    ) {
        parent::__construct($companyUuid, $firstname, $lastname, $email, $phone, $sex, $dateOfBirth);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return EdiSalaryRequest
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
