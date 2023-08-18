<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

/**
 * class GeneralCompanyModel
 */
final class GeneralCompanyModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $name
     * @param string $logo
     * @param string $legalStructure
     * @param string $socialReason
     * @param \DateTime $createdAt
     * @param float $sales
     * @param string $address
     * @param string $postalCode
     * @param string $city
     * @param string $site
     * @param string $phoneNumber
     */
    public function __construct(
        private string $name,
        private string $logo,
        private string $legalStructure,
        private string $socialReason,
        private \DateTime $createdAt,
        private float $sales,
        private string $address,
        private string $postalCode,
        private string $city,
        private string $site,
        private string $phoneNumber
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     * @throws \Exception
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->name,
            $request->logo,
            $request->legalStructure,
            $request->socialReason,
            new \DateTime($request->createdAt),
            (float)$request->sales,
            $request->address,
            $request->postalCode,
            $request->city,
            $request->site,
            $request->phoneNumber
        );
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function logo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function legalStructure(): string
    {
        return $this->legalStructure;
    }

    /**
     * @return string
     */
    public function socialReason(): string
    {
        return $this->socialReason;
    }

    /**
     * @return \DateTime
     */
    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return float
     */
    public function sales(): float
    {
        return $this->sales;
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function postalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function site(): string
    {
        return $this->site;
    }

    /**
     * @return string
     */
    public function phoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
