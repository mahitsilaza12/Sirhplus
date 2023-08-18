<?php

namespace Sirhplus\Api\AbsencePlan\Application\AddAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\AbsencePlanRequest;

final class AddAbsencePlanRequest extends AbsencePlanRequest
{
       /**
     * @param string $name
     */
    public function __construct(public string $name = '', public string $companyId = '')
    {
        parent::__construct($name, $companyId);
    }
}
