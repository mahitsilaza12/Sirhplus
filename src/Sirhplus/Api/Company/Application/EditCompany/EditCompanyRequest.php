<?php

namespace Sirhplus\Api\Company\Application\EditCompany;

use Sirhplus\Api\Company\Application\AbstractCompanyRequest;
use Sirhplus\Api\Company\Application\AddCompany\CompanyIdentificationRequest;
use Sirhplus\Api\Company\Application\AddCompany\CompanyOthersRequest;
use Sirhplus\Api\Company\Application\AddCompany\GeneralCompanyRequest;

/**
 * class EditCompanyRequest
 *
 * @package Sirhplus\Api\Company\Application\EditCompanyInterface
 */
final class EditCompanyRequest extends AbstractCompanyRequest
{
    /** @var string  */
    private string $uuid;

    /**
     * @param GeneralCompanyRequest $general
     * @param CompanyIdentificationRequest $identification
     * @param CompanyOthersRequest $others
     */
    public function __construct(
        GeneralCompanyRequest $general,
        CompanyIdentificationRequest $identification,
        CompanyOthersRequest $others

    ) {
        parent::__construct($general, $identification, $others);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) :EditCompanyRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}
