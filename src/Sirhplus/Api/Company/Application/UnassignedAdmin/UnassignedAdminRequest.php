<?php

namespace Sirhplus\Api\Company\Application\UnassignedAdmin;

use Sirhplus\Shared\Service\Request;

/**
 * class UnassignedAdminRequest
 */
final class UnassignedAdminRequest implements Request
{
    /**
     * @param array $administratorsUuid
     * @param string $companyUuid
     */
    public function __construct(public readonly array $administratorsUuid = [], public string $companyUuid = '')
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
