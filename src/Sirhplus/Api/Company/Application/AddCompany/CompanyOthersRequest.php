<?php

namespace Sirhplus\Api\Company\Application\AddCompany;

use Sirhplus\Shared\Service\Request;

/**
 * class CompanyOthersRequest
 */
final class CompanyOthersRequest implements Request
{
    /**
     * @param string $schedule
     * @param string $leadingStatus
     * @param string $assignment
     */
    public function __construct(
        public string $schedule = '',
        public string $leadingStatus = '',
        public string $assignment = ''
    ) {
    }
}
