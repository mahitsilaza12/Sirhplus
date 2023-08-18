<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

/**
 * class CompanyIdentificationRequest
 *
 * @package Sirhplus\Api\Company\Application\AddCompany
 */
final class CompanyIdentificationRequest implements Request
{
    /**
     * @param CompanyActivityRequest $activity
     * @param CollectiveAgreementRequest $collectiveAgreement
     * @param CompanyOrganismRequest $organism
     * @param string $siren
     * @param string $siret
     * @param string $tva
     * @param string $rcs
     */
    public function __construct(
        public CompanyActivityRequest $activity,
        public CollectiveAgreementRequest $collectiveAgreement,
        public CompanyOrganismRequest $organism,
        public string $siren = '',
        public string $siret = '',
        public string $tva = '',
        public string $rcs = '',
    ) {
    }
}
