<?php

namespace Sirhplus\Api\Functions\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;

/**
 * class EditFunctionModel
 */
final class EditFunctionModel extends FunctionModel
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
     * @return EditFunctionModel
     */
    public static function create(Request $request): EditFunctionModel
    {
        return new self(CompanyUuid::fromString($request->uuid), $request->name);
    }
}
