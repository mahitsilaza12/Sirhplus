<?php

namespace Sirhplus\Api\AbsencePlan\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * class AbsencePlanRequest
 */
abstract class AbsencePlanRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    /**
     * @param string $name
     */
    public function __construct(public string $name = '', public string $companyId = '')
    {
        $this->name = $name;
        $this->companyId = $companyId;
        $this->input = [];
        $this->input['name'] = $name;
        $this->constraint = new Assert\Collection([
            'name' => new Assert\NotBlank([],self::$message)
        ]);
    }

    /**
     * @return mixed
     */
    public function getInput(): mixed
    {
        return $this->input;
    }

    /**
     * @return Collection
     */
    public function getConstraint(): Collection
    {
        return $this->constraint;
    }
}