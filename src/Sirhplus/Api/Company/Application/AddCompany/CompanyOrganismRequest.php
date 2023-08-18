<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

final class CompanyOrganismRequest implements Request
{
    public string $provisioning;
    public string $healthComplementary;
    public string $pensionFund;

    /**
     * @param string $provisioning
     * @param string $healthComplementary
     * @param string $pensionFund
     */
    public function __construct(string $provisioning = '', string $healthComplementary = '', string $pensionFund = '')
    {
        $this->provisioning = $provisioning;
        $this->healthComplementary = $healthComplementary;
        $this->pensionFund = $pensionFund;
    }
}
