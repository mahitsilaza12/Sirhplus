<?php

namespace Sirhplus\Api\Functions\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class AddFunctionModels
 */
final class AddFunctionModel extends FunctionModel
{
    /**
     * @param CompanyUuid $uuid
     * @param string $name
     */
    public function __construct(public CompanyUuid $uuid, public string $name = '')
    {
        parent::__construct($uuid, $name);
    }

    /**
     * @param Request $request
     * @return AddFunctionModel
     */
    public static function create(Request $request): AddFunctionModel
    {
        return new self(CompanyUuid::fromString($request->companyUuid), $request->name);
    }
}
