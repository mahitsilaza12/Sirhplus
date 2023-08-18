<?php

namespace Sirhplus\Api\Salary\Application\UnassignedFunction;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * class UnassignedFunctionRequest
 */
final class UnassignedFunctionRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;

    public function __construct(public string $uuid = '', public string $user = '')
    {
        $this->input = [];
        $this->input['user'] = $user;
        $this->constraint = new Assert\Collection([
            'uuid' => new Assert\Uuid(),
            'user' => new Assert\Uuid(),
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

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
        $this->input['uuid'] = $uuid;
    }
}
