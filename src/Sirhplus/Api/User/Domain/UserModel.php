<?php

namespace Sirhplus\Api\User\Domain;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

final class UserModel
{
    public function __construct(
        private readonly CompanyUuid $uuid,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $phoneNumber,
        private readonly string $sex,
        private readonly \DateTime $dob
    ) {
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public static function create(Request $request): UserModel
    {
        return new self(
            CompanyUuid::fromString($request->companyUuid),
            $request->firstName,
            $request->lastName,
            $request->email,
            $request->phoneNumber,
            $request->sex,
            new \DateTime($request->dateOfBirth),
        );
    }

    /**
     * @return CompanyUuid
     */
    public function getCompanyUuid(): CompanyUuid
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return \DateTime
     */
    public function getDob(): \DateTime
    {
        return $this->dob;
    }
}
