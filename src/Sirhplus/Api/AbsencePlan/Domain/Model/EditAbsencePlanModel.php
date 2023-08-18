<?php

namespace Sirhplus\Api\AbsencePlan\Domain\Model;

use Sirhplus\Shared\Service\Request;

final class EditAbsencePlanModel extends AbsencePlanModel
{
    /**
     * @param string $name
     * @param string $companyId
     */
    public function __construct(public string $name = '', public string $companyId = '')
    {
        parent::__construct($name, $companyId);
    }

    /**
     * @param Request $request
     * @return AbsencePlanModel
     */
    public static function create(Request $request): AbsencePlanModel
    {
        return new self($request->name, $request->companyId);
    }
}