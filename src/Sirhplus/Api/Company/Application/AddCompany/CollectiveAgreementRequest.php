<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

final class CollectiveAgreementRequest implements Request
{
    public string $details;
    public string $idcc;

    /**
     * @param string $details
     * @param string $idcc
     */
    public function __construct(string $details = '', string $idcc = '')
    {
        $this->details = $details;
        $this->idcc = $idcc;
    }
}