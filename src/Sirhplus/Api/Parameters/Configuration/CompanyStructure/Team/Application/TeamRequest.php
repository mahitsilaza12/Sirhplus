<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * class TeamRequest
 */
abstract class TeamRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection|null $constraint;

    /**
     * @param string $uuid
     * @param string $companyUuid
     * @param string $name
     */
    public function __construct(public string $uuid = '', public string $companyUuid = '', public string $name = '')
    {
        if ('' !== $name) {
            $this->input['name'] = $name;
        }

        if ('' !== $companyUuid) {
            $this->input['uuid'] = $companyUuid;
        }
        $this->constraint = null;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
        $this->input['uuid'] = $this->uuid;
        $assert['uuid'] = new Assert\Uuid();

        if ('' !== $this->name) {
            $assert['name'] = new Assert\NotBlank();
        }

        $this->constraint = new Assert\Collection($assert);
    }

    /**
     * @return mixed
     */
    public function getInput(): mixed
    {
        return $this->input;
    }

    /**
     * @return Collection|null
     */
    public function getConstraint(): ?Collection
    {
        return $this->constraint;
    }
}
