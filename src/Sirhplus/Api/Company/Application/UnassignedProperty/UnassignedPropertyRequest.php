<?php

namespace Sirhplus\Api\Company\Application\UnassignedProperty;

use Sirhplus\Shared\Service\Request;

final class UnassignedPropertyRequest implements Request
{
    /**
     * @param string $userUuid
     * @param string $companyUuid
     */
    public function __construct(public readonly string $userUuid = '', public string $companyUuid = '')
    {
    }

    /**
     * @param string $companyUuid
     */
    public function setCompanyUuid(string $companyUuid): void
    {
        $this->companyUuid = $companyUuid;
    }
}
