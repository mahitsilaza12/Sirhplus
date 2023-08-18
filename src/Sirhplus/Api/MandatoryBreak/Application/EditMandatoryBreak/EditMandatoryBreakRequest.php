<?php

namespace Sirhplus\Api\MandatoryBreak\Application\EditMandatoryBreak;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class EditMandatoryBreakRequest
 */
final class EditMandatoryBreakRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    
    /**
     * @var string
     */
    private string $id;
    /**
     * @param string $name
     * @param string $workingTimes
     * @param string $pause
     * @param string $uuid
     */
    public function __construct(
        public string $name = '',
        public string $workingTimes = '',
        public string $pause = '',
        public string $uuid = ''
    )
    {
        $this->name = $name;
        $this->workingTimes = $workingTimes;
        $this->pause = $pause;
        $this->input = [];
        $this->input['name'] = $name;
        $this->input['workingTimes'] = $workingTimes;
        $this->input['pause'] = $pause;
        $this->constraint = new Assert\Collection([
            'name' => new Assert\NotBlank([],self::$message),
            'workingTimes' => new Assert\NotBlank([],self::$message),
            'pause' => new Assert\NotBlank([],self::$message),
        ]);
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return EditMandatoryBreakRequest
     */
    public function setId(string $id): EditMandatoryBreakRequest
    {
        $this->id = $id;

        return $this;
    }

      /**
     * @param string $uuid
     * @return self
     */
    public function sethourlyBreak(string $uuid): self
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