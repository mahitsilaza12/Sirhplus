<?php

namespace Sirhplus\Api\AbsencePlan\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AbsencePlanModel
 */
abstract class AbsencePlanModel extends ValueObject implements Request
{

    /**
     * @param string $name
     */
    public function __construct(public string $name = '', public string $companyId = '')
    {
    }

    /**
     * @param Request $request
     * @return AbsencePlanModel
     */
    public abstract static function create(Request $request): AbsencePlanModel;
}