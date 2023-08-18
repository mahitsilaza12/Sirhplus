<?php

namespace Sirhplus\Api\HourlyRegime\Application;

use Sirhplus\Api\HourlyRegime\Application\HourlyRegimeRequest\AdditionalHourRequest;
use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class AbstractHourlyRegimeRequest
 */
abstract class AbstractHourlyRegimeRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    
    /**
     * @param AdditionalHourRequest $additionalHour
     */
    public function __construct(
        public AdditionalHourRequest $additionalHour,
      ) {
        $name = $this->additionalHour->name;
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