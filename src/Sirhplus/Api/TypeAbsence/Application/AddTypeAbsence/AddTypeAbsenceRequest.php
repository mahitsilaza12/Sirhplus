<?php

namespace Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence;

use Sirhplus\Api\TypeAbsence\Application\TypeAbsenceRequest;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class AddTypeAbsenceRequest
 */
final class AddTypeAbsenceRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    /**
     * @var string
     */
    public string $uuid;

    /**
     * @param string $type
     * @param string $color
     * @param boolean $visibility
     * @param string $companyId
     */
    public function __construct(
        public string $type = '',
        public string $color = '',
        public bool $visibility = false,
        public string $companyId = '',

    ) 
    {
        $this->type = $type;
        $this->input = [];
        $this->input['type'] = $type;
        $this->constraint = new Assert\Collection([
            'type' => new Assert\NotBlank([],self::$message)
        ]);
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
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