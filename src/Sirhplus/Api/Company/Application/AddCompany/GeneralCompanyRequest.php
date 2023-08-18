<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

/**
 * class GeneralCompanyRequest
 */
final class GeneralCompanyRequest implements Request
{
    /**
     * @param string $name
     * @param string $logo
     * @param string $legalStructure
     * @param string $socialReason
     * @param string $createdAt
     * @param string $sales
     * @param string $address
     * @param string $postalCode
     * @param string $city
     * @param string $site
     * @param string $phoneNumber
     */
    public function __construct(
        public string $name = '',
        public string $logo = '',
        public string $legalStructure = '',
        public string $socialReason = '',
        public string $createdAt = '',
        public string $sales = '',
        public string $address = '',
        public string $postalCode = '',
        public string $city = '',
        public string $site = '',
        public string $phoneNumber = ''
    ) {
    }
}
