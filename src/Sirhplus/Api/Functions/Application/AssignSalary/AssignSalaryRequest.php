<?php

namespace Sirhplus\Api\Functions\Application\AssignSalary;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * class AssignSalaryRequest
 */
final class AssignSalaryRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;

    /**
     * @param array|null $salaries
     * @param string $uuid
     */
    public function __construct(public array|null $salaries = [], public string $uuid = '')
    {
        $this->input = [];
        $this->validateSalariesValue();
        $this->constraint = new Assert\Collection($this->getFields());
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
        $this->input['uuid'] = $uuid;
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

    private function getFields(): array
    {
        $fields['uuid'] = new Assert\Uuid();
        foreach ($this->salaries as $key => $value) {
            $fields["salary$key"] = new Assert\Uuid();
        }

        return $fields;
    }

    private function validateSalariesValue(): void
    {
        foreach ($this->salaries as $key => $user) {
            $this->input["salary$key"] = $user;
        }
    }
}
