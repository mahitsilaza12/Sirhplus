<?php

namespace Sirhplus\Api\Company\Application;

use Sirhplus\Api\Company\Application\AddCompany\CompanyIdentificationRequest;
use Sirhplus\Api\Company\Application\AddCompany\CompanyOthersRequest;
use Sirhplus\Api\Company\Application\AddCompany\GeneralCompanyRequest;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AbstractCompanyRequest
 */
abstract class AbstractCompanyRequest extends ValueObject implements Request
{
    /**
     * @param GeneralCompanyRequest $general
     * @param CompanyIdentificationRequest $identification
     * @param CompanyOthersRequest $others
     */
    public function __construct(
        public GeneralCompanyRequest $general,
        public CompanyIdentificationRequest $identification,
        public CompanyOthersRequest $others,
    ) {
    }
}
