<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\ValidateRequest;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * class SiteRequest
 */
abstract class SiteRequest extends ValueObject implements Request, ValidateRequest
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
        $this->input = [];
        $this->constraint = null;

        if ('' !== $name && '' !== $companyUuid) {
            $this->input['uuid'] = $companyUuid;
            $this->input['name'] = $name;
            $this->constraint = new Assert\Collection([
                'uuid' => new Assert\Uuid(),
                'name' => new Assert\NotBlank(),
            ]);
        }
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
        $this->input['uuid'] = $uuid;
        $assert['uuid'] = new Assert\Uuid();

        if ('' !== $this->name) {
            $this->input['name'] = $this->name;
            $assert['name'] = new Assert\NotBlank();
        }

        $this->constraint = new Assert\Collection($assert);
    }

    public function getInput(): mixed
    {
        return $this->input;
    }

    public function getConstraint(): ?Collection
    {
        return $this->constraint;
    }
}
