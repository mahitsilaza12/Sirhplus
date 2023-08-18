<?php

namespace Sirhplus\Api\Functions\Domain\Model;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class FunctionModel
 */
abstract class FunctionModel extends ValueObject implements Request
{
    /**
     * @param CompanyUuid $uuid
     * @param string $name
     */
    public function __construct(public CompanyUuid $uuid, public string $name = '')
    {
    }

    /**
     * @param Request $request
     * @return FunctionModel
     */
    public abstract static function create(Request $request): FunctionModel;
}
