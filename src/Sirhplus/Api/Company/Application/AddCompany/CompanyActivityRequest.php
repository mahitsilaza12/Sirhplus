<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

final class CompanyActivityRequest implements Request
{
    /**
     * @param string $sector
     * @param string $code
     */
    public function __construct(public string $sector = '', public string $code = '')
    {
    }
}
