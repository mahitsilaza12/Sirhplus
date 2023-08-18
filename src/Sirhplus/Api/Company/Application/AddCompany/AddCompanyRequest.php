<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Api\Company\Application\AbstractCompanyRequest;

/**
 * class AddCompanyRequest
 *
 * @package Sirhplus\Api\Company\Application\AddCompany
 */
final class AddCompanyRequest extends AbstractCompanyRequest
{
    /**
     * @param GeneralCompanyRequest $general
     * @param CompanyIdentificationRequest $identification
     * @param CompanyOthersRequest $others
     */
    public function __construct(
        public GeneralCompanyRequest $general,
        public CompanyIdentificationRequest $identification,
        public CompanyOthersRequest $others
    ) {
        parent::__construct($general, $identification, $others);
    }
}
