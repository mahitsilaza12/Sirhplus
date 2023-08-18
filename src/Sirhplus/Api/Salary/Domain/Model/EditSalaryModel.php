<?php

namespace Sirhplus\Api\Salary\Domain\Model;

use Sirhplus\Shared\Service\Request;

/**
 * class EditSalaryModel
 */
final class EditSalaryModel extends AbstractSalaryModel
{
    /**
     * @param SalaryModel $salary
     */
    public function __construct(SalaryModel $salary)
    {
        parent::__construct($salary);
    }

    /**
     * @param Request $request
     * @return AbstractSalaryModel
     * @throws \Exception
     */
    public static function create(Request $request): AbstractSalaryModel
    {
        return new self(
            SalaryModel::create($request)
        );
    }
}
