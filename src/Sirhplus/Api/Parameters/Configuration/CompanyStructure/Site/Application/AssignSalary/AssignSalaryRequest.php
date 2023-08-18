<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\AssignSalary;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AssignSalaryRequest
 */
final class AssignSalaryRequest extends ValueObject implements Request
{
    /**
     * @param array|null $salaries
     * @param string $siteUuid
     */
    public function __construct(public array|null $salaries = [], public string $siteUuid = '')
    {
    }

    /**
     * @param string $siteUuid
     */
    public function setSiteUuid(string $siteUuid): void
    {
        $this->siteUuid = $siteUuid;
    }
}
