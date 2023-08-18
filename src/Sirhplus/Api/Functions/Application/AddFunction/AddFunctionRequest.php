<?php

namespace Sirhplus\Api\Functions\Application\AddFunction;

use Sirhplus\Api\Functions\Application\FunctionRequest;

/**
 * class AddFunctionRequest
 */
final class AddFunctionRequest extends FunctionRequest
{
    /**
     * @param string $companyUuid
     * @param string $name
     */
    public function __construct(public string $companyUuid = '', public string $name = '')
    {
        parent::__construct($companyUuid, $name);
    }
}
