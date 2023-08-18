<?php

namespace Sirhplus\Api\Salary\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AbstractSalaryModel
 */
abstract class AbstractSalaryModel extends ValueObject implements Request
{
    /**
     * @param SalaryModel $salary
     */
    public function __construct(
        private SalaryModel $salary
    ) {
    }

    /**
     * @param Request $request
     * @return AbstractSalaryModel
     */
    public abstract static function create(Request $request) :AbstractSalaryModel;

    /**
     * @return SalaryModel
     */
    public function salary(): SalaryModel
    {
        return $this->salary;
    }
}
