<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryBySiteUuid;

use Sirhplus\Shared\Service\Request;

final class FindSalaryBySiteUuidRequest implements Request
{
    public function __construct(private string $siteUuid = '')
    {
    }

    /**
     * @return string
     */
    public function getSiteUuid(): string
    {
        return $this->siteUuid;
    }

    /**
     * @param string $siteUuid
     */
    public function setSiteUuid(string $siteUuid): void
    {
        $this->siteUuid = $siteUuid;
    }
}
